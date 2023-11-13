<template>
    <ContentHeader v-if="can('view_mission')">
        <template #title>
            Mission {{ mission?.current?.reference }}
        </template>
        <template class="d-flex justify-between align-center gap-3 mb-9" v-if="!pageLoadingState" #actions>
            <NLFlex lgJustifyContent="end" extraClass="w-100">
                <router-link v-if="can('view_control_campaign,view_page_control_campaigns')"
                    :to="{ name: 'campaign', params: { campaignId: mission?.current.campaign.id } }" class="btn">
                    {{ mission?.current?.campaign?.reference }}
                </router-link>
                <router-link v-if="mission?.current?.remaining_days_before_start > 5 && can('edit_mission')"
                    class="btn btn-warning" :to="{ name: 'missions-edit', params: { missionId: mission?.current.id } }">
                    <i class="las la-edit icon" />
                </router-link>
            </NLFlex>
        </template>
    </ContentHeader>
    <ContentBody v-if="can('view_mission')">

        <!-- Mission informations -->
        <div class="box mb-10">
            <Alert v-if="mission?.current?.remaining_days_before_start > 0" type="is-info" isInline extraClass="mb-6">
                <p>
                    Nous vous informons que la mission débutera le <b>{{ mission?.current?.start }}</b> dans exactement
                    <b>{{
                        mission?.current?.remaining_days_before_start_str }}</b>
                </p>
            </Alert>
            <NLGrid gap="6">
                <!-- Basic informations -->
                <NLColumn>
                    <h2>Informations de base</h2>
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Mission:
                    </span>
                    <span>
                        {{ mission?.current?.reference }}
                    </span>
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Campagne:
                    </span>
                    <span>
                        {{ mission?.current?.campaign?.reference }}
                    </span>
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Dre:
                    </span>
                    <span>
                        {{ mission?.current?.dre?.full_name }}
                    </span>
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Agence:
                    </span>
                    <span>
                        {{ mission?.current?.agency?.full_name }}
                    </span>
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Début:
                    </span>
                    <span>
                        {{ mission?.current?.start }} / {{ mission?.current?.remaining_days_before_start_str }}
                    </span>
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Fin:
                    </span>
                    <span>
                        {{ mission?.current?.end }} / {{ mission?.current?.remaining_days_before_end_str }}
                    </span>
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Taux de progression:
                    </span>
                    <span>
                        {{ mission?.current?.progress_status }}%
                    </span>
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        Statut:
                    </span>
                    <span>
                        {{ current_state_str }}
                    </span>
                </NLColumn>

                <!-- Statistics -->
                <NLColumn>
                    <div class="divider"></div>
                </NLColumn>

                <NLColumn>
                    <h2>Statistiques de base</h2>
                </NLColumn>
                <NLColumn lg="4">
                    <span class="text-bold">
                        Taux d'anomalie:
                    </span>
                    <span>
                        {{ mission?.current?.anomalies_rate }}%
                    </span>
                </NLColumn>
                <NLColumn lg="4">
                    <span class="text-bold">
                        Total anomalies:
                    </span>
                    <span>
                        {{ mission?.current?.total_anomalies || '-' }}
                    </span>
                </NLColumn>
                <NLColumn lg="4">
                    <span class="text-bold">
                        Total points à controlé:
                    </span>
                    <span>
                        {{ mission?.current?.total_details }}
                    </span>
                </NLColumn>
                <NLColumn lg="4">
                    <span class="text-bold">
                        Faits majeur détéctés:
                    </span>
                    <span>
                        {{ mission?.current?.has_major_facts ? 'Oui' : 'Non' }}
                    </span>
                </NLColumn>
                <NLColumn lg="4">
                    <span class="text-bold">
                        Total faits majeurs:
                    </span>
                    <span>
                        {{ mission?.current?.total_major_facts || '-' }}
                    </span>
                </NLColumn>
                <NLColumn lg="4">
                    <span class="text-bold">
                        Moyenne:
                    </span>
                    <span>
                        {{ mission?.current?.avg_score || '-' }}
                    </span>
                </NLColumn>

                <!-- CDC Note -->
                <NLColumn>
                    <div class="divider"></div>
                </NLColumn>

                <NLColumn>
                    <h2>Note du chef de département de contrôle DRE:</h2>
                </NLColumn>
                <NLColumn>
                    <div v-if="mission?.current?.note" class="content text-normal" v-html="mission?.current?.note" />
                    <span v-else>-</span>
                </NLColumn>

                <!-- Signatures -->
                <NLColumn>
                    <div class="divider"></div>
                </NLColumn>
                <NLColumn>
                    <h2>Intervenants</h2>
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        Contrôleurs DRE:
                    </span>
                    {{ mission?.current?.dre_controllers_str || '-' }}
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        Contrôlé le:
                    </span>
                    {{ mission?.current?.ci_validation_at || '-' }}
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Validé par:
                    </span>
                    {{ mission?.current?.cdc_validator?.full_name || '-' }}
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        Validé le:
                    </span>
                    {{ mission?.current?.cdc_validation_at || '-' }}
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Contrôleurs DCP:
                    </span>
                    {{ mission?.current?.dcp_controllers_str || '-' }}
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        Contrôlé le:
                    </span>
                    {{ mission?.current?.cc_validation_at || '-' }}
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Validé par:
                    </span>
                    {{ mission?.current?.cdcr_validator?.full_name || '-' }}
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        1<sup>ère</sup> validation:
                    </span>
                    {{ mission?.current?.cdcr_validation_at || '-' }}
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        Validé par:
                    </span>
                    {{ mission?.current?.dcp_validator?.full_name || '-' }}
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        2<sup>ème</sup> validation:
                    </span>
                    {{ mission?.current?.dcp_validation_at || '-' }}
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        Régularisé par:
                    </span>
                    {{ mission?.current?.da_regularizator?.full_name || '-' }}
                </NLColumn>
                <NLColumn lg="3">
                    <span class="text-bold">
                        Régularisé le
                    </span>
                    {{ mission?.current?.da_validation_at || '-' }}
                </NLColumn>
            </NLGrid>
        </div>

        <NLFlex lgJustifyContent="start" gap="2">
            <!-- Actions -->
            <NLFlex lgJustifyContent="start" gap="2">
                <button v-if="mission?.current?.pdf_report_exists" class="btn btn-pdf has-icon" @click="exportReport()">
                    <i class="las la-file-pdf icon" />
                    Exporter le rapport
                </button>

                <!-- View report -->
                <button
                    v-if="mission?.current.is_validated_by_cdc && is(['dcp', 'cdcr', 'cc', 'dg', 'cdrcp', 'da', 'ig', 'der', 'deac', 'dga'])"
                    class="btn btn-info has-icon" @click="showCommentForm('cdc_report', true)">
                    <i class="las la-file-alt icon" />
                    Conclusion de la mission
                </button>

                <!-- Download files -->
                <button v-if="mission?.current.is_validated_by_cdc" class="btn btn-info has-icon" @click="downloadZip()">
                    <i class="las la-file-archive icon" />
                    Pièces jointes
                </button>
            </NLFlex>

            <NLFlex lgJustifyContent="start" gap="2" v-if="is('root')">
                <button
                    v-if="mission?.current?.is_validated_by_dcp && showGenerateReportBtn && !mission?.current?.pdf_report_exists"
                    class="btn btn-pdf has-icon" @click.prevent="generateReport()">
                    <i class="las la-file-pdf icon" />
                    Regénérer le rapport
                </button>
            </NLFlex>

            <NLFlex lgJustifyContent="start" gap="2" v-if="is('ci')">
                <button
                    v-if="mission?.current.progress_status == 100 && !mission?.current.is_validated_by_ci && mission?.current?.ci_report_exists"
                    class="btn btn-success has-icon" @click.prevent="validateMission('ci')">
                    <i class="las la-check-circle icon" />
                    Valider la mission
                </button>
                <button v-if="mission?.current?.ci_report_exists" class="btn btn-info has-icon"
                    @click="showCommentForm('ci_report', true)">
                    <i class="las la-file-alt icon" />
                    Compte-rendu de la mission
                </button>
                <button
                    v-if="!mission?.current?.ci_report_exists && !mission?.current?.cdc_report_exists && mission?.current?.progress_status == 100"
                    class="btn btn-info has-icon" @click="showCommentForm('ci_report')">
                    <i class="las la-file-medical icon" />
                    Ajouter votre compte-rendu
                </button>
            </NLFlex>

            <NLFlex lgJustifyContent="start" gap="2" v-if="is('cdc')">
                <button
                    v-if="mission?.current.progress_status == 100 && !mission?.current.cdc_report_exists && mission?.current?.is_validated_by_ci"
                    class="btn btn-info has-icon" @click="showCommentForm('cdc_report')">
                    <i class="las la-file-medical icon" />
                    Ajouter votre conclusion
                </button>
                <button
                    v-if="mission?.current.is_validated_by_ci && !mission?.current.is_validated_by_cdc && mission?.current.cdc_report_exists"
                    class="btn btn-success has-icon" @click.prevent="validateMission('cdc')">
                    <i class="las la-check-circle icon" />
                    Valider la mission
                </button>
                <button v-if="mission?.current.cdc_report_exists" class="btn btn-info has-icon"
                    @click="showCommentForm('cdc_report', true)">
                    <i class="las la-file-alt icon" />
                    Conclusion de la mission
                </button>
                <button v-if="mission?.current.is_validated_by_ci" class="btn btn-info has-icon"
                    @click="showCommentForm('ci_report', true)">
                    <i class="las la-file-alt icon" />
                    Compte-rendu de la mission
                </button>
            </NLFlex>

            <NLFlex lgJustifyContent="start" gap="2" v-if="is('cdcr')">
                <button
                    v-if="mission?.current.is_validated_by_cdc && (mission?.current?.has_dcp_controllers ? mission?.current?.is_validated_by_cc && !mission?.current.is_validated_by_cdcr : !mission?.current.is_validated_by_cdcr)"
                    class="btn btn-success has-icon" @click.prevent="validateMission('cdcr')">
                    <i class="las la-check icon" />
                    Valider la mission
                </button>
                <button
                    v-if="(mission?.current?.has_dcp_controllers ? !mission?.current?.is_validated_by_cc && !mission?.current.is_validated_by_cdcr : !mission?.current.is_validated_by_cdcr) && mission?.current.is_validated_by_cdc"
                    class="btn btn-success has-icon" @click.prevent="showDispatchForm">
                    <span v-if="!mission?.current?.dcp_controllers?.length">
                        Déléguer
                    </span>
                    <span v-else>
                        Modifier l'assignation
                    </span>
                </button>
            </NLFlex>

            <NLFlex lgJustifyContent="start" gap="2" v-if="is('cc')">
                <button
                    v-if="!mission?.current?.is_validated_by_cc && mission?.current?.is_validated_by_cdc && mission?.current?.dcp_controllers?.some((controller) => controller.id = currentUser.id)"
                    class="btn btn-success has-icon" @click.prevent="validateMission('cc')">
                    <i class="las la-check-circle icon" />
                    Valider la mission
                </button>
            </NLFlex>

            <NLFlex lgJustifyContent="start" gap="2" v-if="is('dcp')">
                <button v-if="mission?.current.is_validated_by_cdcr && !mission?.current.is_validated_by_dcp"
                    class="btn btn-success has-icon" @click.prevent="validateMission('dcp')">
                    <i class="las la-check-double icon" />
                    Valider la mission
                </button>
            </NLFlex>

            <NLFlex lgJustifyContent="start" gap="2" v-if="is('da')">
                <button
                    v-if="mission?.current?.is_validated_by_dcp && !mission?.current?.is_validated_by_da && mission?.current?.regularization_status == 100"
                    class="btn btn-success has-icon" @click.prevent="validateMission('da')">
                    <i class="las la-check-circle icon" />
                    Valider la mission
                </button>
            </NLFlex>
        </NLFlex>

        <NLDatatable v-if="mission?.current?.id" :columns="columns" :details="details" :filters="filters"
            title="Liste des processus" :urlPrefix="'missions/' + mission?.current?.id + '/processes'"
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
        <MissionCommentForm v-if="mission" :type="commentType" :missionId="mission?.current?.id" :readonly="commentReadonly"
            :show="modals.comment" @success="success" @close="close" />

        <!-- Assign mission processing -->
        <MissionAssignationDetailsForm v-if="mission" :mission="mission?.current" type="cc"
            :title="'Assigné le traitement des anomalies de la mission ' + mission?.current?.reference"
            :show="modals.dispatch" @success="success" @close="close({ type: 'dispatch' })" />
    </ContentBody>
