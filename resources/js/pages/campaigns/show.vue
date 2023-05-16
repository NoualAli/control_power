<template>
    <ContentBody v-if="can('view_control_campaign')">
        <div :key="forcedRerenderKey" class="d-flex justify-end align-center gap-3 my-2">
            <template v-if="forcedRerenderKey !== -1">
                <router-link v-if="can('view_mission')"
                    :to="{ name: 'campaign-missions', params: { campaignId: campaign?.current?.id } }" class="btn">
                    Missions
                </router-link>
                <router-link
                    v-if="(campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign')) || !campaign?.current.validated_by_id"
                    class="btn btn-warning" :to="{ name: 'campaigns-edit', params: { campaignId: campaign?.current?.id } }">
                    <i class="las la-edit icon" />
                </router-link>
                <button
                    v-if="(campaign?.current?.remaining_days_before_start > 5 && can('delete_control_campaign')) || !campaign?.current.validated_by_id"
                    class="btn btn-danger" @click.stop="destroy">
                    <i class="las la-trash icon" />
                </button>
                <button v-if="!campaign?.current?.validated_by_id && can('validate_control_campaign')"
                    class="btn btn-info has-icon" @click.stop="validate(campaign?.current)">
                    <i class="las la-check icon" />
                </button>
            </template>
        </div>

        <!-- Control campaign informations -->
        <div class="box mb-10 border-primary-dark border-1">
            <div class="grid gap-12">
                <div class="col-12 col-lg-4">
                    <span class="text-bold">
                        Référence:
                    </span>
                    <span class="text-bold">
                        {{ campaign?.current?.reference }}
                    </span>
                </div>
                <div v-has-role="'cdcr,dcp'" class="col-12 col-lg-4">
                    <span class="text-bold">
                        Etat:
                    </span>
                    <span>
                        {{ campaign?.current?.validated_by_id ? 'Validé' : 'En attente de validation' }}
                    </span>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="grid">
                        <div class="col-12 grid">
                            <div class="col-12 col-lg-6">
                                <span class="text-bold">
                                    Début:
                                </span>
                                <span>
                                    {{ campaign?.current?.start + ' / ' +
                                        campaign?.current?.remaining_days_before_start_str }}
                                </span>
                            </div>
                            <div class="col-12 col-lg-6">
                                <span class="text-bold">
                                    Fin:
                                </span>
                                <span>
                                    {{ campaign?.current?.end + ' / ' +
                                        campaign?.current?.remaining_days_before_end_str }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <span class="text-bold">
                        Description:
                    </span>
                    <br>
                    <div v-if="campaign?.current?.description !== '-'" class="mt-2 content"
                        v-html="campaign?.current?.description" />
                    <span v-else />
                </div>
            </div>
        </div>

        <!-- Processes List -->
        <NLDatatable namespace="campaigns" state-key="processes" :config="config"
            title="Liste des processus de la campagne de contrôle" @show="show" @delete="destroy">
            <template #actions="item">
                <button
                    v-if="campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign') && !campaign?.current.validated_by_id && config.data?.meta?.total > 1 && is('dcp')"
                    class="btn btn-danger has-icon" @click.stop="detachProcess(item.item)">
                    <i class="las la-unlink icon" />
                </button>
            </template>
        </NLDatatable>

        <!-- Process details (control points) -->
        <NLModal :show="rowSelected" @close="close">
            <template #title>
                <small class="tag is-info text-small">
                    {{ rowSelected?.familly_name }}
                </small>
                <small class="tag is-primary-dark text-small mx-1">
                    {{ rowSelected?.domain_name }}
                </small>
                <small class="tag is-warning text-small">
                    {{ rowSelected?.name }}
                </small>
            </template>
            <template #default>
                <p class="text-bold mb-6">
                    Points de contrôle
                </p>
                <div class="grid list">
                    <div v-for="controlPoint in process?.controlPoints" :key="controlPoint.id" class="col-12 list-item">
                        <div class="list-item-content">
                            {{ controlPoint.label }}
                        </div>
                    </div>
                </div>
            </template>
            <template
                v-if="campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign') && config.data?.meta?.total > 1 && is('dcp')"
                #footer>
                <button class="btn btn-danger has-icon"
                    @click.stop="destroy(rowSelected, campaign?.current) && config.data?.meta?.total > 1">
                    <i class="las la-unlink icon" />
                    Détacher
                </button>
            </template>
        </NLModal>
    </ContentBody>
</template>

<script>
import NLDatatable from '../../components/NLDatatable'
import { mapGetters } from 'vuex'
import api from '../../plugins/api'
export default {
    components: {
        NLDatatable
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            forcedRerenderKey: -1,
            rowSelected: null,
            config: {
                data: null,
                columns: [
                    {
                        label: 'Famille',
                        field: 'familly_name'
                    },
                    {
                        label: 'Domaine',
                        field: 'domain_name'
                    },
                    {
                        label: 'Processus',
                        field: 'name'
                    },
                    {
                        label: 'Total points de contrôle',
                        field: 'control_points_count'
                    }
                ],
                actions: {
                    show: true
                }
            }
        }
    },
    computed: {
        ...mapGetters({
            processes: 'campaigns/processes',
            process: 'processes/controlPoints',
            campaign: 'campaigns/current'
        })
    },
    watch: {
        campaign: {
            immediate: true,
            deep: true,
            handler(newValue, oldValue) {
                if (newValue) {
                    this.forcedRerenderKey = newValue.current.id
                }
            }
        }
    },

    created() {
        this.initData()
    },
    mounted() {
        this.initData()
    },
    methods: {
        initData() {
            this.close()
            const campaignId = this.$route.params.campaignId
            this.$store.dispatch('campaigns/fetch', { campaignId }).then(() => {
                const length = this.$breadcrumbs.value.length
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Détails campagne') {
                    this.$breadcrumbs.value[ length - 1 ].label = 'Détails campagne ' + this.campaign.current?.reference
                }
            })
            this.$store.dispatch('campaigns/fetchProcesses', campaignId).then(() => { this.config.data = this.processes.processes })
        },
        loadControlPoints(process) {
            this.$store.dispatch('processes/fetch', { id: process.id, onlyControlPoints: true }).then(() => { this.control_points = this.process.controlPoints })
        },
        /**
         * Valide une campagne de contrôle
         *
         * @param {Object} item
         */
        validate(item) {
            this.$swal.confirm({ title: 'Validation', message: 'Validation de la campagne de contrôle ' + item.reference, icon: 'success' }).then(response => {
                if (response.isConfirmed) {
                    api.put('campaigns/' + item.id + '/validate').then(response => {
                        if (response.data.status) {
                            this.initData()
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                this.$swal.alert_error(error)
            })
        },
        /**
         * Delete campaign
         */
        destroy() {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('campaigns/' + this.campaign?.current?.id).then(response => {
                        if (response.data.status) {
                            this.$swal.toast_success(response.data.message)
                            this.$router.push({ name: 'campaigns' })
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                    }).catch(error => {
                        console.log(error)
                    })
                }
            })
        },

        /**
         * Detach specific process from campaign
         *
         * @param {Object} process
         */
        detachProcess(process) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('campaigns/' + this.campaign?.current?.id + '/process/' + process.id).then(response => {
                        if (response.data.status) {
                            this.initData()
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                    }).catch(error => {
                        console.log(error)
                    })
                }
            })
        },
        show(item) {
            this.rowSelected = item
            this.loadControlPoints(item)
        },
        close() {
            this.rowSelected = null
        }
    }
}
</script>
