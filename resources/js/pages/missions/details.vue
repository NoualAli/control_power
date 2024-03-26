<template>
    <ContentBody v-if="can('view_mission,control_agency,create_cdc_report,validate_cdc_report')">
        <NLContainer v-if="!pageLoadingState">
            <NLGrid>
                <NLColumn lg="1" />
                <NLColumn lg="11">
                    <div class="tags">
                        <span class="btn btn-tag p-0" @click.prevent="showDocumentation" v-if="process?.media?.length">
                            <NLIcon name="description" />
                            Référence
                        </span>
                        <NLTooltip type="bottom">
                            <template #content>
                                <b>Famille</b>
                                <p class="mt-2">{{ process?.family?.name }}</p>
                            </template>
                            <span class="tag is-start">
                                <NLIcon name="tenancy" /> {{ str_slice(process?.family?.name, 50) }}
                            </span>
                        </NLTooltip>
                        <NLTooltip type="bottom">

                            <template #content>
                                <b>Domaine</b>
                                <p class="mt-2">{{ process?.domain?.name }}</p>
                            </template>
                            <span class="tag is-start">
                                <NLIcon name="network_node" /> {{ str_slice(process?.domain?.name, 50) }}
                            </span>
                        </NLTooltip>
                        <NLTooltip title="Processus" type="bottom">

                            <template #content>
                                <b>Processus</b>
                                <p class="mt-2">{{ process?.name }}</p>
                            </template>
                            <span class="tag is-start">
                                <NLIcon name="account_tree" /> {{ str_slice(process?.name, 50) }}
                            </span>
                        </NLTooltip>
                    </div>
                </NLColumn>
                <NLColumn lg="1" />
                <NLColumn lg="11">
                    <div v-for="detail in details" class="my-6">
                        <div class="box" v-if="!detail?.score && [1, 2].includes(mode)">
                            <NLFlex alignItems="center">
                                <p class="text-bold">
                                    {{ detail.control_point.name }}
                                </p>
                                <NLButton type="info" label="Contrôler"
                                    v-if="mode == 1 && !detail?.score && user().id == mission.assigned_to_ci_id"
                                    @click="showForm({ row: detail, type: 'edit' })" />
                            </NLFlex>
                        </div>
                        <div v-if="detail.score" class="box border-1 border-solid"
                            :class="[{ 'p-none': detail?.id == rowIsLoading?.id, 'border-success': detail?.score == 1 && !detail?.major_fact }, { 'border-warning': [3, 4].includes(Number(detail?.score)) && !detail?.major_fact && !is(['ci', 'cdc', 'da']) }, { 'border-info': [2].includes(Number(detail?.score)) && !detail?.major_fact && !is(['ci', 'cdc', 'da']) }, { 'border-danger': detail?.major_fact }, { 'border-warning': [2, 3, 4].includes(Number(detail?.score)) && !detail?.major_fact && is(['ci', 'cdc', 'da']) }]">
                            <NLGrid :class="[{ 'p-5': detail?.id == rowIsLoading?.id }]">
                                <NLComponentLoader :isLoading="rowIsLoading?.id == detail?.id"></NLComponentLoader>
                                <!-- Control Point name -->
                                <NLColumn>
                                    <NLFlex>
                                        <h3>{{ detail?.control_point?.name }}</h3>
                                        <NLTooltip title="Ce point a déjà été traiter" type="left">
                                            <NLIcon name="check_circle" class="text-success is-clickable"
                                                v-if="isControlled(detail)">
                                            </NLIcon>
                                        </NLTooltip>
                                    </NLFlex>
                                </NLColumn>

                                <!-- Score -->
                                <NLColumn lg="2">
                                    <b>Référence:</b>
                                </NLColumn>
                                <NLColumn lg="10" class="text-bold">
                                    {{ detail?.reference }}
                                </NLColumn>

                                <!-- Major fact -->
                                <NLColumn v-if="detail?.major_fact && !is('da')">
                                    <b class="text-danger">
                                        Fait majeur déclenché par {{ detail?.major_fact_is_detected_by_full_name }}
                                        le {{ detail?.major_fact_is_detected_at }}
                                    </b>
                                </NLColumn>

                                <!-- Score -->
                                <NLColumn lg="2" v-if="Number(detail?.score) !== 5">
                                    <b>Appréciation:</b>
                                </NLColumn>
                                <NLColumn lg="10" v-if="Number(detail?.score) !== 5">
                                    {{ detail?.appreciation }}
                                </NLColumn>

                                <!-- Report -->
                                <NLColumn lg="2" v-if="Number(detail?.score) !== 5">
                                    <b>Constat:</b>
                                </NLColumn>
                                <NLColumn lg="10" v-if="Number(detail?.score) !== 5 && detail?.observation?.content"
                                    v-html="detail?.observation?.content || '-'">
                                </NLColumn>
                                <!-- Recovery plan -->
                                <NLColumn lg="2" v-if="Number(detail?.score) !== 5">
                                    <b>Plan de redressement:</b>
                                </NLColumn>
                                <NLColumn lg="10" v-if="Number(detail?.score) !== 5"
                                    v-html="detail?.recovery_plan || '-'">
                                </NLColumn>

                                <!-- Regularization -->
                                <NLColumn lg="2" v-if="mission?.is_validated_by_dcp">
                                    <b>Régularisation:</b>
                                </NLColumn>
                                <NLColumn lg="10" v-if="mission?.is_validated_by_dcp">
                                    <p v-if="detail?.reg_is_regularized">
                                        Levée
                                    </p>
                                    <p v-else-if="detail?.reg_is_rejected">
                                        Rejetée
                                    </p>
                                    <p v-else-if="detail?.reg_is_sanitation_in_progress && !detail?.reg_is_rejected">
                                        En cours d'assainissement
                                    </p>
                                    <p v-else>
                                        Non levée
                                    </p>
                                </NLColumn>

                                <!-- Actions -->
                                <NLColumn extraClass="d-flex justify-end align-center"
                                    v-if="Number(detail?.score) !== 5">
                                    <NLFlex gap="2">
                                        <button class="btn btn-info has-icon" @click="show(detail)">
                                            <NLIcon name="visibility" />
                                            Voir plus
                                        </button>

                                        <!-- CI -->
                                        <button
                                            v-if="mode == 1 && !detail?.major_fact && !mission?.is_validated_by_ci && user().id == mission.assigned_to_ci_id"
                                            class="btn btn-warning has-icon" @click="edit(detail)">
                                            <NLIcon name="edit" />
                                            Modifier
                                        </button>
                                        <!-- CDC -->
                                        <button
                                            v-if="mode == 2 && !detail?.major_fact && !mission?.is_validated_by_cdc && can('create_cdc_report,validate_cdc_report')"
                                            class="btn btn-warning has-icon" @click="edit(detail)">
                                            <NLIcon name="edit" />
                                            Modifier
                                        </button>

                                        <button
                                            v-if="(mode == 2 && !mission?.is_validated_by_dcp && !mission?.is_validated_by_cdcr && !detail?.major_fact_is_dispatched_to_dcp_at && !detail.regularization && row?.major_fact && is('cdc'))"
                                            class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                                            <NLIcon name="edit" />
                                            Traiter
                                        </button>

                                        <!-- CDCR -->
                                        <button v-if="mode == 4 &&
        !(detail?.major_fact_is_detected_by_id == user().id)
        && !detail?.major_fact_is_dispatched_at
        && (mission?.assigned_to_cc_id ? mission?.is_validated_by_cc && !mission?.is_validated_by_cdcr : !mission?.is_validated_by_cdcr)
        && [2, 3, 4].includes(Number(detail?.score))
        && is('cdcr')" class="btn btn-warning has-icon" @click="edit(detail)">
                                            <NLIcon name="edit" />
                                            Traiter
                                        </button>

                                        <!-- CC -->
                                        <button v-if="mode == 3
        && !detail.major_fact
        && !detail?.major_fact_is_dispatched_at
        && mission.assigned_to_cc_id == user().id
        && !mission?.is_validated_by_cc
        && [2, 3, 4].includes(Number(detail?.score))
        && is('cc')" class="btn btn-warning has-icon" @click="edit(detail)">
                                            <NLIcon name="edit" />
                                            Traiter
                                        </button>

                                        <!-- DCP -->
                                        <button
                                            v-if="(mode == 5
        && !(detail?.major_fact_is_detected_by_id == user().id)
        && !mission?.is_validated_by_dcp
        && mission.is_validated_by_cdc
        && !detail?.major_fact_is_dispatched_at
        && [2, 3, 4].includes(Number(detail?.score))
        || (detail?.major_fact && !detail?.major_fact_is_dispatched_at && !(detail?.major_fact_is_detected_by_id == user().id) && [3, 4].includes(Number(detail?.score)))) && is('dcp')"
                                            class="btn btn-warning has-icon" @click="edit(detail)">
                                            <NLIcon name="edit" />
                                            Traiter
                                        </button>
                                        <button
                                            v-if="mode == 5 && !detail?.major_fact_is_dispatched_at && detail?.major_fact && is('dcp')"
                                            class="btn btn-info has-icon" @click.prevent="notify(detail)">
                                            <NLIcon name="notifications" />
                                            Notifier
                                        </button>

                                        <!-- Agency director -->
                                        <button
                                            v-if="mission?.is_validated_by_dcp && !detail?.reg_is_regularized && Number(detail?.score) !== 1 && is('da')"
                                            class="btn btn-warning has-icon" @click="regularize(detail)">
                                            <NLIcon name="done" />
                                            Régulariser
                                        </button>
                                    </NLFlex>
                                </NLColumn>
                            </NLGrid>
                        </div>
                    </div>
                </NLColumn>
            </NLGrid>
        </NLContainer>

        <!-- View control point informations -->
        <MissionDetailModal :rowSelected="rowSelected" :show="modals.show" @showForm="showForm" @close="close" />

        <!-- Traitement du point de contrôle -->
        <MissionDetailForm :data="rowSelected" :show="modals.edit" @success="success" @close="close" />

        <!-- Régularization du point de contrôle -->
        <MissionRegularizationForm :detail="rowSelected" :show="modals.regularize" @success="success" @close="close"
            :key="forceReload" />

        <!-- Points de contrôle et documentations du procéssus -->
        <ProcessInformationsModal :process="process" :show="modals.processInformations" @close="close" />
    </ContentBody>
