<template>
    <ContentBody v-if="can('create_mission')">
        <ContentHeader>
            <template #actions>
                <button class="btn btn-info has-icon" @click.prevent="cdcModalIsOpen = true">
                    <i class="las la-exclamation-circle icon" />
                    Campagne de contrôle
                </button>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLForm :action="create" :form="form">
                <!-- Control campaigns -->
                <NLColumn v-if="!campaignId" lg="6">
                    <NLSelect v-model="form.control_campaign_id" name="control_campaign_id" label="Campagne de contrôle"
                        placeholder="Veuillez choisir une campagne de contrôle" :options="campaignsList" :form="form"
                        label-required />
                </NLColumn>
                <NLColumn v-else lg="6">
                    <NLInput v-model="currentCampaignReference" name="campaign" label="Campagne de contrôle" readonly />
                </NLColumn>
                <!-- Agencies -->
                <NLColumn lg="6">
                    <NLSelect v-model="form.agency" name="agency" label="Agence" placeholder="Veuillez choisir une agence"
                        :options="agenciesList" :form="form" label-required />
                </NLColumn>

                <!-- Controllers -->
                <NLColumn>
                    <NLSelect v-model="form.controllers" name="controllers" label="Contrôleurs"
                        placeholder="Veuillez choisir un ou plusieurs contrôleurs" :options="controllersList" :form="form"
                        label-required :multiple="true" loading-text="Chargement de la liste des contrôleurs en cours"
                        no-options-text="Vous n'avez aucun contrôleur de disponible pour le moment" />
                </NLColumn>

                <!-- Start date -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.programmed_start" :form="form" name="programmed_start" label="Date début"
                        type="date" label-required />
                </NLColumn>

                <!-- End date -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.programmed_end" :form="form" name="programmed_end" label="Date fin" type="date"
                        label-required />
                </NLColumn>

                <!-- Note -->
                <NLColumn>
                    <NLWyswyg v-model="form.note" :form="form" name="note" label="Note" :length="1000"
                        placeholder="Ajouter une note" />
                </NLColumn>

                <NLColumn>
                    <!-- Submit Button -->
                    <NLFlex lgJustifyContent="end">
                        <NLButton :loading="formIsLoading" label="Ajouter" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
            <!-- Control campaign informations -->
            <NLModal :show="cdcModalIsOpen" @close="cdcModalIsOpen = false">
                <template #title>
                    {{ currentCampaign?.reference }}
                </template>
                <template #default>
                    <div class="list grid gap-12">
                        <div class="col-12 col-lg-6 list-item">
                            <span class="list-item-label">
                                Début
                            </span>
                            <span class="list-item-content">
                                {{ currentCampaign?.start_date + ' / ' +
                                    currentCampaign?.remaining_days_before_start_str }}
                            </span>
                        </div>
                        <div class="col-12 col-lg-6 list-item">
                            <span class="list-item-label">
                                Fin
                            </span>
                            <span class="list-item-content">
                                {{ currentCampaign?.end_date + ' / ' +
                                    currentCampaign?.remaining_days_before_end_str }}
                            </span>
                        </div>
                        <div class="col-12 list-item">
                            <span class="list-item-label">
                                Description:
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
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            formIsLoading: false,
            campaignId: null,
            form: new Form({
                note: null,
                start: null,
                end: null,
                agency: null,
                controllers: null,
                control_campaign_id: null
            }),
            currentCampaign: null,
            campaignsList: [],
            controllersList: [],
            agenciesList: [],
            cdcModalIsOpen: false,
            currentCampaignReference: null,
        }
    },
    computed: {
        ...mapGetters({
            config: 'missions/config',
        }),
    },
    watch: {
        'form.control_campaign_id': function (newVal, oldVal) {
            if (newVal !== oldVal && newVal !== null && newVal !== undefined) this.initData()
        },
        // 'form.programmed_start': function (newVal, oldVal) {
        //     if (newVal !== oldVal && newVal) this.form.programmed_end = this.addDays(newVal, 15)
        // },
        currentCampaignReference: function (newVal, oldVal) {
            if (newVal !== oldVal) {
                this.currentCampaignReference = newVal
            }
        }
    },

    created() {
        this.initData()
    },
    methods: {
        /**
         * Initialise les données
         */
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            if (this.$route.params.campaignId) {
                this.form.control_campaign_id = this.$route.params.campaignId
                this.campaignId = this.$route.params.campaignId
            }
            this.$store.dispatch('missions/fetchConfig', this.form.control_campaign_id).then(() => {
                this.agenciesList = this.config?.config.agencies
                this.controllersList = this.config?.config.controllers
                this.campaignsList = this.config?.config.campaigns
                this.currentCampaign = this.config?.config.currentCampaign
                this.form.programmed_start = this.currentCampaign.start_date.split('-').reverse().join('-')
                // this.form.programmed_end = this.addDays(this.form.programmed_start, 15)
                this.form.control_campaign_id = this.currentCampaign?.id
                this.currentCampaignReference = this.config?.config.currentCampaign.reference
                const length = this.$breadcrumbs.value.length
                if (this.$breadcrumbs.value[ length - 1 ].lable === 'Répartition des missions de contrôle de la campagne') {
                    this.$breadcrumbs.value[ length - 1 ].lable = 'Répartition des missions de contrôle de la campagne ' + this.currentCampaignReference
                    this.$breadcrumbs.value[ length - 1 ].parent = 'campaign'
                }
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        resetForm() {
            this.form.note = null
            this.form.programmed_start = null
            this.form.programmed_end = null
            this.form.agency = null
            this.form.controllers = null
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