</template>

<script>
import MissionCommentForm from '../../forms/MissionCommentForm'
import MissionAssignationDetailsForm from '../../forms/MissionAssignationDetailsForm.vue'
import { mapGetters } from 'vuex'
import { Form } from 'vform'
import api from '../../plugins/api'
import { hasRole, user } from '../../plugins/user'
export default {
    components: {
        MissionCommentForm,
        MissionAssignationDetailsForm,
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            controllersList: [],
            commentType: null,
            commentReadonly: false,
            showGenerateReportBtn: false,
            currentUser: null,
            columns: [
                {
                    label: 'Famille',
                    field: 'family',
                    sortable: true,
                },
                {
                    label: 'Domaine',
                    field: 'domain',
                    sortable: true,
                },
                {
                    label: 'Processus',
                    field: 'name',
                    sortable: true,
                },
                {
                    label: 'Total points de contrôle',
                    field: 'control_points_count',
                    align: 'center',
                    sortable: true,
                },
                {
                    label: 'Total anomalies',
                    field: 'total_anomalies',
                    align: 'center',
                    sortable: true,
                },
                {
                    label: 'Taux d\'anomalies',
                    field: 'anomalies_rate',
                    align: 'center',
                    sortable: true,
                    methods: {
                        showField(item) {
                            return item.anomalies_rate + '%'
                        }
                    }
                },
                {
                    label: 'Note moyenne',
                    field: 'avg_score',
                    hide: !hasRole([ 'dcp', 'cdcr', 'cc' ]),
                    isHtml: true,
                    align: 'center',
                    sortable: true,
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
                },
                {
                    label: 'Fait majeur',
                    field: 'major_fact',
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
        current_state_str() {
            const TODO_STR = 'À réaliser';
            const ACTIVE_STR = 'En cours';
            const PENDING_CDC_VALIDATION_STR = 'En attente de validation CDC';
            const PENDING_CC_VALIDATION_STR = 'En attente de validation CC';
            const PENDING_CDCR_VALIDATION_STR = 'En attente de validation CDCR';
            const PENDING_DCP_VALIDATION_STR = 'En attente de validation DCP';
            const PENDING_DA_VALIDATION_STR = 'En attente de validation DA';
            const DONE_STR = 'Réalisée, validée et régularisée';
            let status = ''
            let is_late = this.mission?.current?.is_late ? ' / En retard' : ''

            switch (Number(this.mission?.current?.current_state)) {
                case 1:
                    status = TODO_STR
                    break;
                case 2:
                    status = ACTIVE_STR
                    break;
                case 3:
                    status = PENDING_CDC_VALIDATION_STR
                    break;
                case 4:
                    status = PENDING_CC_VALIDATION_STR
                    break;
                case 5:
                    status = PENDING_CDCR_VALIDATION_STR
                    break;
                case 6:
                    status = PENDING_DCP_VALIDATION_STR
                    break;
                case 7:
                    status = PENDING_DA_VALIDATION_STR
                    break;
                case 8:
                    status = DONE_STR
                    break;
                default:
                    status = TODO_STR
                    break;
            }
            return status + is_late
        }
    },
    created() {
        this.initData()
    },
    methods: {
        /**
         * Export or Preview report
         */
        generateReport() {
            this.showGenerateReportBtn = false
            this.$api.get('missions/' + this.mission?.current?.id + '/report?action=generate').then((response) => {
                this.$swal.alert_success('La génération du rapport de la mission ' + this.mission?.current?.reference + ' est en cours, vous recevrez une notification une fois la génération terminer.', 'Génération du rapport PDF')
            }).catch((error) => {
                console.log(error);
            })
        },
        /**
         * Download mission's and detail's media
         *
         */
        downloadZip() {
            window.open('/zip/Mission/' + this.mission?.current?.id)
        },
        /**
         * Export or Preview report
         *
         */
        exportReport() {
            window.open('/missions/' + this.mission?.current?.id + '/report?action=export')
        },

        /**
         * Dispatch mission
         */
        dispatchMission() {
            this.forms.dispatch.put('missions/' + this.mission?.current?.id + '/assign').then(response => {
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
            this.$swal.confirm({ title: 'Mission ' + this.mission?.current.reference, message: 'Vous êtes sur de vouloir valider la mission ' + this.mission?.current.reference }).then((action) => {
                if (action.isConfirmed) {
                    api.put('/missions/' + this.mission?.current.id + '/validate/' + type).then(response => {
                        if (response.data.status) {
                            this.$swal.toast_success(response.data.message)
                            if (type == 'dcp') {
                                this.$swal.alert_success('La génération du rapport de la mission ' + this.mission?.current?.reference + ' est en cours, vous recevrez une notification une fois la génération terminer.', 'Génération du rapport PDF')
                            }
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
            this.currentUser = user()
            this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId }).then(() => {
                this.$api.get('missions/' + this.mission?.current?.id + '/report/check-if-is-generated').then((response) => {
                    this.showGenerateReportBtn = !response.data
                })
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
            return this.$router.push({ name, params: { missionId: this.mission?.current.id, processId: item.id } })
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
