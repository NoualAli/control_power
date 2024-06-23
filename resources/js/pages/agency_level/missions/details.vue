<template>
    <ContentBody v-if="can('view_mission,control_agency,create_cdc_report,validate_cdc_report')">
        <NLContainer v-if="!pageLoadingState">
            <NLGrid>
                <!-- Informations -->
                <NLColumn lg="1" />
                <NLColumn lg="10">
                    <div class="tags">
                        <span class="btn btn-tag p-0" @click.prevent="showDocumentation" v-if="process?.media?.length">
                            <NLIcon name="description" />
                            Référence
                        </span>
                        <NLTooltip type="bottom">
                            <template #content>
                                <b>Famille</b>
                                <p class="mt-2">{{ process?.family_name }}</p>
                            </template>
                            <span class="tag is-start">
                                <NLIcon name="tenancy" /> {{ str_slice(process?.family_name, 50) }}
                            </span>
                        </NLTooltip>
                        <NLTooltip type="bottom">

                            <template #content>
                                <b>Domaine</b>
                                <p class="mt-2">{{ process?.domain_name }}</p>
                            </template>
                            <span class="tag is-start">
                                <NLIcon name="network_node" /> {{ str_slice(process?.domain_name, 50) }}
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
                <NLColumn lg="1">
                    <NLFlex lgJustifyContent="end">
                        <NLButton class="has-icon" @click="() => initData()">
                            <NLIcon name="sync" />
                        </NLButton>
                    </NLFlex>
                </NLColumn>

                <!-- Details -->
                <NLColumn lg="1" />
                <NLColumn lg="11">
                    <NLGrid>
                        <NLColumn v-for="detail in details">
                            <DetailBox :isLoading="loadingRow?.id == detail?.id" @success="success" :mode="mode"
                                @show="show" @showForm="showForm" @notify="notify" @reject="reject"
                                @controlled="controlled" :detail="detail" :mission="mission" />
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Additional anomalies -->
                <!-- <NLColumn lg="1" v-if="showAdditionalAnomaly" />
                <NLColumn lg="11" v-if="showAdditionalAnomaly">
                    <NLForm :action="saveAdditionalAnomaly" :form="additionalAnomalyFrom">
                        <NLColumn v-if="!canAddAdditionalAnomaly">
                            <h3>
                                Ce champ est destiné aux anomalies non prises en charge par les points de contrôle
                                suggérés
                            </h3>
                        </NLColumn>
                        <NLColumn>
                            <NLWyswyg :length="3000" v-model="additionalAnomalyFrom.content" name="content"
                                label="Anomalie(s) supplémentaires" :form="additionalAnomalyFrom"
                                placeholder="Veuillez saisir vos anomalies supplémentaires dans ce champ"
                                :readonly="canAddAdditionalAnomaly" />
                        </NLColumn>
                        <NLColumn v-if="!canAddAdditionalAnomaly">
                            <NLFlex lgJustifyContent="end">
                                <NLButton :loading="additionalAnomalyFrom.busy" label="Enregistrer" />
                            </NLFlex>
                        </NLColumn>
                    </NLForm>
                </NLColumn> -->
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
        <ProcessModal :rowSelected="process" :refresh="0" :show="modals.processInformations" @close="close" />
    </ContentBody>
</template>

