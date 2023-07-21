<template>
    <ContentBody v-if="can('create_mission') && !pageLoadingState">
        <ContentHeader>
            <template #actions>
                <button class="btn btn-info has-icon" @click.prevent="cdcModalIsOpen = true">
                    <i class="las la-exclamation-circle icon" />
                    Campagne de contrôle
                </button>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Control campaigns -->
                <NLColumn lg="6">
                    <NLInput v-model="this.form.campaign" name="campaign" label="Campagne de contrôle" readonly />
                </NLColumn>
                <!-- Agencies -->
                <NLColumn lg="6">
                    <NLInput v-model="form.agency" name="agency" label="Agence" readonly />
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
                    <NLWyswyg v-model="form.note" :form="form" name="note" label="Note" placeholder="Ajouter une note" />
                </NLColumn>
                <NLColumn>
                    <NLFlex lgJustifyContent="end">
                        <NLButton :loading="form.busy" label="Mettre à jour" />
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
                                {{ currentCampaign?.start + ' / ' +
                                    currentCampaign?.remaining_days_before_start_str }}
                            </span>
                        </div>
                        <div class="col-12 col-lg-6 list-item">
                            <span class="list-item-label">
                                Fin
                            </span>
                            <span class="list-item-content">
                                {{ currentCampaign?.end + ' / ' +
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
import NLFlex from '../../components/Grid/NLFlex'
import NLColumn from '../../components/Grid/NLColumn'
import NLForm from '../../components/NLForm'
import ContentBody from '../../components/ContentBody'
import { mapGetters } from 'vuex'
import Form from 'vform'
export default {
    components: {
        NLFlex,
        NLColumn,
        NLForm, ContentBody
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            form: new Form({
                note: null,
                programmed_start: null,
                programmed_end: null,
                agency: null,
                campaign: null,
                controllers: null,
                control_campaign_id: null
            }),
            currentCampaign: null,
            campaignsList: [],
            controllersList: [],
            cdcModalIsOpen: false,
        }
    },
    computed: {
        ...mapGetters({
            config: 'missions/config',
            mission: 'missions/current',
            pageLoadingState: 'settings/pageIsLoading',
        }),
        canBeEdited() {
            return this.mission.current.remaining_days_before_start > 5
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
            this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId, edit: true }).then(() => {
                if (this.canBeEdited) {
                    this.$store.dispatch('missions/fetchConfig', this.mission.current.campaign.id).then(() => {
                        this.controllersList = this.config.config.controllers
                    })
                    this.form.agency = this.mission.current.agency.name
                    this.form.campaign = this.mission.current.campaign.reference
                    this.form.control_campaign_id = this.mission.current.campaign.id
                    this.currentCampaign = this.mission.current.campaign
                    this.form.controllers = this.mission.current.dre_controllers.map((controller) => controller.id)
                    this.form.programmed_start = this.mission.current.programmed_start.split('-').reverse().join('-')
                    this.form.programmed_end = this.mission.current.programmed_end.split('-').reverse().join('-')
                    this.form.note = this.mission.current.note
                } else {
                    this.$swal.alert_error('Vous ne pouvez plus modifier cette mission car le temps restant avant le début de l\'execution de cette dernière est écoulé')
                }
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(error => {
                this.$swal.alert_error(error)
            })
        },
        /**
         * Update mission
         */
        update() {
            this.form.put('missions/' + this.mission.current.id).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.initData()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
