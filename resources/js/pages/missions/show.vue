<template>
    <ContentHeader>
        <template class="d-flex justify-between align-center gap-3 mb-9" v-if="!pageLoadingState" #title>
            <h2 class="w-100">Informations de la mission</h2>
            <NLFlex lgJustifyContent="end" extraClass="w-100">
                <router-link v-if="can('view_control_campaign,view_page_control_campaigns')"
                    :to="{ name: 'campaign', params: { campaignId: mission?.current.campaign.id } }" class="btn">
                    Campagne de contrôle
                </router-link>
                <router-link v-if="mission?.current?.remaining_days_before_start > 5 && can('edit_mission')"
                    class="btn btn-warning" :to="{ name: 'missions-edit', params: { missionId: mission?.current.id } }">
                    <i class="las la-edit icon" />
                </router-link>
            </NLFlex>
        </template>
    </ContentHeader>
    <ContentBody v-if="can('view_mission') && forcedRerenderKey !== -1" :key="forcedRerenderKey">

        <!-- Mission informations -->
        <div class="box mb-10" v-if="!pageLoadingState">
            <Alert v-if="mission?.current?.remaining_days_before_start > 0" type="is-info" isInline extraClass="mb-6">
                <p>
                    Nous vous informons que la mission débutera le <b>{{ mission?.current?.start }}</b> dans exactement
                    <b>{{
                        mission?.current?.remaining_days_before_start_str }}</b>
                </p>
            </Alert>
            <NLGrid gap="6">
                <NLColumn lg="4">
                    <NLGrid gap="6">
                        <NLColumn>
                            <span class="text-bold">
                                Mission:
                            </span>
                            <span>
                                {{ mission?.current?.reference }}
                            </span>
                        </NLColumn>
                        <NLColumn>
                            <span class="text-bold">
                                DRE:
                            </span>
                            <span>
                                {{ mission?.current?.dre.full_name }}
                            </span>
                        </NLColumn>
                        <NLColumn>
                            <span class="text-bold">
                                Début:
                            </span>
                            <span>
                                {{ mission?.current?.programmed_start + ' / ' +
                                    mission?.current?.remaining_days_before_start_str }}
                            </span>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn lg="4">
                    <NLGrid gap="6">
                        <NLColumn>
                            <span class="text-bold">
                                Campagne:
                            </span>
                            <span>
                                {{ mission?.current?.campaign.reference }}
                            </span>
                        </NLColumn>
                        <NLColumn>
                            <span class="text-bold">
                                Agence:
                            </span>
                            <span>
                                {{ mission?.current?.agency.full_name }}
                            </span>
                        </NLColumn>
                        <NLColumn>
                            <span class="text-bold">
                                Fin:
                            </span>
                            <span>
                                {{ mission?.current?.end + ' / ' +
                                    mission?.current?.remaining_days_before_end_str }}
                            </span>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn lg="4">
                    <NLGrid gap="6">
                        <NLColumn>
                            <span class="text-bold">
                                Contrôleurs dcp:
                            </span>
                            <span v-if="mission?.current?.dcp_controllers.length">
                                <ul class="d-inline-block ml-6">
                                    <li v-for="controller in mission?.current?.dcp_controllers"
                                        :key="'dcp-controller-' + controller.id">
                                        {{ controller.full_name }}
                                    </li>
                                </ul>
                            </span>
                            <span v-else>-</span>
                        </NLColumn>
                        <NLColumn>
                            <span class="text-bold">
                                Contrôleurs dre:
                            </span>
                            <span>
                                <ul class="d-inline-block ml-6">
                                    <li v-for="controller in mission?.current?.dre_controllers"
                                        :key="'dre_controller-' + controller.id">
                                        {{ controller.full_name }}
                                    </li>
                                </ul>
                            </span>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn lg="4">
                    <span class="text-bold">
                        Taux de progression:
                    </span>
                    <span>
                        {{ mission?.current?.progress_status }}%
                    </span>
                </NLColumn>
                <NLColumn lg="4">
                    <span class="text-bold">
                        Statut:
                    </span>
                    <span>
                        {{ mission?.current?.realisation_state }}
                    </span>
                </NLColumn>
                <NLColumn lg="4">
                    <span class="text-bold">
                        Moyenne:
                    </span>
                    <span>
                        {{ mission?.current?.avg_score }}
                    </span>
                </NLColumn>
                <NLColumn lg="4" v-if="mission?.current?.cdcr_validation_at">
                    <span class="text-bold">
                        1<sup>ère</sup> validation
                    </span>
                    <span>
                        {{ mission?.current?.cdcr_validation_at }}
                    </span>
                </NLColumn>
                <NLColumn lg="4" v-if="mission?.current?.cdcr_validation_at">
                    <span class="text-bold">
                        Validé par:
                    </span>
                    <span>
                        {{ mission?.current?.cdcr_validator?.full_name }}
                    </span>
                </NLColumn>
                <NLColumn lg="4" extraClass="d-none d-lg-block" />
                <NLColumn lg="4" v-if="mission?.current?.dcp_validation_at">
                    <span class="text-bold">
                        2<sup>ème</sup> validation
                    </span>
                    <span>
                        {{ mission?.current?.dcp_validation_at }}
                    </span>
                </NLColumn>
                <NLColumn lg="4" v-if="mission?.current?.dcp_validation_at">
                    <span class="text-bold">
                        Validé par:
                    </span>
                    <span>
                        {{ mission?.current?.dcp_validator?.full_name }}
                    </span>
                </NLColumn>
                <NLColumn>
                    <span class="text-bold">
                        Note:
                    </span>
                    <div v-if="mission?.current?.note" class="mt-2 content" v-html="mission?.current?.note" />
                    <span v-else>-</span>
                </NLColumn>
            </NLGrid>
        </div>

        <!-- Actions -->
        <div class="d-flex align-items gap-2" v-if="!pageLoadingState">
            <button v-if="mission?.current?.is_validated_by_dcp && is(['dcp', 'dg', 'ig', 'sg', 'cdrcp', 'der'])"
                class="btn btn-pdf has-icon" @click="exportReport(false)">
                <i class="las la-file-contract icon" />
                Exporter le rapport
            </button>
            <!-- CDC -->
            <button
                v-if="mission?.current.progress_status == 100 && !mission?.current.cdc_report_exists && mission?.current?.is_validated_by_ci && can('create_cdc_report')"
                class="btn btn-info" @click="showCommentForm('cdc_report')">
                Ajouter votre rapport
            </button>
            <button
                v-if="mission?.current.is_validated_by_ci && !mission?.current.is_validated_by_cdc && mission?.current.cdc_report_exists && can('validate_cdc_report')"
                class="btn btn-success" @click.prevent="validateMission('cdc_report')">
                Valider la mission
            </button>

            <!-- CI -->
            <button
                v-if="mission?.current.progress_status == 100 && !mission?.current.is_validated_by_ci && mission?.current?.ci_report_exists && can('validate_ci_report')"
                class="btn btn-success" @click.prevent="validateMission('ci_report')">
                Valider la mission
            </button>

            <button
                v-if="!mission?.current?.ci_report_exists && !mission?.current?.cdc_report_exists && mission?.current?.progress_status == 100 && can('create_ci_report')"
                class="btn btn-info" @click="showCommentForm('ci_report')">
                Ajouter votre compte-rendu
            </button>

            <!-- CDCR -->
            <button
                v-if="!mission?.current.is_validated_by_cdcr && mission.current.is_validated_by_cdc && can('make_first_validation')"
                class="btn btn-success" @click.prevent="validateMission('cdcr')">
                Valider la mission
            </button>
            <button
                v-if="!mission?.current.is_validated_by_cdcr && mission.current.is_validated_by_cdc && can('assign_mission_processing')"
                class="btn btn-success" @click.prevent="showDispatchForm">
                Assigné
            </button>

            <!-- DCP -->
            <button
                v-if="mission?.current.is_validated_by_cdcr && !mission?.current.is_validated_by_dcp && can('make_second_validation')"
                class="btn btn-success" @click.prevent="validateMission('dcp')">
                Valider la mission
            </button>

            <!-- View report -->
            <button v-if="mission?.current.cdc_report_exists && is('cdc')" class="btn btn-info"
                @click="showCommentForm('cdc_report', true)">
                Rapport de la mission
            </button>
            <button v-if="mission?.current.is_validated_by_cdc && is(['dcp', 'cdcr', 'cc'])" class="btn btn-info"
                @click="showCommentForm('cdc_report', true)">
                Rapport de la mission
            </button>
            <button v-if="mission?.current.is_validated_by_dcp && is(['dg', 'cdrcp', 'da', 'ig', 'der'])"
                class="btn btn-info" @click="showCommentForm('cdc_report', true)">
                Rapport de la mission
            </button>

            <!-- View ci comment -->
            <button v-if="mission?.current.is_validated_by_ci && is('cdc')" class="btn btn-info"
                @click="showCommentForm('ci_report', true)">
                Compte rendu de la mission
            </button>
            <button v-if="mission?.current?.ci_report_exists && is('ci')" class="btn btn-info"
                @click="showCommentForm('ci_report', true)">
                Compte rendu de la mission
            </button>
        </div>

        <NLDatatable v-if="mission?.current?.id && !pageLoadingState" :columns="columns" :details="details"
            :filters="filters" title="Liste des processus" :urlPrefix="'missions/' + mission?.current?.id + '/processes'"
            detailsUrlPrefix="processes">
            <template #actions-after="{ item }">
                <button
                    v-if="can('control_agency,view_mission_detail') && mission?.current?.remaining_days_before_start <= 0"
                    class="btn btn-info has-icon" @click.stop="showProcess(item)">
                    <i v-if="item.progress_status < 100 && !mission?.current.opinion" class="las la-tasks icon" />
                    <i v-else class="las la-list-alt icon" />
                </button>
            </template>
        </NLDatatable>

        <!-- Mission comment -->
        <MissionCommentForm :type="commentType" :mission="mission.current" :readonly="commentReadonly"
            :show="modals.comment" @success="success" @close="close" />

        <!-- Assign mission processing -->
        <MissionAssignationDetailsForm :mission="mission.current" type="cc"
            :title="'Assigné le traitement des anomalies de la mission' + mission?.current?.reference"
            :show="modals.dispatch" @success="success" @close="close" v-if="!pageLoadingState" />
    </ContentBody>
