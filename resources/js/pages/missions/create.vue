<template>
    <ContentBody v-if="can('create_mission')">
        <ContentHeader>
            <template #actions>
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
                    <NLSelect v-model="form.control_campaign_id" name="control_campaign_id" label="Campagne de contrôle"
                        placeholder="Veuillez choisir une campagne de contrôle" :options="campaignsList" :form="form"
                        label-required />
                </NLColumn>
                <NLColumn v-else lg="4">
                    <NLInput v-model="currentCampaignReference" name="campaign" label="Campagne de contrôle" readonly />
                </NLColumn>

                <!-- Agencies -->
                <NLColumn lg="4">
                    <NLSelect v-model="form.agency" name="agency" label="Agence" placeholder="Veuillez choisir une agence"
                        :options="agenciesList" :form="form" label-required :disabled="disabled.agency" />
                </NLColumn>

                <!-- Controllers -->
                <NLColumn lg="4">
                    <NLSelect v-model="form.controller" name="controller" label="Contrôleur"
                        placeholder="Veuillez choisir un contrôleur" :options="controllersList" :form="form" label-required
                        loading-text="Chargement de la liste des contrôleurs en cours"
                        no-options-text="Vous n'avez aucun contrôleur de disponible pour le moment"
                        :disabled="disabled.controller" />
                </NLColumn>

                <!-- Start date -->
                <NLColumn lg="6" md="6">
                    <NLInputDate v-model="form.programmed_start" :form="form" name="programmed_start" label="Date début"
                        :min="minDateForStart" :max="maxDateForStart" label-required :disabled="disabled.start" />
                </NLColumn>

                <!-- End date -->
                <NLColumn lg="6" md="6">
                    <NLInputDate v-model="form.programmed_end" :form="form" name="programmed_end" label="Date fin"
                        :min="minDateForEnd" :max="maxDateForEnd" label-required :disabled="disabled.end" />
                </NLColumn>

                <!-- Note -->
                <NLColumn>
                    <NLWyswyg v-model="form.note" :form="form" name="note" label="Note" :length="1000"
                        placeholder="Ajouter une note" :disabled="disabled.note" />
                </NLColumn>

                <NLColumn lg="6" v-if="!currentCampaign?.is_for_testing">
                    <NLSwitch v-model="form.is_for_testing" name="is_for_testing" :form="form" label="Mission TEST"
                        type="is-success" />
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
                agency: null,
                controller: null,
                control_campaign_id: null,
                is_for_testing: false,
            }),
            disabled: {
                agency: true,
                controller: true,
                start: true,
                end: true,
                note: true
            },
            currentCampaign: null,
            campaignsList: [],
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
            console.log(newVal, oldVal);
            if (newVal !== oldVal && newVal) {
                this.initData()
            } else {
                this.resetForm()
            }
            this.initBreadcrumb()
        },
        currentCampaignReference: function (newVal, oldVal) {
            if (newVal !== oldVal) {
                this.currentCampaignReference = newVal
            }
        },
        "form.programmed_start": function (newVal, oldVal) {
            this.setMinDateForEnd(this.currentCampaign.start_date)
            this.setMaxDateForEnd(this.currentCampaign.end_date)
        }
    },

    created() {
        this.initData()
    },
    methods: {
        /**
         * Enable / Disable fields
         */
        handleFieldsState() {
            for (const key in this.disabled) {
                if (Object.hasOwnProperty.call(this.disabled, key)) {
                    const element = this.disabled[ key ];
                    let condition = true
                    if (key == 'end') {
                        condition = this.form.programmed_start !== null && this.form.programmed_start !== undefined
                    }
                    if ((element || this.form.control_campaign_id) && condition) {
                        this.disabled[ key ] = false
                    } else {
                        this.disabled[ key ] = true
                    }
                }
            }
        },
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
            this.minDateForEnd = today.diff(this.form.programmed_start, 'days') >= 0 && today.diff(campaignStart, 'days') >= 0 ? moment(today).add('2', 'day').format('YYYY-MM-DD') : moment(this.form.programmed_start, 'YYYY-MM-DD').add('1', 'day').format('YYYY-MM-DD')
            if (this.disabled.end) {
                this.disabled.end = false
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
         * Initialise les données
         */
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.resetForm()
            if (this.$route.params.campaignId) {
                this.form.control_campaign_id = this.$route.params.campaignId
                this.campaignId = this.$route.params.campaignId
            }
            if (this.form.control_campaign_id) {
                this.$store.dispatch('missions/fetchConfig', this.form.control_campaign_id).then(() => {
                    this.agenciesList = this.config?.config.agencies
                    this.controllersList = this.config?.config.controllers
                    this.campaignsList = this.config?.config.campaigns
                    this.currentCampaign = this.config?.config.currentCampaign
                    this.setMinDateForStart(this.currentCampaign.start_date)
                    this.setMinDateForEnd(this.currentCampaign.start_date)
                    this.setMaxDateForStart(this.currentCampaign.end_date)
                    this.setMaxDateForEnd(this.currentCampaign.end_date)
                    this.form.control_campaign_id = this.currentCampaign?.id
                    this.currentCampaignReference = this.currentCampaign?.reference
                    this.handleFieldsState()
                    this.initBreadcrumb()
                    this.$store.dispatch('settings/updatePageLoading', false)
                })
            } else {
                this.fetchCampaignsList()
            }
        },
        fetchCampaignsList() {
            this.$store.dispatch('missions/fetchConfig').then(() => {
                this.campaignsList = this.config.config.campaigns
                this.initBreadcrumb()
                this.$store.dispatch('settings/updatePageLoading', false)
            })
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
            this.form.agency = null
            this.form.controller = null
            this.form.is_for_testing = false
            this.handleFieldsState()
        },
        /**
         * Création de la mission
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
                console.log(error)
                this.formIsLoading = false
            })
        }
    }
}
</script>
