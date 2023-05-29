<template>
    <ContentBody v-if="mission?.current?.remaining_days_before_start > 5 && can('edit_mission')">
        <ContentHeader>
            <template #actions>
                <button class="btn btn-info has-icon" @click.prevent="cdcModalIsOpen = true">
                    <i class="las la-exclamation-circle icon" />
                    Campagne de contrôle
                </button>
            </template>
        </ContentHeader>

        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
            <div class="grid my-2">
                <!-- Campaign -->
                <div class="col-12 col-lg-6">
                    <NLInput v-model="form.campaign" name="campaign" label="Campagne de contrôle" readonly />
                </div>
                <!-- Agency -->
                <div class="col-12 col-lg-6">
                    <NLInput v-model="form.agency" name="agency" label="Agences" readonly />
                </div>

                <!-- Controllers -->
                <div class="col-12">
                    <NLSelect v-model="form.controllers" name="controllers" label="Contrôleurs"
                        placeholder="Veuillez choisir un ou plusieurs contrôleurs" :options="controllersList" :form="form"
                        label-required :multiple="true" loading-text="Chargement de la liste des contrôleurs en cours"
                        no-options-text="Vous n'avez aucun contrôleur de disponible pour le moment" />
                </div>

                <!-- Start date -->
                <div class="col-12 col-lg-6 col-tablet-6">
                    <NLInput v-model="form.start" :form="form" name="start" label="Date début" type="date" label-required />
                </div>

                <!-- End date -->
                <div class="col-12 col-lg-6 col-tablet-6">
                    <NLInput v-model="form.end" :form="form" name="end" label="Date fin" type="date" label-required />
                </div>

                <!-- Note -->
                <div class="col-12">
                    <NLTextarea v-model="form.note" :form="form" name="note" label="Note" placeholder="Ajouter une note" />
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-end align-center">
                <NLButton :loading="form.busy" label="Mettre à jour" class="is-radius" />
            </div>
        </form>
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
                        <span class="list-item-content content" v-html="currentCampaign?.description"></span>
                    </div>
                </div>
            </template>
        </NLModal>
    </ContentBody>
</template>

<script>
import NLSelect from '../../components/Inputs/NLSelect'
import { mapGetters } from 'vuex'
import Form from 'vform'
export default {
    components: { NLSelect },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    metaInfo() {
        return { title: 'Edition mission de contrôle' }
    },
    breadcrumb() {
        return {
            label: 'Edition mission ' + this.currentCampaign?.reference
        }
    },
    data() {
        return {
            form: new Form({
                note: null,
                start: null,
                end: null,
                agency: null,
                campaign: null,
                controllers: null,
                control_campaign_id: null
            }),
            controllersList: [],
            cdcModalIsOpen: false,
            currentCampaign: null
        }
    },
    computed: mapGetters({
        config: 'missions/config',
        mission: 'missions/current'
    }),
    created() {
        this.initData()
    },
    methods: {
        /**
         * Initialise les données
         */
        initData() {
            this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId, edit: true }).then(() => {
                if (this.mission.current.remaining_days_before_start > 5) {
                    this.$store.dispatch('missions/fetchConfig', this.mission.current.campaign.id).then(() => {
                        this.controllersList = this.config.config.controllers
                    })
                    this.form.agency = this.mission.current.agency.name
                    this.form.campaign = this.mission.current.campaign.reference
                    this.form.control_campaign_id = this.mission.current.campaign.id
                    this.currentCampaign = this.mission.current.campaign
                    this.form.controllers = this.mission.current.agency_controllers.map((controller) => controller.id)
                    this.form.start = this.mission.current.start.split('-').reverse().join('-')
                    this.form.end = this.mission.current.end.split('-').reverse().join('-')
                    this.form.note = this.mission.current.note
                }
            }).catch(error => {
                this.$swal.alert_error(error)
            })
        },
        /**
         * Mise à jour de la mission
         */
        update() {
            this.form.put('/api/missions/' + this.mission.current.id).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                this.$swal.alert_status(error)
            })
        }
    }
}
</script>
