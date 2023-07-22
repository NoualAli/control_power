<template>
    <ContentBody v-if="can('view_mission,control_agency,create_cdc_report,validate_cdc_report')">
        <NLContainer v-if="!pageLoadingState">
            <NLGrid>
                <NLColumn lg="1" />
                <NLColumn lg="11">
                    <div class="tags">
                        <span class="tag"><i class="las la-tag icon mr-1"></i> {{ process?.familly?.name }}</span>
                        <span class="tag"><i class="las la-tags icon mr-1"></i> {{ process?.domain?.name }}</span>
                        <span class="tag"><i class="las la-project-diagram icon mr-1"></i> {{ process?.name }}</span>
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
                                    @click="showControlForm(detail)" />
                            </NLFlex>
                        </div>
                        <div v-if="detail.score" class="box border-1 border-solid"
                            :class="[{ 'border-success': detail.score == 1 }, { 'border-warning': [2, 3, 4].includes(Number(detail.score)) && !detail.major_fact }, { 'border-danger': detail.major_fact }]">
                            <NLGrid>
                                <!-- Control Point name -->
                                <NLColumn>
                                    <h3>{{ detail?.control_point?.name }}</h3>
                                </NLColumn>

                                <!-- Major fact -->
                                <NLColumn lg="4">
                                    <b>Fait majeur:</b>
                                </NLColumn>
                                <NLColumn lg="8">
                                    <span v-if="!detail?.major_fact">
                                        <i class="las la-check-circle icon text-success" />
                                        Non
                                    </span>
                                    <span v-else>
                                        <i class="las la-times-circle icon text-danger" />
                                        Oui
                                    </span>
                                </NLColumn>

                                <!-- Score -->
                                <NLColumn lg="4">
                                    <b>Appréciation:</b>
                                </NLColumn>
                                <NLColumn lg="8">
                                    {{ detail?.appreciation }}
                                </NLColumn>

                                <!-- Report -->
                                <NLColumn lg="4">
                                    <b>Constat:</b>
                                </NLColumn>
                                <NLColumn lg="8">
                                    {{ detail?.report || '-' }}
                                </NLColumn>

                                <!-- Recovery plan -->
                                <NLColumn lg="4">
                                    <b>Plan de redressement:</b>
                                </NLColumn>
                                <NLColumn lg="8">
                                    {{ detail?.recovery_plan || '-' }}
                                </NLColumn>

                                <!-- Regularization -->
                                <NLColumn v-if="detail?.regularization?.regularized">
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
                                <NLColumn extraClass="d-flex justify-end align-center">
                                    <NLFlex gap="2">
                                        <button class="btn btn-info has-icon" @click="showDetail(detail)">
                                            <i class="las la-eye icon" />
                                            Voir plus
                                        </button>

                                        <!-- CI -->
                                        <button
                                            v-if="mode == 1 && !detail?.major_fact && !mission?.is_validated_by_ci && can('create_ci_report')"
                                            class="btn btn-warning has-icon" @click="showControlForm(detail)">
                                            <i class="las la-pen icon" />
                                            Modifier
                                        </button>
                                        <!-- CDC -->
                                        <button
                                            v-if="mode == 2 && !detail?.major_fact && !mission?.is_validated_by_cdc && mission?.is_validated_by_ci && can('create_cdc_report,validate_cdc_report')"
                                            class="btn btn-warning has-icon" @click="showControlForm(detail)">
                                            <i class="las la-pen icon" />
                                            Modifier
                                        </button>

                                        <!-- CDCR -->
                                        <button
                                            v-if="mode == 4 && !detail?.major_fact_dispatched_at && !mission?.is_validated_by_cdcr && can(['make_first_validation', 'process_mission']) && [2, 3, 4].includes(Number(detail?.score))"
                                            class="btn btn-warning has-icon" @click="showControlForm(detail)">
                                            <i class="las la-pen icon" />
                                            Traiter
                                        </button>

                                        <!-- DCP -->
                                        <button
                                            v-if="(mode == 5 && !mission?.is_validated_by_dcp && mission.is_validated_by_cdcr && !detail?.major_fact_dispatched_at && [2, 3, 4].includes(Number(detail?.score)) || (detail?.major_fact && !detail?.major_fact_dispatched_at && [3, 4].includes(Number(detail?.score)))) && can('make_second_validation')"
                                            class="btn btn-warning has-icon" @click="showControlForm(detail)">
                                            <i class="las la-pen icon" />
                                            Traiter
                                        </button>
                                        <button
                                            v-if="mode == 5 && !detail?.major_fact_dispatched_at && detail?.major_fact && can('dispatch_major_fact')"
                                            class="btn btn-info has-icon" @click.prevent="notify(detail)">
                                            <i class="las la-bell icon" />
                                            Notifier
                                        </button>

                                        <!-- Agency director -->
                                        <button
                                            v-if="mission?.is_validated_by_dcp && !detail?.regularization?.regularized_at && !detail?.major_fact && detail?.score !== 1 && can('regularize_mission_detail')"
                                            class="btn btn-warning has-icon" @click="regularize(detail)">
                                            <i class="las la-pen icon" />
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

        <!-- Traitement du point de contrôle -->
        <MissionDetailForm :data="rowSelected" :show="modals.forms.control" @success="success" @close="close" />

        <!-- Informations du point de contrôle -->
        <MissionDetailModal :rowSelected="rowSelected" :show="modals.popups.control" @showForm="showForm" @close="close" />

        <!-- Régularization du point de contrôle -->
        <MissionRegularizationForm :data="rowSelected" :show="modals.regularize" @success="success" @close="close" />
    </ContentBody>
