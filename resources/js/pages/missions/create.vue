<template>
    <ContentBody v-if="can('create_mission')">
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
            <NLForm :action="create" :form="form">
                <!-- Control campaigns -->
                <NLColumn v-if="!campaignId" lg="4">
                    <NLSelect v-model="form.control_campaign_id" name="control_campaign_id"
                        loadingText="Chargement de la liste des campagnes de contrôle en cours..."
                        label="Campagne de contrôle" placeholder="Veuillez choisir une campagne de contrôle"
                        noOptionsText="Il n'y a aucune campagne de contrôle pour le moment" :options="campaignsList"
                        :form="form" label-required />
                </NLColumn>
                <NLColumn v-else lg="4">
                    <NLInput v-model="currentCampaignReference" name="campaign" label="Campagne de contrôle" readonly />
                </NLColumn>

                <!-- Agencies -->
                <NLColumn lg="4">
                    <NLSelect v-model="form.agency_id" name="agency_id" label="Agence"
                        placeholder="Veuillez choisir une agence" :options="agenciesList" :form="form" label-required
                        loadingText="Chargement de la liste des agences en cours..."
                        noOptionsText="Il n'y a aucune agence de disponible le moment" :disabled="disabled.agency_id" />
                </NLColumn>

                <NLColumn lg="4"></NLColumn>

                <!-- Start date -->
                <NLColumn lg="4">
                    <NLInputDate v-model="form.programmed_start" :form="form" name="programmed_start" label="Date début"
                        :min="minDateForStart" :max="maxDateForStart" label-required :disabled="disabled.start" />
                </NLColumn>

                <!-- End date -->
                <NLColumn lg="4">
                    <NLInputDate v-model="form.programmed_end" :form="form" name="programmed_end" label="Date fin"
                        :min="minDateForEnd" :max="maxDateForEnd" label-required :disabled="disabled.end" />
                </NLColumn>

                <NLColumn lg="4"></NLColumn>

                <!-- Head of mission -->
                <NLColumn lg="3">
                    <NLSelect v-model="form.head_of_mission_id" name="head_of_mission_id" label="Chef de mission"
                        placeholder="Veuillez choisir un chef de mission" :options="headsOfMissionList" :form="form"
                        label-required loadingText="Chargement de la liste des chefs de mission en cours..."
                        noOptionsText="Vous n'avez aucun chef de mission de disponible pour le moment"
                        :disabled="disabled.head_of_mission_id" />
                </NLColumn>

                <!-- Assistants -->
                <NLColumn lg="3">
                    <NLSelect v-model="form.assistants" name="assistants" label="Contrôleur(s)"
                        placeholder="Veuillez choisir un ou deux contrôleur pour la mission" :options="controllersList"
                        :form="form" loadingText="Chargement de la liste des contrôleurs en cours..."
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
                        <NLButton :loading="formIsLoading" label="Ajouter" />
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
            formIsLoading: false,
            campaignId: null,
            form: new Form({
                note: null,
                programmed_start: null,
                programmed_end: null,
                agency_id: null,
                head_of_mission_id: null,
                assistants: [],
                control_campaign_id: null,
                is_for_testing: false,
            }),
            disabled: {
                agency_id: true,
                head_of_mission_id: true,
                start: true,
                end: true,
                note: true,
                assistants: true
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
        }
    },
    computed: {
        ...mapGetters({
            config: 'missions/config',
        }),
    },
    watch: {
        'form.control_campaign_id': function (newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.initData()
                this.enableFields()
                this.fetchHeadsOfMission()
            } else {
                this.resetForm()
            }
            this.initBreadcrumb()
        },
        'form.head_of_mission_id': function (newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.controllersList = []
                this.form.assistants = []
                this.disabled.assistants = true
                this.fetchControllers()
            } else {
                this.disabled.assistants = true
                this.controllersList = []
            }
        },
        currentCampaignReference: function (newVal, oldVal) {
            if (newVal !== oldVal) {
                this.currentCampaignReference = newVal
            }
        },
        "form.programmed_start": function (newVal, oldVal) {
            if (newVal) {
                this.disabled.end = false
                this.setMinDateForEnd(newVal)
                this.setMaxDateForEnd(this.currentCampaign.end_date)
                this.fetchHeadsOfMission()
            } else {
                this.form.programmed_end = null
                this.disabled.end = true
            }
        },
        "form.programmed_end": function (newVal, oldVal) {
            if (newVal) {
                this.disabled.end = false
                this.setMinDateForEnd(newVal)
                this.setMaxDateForEnd(this.currentCampaign.end_date)
                this.fetchHeadsOfMission()
            } else {
                this.form.programmed_end = null
                this.disabled.end = true
            }
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
            this.minDateForStart = today.diff(campaignStart, 'days') >= 0 ? today.add(1, 'day').format('YYYY-MM-DD') : campaignStart
        },
        /**
         * Set minimum value to choose in calendar for end date
         */
        setMinDateForEnd(campaignStart = null) {
            campaignStart = moment(campaignStart, 'DD-MM-YYYY').format('YYYY-MM-DD')
            let today = moment()
            if (this.form.programmed_start) {
                this.minDateForEnd = today.diff(this.form.programmed_start, 'days') >= 0 && today.diff(campaignStart, 'days') >= 0 ? moment(today).add('2', 'day').format('YYYY-MM-DD') : moment(this.form.programmed_start, 'YYYY-MM-DD').add('1', 'day').format('YYYY-MM-DD')
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
            if (this.$route.params.campaignId) {
                this.form.control_campaign_id = this.$route.params.campaignId
                this.campaignId = this.$route.params.campaignId
            }

            if (!this.campaignsList.length) {
                this.fetchCampaignsList()
            }

            if (this.form.control_campaign_id) {
                this.$api.get('missions/concerns/config?campaign_id=' + this.form.control_campaign_id).then(response => {
                    this.currentCampaign = response.data.currentCampaign
                    this.currentCampaignReference = this.currentCampaign?.reference
                    this.agenciesList = response.data.agencies
                    this.setMinDateForStart(this.currentCampaign.start_date)
                    this.setMinDateForEnd(this.currentCampaign.start_date)
                    this.setMaxDateForStart(this.currentCampaign.end_date)
                    this.setMaxDateForEnd(this.currentCampaign.end_date)
                    this.initBreadcrumb()
                    this.$store.dispatch('settings/updatePageLoading', false)
                })
            }
        },
        /**
         * Set breadcrumb value for current campaign reference
         */
        initBreadcrumb() {
            const length = this.$breadcrumbs.value.length
            if (this.form.control_campaign_id) {
                this.$breadcrumbs.value[ length - 1 ].label = 'Répartition des missions de contrôle de la campagne ' + this.currentCampaignReference
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Répartition des missions de contrôle de la campagne') {
                    this.$breadcrumbs.value[ length - 1 ].parent = 'missions'
                }
            } else {
                this.$breadcrumbs.value[ length - 1 ].label = 'Répartition des missions de contrôle de la campagne'
                this.$breadcrumbs.value[ length - 1 ].parent = 'missions'
            }
        },
        /**
         * Reset form after create success
         */
        resetForm() {
            this.form.note = null
            this.form.programmed_start = null
            this.form.programmed_end = null
            this.form.agency_id = null
            this.form.head_of_mission_id = null
            this.form.assistants = null
            this.form.is_for_testing = false
            this.disableFields()
        },
        /**
         * Disable fields
         *  - assistants
         *  - head_of_mission_id
         *  - end
         */
        disableFields() {
            this.disabled = {
                assistants: true,
                head_of_mission_id: true,
                end: true,
            }
        },
        /**
         * Enable fields
         *  - agency_id
         *  - start
         *  - note
         */
        enableFields() {
            this.disabled.agency_id = false
            this.disabled.start = false
            this.disabled.note = false
        },
        /**
         * Create mission
         */
        create() {
            this.formIsLoading = true
            this.form.post('missions').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.initData()
                    this.resetForm()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
                this.formIsLoading = false
            }).catch(error => {
                this.formIsLoading = false
                this.$swal.catchError(error)
            })
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
            if (this.form.control_campaign_id && this.form.programmed_start && this.form.programmed_end) {
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
            if (this.form.control_campaign_id && this.form.programmed_start && this.form.programmed_end && this.form.head_of_mission_id) {
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