<script>
import MissionDetailForm from '~/forms/MissionDetailForm'
import MissionDetailModal from '~/Modals/MissionDetailModal'
import MissionRegularizationForm from '~/forms/MissionRegularizationForm'
import ProcessModal from '~/Modals/ProcessModal'
import NLComponentLoader from '~/components/NLComponentLoader'
import DetailBox from '~/boxes/DetailBox.vue'
import { mapGetters } from 'vuex'
import { hasRole, user } from '~/plugins/user'
import Form from 'vform'
export default {
    components: {
        MissionDetailForm,
        MissionDetailModal,
        MissionRegularizationForm,
        ProcessModal,
        NLComponentLoader,
        DetailBox,
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            forceReload: 1,
            process: null,
            mission: null,
            details: [],
            rowSelected: null,
            loadingRow: null,
            modals: {
                show: false,
                edit: false,
                regularize: false,
                processInformations: false,
            },
            additionalAnomalyFrom: new Form({
                content: null,
            }),
        }
    },
    computed: {
        ...mapGetters({
            config: 'missions/detailsConfig',
            detail: 'details/detail',
            pageLoadingState: 'settings/pageIsLoading'
        }),
        // canAddAdditionalAnomaly() {
        //     if (hasRole([ 'ci', 'cdc' ])) {
        //         if (hasRole('ci') && this.mission.assigned_to_ci_id == this.user().id) {
        //             return this.mission.is_validated_by_ci
        //         } else if (hasRole('cdc') && this.mission.created_by_id == this.user().id) {
        //             return this.mission.is_validated_by_cdc
        //         }
        //     }
        //     return true
        // },
        // showAdditionalAnomaly() {
        //     if (hasRole([ 'ci', 'cdc' ])) {
        //         if (hasRole('ci') && this.mission.assigned_to_ci_id == this.user().id) {
        //             return true
        //         } else if (hasRole('cdc') && this.mission.created_by_id == this.user().id) {
        //             return true
        //         }
        //     }
        //     return this.additionalAnomalyFrom?.content?.length
        // }
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
                // this.additionalAnomalyFrom.content = this.config?.detailsConfig?.additional_anomaly?.content
                if (reloadAll) {
                    this.$breadcrumbs.value[ length - 1 ].label = this.process?.name
                    this.$breadcrumbs.value[ length - 3 ].label = 'Mission ' + this.mission?.reference
                    this.$store.dispatch('settings/updatePageLoading', false)
                }
                setTimeout(() => {
                    this.rowSelected = null
                    this.loadingRow = null
                }, 1000)
            })
        },

        /**
         * @param {Object} detail
         *
         * Notify major fact
         */
        notify(detail) {
            this.$swal.confirm({ title: 'Notification fait majeur', message: 'Voulez-vous notifier les autorités concernées ?' }).then(action => {
                if (action.isConfirmed) {
                    this.loadingRow = detail
                    this.$alapi.post('major-facts/' + detail.id).then(response => {
                        this.$swal.toast_success(response.data.message)
                        this.success(false)
                    }).catch(error => {
                        this.$swal.alert_error(error)
                        this.success(false)
                    })
                }
            })
        },

        /**
         * @param {Object} detail
         *
         * Reject major fact
         */
        reject(detail) {
            this.$swal.confirm({ title: 'Rejet fait majeur', message: 'Voulez-vous rejeter ce fait majeur?' }).then(action => {
                if (action.isConfirmed) {
                    this.loadingRow = detail
                    this.$alapi.put('major-facts/' + detail.id).then(response => {
                        this.$swal.toast_success(response.data.message)
                        this.success(false)
                    }).catch(error => {
                        this.$swal.alert_error(error)
                        this.success(false)
                    })
                }
            })
        },

        /**
         * Show documentation modal
         */
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
            this.loadingRow = this.rowSelected
            this.initData(false)
        },

        /**
         * @param {Boolean} forceReload
         *
         * Handle close event
         */
        close(forceReload = false) {
            for (const key in this.modals) {
                if (Object.hasOwnProperty.call(this.modals, key)) {
                    this.modals[ key ] = false
                }
            }
            // this.rowSelected = null
            if (forceReload) {
                // this.$store.dispatch('settings/updatePageLoading', true)
                this.forceReload += 1
            }
            // this.$store.dispatch('settings/updatePageLoading', false)
        },

        /**
         * Add additional anomalies to current process
         */
        // saveAdditionalAnomaly() {
        //     this.$swal.confirm({}).then(action => {
        //         if (action.isConfirmed) {
        //             this.additionalAnomalyFrom.post('agency_level/missions/' + this.mission.id + '/additional-anomaly/' + this.process.id).then(response => {
        //                 if (response.data.status) {
        //                     this.$swal.toast_success(response.data.message)
        //                 } else {
        //                     this.$swal.alert_error(response.data.message)
        //                 }
        //             }).catch(error => {
        //                 this.$swal.catchError(error)
        //             })
        //         }
        //     })
        // },

        controlled(detail) {
            this.loadingRow = detail
            this.initData(false)
        }
    }
}
</script>
