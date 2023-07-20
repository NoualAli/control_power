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
                    label: 'Contrôle sur place par',
                    field: 'agency_controllers_str',
                    hide: hasRole([ 'ci' ])
                },
                {
                    label: 'Date début',
                    field: 'start',
                    sortable: true,
                },
                {
                    label: 'Date fin',
                    field: 'end',
                    sortable: true,
                },
                {
                    label: 'Moyenne',
                    field: 'avg_score',
                    hide: hasRole([ 'cdc', 'ci' ]),
                    isHtml: true,
                    align: 'center',
                    methods: {
                        showField(item) {
                            const score = Number(item.avg_score)
                            let style = 'text-dark text-bold'
                            if (score === 1) {
                                style = 'bg-success text-white text-bold'
                            } else if (score === 2) {
                                style = 'bg-info text-white text-bold'
                            } else if (score === 3) {
                                style = 'bg-warning text-bold'
                            } else if (score === 4) {
                                style = 'bg-danger text-white text-bold'
                            } else {
                                style = 'bg-grey text-dark text-bold'
                            }
                            return `<div class="container">
                                        <div class="has-border-radius py-1 text-center ${style}">${score}</div>
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
                            let state = 'done'
                            if (item.state === 'En cours') {
                                state = 'inProgress'
                            } else if (item.state === 'À réaliser') {
                                state = 'todo'
                            } else if (item.state === 'Réliser') {
                                state = 'done'
                            } else if (item.state === 'En retard') {
                                state = 'late'
                            } else if (item.state === 'Validé et envoyé') {
                                state = 'validated'
                            } else if (item.state === 'En attente de validation') {
                                state = 'pending-validation'
                            } else if (item.state === '1ère validation') {
                                state = 'first-validation'
                            } else if (item.state === '2ème validation') {
                                state = 'second-validation'
                            }
                            return `<div class="container" title="${item.state}">
                                        <div class="mission-state ${state}"></div>
                                    </div>`
                        }
                    }
                },
                {
                    label: 'Taux de progression',
                    field: 'progress_status',
                    align: 'center',
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
                dre_controllers: {
                    label: 'Contrôleurs',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null,
                    hide: !hasRole([ 'ci' ])
                },
                between: {
                    cols: 3,
                    value: [],
                    type: 'date-range',
                    // cols: 'col-lg-6',
                    attributes: {
                        start: {
                            cols: 'col-lg-6',
                            label: 'De',
                            value: null
                        },
                        end: {
                            cols: 'col-lg-6',
                            label: 'À',
                            value: null
                        }
                    }
                }
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
            console.log(this.$store.getters[ 'settings/pageIsLoading' ]);
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
