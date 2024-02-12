<template>
    <ContentBody v-if="can('edit_mission')">
        <ContentHeader>
            <template #right-actions>
                <button class="btn btn-info has-icon" @click.prevent="cdcModalIsOpen = true"
                    v-if="form.control_campaign_id">
                    <i class="las la-exclamation-circle icon" />
                    Campagne de contrôle
                </button>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLForm :action="edit" :form="form">
                <!-- Control campaigns -->
                <NLColumn lg="2">
                    <NLFlex lgDirection="column" extraClass="w-100" gap="3">
                        <label class="form-label">Campagne de contrôle</label>
                        <div class="tag text-small text-bold w-100">
                            {{ currentCampaignReference }}
                        </div>
                    </NLFlex>
                </NLColumn>

                <!-- Agencies -->
                <NLColumn lg="4">
                    <NLSelect v-model="form.agency_id" name="agency_id" label="Agence"
                        placeholder="Veuillez choisir une agence" :options="agenciesList" :form="form" label-required
                        :disabled="disabled.agency_id" loadingText="Chargement de la liste des agences en cours..."
                        noOptionsText="Il n'y a aucune agence de disponible le moment" />
                </NLColumn>

                <NLColumn lg="4"></NLColumn>

                <!-- Start date -->
                <NLColumn lg="3">
                    <NLInputDate v-model="form.programmed_start" :form="form" name="programmed_start" label="Date début"
                        :min="minDateForStart" :max="maxDateForStart" label-required :disabled="disabled.start" />
                </NLColumn>

                <!-- End date -->
                <NLColumn lg="3">
                    <NLInputDate v-model="form.programmed_end" :form="form" name="programmed_end" label="Date fin"
                        :min="minDateForEnd" :max="maxDateForEnd" label-required :disabled="disabled.end" />
                </NLColumn>

                <NLColumn lg="6"></NLColumn>

                <!-- Head of mission -->
                <NLColumn lg="3">
                    <NLSelect v-model="form.head_of_mission_id" name="head_of_mission_id" label="Chef de mission"
                        placeholder="Veuillez choisir un chef de mission" :options="headsOfMissionList" :form="form"
                        label-required loadingText="Chargement de la liste des chefs de mission en cours"
                        noOptionsText="Vous n'avez aucun chef de mission de disponible pour le moment"
                        :disabled="disabled.head_of_mission_id" />
                </NLColumn>

                <!-- Assistants -->
                <NLColumn lg="3">
                    <NLSelect v-model="form.assistants" name="assistants" label="Contrôleur(s)"
                        placeholder="Veuillez choisir un ou deux contrôleur pour la mission" :options="controllersList"
                        :form="form" loadingText="Chargement de la liste des contrôleurs en cours"
                        noOptionsText="Vous n'avez aucun contrôleur de disponible pour le moment"
                        :disabled="disabled.assistants" multiple />
                </NLColumn>

                <!-- Note -->
                <NLColumn>
                    <NLWyswyg v-model="form.note" :form="form" name="note" label="Note" :length="1000"
                        placeholder="Ajouter une note" :disabled="disabled.note" />
                </NLColumn>

                <NLColumn>
                    <!-- Submit Button -->
                    <NLFlex lgJustifyContent="end">
                        <NLButton :loading="formIsLoading" label="Mettre à jour" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
            <!-- Control campaign informations -->
            <NLModal v-show="form.control_campaign_id" :show="cdcModalIsOpen" @close="cdcModalIsOpen = false">
                <template #title>
                    {{ currentCampaign?.reference }}
                </template>
                <template #default>
                    <div class="list grid gap-12">
                        <div class="col-12 col-lg-6 list-item">
                            <span class="list-item-label text-bold">
                                Début
                            </span>
                            <span class="list-item-content">
                                {{ currentCampaign?.start_date + ' / ' +
                                    currentCampaign?.remaining_days_before_start_str }}
                            </span>
                        </div>
                        <div class="col-12 col-lg-6 list-item">
                            <span class="list-item-label text-bold">
                                Fin
                            </span>
                            <span class="list-item-content">
                                {{ currentCampaign?.end_date + ' / ' +
                                    currentCampaign?.remaining_days_before_end_str }}
                            </span>
                        </div>
                        <div class="col-12 list-item">
                            <span class="list-item-label text-bold">
                                Description
                            </span>
                            <div class="list-item-content content" v-html="currentCampaign?.description"></div>
                        </div>
                    </div>
                </template>
            </NLModal>
        </ContentBody>
    </ContentBody>