</template>

<script>
import MissionCommentForm from '../../forms/MissionCommentForm'
import MissionAssignationDetailsForm from '../../forms/MissionAssignationDetailsForm.vue'
import { mapGetters } from 'vuex'
import { Form } from 'vform'
import api from '../../plugins/api'
import { hasRole } from '../../plugins/user'
export default {
    components: {
        MissionCommentForm,
        MissionAssignationDetailsForm,
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            forcedRerenderKey: -1,
            controllersList: [],
            commentType: null,
            commentReadonly: false,
            columns: [
                {
                    label: 'Famille',
                    field: 'familly'
                },
                {
                    label: 'Domaine',
                    field: 'domain'
                },
                {
                    label: 'Processus',
                    field: 'name'
                },
                {
                    label: 'Total points de contrôle',
                    field: 'control_points_count',
                    align: 'center',
                    sortable: true,
                },
                {
                    label: 'Taux de progression',
                    field: 'progress_status',
                    align: 'center',
                    sortable: true,
                    hide: !hasRole([ 'ci', 'cdc' ]),
                    methods: {
                        showField(item) {
                            return item.progress_status + '%'
                        }
                    }
                },
                {
                    label: 'Moyenne',
                    field: 'avg_score',
                    hide: !hasRole([ 'dcp', 'cdcr', 'cc' ]),
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
                            return `<div class="has-border-radius py-2 px-4 text-center d-inline-block ${style}">${score}</div>`
                        }
                    }
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
                    value: null,
                    cols: 4
                },
                domain: {
                    label: 'Domaine',
                    name: 'domain',
                    multiple: true,
                    data: null,
                    value: null,
                    cols: 5
                }
            },
            modals: {
                comment: false,
                dispatch: false
            },
            forms: {
                // comment: {},
                dispatch: new Form({
                    controllers: []
                }),
            },
        }
    },
    computed: {
        ...mapGetters({
            mission: 'missions/current',
            pageLoadingState: 'settings/pageIsLoading',
        }),
    },
    watch: {
        mission: {
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
        /**
         * Export or Preview report
         *
         * @param {Boolean} preview
         */
        exportReport(preview) {
            let url = '/api/missions/' + this.mission.current.id + '/export?type=pdf'
            if (preview) {
                url += '&mode=preview'
            } else {
                url += '&mode=download'
            }
            window.open(url)
        },

        /**
         * Dispatch mission
         */
        dispatchMission() {
            this.forms.dispatch.put('/api/missions/' + this.mission.current.id + '/assign').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.initData()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                console.log(error)
            })
        },

        /**
         * Show dispatch mission form to cc
         */
        showDispatchForm() {
            // const filters = {
            //     roles_codes: 'cc'
            // }
            // this.$store.dispatch('users/fetchAll', filters).then(() => {
            //     this.controllersList = this.users.all
            //     this.forms.dispatch.controllers = this.mission.current.dcp_controllers.map(controller => controller.id)
            // })
            // this.$sotre.dispatch('missions/fetch', { missionId: this.mission.id, onlyProcesses: true }).then(() => {
            //     console.log(this.current);
            // }).catch(error => console.log(error))
            this.modals.dispatch = true
        },
        /**
         * Show mission comment (ci opinion, cdc report)
         */
        showCommentForm(type, readonly = false) {
            if (type == 'cdc_report') {
                this.showCdcReport(readonly)
            }

            if (type == 'ci_report') {
                this.showCiReport(readonly)
            }
        },
        /**
                 * Initialize ci opinion data
                 *
                 * @param {Boolean} readonly
                 */
        showCiReport(readonly) {
            this.modals.comment = true
            this.commentType = 'ci_report'
            this.commentReadonly = readonly
        },

        /**
         * Initialize cdc report data
         *
         * @param {Boolean} readonly
         */
        showCdcReport(readonly) {
            this.modals.comment = true
            this.commentType = 'cdc_report'
            this.commentReadonly = readonly
        },
        /**
         * Validate mission
         */
        validateMission(type) {
            this.$swal.confirm({ title: 'Mission ' + this.mission.current.reference, message: 'Vous êtes sur de vouloir valider la mission ' + this.mission.current.reference }).then((action) => {
                if (action.isConfirmed) {
                    api.put('/missions/' + this.mission.current.id + '/validate/' + type).then(response => {
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
            })
        },

        /**
         * Initialize data
         */
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId }).then(() => {
                const length = this.$breadcrumbs.value.length
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Mission') { this.$breadcrumbs.value[ length - 1 ].label = 'Mission ' + this.mission?.current?.reference }
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(error => this.$swal.alert_error(error))
        },

        /**
         * Show process control points's
         *
         * @param {Object} item
         */
        showProcess(item) {
            item = item?.item?.id ? item.item : item
            name = 'mission-details'
            return this.$router.push({ name, params: { missionId: this.mission.current.id, processId: item.id } })
        },
        /**
         * Destroy mission
         */
        destroy() {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('missions/' + this.mission?.current.id).then(response => {
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
        /**
         * Close modals
         */
        close({ type, reload }) {
            for (const key in this.modals) {
                if (Object.hasOwnProperty.call(this.modals, key)) {
                    this.modals[ key ] = false;
                }
            }
            if (reload) {
                this.initData()
                if (type) {
                    if (type == 'ci_report') {
                        this.showCiReport(true)
                    }

                    if (type == 'cdc_report') {
                        this.showCdcReport(true)
                    }
                }
                console.log('reloaded');
            }
        },
        /**
         * Handle success event
         */
        success() {
            this.initData()
        },
    }
}
</script>
