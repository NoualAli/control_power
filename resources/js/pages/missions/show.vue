<template>
    <ContentHeader v-if="can('view_mission')">
        <template #title>
            Mission {{ mission?.current?.reference }}
        </template>

        <template v-if="!pageLoadingState" #right-actions>
            <NLFlex lgJustifyContent="end" extraClass="w-100">
                <router-link v-if="can('view_control_campaign')"
                    :to="{ name: 'campaign', params: { campaignId: mission?.current.campaign.id } }" class="btn">
                    {{ mission?.current?.campaign?.reference }}
                </router-link>
                <router-link v-if="mission?.current?.remaining_days_before_start > 0" class="btn btn-warning has-icon"
                    :to="{ name: 'missions-edit', params: { missionId: mission?.current.id } }">
                    <NLIcon name="edit" />
                    Modifier
                </router-link>
                <NLButton v-if="mission?.current?.remaining_days_before_start > 0 && can('delete_mission')"
                    label="Supprimer" :loading="isLoading.destroy" @click.stop="destroy"
                    class="btn btn-danger has-icon">
                    <NLIcon name="delete" />
                </NLButton>
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
                        {{ mission?.current?.start }} {{ mission?.current?.remaining_days_before_start_str }}
                    </span>
                </NLColumn>

                <NLColumn lg="3">
                    <span class="text-bold">
                        Fin:
                    </span>
                    <span>
                        {{ mission?.current?.end }} {{ mission?.current?.remaining_days_before_end_str }}
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
                <NLColumn lg="4" v-if="!is('da')">
                    <span class="text-bold">
                        Faits majeurs détéctés:
                    </span>
                    <span>
                        {{ mission?.current?.has_major_facts ? 'Oui' : 'Non' }}
                    </span>
                </NLColumn>
                <NLColumn lg="4" v-if="!is('da')">
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
                <NLColumn v-if="mission?.current?.note">
                    <div class="divider"></div>
                </NLColumn>

                <NLColumn v-if="mission?.current?.note">
                    <h2>Note du chef de département de contrôle DRE:</h2>
                </NLColumn>
                <NLColumn v-if="mission?.current?.note">
                    <NLReadMore :value="mission?.current?.note"></NLReadMore>
                    <!-- <div v-if="mission?.current?.note" class="content text-normal" v-html="mission?.current?.note" />
                    <span v-else>-</span> -->
                </NLColumn>

                <!-- Signatures -->
                <NLColumn>
                    <div class="divider"></div>
                </NLColumn>
                <NLColumn>
                    <h2>Intervenants</h2>
                </NLColumn>
                <NLColumn>
                    <NLGrid>
                        <NLColumn>
                            <h2>DRE</h2>
                        </NLColumn>
                        <NLColumn lg="3">
                            <span class="text-bold">
                                Chef de mission:
                            </span>
                            <span v-if="mission?.current?.dre_controller">
                                {{ mission?.current?.dre_controller?.gender == 1 ? 'M' : 'Mme' }}
                            </span>
                            {{ mission?.current?.dre_controller?.full_name || '-' }}
                        </NLColumn>
                        <NLColumn lg="3">
                            <span class="text-bold">
                                Contrôlé le:
                            </span>
                            {{ mission?.current?.ci_validation_at || '-' }}
                        </NLColumn>
                        <NLColumn lg="3">
                            <span class="text-bold">
                                Contrôleur(s):
                            </span>
                            {{ mission?.current?.assistants_str || '-' }}
                        </NLColumn>

                        <NLColumn lg="3">
                            <span class="text-bold">
                                Validé par:
                            </span>
                            {{ mission?.current?.cdc_validator_full_name ?
        mission?.current?.cdc_validator_full_name.replace(' (CDC)', '')
        : '-' }}
                        </NLColumn>
                        <NLColumn lg="3">
                            <span class="text-bold">
                                Validé le:
                            </span>
                            {{ mission?.current?.cdc_validation_at || '-' }}
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <NLColumn v-if="mission?.current?.cdc_validation_at">
                    <NLGrid>
                        <NLColumn>
                            <h2>DCP</h2>
                        </NLColumn>
                        <NLColumn lg="3">
                            <span class="text-bold">
                                Chef de secteur:
                            </span>
                            <span>
                                {{ mission?.current?.cc_validator?.abbreviated_name_with_martial || '-' }}
                            </span>
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
                            {{ mission?.current?.cdcr_validator_full_name ?
        mission?.current?.cdcr_validator_full_name.replace(' (CDCR)', '')
        : '-' }}
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
                            {{ mission?.current?.dcp_validator_full_name ?
        mission?.current?.dcp_validator_full_name.replace(' (DCP)', '') : '-' }}
                        </NLColumn>
                        <NLColumn lg="3">
                            <span class="text-bold">
                                2<sup>ème</sup> validation:
                            </span>
                            {{ mission?.current?.dcp_validation_at || '-' }}
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn v-if="mission?.current?.da_validation_at">
                    <NLGrid>
                        <NLColumn>
                            <h2>Agence</h2>
                        </NLColumn>
                        <NLColumn lg="3">
                            <span class="text-bold">
                                Régularisé par:
                            </span>
                            {{ mission?.current?.da_validator_full_name.replace(' (DA)', '') || '-' }}
                        </NLColumn>
                        <NLColumn lg="3">
                            <span class="text-bold">
                                Régularisé le
                            </span>
                            {{ mission?.current?.da_validation_at || '-' }}
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
            </NLGrid>
        </div>

        <!-- Mission actions -->
        <NLFlex lgJustifyContent="start" gap="2">
            <!-- Actions -->
            <NLFlex lgJustifyContent="start" gap="2">
                <NLButton class="has-icon" type="office-excel" label="Exporter"
                    @click.stop="this.excelExportIsOpen = true"
                    v-if="mission?.current?.progress_status > 0 && is('ci')">
                    <NLIcon name="table" />
                </NLButton>
                <a v-if="mission?.current?.pdf_report_exists" class="btn has-icon" :href="mission?.current?.report_link"
                    target="_blank">
                    <NLIcon name="picture_as_pdf" />
                    Exporter le rapport
                </a>

                <!-- View report -->
                <NLButton v-if="mission?.current.is_validated_by_cdc && can('view_dre_report')" class="has-icon"
                    label="Conclusion de la mission" @click="showCommentForm('cdc_report', true)">
                    <NLIcon name="description" />
                </NLButton>

                <!-- Download files -->
                <NLButton v-if="mission?.current.is_validated_by_cdc" label="Pièces jointes" class="has-icon"
                    @click="downloadZip()">
                    <NLIcon name="folder_zip" />
                </NLButton>
            </NLFlex>

            <NLFlex lgJustifyContent="start" gap="2" v-if="is('root')">
                <NLButton v-if="mission?.current?.is_validated_by_dcp" class="btn btn-pdf has-icon"
                    @click.prevent="generateReport()" label="Regénérer le rapport" :loading="generateReportIsLoading">
                    <NLIcon name="picture_as_pdf" />
                </NLButton>
            </NLFlex>

            <!-- CI ACTIONS -->
            <NLFlex lgJustifyContent="start" gap="2" v-if="is('ci')">
                <NLButton
                    v-if="mission?.current.progress_status == 100 && !mission?.current.is_validated_by_ci && mission?.current?.ci_report_exists && user().id == mission?.current?.assigned_to_ci_id"
                    class="has-icon" type="success" label="Valider la mission" @click.prevent="validateMission('ci')">
                    <NLIcon name="check_circle" />
                </NLButton>
                <NLButton v-if="mission?.current?.ci_report_exists"
                    :label="mission?.current?.assigned_to_ci_id !== user().id ? 'Conclusion du chef de mission' : 'Votre conclusion'"
                    type="info" class="has-icon" @click="showCommentForm('ci_report', true)">
                    <NLIcon name="description" />
                </NLButton>
                <NLButton
                    v-if="!mission?.current?.ci_report_exists && !mission?.current?.cdc_report_exists && mission?.current?.progress_status == 100 && user().id == mission?.current?.assigned_to_ci_id"
                    class="has-icon" type="info" label="Ajouter votre conclusion" @click="showCommentForm('ci_report')">
                    <!-- <NLIcon name="add_note"/> -->
                    <NLIcon name="add_notes" />
                </NLButton>
            </NLFlex>

            <!-- CDC ACTIONS -->
            <NLFlex lgJustifyContent="start" gap="2" v-if="is('cdc')">
                <NLButton
                    v-if="mission?.current.progress_status == 100 && !mission?.current.cdc_report_exists && mission?.current?.is_validated_by_ci"
                    class="has-icon" type="info" label="Ajouter votre conclusion"
                    @click="showCommentForm('cdc_report')">
                    <NLIcon name="add_notes" />
                </NLButton>
                <NLButton
                    v-if="mission?.current.is_validated_by_ci && !mission?.current.is_validated_by_cdc && mission?.current.cdc_report_exists"
                    label="Valider la mission" type="success" class="has-icon" @click.prevent="validateMission('cdc')"
                    loadingLabel="Validation en cours" :loading="isLoading.cdcValidation">
                    <NLIcon name="check_circle" />
                </NLButton>
                <NLButton v-if="mission?.current.is_validated_by_ci" label="Conclusion du chef de mission" type="info"
                    class="has-icon" @click="showCommentForm('ci_report', true)">
                    <NLIcon name="description" />
                </NLButton>
            </NLFlex>

            <!-- CDCR ACTIONS -->
            <NLFlex lgJustifyContent="start" gap="2" v-if="is('cdcr')">
                <NLButton v-if="Number(this.mission?.current?.current_state) == 5" class="has-icon" type="success"
                    label="Valider la mission" :loading="isLoading.cdcrValidation"
                    @click.prevent="validateMission('cdcr')">
                    <NLIcon name="check" />
                </NLButton>
                <NLButton
                    v-if="[4, 5].includes(Number(this.mission?.current?.current_state)) && !this.mission?.current?.is_validated_by_cc"
                    class="has-icon" :type="!mission?.current?.assigned_to_cc_id ? 'info' : 'warning'"
                    :label="!mission?.current?.assigned_to_cc_id ? 'Déléguer' : 'Modifier l\'assignation'"
                    @click.prevent="showDispatchForm">
                    <NLIcon name="account_circle" v-if="!mission?.current?.assigned_to_cc_id" />
                    <NLIcon name="person_edit" v-else />
                </NLButton>
            </NLFlex>
            <!-- CC ACTIONS -->
            <NLFlex lgJustifyContent="start" gap="2" v-if="is('cc')">
                <NLButton
                    v-if="!mission?.current?.is_validated_by_cc && mission?.current?.is_validated_by_cdc && mission?.current?.assigned_to_cc_id == user().id"
                    class="has-icon" type="success" label="Valider la mission" :loading="isLoading.ccValidation"
                    @click.prevent="validateMission('cc')">
                    <NLIcon name="check_circle" />
                </NLButton>
            </NLFlex>

            <!-- DCP ACTIONS -->
            <NLFlex lgJustifyContent="start" gap="2" v-if="is('dcp')">
                <NLButton v-if="mission?.current.is_validated_by_cdc && !mission?.current.is_validated_by_dcp"
                    class="has-icon" type="success" label="Valider la mission" :loading="isLoading.dcpValidation"
                    @click.prevent="validateMission('dcp')">
                    <NLIcon name="done_all" />
                </NLButton>
            </NLFlex>

            <!-- DER ACTIONS -->
            <NLFlex lgJustifyContent="start" gap="2" v-if="is('der')">
                <NLButton v-if="Number(this.mission?.current?.current_state) == 8" class="has-icon"
                    :type="!mission?.current?.assigned_to_cder_id ? 'info' : 'warning'"
                    :label="!mission?.current?.assigned_to_cder_id ? 'Déléguer' : 'Modifier l\'assignation'"
                    @click.prevent="showDispatchForm">
                    <NLIcon name="account_circle" v-if="!mission?.current?.assigned_to_cder_id" />
                    <NLIcon name="person_edit" v-else />
                </NLButton>
            </NLFlex>
        </NLFlex>
        <!-- Assign mission processing -->
        <MissionAssignationDetailsForm v-if="mission" :mission="mission?.current" isFluid :type="controllersType"
            :show="modals.dispatch" @success="close({ reload: true })" @close="close({ type: 'dispatch' })" />

        <NLDatatable v-if="mission?.current?.id" :columns="columns" :details="details" title="Liste des processus"
            :urlPrefix="'agency_level/missions/' + mission?.current?.id + '/processes'" detailsUrlPrefix="processes"
            :refresh="refresh" @dataLoaded="handleDataLoaded">

            <template #actions-after="{ item }">
                <button
                    v-if="can('control_agency,view_mission_detail') && !item.is_disabled && mission?.current?.remaining_days_before_start <= 0"
                    class="btn btn-info has-icon" @click.stop="showProcess(item)">
                    <NLIcon name="list"
                        v-if="item.progress_status_num < 100 && !mission?.current.opinion && !is('cc')" />
                    <NLIcon name="visibility"
                        v-else-if="item.progress_status_num < 100 && !mission?.current.opinion && is('cc') && user().id == item?.assigned_to_cc_id" />
                    <NLIcon name="checklist_rtl" v-else />
                </button>
                <NLButton loadingLabel=""
                    v-if="mission?.current?.remaining_days_before_start <= 0 && item.progress_status_num == 0 && !mission?.current?.is_validated_by_ci && !item.is_disabled && (is('cdc') || (is('ci') && user().id == mission?.current?.assigned_to_ci_id))"
                    class="btn btn-danger has-icon" :loading="lockProcessIsLoading == item.id"
                    @click.stop="lockProcess(item)">
                    <NLIcon name="lock" />
                </NLButton>
                <NLButton loadingLabel=""
                    v-if="mission?.current?.remaining_days_before_start <= 0 && item.progress_status_num == 0 && !mission?.current?.is_validated_by_ci && item.is_disabled && (is('cdc') || (is('ci') && user().id == mission?.current?.assigned_to_ci_id))"
                    class="btn btn-success has-icon" :loading="unlockProcessIsLoading == item.id"
                    @click.stop="unlockProcess(item)">
                    <NLIcon name="lock_open" />
                </NLButton>
            </template>

            <template #table-actions>
                <NLButton class="has-icon" @click="refresh += 1">
                    <NLIcon name="sync" />
                </NLButton>
            </template>
        </NLDatatable>

        <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen"
            :route="'/api/agency_level/missions/details/' + mission?.current?.id + '/export?export'"
            @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" :hideOptions="true" />

        <!-- Mission comment -->
        <MissionCommentForm v-if="mission" :type="commentType" :missionId="mission?.current?.id"
            :readonly="commentReadonly" :show="modals.comment" @success="success" @close="close" />

    </ContentBody>
