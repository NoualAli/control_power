<template>
    <div v-if="can('view_mission')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_mission') && campaignId"
                    :to="{ name: 'missions-create', params: { campaignId } }" class="btn btn-info">
                    Ajouter
                </router-link>
                <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true"
                    v-if="is(['root', 'admin', 'cdcr', 'dcp'])">
                    <i class="las la-file-excel icon" />
                    Exporter
                </button>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" :filters="filters"
                title="Suivi des réalisations des missions" urlPrefix="missions" :refresh="refresh"
                @dataLoaded="handleDataLoaded" />
            <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl + '&export'"
                @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" :hideOptions="true" />
        </ContentBody>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { hasRole } from '../../plugins/user'
import * as MissionState from '../../store/global/MissionStates'
import ExcelExportModal from '../../Modals/ExcelExportModal';
export default {
    components: { ExcelExportModal },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            currentUrl: null,
            excelExportIsOpen: false,
            refresh: 0,
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
                    field: 'current_state',
                    isHtml: true,
                    align: 'center',
                    sortable: true,
                    methods: {
                        showField(item) {
                            let title = ''
                            let state = ''
                            let is_late = Boolean(item.is_late) ? 'is-late' : ''

                            switch (Number(item.current_state)) {
                                case 1:
                                    title = MissionState.TODO_STR
                                    state = MissionState.TODO_CLASS
                                    break;
                                case 2:
                                    title = MissionState.ACTIVE_STR
                                    state = MissionState.ACTIVE_CLASS
                                    break;
                                case 3:
                                    title = MissionState.PENDING_CDC_VALIDATION_STR
                                    state = MissionState.PENDING_CDC_VALIDATION_CLASS
                                    break;
                                case 4:
                                    title = MissionState.PENDING_CC_VALIDATION_STR
                                    state = MissionState.PENDING_CC_VALIDATION_CLASS
                                    break;
                                case 5:
                                    title = MissionState.PENDING_CDCR_VALIDATION_STR
                                    state = MissionState.PENDING_CDCR_VALIDATION_CLASS
                                    break;
                                case 6:
                                    title = MissionState.PENDING_DCP_VALIDATION_STR
                                    state = MissionState.PENDING_DCP_VALIDATION_CLASS
                                    break;
                                case 7:
                                    title = MissionState.PENDING_DA_VALIDATION_STR
                                    state = MissionState.PENDING_DA_VALIDATION_CLASS
                                    break;
                                case 8:
                                    title = MissionState.DONE_STR
                                    state = MissionState.DONE_CLASS
                                    break;
                                default:
                                    title = MissionState.TODO_STR
                                    state = MissionState.TODO_CLASS
                                    break;
                            }
                            return `<div class="container" title="${title}">
                                        <div class="mission-state ${state} ${is_late}"></div>
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
                        } else if (hasRole([ 'cdcr', 'cc' ])) {
                            return this.can('view_mission') && item.progress_status.toString() === '100' && Number(item?.is_validated_by_cdc) == 1
                        } else if (hasRole('dcp')) {
                            return this.can('view_mission') && item.progress_status.toString() === '100' && Number(item?.is_validated_by_cdcr) == 1
                        } else {
                            return this.can('view_mission') && item.progress_status.toString() === '100' && Number(item?.is_validated_by_dcp) == 1
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
                    hide: hasRole([ 'cdc', 'ci' ])
                },
                agency: {
                    label: 'Agence',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null
                },
                current_state: {
                    label: 'État',
                    cols: 3,
                    multiple: true,
                    data: [
                        {
                            id: MissionState.TODO,
                            label: MissionState.TODO_STR
                        },
                        {
                            id: MissionState.ACTIVE,
                            label: MissionState.ACTIVE_STR
                        },
                        {
                            id: MissionState.PENDING_CDC_VALIDATION,
                            label: MissionState.PENDING_CDC_VALIDATION_STR
                        },
                        {
                            id: MissionState.PENDING_CC_VALIDATION,
                            label: MissionState.PENDING_CC_VALIDATION_STR
                        },
                        {
                            id: MissionState.PENDING_CDCR_VALIDATION,
                            label: MissionState.PENDING_CDCR_VALIDATION_STR
                        },
                        {
                            id: MissionState.PENDING_DCP_VALIDATION,
                            label: MissionState.PENDING_DCP_VALIDATION_STR
                        },
                        {
                            id: MissionState.PENDING_DA_VALIDATION,
                            label: MissionState.PENDING_DA_VALIDATION_STR
                        },
                        {
                            id: MissionState.DONE,
                            label: MissionState.DONE_STR
                        }
                    ]
                },

                progress_status: {
                    label: 'Taux de progression',
                    cols: 3,
                    data: [
                        {
                            id: '-20',
                            label: '< 20%'
                        },
                        {
                            id: '-40',
                            label: '>= 20% et < 40%'
                        },

                        {
                            id: '-60',
                            label: '>= 40% et < 60%'
                        },

                        {
                            id: '-80',
                            label: '>= 60% et < 80%'
                        },

                        {
                            id: '-100',
                            label: '>= 80% et < 100%'
                        },
                        {
                            id: '100',
                            label: '= 100%'
                        },
                    ],
                    value: null
                },

                avg_score: {
                    label: 'Moyenne',
                    cols: 3,
                    data: [
                        {
                            id: 'score >= 1 AND score < 2',
                            label: 'Entre 1 et 2'
                        },
                        {
                            id: 'score >= 2 AND score < 3',
                            label: 'Entre 2 et 3'
                        },
                        {
                            id: 'score >= 3 AND score < 4',
                            label: 'Entre 3 et 4'
                        },
                        {
                            id: 'score = 4',
                            label: '>= 4'
                        },
                    ],
                    value: null,
                    hide: hasRole([ 'cdc', 'ci' ]),
                },
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
        handleDataLoaded(response) {
            this.currentUrl = response.url
            this.$store.dispatch('settings/updatePageLoading', false)
        },
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
            // return this.$router.push({ name: 'mission', params: { missionId: e.item.id } })
            window.open(this.$router.resolve({ name: 'mission', params: { missionId: e.item.id } }).href, '_blank');
        },
        edit(e) {
            // return this.$router.push({ name: 'missions-edit', params: { missionId: e.item.id } })
            window.open(this.$router.resolve({ name: 'missions-edit', params: { missionId: e.item.id } }).href, '_blank');
        },
        destroy(e) {
            return this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    this.refresh += 1
                    return this.$api.delete('missions/' + e.item.id)
                }
            })
        }
    }
}
</script>
