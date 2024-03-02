<template>
    <ContentBody v-if="can('view_mission')">
        <NLDatatable :columns="columns" :actions="actions" :filters="filters" title="Suivi des réalisations des missions"
            urlPrefix="missions" :refresh="refresh" @dataLoaded="handleDataLoaded">
            <template #table-actions>
                <router-link v-if="can('create_mission') && campaignId"
                    :to="{ name: 'missions-create', params: { campaignId } }" class="btn">
                    <NLIcon name="add" />
                    Ajouter
                </router-link>
                <button class="btn btn-office-excel has-icon" v-if="!is('da')" @click="this.excelExportIsOpen = true">
                    <NLIcon name="table" />
                    Exporter
                </button>
            </template>
        </NLDatatable>
        <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl + '&export'"
            @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" :hideOptions="true" />
    </ContentBody>
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
                // {
                //     label: 'Agence',
                //     field: 'agency'
                // },
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
                    label: 'Chef de mission',
                    field: 'dre_controller_full_name',
                    hide: hasRole('da'),
                    // align: 'center',
                    sortable: true,
                },
                {
                    label: 'Chef de secteur',
                    field: 'dcp_controller_full_name',
                    hide: !hasRole([ 'cdcr', 'cc', 'dcp', 'root', 'admin' ]),
                    // align: 'center',
                    sortable: true,
                },
                {
                    label: 'Contrôleur DER',
                    field: 'der_controller_full_name',
                    hide: !hasRole([ 'der' ]),
                    // align: 'center',
                    sortable: true,
                },
                {
                    label: 'Moyenne',
                    field: 'avg_score',
                    hide: hasRole([ 'cdc', 'ci', 'da' ]),
                    isHtml: true,
                    align: 'center',
                    sortable: true,
                    methods: {
                        showField(item) {
                            const score = item.avg_score ? parseFloat(item.avg_score).toFixed(2) : '0.00'
                            let style = 'text-dark'
                            if (score >= 1 && score < 2) {
                                style = 'is-success text-white'
                            } else if (score >= 2 && score < 3) {
                                style = 'is-info text-white'
                            } else if (score >= 3 && score < 4) {
                                style = 'is-warning'
                            } else if (score >= 4) {
                                style = 'is-danger text-white'
                            } else {
                                style = 'is-grey text-dark'
                            }
                            return `<div class="tags is-centered">
                                        <span class="tag text-small is-centered w-auto text-center ${style}" title="${score}">${score}</span>
                                    </div>`
                        }
                    }
                },
                {
                    label: 'État',
                    // hide: !hasRole([ 'dcp', 'cdrcp', 'cdcr', 'cc', 'ci', 'cdc', 'da', 'root', 'admin' ]),
                    field: 'current_state',
                    isHtml: true,
                    align: 'center',
                    sortable: true,
                    methods: {
                        showField(item) {
                            let title = ''
                            let state = ''
                            let is_late = Boolean(item.is_late) ? 'is-late' : ''
                            if (hasRole([ 'cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin' ])) {
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
                            } else {
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
                                        title = 'En cours de traitement DCP'
                                        state = MissionState.PENDING_CC_VALIDATION_CLASS
                                        break;
                                    case 5:
                                        title = 'En cours de traitement DCP'
                                        state = MissionState.PENDING_CDCR_VALIDATION_CLASS
                                        break;
                                    case 6:
                                        title = 'En cours de traitement DCP'
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
                    hide: hasRole([ 'cc', 'cder' ]),
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
                        } else if (hasRole([ 'cdcr', 'cc', 'dcp' ])) {
                            return this.can('view_mission') && item.progress_status == 100 && Number(item?.is_validated_by_cdc) == 1
                        } else {
                            return this.can('view_mission') && item.progress_status == 100 && Number(item?.is_validated_by_dcp) == 1
                        }
                    },
                    apply: this.show
                },
                edit: {
                    show: (item) => {
                        return this.can('edit_mission') && item.remaining_days_before_start < 0
                    },
                    apply: this.edit
                },
                delete: {
                    show: (item) => {
                        return this.can('delete_mission') && item.remaining_days_before_start < 0
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
                    hide: hasRole([ 'cdc', 'ci', 'da' ])
                },
                agency: {
                    label: 'Agence',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null,
                    hide: hasRole([ 'da' ])
                },
                current_state: {
                    label: 'État',
                    cols: 3,
                    multiple: true,
                    // hide: !hasRole([ 'dcp', 'cdrcp', 'cdcr', 'cc', 'ci', 'cdc', 'root', 'admin' ]),
                    data: function () {
                        if (!hasRole([ 'cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin' ])) {
                            return [
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
                                    id: 10,
                                    label: 'En cours de traitement DCP'
                                },
                                {
                                    id: MissionState.DONE,
                                    label: MissionState.DONE_STR
                                }
                            ]
                        } else {
                            return [
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
                                    id: MissionState.DONE,
                                    label: MissionState.DONE_STR
                                }
                            ]
                        }
                    },
                    value: null,
                    // hide: hasRole([ 'da', 'cdc', 'ci' ])
                },
                is_late: {
                    label: 'Retard',
                    cols: 3,
                    multiple: false,
                    data: [
                        {
                            id: 'Non',
                            label: 'Non',
                        },
                        {
                            id: 'Oui',
                            label: 'Oui',
                        }
                    ],
                    value: null,
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
                    hide: hasRole([ 'da' ]),
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
                    hide: hasRole([ 'cdc', 'ci', 'da' ]),
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
            if (this.$route.query[ 'filter[is_late]' ]?.length) {
                this.filters.is_late.value = this.$route.query[ 'filter[is_late]' ]
            }
            if (this.$route.query[ 'filter[current_state]' ]?.length) {
                this.filters.current_state.value = this.$route.query[ 'filter[current_state]' ]
            }
            // if (this.$route.query[ 'filter[campaign]' ]?.length) {
            //     this.filters.campaign.value = this.$route.query[ 'filter[campaign]' ]
            // }

            if (this.$route.params.campaignId || this.$route.query[ 'filter[campaign]' ]?.length) {
                let campaignId = null
                if (this.$route.query[ 'filter[campaign]' ]?.length && !this.$route.params.campaignId) {
                    campaignId = this.$route.query[ 'filter[campaign]' ]
                } else {
                    campaignId = this.$route.params.campaignId
                }
                this.filters.campaign.value = campaignId
                this.$store.dispatch('campaigns/fetch', { campaignId }).then((data) => {
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
            return this.$swal.confirm({ message: "Êtes-vous sûr de vouloir supprimer la mission <b>" + e.item.reference + "</b>" }).then((action) => {
                if (action.isConfirmed) {
                    this.refresh += 1
                    return this.$api.delete('missions/' + e.item.id)
                }
            })
        }
    }
}
</script>