</template>

<script>
import { mapGetters } from 'vuex'
import Form from 'vform'
import moment from 'moment'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            canLeave: false,
            formIsLoading: false,
            campaignId: null,
            originalData: {
                note: null,
                agency_id: null,
                programmed_start: null,
                programmed_end: null,
                head_of_mission_id: null,
                assistants: [],
            },
            form: new Form({
                note: null,
                agency_id: null,
                programmed_start: null,
                programmed_end: null,
                head_of_mission_id: null,
                assistants: [],
                control_campaign_id: null,
            }),
            disabled: {
                agency_id: false,
                head_of_mission_id: false,
                start: false,
                end: false,
                note: false,
                assistants: false
            },
            currentCampaign: null,
            campaignsList: [],
            headsOfMissionList: [],
            controllersList: [],
            agenciesList: [],
            cdcModalIsOpen: false,
            currentCampaignReference: null,
            minDateForEnd: null,
            minDateForStart: null,
            maxDateForEnd: null,
            maxDateForStart: null,
            canRefresh: false,
        }
    },
    computed: {
        ...mapGetters({
            // config: 'missions/config',
            mission: 'missions/current',
        }),
    },
    watch: {
        "form.programmed_start": function (newVal, oldVal) {
            // console.log('programmed_start', newVal, oldVal, this.canRefresh);
            if (this.canRefresh) {
                if (newVal && newVal !== oldVal) {
                    this.disabled.end = false
                    // this.form.programmed_end = null
                    this.setMinDateForEnd(newVal)
                    this.setMaxDateForEnd(this.currentCampaign.end_date)
                    this.fetchHeadsOfMission()
                    // this.fetchControllers()
                } else {
                    this.form.programmed_end = null
                    this.disabled.end = true
                }
            }
        },
        "form.programmed_end": function (newVal, oldVal) {
            // console.log('programmed_end', newVal, oldVal, this.canRefresh);
            if (this.canRefresh) {
                if (newVal) {
                    this.disabled.end = false
                    this.setMinDateForEnd(newVal)
                    this.setMaxDateForEnd(this.currentCampaign.end_date)
                    this.fetchHeadsOfMission()
                    // this.fetchControllers()
                } else {
                    this.form.programmed_end = null
                    // this.disabled.end = true
                }
            }
        },
        'form.head_of_mission_id': function (newVal, oldVal) {
            // console.log('head_of_mission_id', newVal, oldVal, this.canRefresh);
            if (this.canRefresh) {
                if (newVal !== oldVal && newVal) {
                    // this.controllersList = []
                    // this.form.assistants = []
                    // this.disabled.assistants = true
                    this.fetchControllers()
                } else {
                    this.disabled.assistants = true
                    this.controllersList = []
                }
            }
        },
    },
    beforeRouteLeave(to, from, next) {
        if (!this.canLeave) {
            if (!this.checkIfCanLeave()) {
                next()
            } else {
                this.$swal.confirm({ message: "Êtes-vous sûr de vouloir quitter sans enregistrer les informations de la mission <b>" + this.mission?.current?.reference + "</b>" }).then(action => {
                    if (action.isConfirmed) {
                        next()
                    } else {
                        next(false)
                    }
                })
            }
        } else {
            next()
        }
    },
    created() {
        this.initData()
    },
    methods: {
        /**
         * Set minimum value to choose in calendar for start date
         */
        setMinDateForStart(campaignStart = null) {
            campaignStart = moment(campaignStart, 'DD-MM-YYYY').format('YYYY-MM-DD')
            let today = moment()
            this.minDateForStart = today.diff(campaignStart, 'days') >= 0 ? campaignStart : today.add(1, 'day').format('YYYY-MM-DD')
        },
        /**
         * Set minimum value to choose in calendar for end date
         */
        setMinDateForEnd(campaignStart = null) {
            campaignStart = moment(campaignStart, 'DD-MM-YYYY').format('YYYY-MM-DD')
            let today = moment()
            if (this.form.programmed_start) {
                this.minDateForEnd = today.diff(this.form.programmed_start, 'days') > 0 && today.diff(campaignStart, 'days') > 0 ? moment(today).add('2', 'day').format('YYYY-MM-DD') : moment(this.form.programmed_start, 'YYYY-MM-DD').add('1', 'day').format('YYYY-MM-DD')
            }
        },
        /**
         * Set maximum value to choose in calendar for start date
         */
        setMaxDateForStart(campaignEnd = null) {
            campaignEnd = moment(campaignEnd, 'DD-MM-YYYY').format('YYYY-MM-DD')
            let today = moment()
            this.maxDateForStart = today.diff(campaignEnd, 'days') >= 0 ? today.format('YYYY-MM-DD') : campaignEnd
        },
        /**
         * Set maximum value to choose in calendar for start date
         */
        setMaxDateForEnd(campaignEnd = null) {
            campaignEnd = moment(campaignEnd, 'DD-MM-YYYY');
            let start = moment(this.form.programmed_start, 'YYYY-MM-DD');

            // Calculer la différence entre la date de fin de campagne et la date de début de la mission en jours
            let daysDifference = campaignEnd.diff(start, 'day');
            if (daysDifference > 15) {
                // Si l'écart est supérieur à 15 jours, la date maximale est la date de début + 15 jours
                this.maxDateForEnd = start.add(15, 'days').format('YYYY-MM-DD');
            } else {
                // Sinon, la date maximale est la date de fin de campagne
                this.maxDateForEnd = campaignEnd.format('YYYY-MM-DD');
            }
        },
        /**
         * Initialize data
         */
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId }).then(() => {
                let mission = this.mission?.current
                let programmedStart = moment(mission?.programmed_start, 'DD-MM-YYYY').format('YYYY-MM-DD')
                let programmedEnd = moment(mission?.programmed_end, 'DD-MM-YYYY').format('YYYY-MM-DD')

                this.$api.get('missions/concerns/config?mission_id=' + mission?.id + '&campaign_id=' + mission?.campaign?.id + '&head_of_mission_id=' + mission?.assigned_to_ci_id + '&programmed_start=' + programmedStart + '&programmed_end=' + programmedEnd).then(response => {
                    this.currentCampaign = response.data.currentCampaign
                    this.currentCampaignReference = this.currentCampaign?.reference
                    this.agenciesList = response.data.agencies
                    this.headsOfMissionList = response.data.headsOfMission
                    this.controllersList = response.data.controllers

                    this.setMinDateForStart(this.currentCampaign.start_date)
                    this.setMinDateForEnd(this.currentCampaign.start_date)
                    this.setMaxDateForStart(this.currentCampaign.end_date)
                    this.setMaxDateForEnd(this.currentCampaign.end_date)

                    this.disabled.agency_id = false
                    this.disabled.start = false
                    this.disabled.end = false
                    this.disabled.head_of_mission_id = false
                    this.disabled.assistants = false

                    this.form.control_campaign_id = mission?.campaign?.id
                    this.form.note = mission?.note
                    this.form.agency_id = mission?.agency?.id
                    this.form.programmed_start = programmedStart
                    this.form.programmed_end = programmedEnd
                    this.form.head_of_mission_id = mission?.assigned_to_ci_id
                    this.form.assistants = mission?.assistants.map(assistant => assistant.id)

                    this.originalData.note = mission?.note
                    this.originalData.agency_id = mission?.agency?.id
                    this.originalData.programmed_start = programmedStart
                    this.originalData.programmed_end = programmedEnd
                    this.originalData.head_of_mission_id = mission?.assigned_to_ci_id
                    this.originalData.assistants = mission?.assistants.map(assistant => assistant.id)

                    this.initBreadcrumb()
                    this.$store.dispatch('settings/updatePageLoading', false)
                    this.canRefresh = true
                })
            })
        },

        /**
         * Set breadcrumb value for current campaign reference
         */
        initBreadcrumb() {
            this.$breadcrumbs.value[ 2 ].current = true
            this.$breadcrumbs.value[ 2 ].label = 'Modification des informations de la mission ' + (this.mission?.current?.reference || '')
            this.$breadcrumbs.value[ 3 ].label = ''
        },
        /**
         * Update current mission
         */
        edit() {
            let cantLeave = this.checkIfCanLeave()
            if (cantLeave) {
                this.$swal.confirm({ message: "Êtes-vous sûr de vouloir mettre à jour les informations la mission <b>" + this.mission?.current?.reference + "</b>" }).then(action => {
                    if (action.isConfirmed) {
                        this.formIsLoading = true
                        this.form.put('missions/' + this.mission?.current?.id).then(response => {
                            if (response.data.status) {
                                this.$swal.toast_success(response.data.message)
                                this.canLeave = true
                                this.$router.push({ name: 'mission', params: { missionId: this.$route.params.missionId } })
                            } else {
                                this.$swal.alert_error(response.data.message)
                            }
                            this.formIsLoading = false
                        }).catch(error => {
                            this.formIsLoading = false
                            this.$swal.catchError(error)
                        })
                    }
                })
            } else {
                this.formIsLoading = false
                this.$router.push({ name: 'mission', params: { missionId: this.$route.params.missionId } })
            }
        },
        /**
         * Check whatever if user changed form values or not
         */
        checkIfCanLeave() {
            let data = JSON.stringify({
                note: this.form.note,
                agency_id: this.form.agency_id,
                programmed_start: this.form.programmed_start,
                programmed_end: this.form.programmed_end,
                head_of_mission_id: this.form.head_of_mission_id,
                assistants: this.form.assistants,
            })
            let originalData = JSON.stringify(this.originalData)
            return data != originalData
        },
        /**
         * Inititalize campaignsList attribute
         */
        fetchCampaignsList() {
            this.$store.dispatch('missions/fetchConfig').then(() => {
                this.campaignsList = this.config.config.campaigns
                this.initBreadcrumb()
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        /**
         * Inititalize headsOfMission attribute
         */
        fetchHeadsOfMission() {
            if (this.form.control_campaign_id && this.form.programmed_start && this.form.programmed_end && this.canRefresh) {
                this.disabled.head_of_mission_id = false
                this.$api.get('missions/concerns/config?campaign_id=' + this.form.control_campaign_id + '&programmed_start=' + this.form.programmed_start + '&programmed_end=' + this.form.programmed_end).then(response => {
                    this.headsOfMissionList = response.data.headsOfMission
                })
            }
        },
        /**
         * Inititalize controllersList attribute
         */
        fetchControllers() {
            if (this.form.control_campaign_id && this.form.programmed_start && this.form.programmed_end && this.form.head_of_mission_id && this.canRefresh) {
                this.disabled.assistants = false
                this.$api.get('missions/concerns/config?campaign_id=' + this.form.control_campaign_id + '&head_of_mission_id=' + this.form.head_of_mission_id + '&programmed_start=' + this.form.programmed_start + '&programmed_end=' + this.form.programmed_end).then(response => {
                    this.headsOfMissionList = response.data.headsOfMission
                    this.controllersList = response.data.controllers
                })
            }
        }
    }
}
</script>