</template>

<script>
import MissionDetailForm from '../../forms/MissionDetailForm'
import MissionDetailModal from '../../Modals/MissionDetailModal'
import MissionRegularizationForm from '../../forms/MissionRegularizationForm'
import { mapGetters } from 'vuex'
export default {
    components: {
        MissionDetailForm,
        MissionDetailModal,
        MissionRegularizationForm
    },
    emits: [ 'loading' ],
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            process: null,
            mission: null,
            details: [],
            rowSelected: null,
            mode: 1,
            modals: {
                forms: {
                    control: false,
                    regularization: false
                },
                popups: {
                    control: false
                }
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
        initData() {
            const length = this.$breadcrumbs.value.length
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('missions/fetchDetails', { missionId: this.$route.params.missionId, processId: this.$route.params.processId }).then(() => {
                this.details = this.config.detailsConfig.details
                this.mission = this.config.detailsConfig.mission
                this.process = this.config.detailsConfig.process
                this.mode = this.config.detailsConfig.mode
                if (this.$breadcrumbs.value[ length - 3 ].label === 'Mission') { this.$breadcrumbs.value[ length - 3 ].label = 'Mission ' + this.mission?.reference }
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Exécution de la mission') {
                    this.$breadcrumbs.value[ length - 2 ].label = ''
                    this.$breadcrumbs.value[ length - 1 ].label = this.process?.name
                }
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },

        /**
         * Handle form visibility
         *
         * @param {Object} Object
         * @param {Object} Object.row
         * @param {string} Object.type
         */
        showForm({ row, type }) {
            if ([ 'processing', 'edit' ].includes(type)) {
                this.showControlForm(row)
            } else if (type == 'regularization') {
                this.showRegularizationForm(row)
            }
        },

        /**
         * Show control form for edition and processing
         *
         * @param {Object} detail
         */
        showControlForm(detail) {
            this.rowSelected = detail
            this.modals.popups.control = false
            this.modals.forms.control = true
        },

        /**
         * Show control point informations
         *
         * @param {Object} detail
         */
        showDetail(detail) {
            this.rowSelected = detail
            this.modals.popups.control = true
        },

        /**
         * Show regularization form
         *
         * @param {Object} detail
         */
        showRegularizationForm(detail) {
            this.rowSelected = detail
            this.modals.popups.regularization = true
        },

        /**
         * Handle success event
         */
        success() {
            this.rowSelected = null
            this.modals.forms.control = false
            this.initData()
        },

        /**
         * Handle close event
         */
        close() {
            this.rowSelected = null
            for (const key in this.modals.forms) {
                if (Object.hasOwnProperty.call(this.modals.forms, key)) {
                    this.modals.forms[ key ] = false
                }
            }
            for (const key in this.modals.popups) {
                if (Object.hasOwnProperty.call(this.modals.popups, key)) {
                    this.modals.popups[ key ] = false
                }
            }
        }
    }
}
</script>
