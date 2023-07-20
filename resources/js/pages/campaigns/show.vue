<template>
    <ContentBody v-if="can('view_control_campaign')">
        <div :key="forcedRerenderKey" class="d-flex justify-end align-center gap-3 my-2">
            <template v-if="forcedRerenderKey !== -1">
                <router-link v-if="can('view_mission')"
                    :to="{ name: 'campaign-missions', params: { campaignId: campaign?.current?.id } }" class="btn">
                    Missions
                </router-link>
                <router-link
                    v-if="(campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign')) && !campaign?.current.is_validated"
                    class="btn btn-warning" :to="{ name: 'campaigns-edit', params: { campaignId: campaign?.current?.id } }">
                    <i class="las la-edit icon" />
                </router-link>
                <button
                    v-if="(campaign?.current?.remaining_days_before_start > 5 && can('delete_control_campaign')) && !campaign?.current.is_validated"
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
        <NLDatatable v-if="campaign?.current?.id" :columns="columns" :details="details" :filters="filters"
            title="Liste des processus de la campagne de contrôle"
            :urlPrefix="'campaigns/processes/' + campaign?.current?.id" detailsUrlPrefix="processes"
            @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
            <template #actions-before="{ item, callback }"
                v-if="can('edit_control_campaign') && !campaign?.current.validated_by_id && is(['dcp'])">
                <button class="btn btn-danger has-icon" @click.stop="callback(detachProcess, item)">
                    <i class="las la-unlink icon" />
                </button>
            </template>
        </NLDatatable>
    </ContentBody>
</template>

<script>
import { mapGetters } from 'vuex'
import api from '../../plugins/api'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            forcedRerenderKey: -1,
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
            details: [
                {
                    label: 'Points de contrôle',
                    field: 'control_points.name',
                    hasMany: true
                }
            ],
            filters: {
                family: {
                    label: 'Famille',
                    name: 'family',
                    multiple: true,
                    data: null,
                    value: null
                },
                domain: {
                    label: 'Domaine',
                    name: 'domain',
                    multiple: true,
                    data: null,
                    value: null,
                    dependsOn: 'familly'
                },
            },
        }
    },
    computed: {
        ...mapGetters({
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
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.close()
            const campaignId = this.$route.params.campaignId
            this.$store.dispatch('campaigns/fetch', { campaignId }).then(() => {
                const length = this.$breadcrumbs.value.length
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Détails campagne') {
                    this.$breadcrumbs.value[ length - 1 ].label = 'Détails campagne ' + this.campaign.current?.reference
                }
                this.$store.dispatch('settings/updatePageLoading', false)
            })
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
        destroy(e) {
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
        detachProcess(item) {
            return this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    return api.delete('campaigns/' + this.campaign?.current?.id + '/process/' + item.id)
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
