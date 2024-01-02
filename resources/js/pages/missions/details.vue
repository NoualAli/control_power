<template>
    <ContentBody v-if="can('view_mission,control_agency,create_cdc_report,validate_cdc_report')">
        <NLContainer v-if="!pageLoadingState">
            <NLGrid>
                <NLColumn lg="1" />
                <NLColumn lg="11">
                    <div class="tags is-even">
                        <button class="btn btn-info" @click.prevent="showDocumentation" v-if="process?.media?.length"
                            title="Afficher la documentation du processus">
                            <i class="las la-file icon"></i>
                        </button>
                        <span class="tag is-start">
                            <i class="las la-tag icon mr-1"></i> {{ process?.family?.name }}
                        </span>
                        <span class="tag is-start">
                            <i class="las la-tags icon mr-1"></i> {{ process?.domain?.name }}
                        </span>
                        <span class="tag is-start">
                            <i class="las la-project-diagram icon mr-1"></i> {{ process?.name }}
                        </span>
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
                                <NLButton type="info" label="Contrôler" v-if="mode == 1 && !detail?.score"
                                    @click="showForm({ row: detail, type: 'edit' })" />
                            </NLFlex>
                        </div>
                        <div v-if="detail.score" class="box border-1 border-solid"
                            :class="[{ 'border-success': detail?.score == 1 && !detail?.major_fact }, { 'border-warning': [3, 4].includes(Number(detail?.score)) && !detail?.major_fact && !is(['ci', 'cdc', 'da']) }, { 'border-info': [2].includes(Number(detail?.score)) && !detail?.major_fact && !is(['ci', 'cdc', 'da']) }, { 'border-danger': detail?.major_fact }, { 'border-warning': [2, 3, 4].includes(Number(detail?.score)) && !detail?.major_fact && is(['ci', 'cdc', 'da']) }]">
                            <NLGrid>
                                <!-- Control Point name -->
                                <NLColumn>
                                    <h3>{{ detail?.control_point?.name }}</h3>
                                </NLColumn>

                                <!-- Major fact -->
                                <NLColumn v-if="detail?.major_fact">
                                    <b class="text-danger">
                                        Fait majeur déclencher par {{ detail?.major_fact_is_detected_by_full_name }}
                                        le {{ detail?.major_fact_is_detected_at }}
                                    </b>
                                </NLColumn>

                                <!-- Score -->
                                <NLColumn lg="4" v-if="Number(detail?.score) !== 5">
                                    <b>Appréciation:</b>
                                </NLColumn>
                                <NLColumn lg="8" v-if="Number(detail?.score) !== 5">
                                    {{ detail?.appreciation }}
                                </NLColumn>

                                <!-- Report -->
                                <NLColumn lg="4" v-if="Number(detail?.score) !== 5">
                                    <b>Constat:</b>
                                </NLColumn>
                                <NLColumn lg="8" v-if="Number(detail?.score) !== 5" v-html="detail?.report || '-'">
                                </NLColumn>
                                <!-- Recovery plan -->
                                <NLColumn lg="4" v-if="Number(detail?.score) !== 5">
                                    <b>Plan de redressement:</b>
                                </NLColumn>
                                <NLColumn lg="8" v-if="Number(detail?.score) !== 5" v-html="detail?.recovery_plan || '-'">
                                </NLColumn>

                                <!-- Regularization -->
                                <NLColumn v-if="detail?.regularization?.regularized && Number(detail?.score) !== 5">
                                    <NLGrid>
                                        <NLColumn lg="4">
                                            <b>Régularisation:</b>
                                        </NLColumn>
                                        <div lg="8">
                                            {{ detail?.regularization?.regularized || '-' }}
                                        </div>
                                    </NLGrid>
                                </NLColumn>

                                <!-- Actions -->
                                <NLColumn extraClass="d-flex justify-end align-center" v-if="Number(detail?.score) !== 5">
                                    <NLFlex gap="2">
                                        <button class="btn btn-info has-icon" @click="show(detail)">
                                            <i class="las la-eye icon" />
                                            Voir plus
                                        </button>

                                        <!-- CI -->
                                        <button
                                            v-if="mode == 1 && !detail?.major_fact && !mission?.is_validated_by_ci && can('create_ci_report')"
                                            class="btn btn-warning has-icon" @click="edit(detail)">
                                            <i class="las la-pen icon" />
                                            Modifier
                                        </button>
                                        <!-- CDC -->
                                        <button
                                            v-if="mode == 2 && !detail?.major_fact && !mission?.is_validated_by_cdc && can('create_cdc_report,validate_cdc_report')"
                                            class="btn btn-warning has-icon" @click="edit(detail)">
                                            <i class="las la-pen icon" />
                                            Modifier
                                        </button>

                                        <button
                                            v-if="(mode == 2 && !mission?.is_validated_by_dcp && !mission?.is_validated_by_cdcr && !detail?.major_fact_is_dispatched_to_dcp_at && !detail.regularization && row?.major_fact && is('cdc'))"
                                            class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                                            <i class="las la-pen icon" />
                                            Traiter
                                        </button>

                                        <!-- CDCR -->
                                        <button v-if="mode == 4 &&
                                            !(detail?.major_fact_is_detected_by_id == user().id)
                                            && !detail?.major_fact_is_dispatched_at
                                            && (mission?.has_dcp_controllers ? mission?.is_validated_by_cc && !mission?.is_validated_by_cdcr : !mission?.is_validated_by_cdcr)
                                            && [2, 3, 4].includes(Number(detail?.score))
                                            && is('cdcr')" class="btn btn-warning has-icon" @click="edit(detail)">
                                            <i class="las la-pen icon" />
                                            Traiter
                                        </button>

                                        <!-- CC -->
                                        <button v-if="mode == 3
                                            && !detail.major_fact
                                            && !detail?.major_fact_is_dispatched_at
                                            && detail.assigned_to_cc_id == user().id
                                            && !mission?.is_validated_by_cc
                                            && [2, 3, 4].includes(Number(detail?.score))
                                            && is('cc')" class="btn btn-warning has-icon" @click="edit(detail)">
                                            <i class="las la-pen icon" />
                                            Traiter
                                        </button>

                                        <!-- DCP -->
                                        <button
                                            v-if="(mode == 5
                                                && !(detail?.major_fact_is_detected_by_id == user().id)
                                                && !mission?.is_validated_by_dcp
                                                && mission.is_validated_by_cdcr
                                                && !detail?.major_fact_is_dispatched_at
                                                && [2, 3, 4].includes(Number(detail?.score))
                                                || (detail?.major_fact && !detail?.major_fact_is_dispatched_at && !(detail?.major_fact_is_detected_by_id == user().id) && [3, 4].includes(Number(detail?.score)))) && is('dcp')"
                                            class="btn btn-warning has-icon" @click="edit(detail)">
                                            <i class="las la-pen icon" />
                                            Traiter
                                        </button>
                                        <button
                                            v-if="mode == 5 && !detail?.major_fact_is_dispatched_at && detail?.major_fact && is('dcp')"
                                            class="btn btn-info has-icon" @click.prevent="notify(detail)">
                                            <i class="las la-bell icon" />
                                            Notifier
                                        </button>

                                        <!-- Agency director -->
                                        <button
                                            v-if="mission?.is_validated_by_dcp && !detail?.is_regularized && !detail?.major_fact && Number(detail?.score) !== 1 && is('da')"
                                            class="btn btn-warning has-icon" @click="regularize(detail)">
                                            <i class="las la-check icon" />
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
import MissionDetailForm from '../../forms/MissionDetailForm.vue'
import MissionDetailModal from '../../Modals/MissionDetailModal.vue'
import MissionRegularizationForm from '../../forms/MissionRegularizationForm.vue'
import ProcessInformationsModal from '../../Modals/ProcessInformationsModal.vue'
import { mapGetters } from 'vuex'
import { user } from '../../plugins/user'
export default {
    components: {
        MissionDetailForm,
        MissionDetailModal,
        MissionRegularizationForm,
        ProcessInformationsModal
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
        })
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
                if (reloadAll) {
                    this.$breadcrumbs.value[ length - 1 ].label = this.process?.name
                    this.$breadcrumbs.value[ length - 3 ].label = 'Mission ' + this.mission?.reference
                    this.$store.dispatch('settings/updatePageLoading', false)
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