</template>

<script>
import MissionCommentForm from '../../forms/MissionCommentForm'
import MissionAssignationDetailsForm from '../../forms/MissionAssignationDetailsForm'
import { mapGetters } from 'vuex'
import { Form } from 'vform'
import alapi from '../../plugins/agencyLevelApi'
import { hasRole, user } from '../../plugins/user'
import ExcelExportModal from '../../Modals/ExcelExportModal';
import NLReadMore from '../../components/NLReadMore'
export default {
    components: {
        NLReadMore,
        ExcelExportModal,
        MissionCommentForm,
        MissionAssignationDetailsForm,
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            generateReportIsLoading: false,
            currentUrl: null,
            excelExportIsOpen: false,
            controllersList: [],
            commentType: null,
            commentReadonly: false,
            currentUser: null,
            refresh: 0,
            lockProcessIsLoading: null,
            unlockProcessIsLoading: null,
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
                    field: 'process',
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
                            let style = 'is-grey'
                            if (score === 1) {
                                style = 'is-success'
                            } else if (score === 2) {
                                style = 'is-info'
                            } else if (score === 3) {
                                style = 'is-warning'
                            } else if (score === 4) {
                                style = 'is-danger'
                            } else {
                                style = 'is-grey'
                            }
                            return item.is_disabled ? '-' : `<div class="tag is-centered ${style}">${score}</div>`
                        }
                    }
                },
                {
                    label: 'Fait majeur',
                    field: 'major_fact',
                    align: 'center',
                    sortable: true,
                    hide: hasRole('da')
                },
                {
                    label: 'Taux de progression',
                    field: 'progress_status',
                    align: 'center',
                    sortable: true,
                    hide: !hasRole([ 'ci', 'cdc' ]),
                },
                // {
                //     label: 'Contrôleur',
                //     field: 'cc_full_name',
                // },
            ],
            details: [
                {
                    label: 'Points de contrôle',
                    field: 'control_points.name',
                    hasMany: true
                }
            ],
            // filters: {
            //     family: {
            //         label: 'Famille',
            //         name: 'family',
            //         multiple: true,
            //         data: null,
            //         value: null,
            //         cols: 4
            //     },
            //     domain: {
            //         label: 'Domaine',
            //         name: 'domain',
            //         multiple: true,
            //         data: null,
            //         value: null,
            //         cols: 5
            //     }
            // },
            modals: {
                comment: false,
                dispatch: false
            },
            forms: {
                dispatch: new Form({
                    controllers: []
                }),
            },
            isLoading: {
                ciValidation: false,
                cdcValidation: false,
                cdcrValidation: false,
                dcpValidation: false,
                ccValidation: false,
                daValidation: false,
                destroy: false,
            }
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
            const DONE_STR = 'Réalisée, validée';
            let status = ''
            let is_late = this.mission?.current?.is_late ? ' / En retard' : ''
            if (hasRole([ 'cdrcp', 'dcp', 'cdcr', 'cc' ])) {
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
                        status = DONE_STR
                        break;
                    default:
                        status = TODO_STR
                        break;
                }
            } else {
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
                        status = 'En cours de traitement DCP'
                        break;
                    case 5:
                        status = 'En cours de traitement DCP'
                        break;
                    case 6:
                        status = 'En cours de traitement DCP'
                        break;
                    case 7:
                        status = DONE_STR
                        break;
                    default:
                        status = TODO_STR
                        break;
                }
            }

            return status + is_late
        },
        controllersType() {
            if (hasRole('cdcr')) {
                return 'cc'
            } else if (hasRole('der')) {
                return 'cder'
            }
        },
    },
    created() {
        this.initData()
    },
    methods: {
        handleDataLoaded(response) {
            this.currentUrl = response.url
        },
        lockProcess(item) {
            this.$swal.confirm_update("Êtes-vous sûr de vouloir verrouiller le processus <b>" + item.process + "</b> ?").then(action => {
                if (action.isConfirmed) {
                    this.lockProcessIsLoading = item.id
                    this.$alapi.put('missions/' + this.mission?.current?.id + '/processes/' + item.id + '/lock').then((response) => {
                        this.lockProcessIsLoading = null
                        if (response?.data?.status) {
                            this.$swal.toast_success(response?.data?.message)
                            this.refresh += 1
                        } else {
                            this.$swal.alert_error(response?.data?.message)
                        }
                    }).catch(error => {
                        this.lockProcessIsLoading = null
                        this.$swal.catchError(error)
                    })
                }
            })
        },

        unlockProcess(item) {
            this.$swal.confirm_update("Êtes-vous sûr de vouloir déverrouiller le processus <b>" + item.process + "</b> ?").then(action => {
                if (action.isConfirmed) {
                    this.unlockProcessIsLoading = item.id
                    this.$alapi.put('missions/' + this.mission?.current?.id + '/processes/' + item.id + '/unlock').then((response) => {
                        this.unlockProcessIsLoading = null
                        if (response?.data?.status) {
                            this.$swal.toast_success(response?.data?.message)
                            this.refresh += 1
                        } else {
                            this.$swal.alert_error(response?.data?.message)
                        }
                    }).catch(error => {
                        this.unlockProcessIsLoading = null
                        this.$swal.catchError(error)
                    })
                }
            })
        },
        /**
         * Export or Preview report
         */
        generateReport() {
            this.generateReportIsLoading = true
            this.$alapi.get('missions/' + this.mission?.current?.id + '/report?action=regenerate').then((response) => {
                this.generateReportIsLoading = false
                if (response.data.status) {
                    this.$swal.alert_success('La génération du rapport de la mission ' + this.mission?.current?.reference + ' est en cours, vous recevrez une notification une fois la génération terminer.', 'Génération du rapport PDF')
                } else {
                    this.$swal.alert_success('On s\'excuse il y\'a eu un problème avec la fonction de regénération de rapport concernant la mission ' + this.mission?.current?.reference + ', veuilez réessayer plus tard, si le proboème perssiste veuillez contacter votre développeur.', 'Génération du rapport PDF')
                }
            }).catch((error) => {
                this.generateReportIsLoading = false
                this.$swal.catchError(error);
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
                this.$swal.catchError(error)
            })
        },

        /**
         * Show dispatch mission form to cc
         */
        showDispatchForm() {
            this.modals.dispatch = !this.modals.dispatch
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
            this.$swal.confirm({
                title: 'Mission ' + this.mission?.current.reference,
                message: 'Êtes-vous sûr de vouloir valider la mission <b>' + this.mission?.current.reference + '</b>.<br/>Aucune modification ne pourra être apportée après votre validation.'
            }).then((action) => {
                if (action.isConfirmed) {
                    this.handleValidationButtonsLoading(type, true)
                    alapi.put('/missions/' + this.mission?.current.id + '/validate/' + type).then(response => {
                        this.handleValidationButtonsLoading(type, false)
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
                        this.handleValidationButtonsLoading(type, false)
                        this.$swal.catchError(error)
                    })
                }
            })
        },
        /**
         * Handle validation button state for each type of validation
         *
         * @param {String} type
         * @param {Boolean} isLoading
         */
        handleValidationButtonsLoading(type, isLoading) {
            let property = type + 'Validation'
            if (this.isLoading.hasOwnProperty(property)) {
                this.isLoading[ property ] = isLoading
            }
        },
        /**
         * Initialize data
         */
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.currentUser = user()
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
            let name = 'mission-details'
            // return this.$router.push({ name, params: { missionId: this.mission?.current.id, processId: item.id } })
            window.open(this.$router.resolve({ name, params: { missionId: this.mission?.current.id, processId: item.id } }).href, '_blank')
        },

        /**
         * ²oy mission
         */
        destroy() {
            this.$swal.confirm({ message: "Êtes-vous sûr de vouloir supprimer la mission <b>" + this.mission?.current?.reference + "</b>" }).then((action) => {
                if (action.isConfirmed) {
                    this.isLoading.destroy = true
                    alapi.delete('missions/' + this.mission?.current.id).then(response => {
                        if (response.data.status) {
                            this.$router.push({ name: 'missions' })
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                        this.isLoading.destroy = false
                    }).catch(error => {
                        this.$swal.catchError(error)
                        this.isLoading.destroy = false
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
