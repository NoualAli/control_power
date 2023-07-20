<template>
    <NLModal :show="show" @close="close" :isLoading="isLoading">
        <template #title>
            <div class="tags">
                <small class="tag is-success">
                    {{ row?.campaign?.reference }}
                </small>
                <small class="tag is-info">
                    {{ row?.mission.reference }}
                </small>
            </div>
        </template>
        <template #default>
            <NLGrid gap="6">
                <NLColumn>
                    <NLGrid gap="6" extraClass="box ">
                        <NLColumn>
                            <h2>Informations de base</h2>
                        </NLColumn>
                        <!-- Basic informations -->
                        <NLColumn v-if="row?.major_fact">
                            <span class="label">Fait majeur: </span>
                            <span v-html="row?.major_fact_str" />
                        </NLColumn>
                        <NLColumn v-if="row?.major_fact && row?.major_fact_dispatched_at">
                            <span class="label">Date de transmission: </span>
                            <span v-html="row?.major_fact_dispatched_at" />
                        </NLColumn>
                        <NLColumn lg="6">
                            <span class="label">Dre: </span>
                            <span>{{ row?.dre?.full_name }}</span>
                        </NLColumn>
                        <NLColumn lg="6">
                            <span class="label">Agence: </span>
                            <span>{{ row?.agency?.full_name }}</span>
                        </NLColumn>
                        <NLColumn lg="6">
                            <span class="label">Famille: </span>
                            <span>{{ row?.familly?.name }}</span>
                        </NLColumn>
                        <NLColumn lg="6">
                            <span class="label">Domaine: </span>
                            <span>{{ row?.domain?.name }}</span>
                        </NLColumn>
                        <NLColumn>
                            <span class="label">Processus: </span>
                            <span>{{ row?.process?.name }}</span>
                        </NLColumn>
                        <NLColumn>
                            <span class="label">Point de contrôle: </span>
                            <span>{{ row?.control_point?.name }}</span>
                        </NLColumn>
                        <NLColumn>
                            <NLFlex alignItems="center" gap="2" lgJustifyContent="start">
                                <span class="label">Appréciation: </span>
                                <span>{{ row?.appreciation }}</span>
                                <span v-html="row?.score_tag"></span>
                            </NLFlex>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Metadata -->
                <NLColumn v-if="row?.metadata?.length" extraClass="list-ite">
                    <div class="list-item-content no-bg grid">
                        <NLColumn :class="{ 'col-lg-8': !row?.metadata }">
                            <div class="table-container " v-if="row?.metadata">
                                <h2>
                                    Informations supplémentaires
                                </h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th v-for="( heading, indexHeading ) in  currentMetadata.keys "
                                                :key="indexHeading" class="text-left">
                                                {{ heading }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="( data, row ) in  row?.metadata " :key="'metadata-row-' + row">
                                            <td v-for="( items, index ) in  data "
                                                :key="'metadata-row-' + row + '-item-' + index" class="text-left">
                                                <template v-for="( item, key ) in  items ">
                                                    <span v-if="key !== 'label' && key !== 'rules'"
                                                        :key="'metadata-row-' + row + '-item-' + index + key + '-content'">
                                                        {{ item || '-' }}
                                                    </span>
                                                </template>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <span v-else>-</span>
                        </NLColumn>
                    </div>
                </NLColumn>

                <NLColumn>
                    <NLGrid gap="6" class="box ">
                        <!-- Report -->
                        <NLColumn>
                            <span class="label">Constat: </span>
                            <span>{{ row?.report || '-' }}</span>
                        </NLColumn>

                        <!-- Recovery plan -->
                        <NLColumn>
                            <span class="label">Plan de redressement: </span>
                            <span>{{ row?.recovery_plan || '-' }}</span>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Media -->
                <NLColumn v-if="row?.media?.length" extraClass="list-item">
                    <NLFile v-model="files" label="Pièces jointes" name="media" :can-delete="false" readonly />
                </NLColumn>

                <!-- Regularization -->
                <NLColumn v-if="row?.score > 1 && row?.regularization?.regularized" class="list-item box ">
                    <div class="list-item-content no-bg grid">
                        <NLColumn>
                            <h2>Régularisation
                                <i class="las la-check-circle text-success" v-if="row?.regularization?.regularized"></i>
                                <i class="las la-exclamation-circle text-warning" v-else></i>
                            </h2>
                        </NLColumn>
                        <NLColumn sm="4" lg="4" md="4">
                            <b>Etat:</b>
                        </NLColumn>
                        <NLColumn sm="8" lg="8" md="8">
                            {{ row?.regularization?.regularized }}
                        </NLColumn>

                        <NLColumn v-if="row?.regularization?.reason" sm="4" lg="4" md="4">
                            <b>Cause:</b>
                        </NLColumn>
                        <NLColumn v-if="row?.regularization?.reason" sm="8" lg="8" md="8">
                            {{ row?.regularization?.reason }}
                        </NLColumn>

                        <NLColumn v-if="row?.regularization?.action_to_be_taken" sm="4" lg="4" md="4">
                            <b>Actions à engagé:</b>
                        </NLColumn>
                        <NLColumn v-if="row?.regularization?.action_to_be_taken" sm="8" lg="8" md="8">
                            {{ row?.regularization?.action_to_be_taken }}
                        </NLColumn>

                        <NLColumn v-if="row?.regularization?.committed_action" sm="4" lg="4" md="4">
                            <b>Actions engagé:</b>
                        </NLColumn>
                        <NLColumn v-if="row?.regularization?.committed_action" sm="8" lg="8" md="8">
                            {{ row?.regularization?.committed_action }}
                        </NLColumn>

                        <NLColumn v-if="row?.regularization?.regularized_at" sm="4" lg="4" md="4">
                            <b>Date Régularisation:</b>
                        </NLColumn>
                        <NLColumn v-if="row?.regularization?.regularized_at" sm="8" lg="8" md="8">
                            {{ row?.regularization?.regularized_at }}
                        </NLColumn>
                    </div>
                </NLColumn>
            </NLGrid>
        </template>
        <template #footer>
            <!-- CI -->
            <button v-if="!row?.mission?.is_validated_by_ci && !row?.major_fact && can('create_ci_report')"
                class="btn btn-warning has-icon" @click="showForm(row, 'edit')">
                <i class="las la-pen icon" />
                Modifier
            </button>

            <!-- CDC -->
            <button
                v-if="!row?.mission?.is_validated_by_cdc && !row?.major_fact && row?.mission?.is_validated_by_ci && can('create_cdc_report,validate_cdc_report')"
                class="btn btn-warning has-icon" @click="showForm(row, 'edit')">
                <i class="las la-pen icon" />
                Modifier
            </button>

            <!-- CDCR -->
            <button
                v-if="(!row?.mission?.is_validated_by_cdcr && !row?.major_fact_dispatched_at && row?.mission?.is_validated_by_cdc && [2, 3, 4].includes(Number(row?.score))) || (row?.major_fact && !row?.major_fact_dispatched_at && [3, 4].includes(Number(row?.score))) && can('make_first_validation,process_mission')"
                class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <i class="las la-pen icon" />
                Traiter
            </button>

            <!-- DCP -->
            <button
                v-if="(!row?.mission?.is_validated_by_dcp && row?.mission?.is_validated_by_cdcr && !row?.major_fact_dispatched_at && !row.regularization && [2, 3, 4].includes(Number(row?.score)) || (row?.major_fact && !row?.major_fact_dispatched_at && [3, 4].includes(Number(row?.score)))) && can('make_second_validation')"
                class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <i class="las la-pen icon" />
                Traiter
            </button>
            <button v-if="!row?.major_fact_dispatched_at && row?.major_fact && can('dispatch_major_fact')"
                class="btn btn-info has-icon" @click.prevent="notify(row)">
                <i class="las la-bell icon" />
                Notifier
            </button>
            <!-- Agency director -->
            <button
                v-if="row?.mission?.is_validated_by_dcp && !row?.regularization?.regularized_at && !row?.major_fact && row?.score !== 1 && can('regularize_mission_detail')"
                class="btn btn-warning has-icon" @click="showForm(row, 'regularization')">
                <i class="las la-pen icon" />
                Régulariser
            </button>
        </template>
    </NLModal>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: 'MissionDetailModal',
    emits: [ 'close', 'showForm' ],
    props: {
        rowSelected: { type: Object, },
        show: { type: Boolean, required: true }
    },
    computed: {
        ...mapGetters({
            detail: 'details/detail',
        }),
        files() {
            return this.row?.media.map(file => file.id)
        }
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
            } else {
                this.row = null
                this.currentMetadata.keys = null
                this.isLoading = false
            }
        }
    },
    data() {
        return {
            row: null,
            currentMetadata: {
                keys: null
            },
            isLoading: false,
        }
    },

    methods: {
        /**
         *
         * @param {*} row
         * @param {*} type
         */
        showForm(row, type) {
            this.$emit('showForm', { row, type })
        },

        /**
         *
         */
        close(forceReload = false) {
            this.row = null
            this.currentMetadata.keys = null
            this.isLoading = false
            this.$emit('close', forceReload)
        },

        /**
         *
         */
        initData() {
            this.isLoading = true
            if (this.rowSelected?.id && this.isLoading && !this.row) {
                this.$store.dispatch('details/fetch', this.rowSelected.id).then(() => {
                    this.row = this.detail.detail
                    this.currentMetadata.keys = Object.keys(this.row.parsed_metadata)
                    this.isLoading = false
                }).catch(error => console.log(error))
            }
        },
        /**
         *
         */
        notify() {
            this.$swal.confirm({ title: 'Dispatch notification', message: 'Voulez-vous notifier les autorités concernées?' }).then(action => {
                if (action.isConfirmed) {
                    this.$api.post('notifications/major-fact/' + this.rowSelected.id).then(response => {
                        this.$swal.toast_success(response.data.message)
                        this.close(true)
                    }).catch(error => {
                        this.$swal.alert_error(error)
                    })
                }
            })
        }
    }
}
</script>