</template>

<script>
import MissionDetailForm from '../../forms/MissionDetailForm'
import MissionDetailModal from '../../Modals/MissionDetailModal'
import MissionRegularizationForm from '../../forms/MissionRegularizationForm'
import ProcessInformationsModal from '../../Modals/ProcessInformationsModal'
import NLComponentLoader from '../../components/NLComponentLoader'
import { mapGetters } from 'vuex'
import { hasRole, user } from '../../plugins/user'
export default {
    components: {
        MissionDetailForm,
        MissionDetailModal,
        MissionRegularizationForm,
        ProcessInformationsModal,
        NLComponentLoader
    },
    emits: [ 'loading' ],
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            forceReload: 1,
            process: null,
            mission: null,
            details: [],
            rowSelected: null,
            rowIsLoading: null,
            mode: 1,
            modals: {
                show: false,
                edit: false,
                regularize: false,
                processInformations: false,
            },
        }
    },
    computed: {
        ...mapGetters({
            config: 'missions/detailsConfig',
            detail: 'details/detail',
            pageLoadingState: 'settings/pageIsLoading'
        }),
        isControlled() {
            return (detail) => {
                if (hasRole('cdc')) {
                    return Boolean(detail?.controlled_by_cdc_id)
                } else if (hasRole('cc')) {
                    return Boolean(detail?.controlled_by_cc_id)
                } else if (hasRole('cdcr')) {
                    return Boolean(detail?.controlled_by_cdcr_id)
                } else if (hasRole('dcp')) {
                    return Boolean(detail?.controlled_by_dcp_id)
                } else if (hasRole('da')) {
                    return Boolean(detail?.reg_is_regularized)
                }
            }
        }
    },
    created() {
        this.initData()
    },

    methods: {
        /**
         * Initialize data
         */
        initData(reloadAll = true) {
            this.close()
            const length = this.$breadcrumbs.value.length
            if (reloadAll) {
                this.$store.dispatch('settings/updatePageLoading', true)
            }
            this.$store.dispatch('missions/fetchDetails', { missionId: this.$route.params.missionId, processId: this.$route.params.processId }).then(() => {
                this.details = this.config.detailsConfig.details
                this.mission = this.config.detailsConfig.mission
                this.process = this.config.detailsConfig.process
                this.mode = this.config.detailsConfig.mode
                this.rowIsLoading = null
                if (reloadAll) {
                    this.$breadcrumbs.value[ length - 1 ].label = this.process?.name
                    this.$breadcrumbs.value[ length - 3 ].label = 'Mission ' + this.mission?.reference
                    this.$store.dispatch('settings/updatePageLoading', false)
                }
            })
        },
        /**
         * Notify major fact
         */
        notify(row) {
            this.$swal.confirm({ title: 'Notification fait majeur', message: 'Voulez-vous notifier les autorités concernées ?' }).then(action => {
                if (action.isConfirmed) {
                    this.$alapi.post('major-facts/' + row.id).then(response => {
                        this.$swal.toast_success(response.data.message)
                        this.initData()
                    }).catch(error => {
                        this.$swal.alert_error(error)
                    })
                }
            })
        },
        showDocumentation() {
            this.modals.processInformations = true
        },

        /**
         * Show control form for edition and processing
         *
         * @param {Object} detail
         */
        edit(detail) {
            this.rowSelected = detail
            this.modals.show = false
            this.modals.regularize = false
            this.modals.edit = true
        },

        /**
         * Show control point informations
         *
         * @param {Object} detail
         */
        show(detail) {
            this.rowSelected = detail
            this.modals.show = true
            this.modals.edit = false
            this.modals.regularize = false
        },

        /**
         * Show regularization form
         *
         * @param {Object} detail
         */
        regularize(detail) {
            this.rowSelected = detail
            this.modals.show = false
            this.modals.edit = false
            this.modals.regularize = true
        },

        /**
         * @param {Object} Object
         * @param {Object} Object.row
         * @param {String} Object.type
         */
        showForm({ row, type }) {
            if (type == 'processing' || type == 'edit') {
                this.edit(row)
            } else if (type == 'regularization') {
                this.regularize(row)
            }
        },

        /**
         * Handle success event
         */
        success() {
            this.rowIsLoading = this.rowSelected
            this.initData(false)
        },

        /**
         * Handle close event
         */
        close(forceReload = false) {
            for (const key in this.modals) {
                if (Object.hasOwnProperty.call(this.modals, key)) {
                    this.modals[ key ] = false
                }
            }
            this.rowSelected = null
            if (forceReload) {
                // this.$store.dispatch('settings/updatePageLoading', true)
                this.forceReload += 1
            }
            // this.$store.dispatch('settings/updatePageLoading', false)
        },
    }
}
</script>
