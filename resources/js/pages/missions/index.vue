<template>
    <div v-if="can('view_mission')">
        <ContentHeader v-if="campaignId">
            <template #actions>
                <router-link v-if="can('create_mission')" :to="{ name: 'missions-create', params: { campaignId } }"
                    class="btn btn-info">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" :filters="filters"
                title="Suivi des réalisations des missions" urlPrefix="missions" :key="forceReload"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)" />
        </ContentBody>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { hasRole } from '../../plugins/user'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            forceReload: 1,
            campaignId: null,
            columns: [
                {
                    label: 'CDC-ID',
                    field: 'campaign'
                },
                {
                    label: 'Référence',
                    field: 'reference',
                    sortable: true,
                },
                {
                    label: 'Dre',
                    field: 'dre',
                    hide: hasRole([ 'cdc', 'ci' ])
                },
                {
                    label: 'Agence',
                    field: 'agency'
                },
                {
                    label: 'Date début',
                    field: 'start_date',
                    sortable: true,
                },
                {
                    label: 'Date fin',
                    field: 'end_date',
                    sortable: true,
                },
                {
                    label: 'Moyenne',
                    field: 'avg_score',
                    hide: hasRole([ 'cdc', 'ci' ]),
                    isHtml: true,
                    align: 'center',
                    sortable: true,
                    methods: {
                        showField(item) {
                            const score = Number(item.avg_score)
                            let style = 'text-dark'
                            if (score >= 1 && score < 2) {
                                style = 'bg-success text-white'
                            } else if (score >= 2 && score < 3) {
                                style = 'bg-info text-white'
                            } else if (score >= 3 && score < 4) {
                                style = 'bg-warning'
                            } else if (score >= 4) {
                                style = 'bg-danger text-white'
                            } else {
                                style = 'bg-grey text-dark'
                            }
                            return `<div class="container">
                                        <div class="has-border-radius text-small py-1 text-bold text-center ${style}">${score}</div>
                                    </div>`
                        }
                    }
                },
                {
                    label: 'État',
                    field: 'state',
                    isHtml: true,
                    align: 'center',
                    methods: {
                        showField(item) {
                            let state = 'todo'
                            let title = 'à réaliser'
                            if (item.current_state === 2) {
                                state = 'inProgress'
                                title = 'En cours'
                            } else if (item.current_state === 1) {
                                state = 'todo'
                                title = 'à réaliser'
                            } else if (item.current_state === 8) {
                                state = 'done'
                                title = 'Réaliser'
                            } else if (item.current_state === 9) {
                                state = 'late'
                                title = 'En retard'
                            } else if (item.current_state === 4) {
                                state = 'En attente de validation CDC'
                            } else if (item.current_state === 5) {
                                state = 'pending-validation'
                                title = 'En attente de validation CDCR'
                            } else if (item.current_state === 6) {
                                state = 'first-validation'
                                title = 'En attente de validation DCP'
                            } else if (item.current_state === 7) {
                                state = 'second-validation'
                                title = 'Réaliser et valider'
                            }

                            return `<div class="container" title="${title}">
                                        <div class="mission-state ${state}"></div>
                                    </div>`
                        }
                    }
                },
                {
                    label: 'Taux de progression',
                    field: 'progress_rate',
                    align: 'center',
                    sortable: true,
                    methods: {
                        showField(item) {
                            return item.progress_status + '%'
                        }
                    }
                }
            ],
            actions: {
                show: {
                    show: (item) => {
                        if (hasRole([ 'cdc', 'ci' ])) {
                            return this.can('view_mission')
                        } else if (hasRole([ 'dcp', 'cdcr' ])) {
                            return this.can('view_mission') && item.progress_status.toString() === '100' && item?.is_validated_by_cdc
                        } else if (hasRole([ 'da', 'dg', 'cdrcp', 'ig', 'der' ])) {
                            return this.can('view_mission') && item.progress_status.toString() === '100' && item?.is_validated_by_dcp
                        } else {
                            return this.can('view_mission') && item.progress_status.toString() === '100'
                        }
                    },
                    apply: this.show
                },
                edit: {
                    show: (item) => {
                        return this.can('edit_mission') && item.remaining_days_before_start > 5
                    },
                    apply: this.edit
                },
                delete: {
                    show: (item) => {
                        return this.can('delete_mission') && item.remaining_days_before_start > 5
                    },
                    apply: this.destroy
                }
            },
            filters: {
                campaign: {
                    label: 'Campagne de contrôle',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null
                },
                dre: {
                    label: 'DRE',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null,
                    hide: !hasRole([ 'cdc', 'ci' ])
                },
                agency: {
                    label: 'Agence',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null
                },
                // between: {
                //     cols: 3,
                //     value: [],
                //     type: 'date-range',
                //     // cols: 'col-lg-6',
                //     attributes: {
                //         start: {
                //             cols: 'col-lg-6',
                //             label: 'De',
                //             value: null
                //         },
                //         end: {
                //             cols: 'col-lg-6',
                //             label: 'À',
                //             value: null
                //         }
                //     }
                // }
            },
        }
    },
    computed: mapGetters({
        campaign: 'campaigns/current',
    }),
    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            const length = this.$breadcrumbs.value.length
            if (this.$route.params.campaignId) {
                this.$store.dispatch('campaigns/fetch', { campaignId: this.$route.params.campaignId }).then((data) => {
                    if (this.$breadcrumbs.value[ length - 2 ].label === 'Détails campagne') {
                        this.$breadcrumbs.value[ length - 2 ].label = 'Détails campagne ' + data.reference
                    }
                    // this.$store.dispatch('settings/updatePageLoading', false)
                })
            } else {
                // this.$store.dispatch('settings/updatePageLoading', false)
            }
        },
        show(e) {
            return this.$router.push({ name: 'mission', params: { missionId: e.item.id } })
        },
        edit(e) {
            return this.$router.push({ name: 'missions-edit', params: { missionId: e.item.id } })
        },
        destroy(e) {
            return this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    this.forceReload += 1
                    return this.$api.delete('missions/' + e.item.id)
                }
            })
        }
    }
}
</script>
