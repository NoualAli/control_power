<template>
    <NLModal :show="show" @close="close" :isLoading="isLoading">
        <template #title>
            <div class="tags">
                <router-link class="tag is-success" :to="'/campaigns/' + row?.campaign.id" target="_blank">
                    <small class="text-center w-100">
                        {{ row?.campaign?.reference }}
                    </small>
                </router-link>
                <router-link class="tag is-info" :to="'/missions/' + row?.mission.id" target="_blank">
                    <small class="text-center w-100">
                        {{ row?.mission?.reference }}
                    </small>
                </router-link>
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
                        <NLColumn v-if="row?.major_fact || Boolean(row?.major_fact_is_rejected)">
                            <NLGrid>
                                <NLColumn extraClass="text-danger text-bold">
                                    Fait majeur déclencher par {{ row?.major_fact_is_detected_by_full_name }}
                                    le {{ row?.major_fact_is_detected_at }}
                                </NLColumn>
                                <NLColumn
                                    v-if="Boolean(row?.major_fact_is_dispatched_to_dcp_at) && row?.major_fact_is_dispatched_to_dcp_by_full_name !== row?.major_fact_is_detected_by_full_name"
                                    extraClass="text-bold">
                                    Fait majeur valider par {{ row?.major_fact_is_dispatched_to_dcp_by_full_name }}
                                    le {{ row?.major_fact_is_dispatched_to_dcp_at }}
                                </NLColumn>
                                <NLColumn v-if="Boolean(row?.major_fact_is_rejected)" extraClass="text-bold">
                                    Fait majeur rejeter par {{ row?.major_fact_is_rejected_by_full_name }}
                                    le {{ row?.major_fact_is_rejected_at }}
                                </NLColumn>
                                <NLColumn
                                    v-if="Boolean(row?.major_fact_is_dispatched_at) && row?.major_fact_is_dispatched_by_full_name !== row?.major_fact_is_detected_by_full_name"
                                    extraClass="text-bold">
                                    Fait majeur valider par {{ row?.major_fact_is_dispatched_by_full_name }}
                                    le {{ row?.major_fact_is_dispatched_at }}
                                </NLColumn>
                            </NLGrid>
                        </NLColumn>
                        <NLColumn v-if="row?.major_fact && row?.major_fact_is_dispatched_at">
                            <span class="label">Date de transmission: </span>
                            <span v-html="row?.major_fact_is_dispatched_at" />
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
                            <span>{{ row?.family?.name }}</span>
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
                                <span v-html="row?.score_tag" v-if="!is(['ci', 'cdc', 'da'])"></span>
                            </NLFlex>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Metadata -->
                <NLColumn v-if="row?.parsed_metadata?.lines" extraClass="list-ite">
                    <div class="list-item-content no-bg grid">
                        <NLColumn :class="{ 'col-lg-8': !row?.parsed_metadata?.lines }">
                            <div class="table-container " v-if="row?.parsed_metadata?.lines">
                                <h2>
                                    Informations supplémentaires
                                </h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th v-for="( heading, indexHeading ) in  row?.parsed_metadata?.headings"
                                                :key="indexHeading" class="text-left">
                                                {{ heading }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="( line, indexLine ) in row?.parsed_metadata?.lines"
                                            :key="'metadata-row-' + indexLine">
                                            <td v-for="( heading, indexHeading ) in  row?.parsed_metadata?.headings">
                                                {{ row?.parsed_metadata?.metadata[indexLine][indexHeading]?.value }}
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
                            <span v-html="row?.report || '-'" class="content my-2 text-normal"></span>
                            <span>
                                {{ row?.cdc_report?.length ? '(Modifier par CDC)' : '' }}
                            </span>
                        </NLColumn>

                        <!-- Recovery plan -->
                        <NLColumn>
                            <span class="label">Plan de redressement: </span>
                            <span v-html="row?.recovery_plan || '-'" class="content my-2 text-normal"></span>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Media -->
                <NLColumn v-if="row?.media?.length" extraClass="list-item">
                    <NLFile v-model="files" label="Pièces jointes" name="media" :can-delete="false" readonly />
                </NLColumn>

                <!-- Regularization -->
                <NLColumn class="box" v-if="row.show_regularizations">
                    <h2>Historique des actions de régularisation</h2>
                    <NLGrid gap="6" v-if="row?.regularizations?.length" v-for="regularization in row?.regularizations"
                        class="p-4 has-border-radius-1 border-1 border-solid my-6"
                        :class="[{ 'border-success': regularization.is_regularized }, { 'border-warning': !regularization.is_regularized }]">
                        <NLColumn>
                            <label class="label">Action à engager</label>
                            <div v-html="regularization.action_to_be_taken" class="mt-3"></div>
                        </NLColumn>
                        <NLColumn v-if="regularization.media.length">
                            <NLFile v-model="regularization.media_array" label="Pièces jointes" readonly isFlat />
                        </NLColumn>
                        <NLColumn>
                            <NLFlex lgJustifyContent="end">
                                {{ regularization.created_at }}
                            </NLFlex>
                        </NLColumn>
                    </NLGrid>
                    <div class="text-center text-bold my-6" v-else>
                        Aucune entrée
                    </div>
                </NLColumn>
            </NLGrid>
        </template>
        <template #footer>
            <!-- CI -->
            <button v-if="currentMode == 1 && !row?.mission?.is_validated_by_ci && !row?.major_fact && is('ci')"
                class="btn btn-warning has-icon" @click="showForm(row, 'edit')">
                <i class="las la-pen icon" />
                Modifier
            </button>

            <!-- CDC -->
            <button v-if="currentMode == 2 && !row?.mission?.is_validated_by_cdc && !row?.major_fact && is('cdc')"
                class="btn btn-warning has-icon" @click="showForm(row, 'edit')">
                <i class="las la-pen icon" />
                Modifier
            </button>
            <button
                v-if="(currentMode == 2 && !row?.mission?.is_validated_by_dcp && !row?.mission?.is_validated_by_cdcr && !row?.major_fact_is_dispatched_to_dcp_at && !row.regularization && [2, 3, 4].includes(Number(row?.score)) && row?.major_fact && is('cdc'))"
                class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <i class="las la-pen icon" />
                Traiter
            </button>
            <button
                v-if="currentMode == 2 && !row?.major_fact_is_dispatched_to_dcp_at && !row.major_fact_is_rejected && row?.major_fact && is('cdc')"
                class="btn btn-info has-icon" @click.prevent="notify(row)">
                <i class="las la-bell icon" />
                Notifier
            </button>
            <button
                v-if="currentMode == 2 && !row?.major_fact_is_dispatched_to_dcp_at && !row.major_fact_is_rejected && row.major_fact_is_detected_by_id !== user().id && row?.major_fact && is('cdc')"
                class="btn btn-danger has-icon" @click.prevent="reject(row)">
                <i class="las la-ban icon" />
                Rejeter
            </button>

            <!-- CC -->
            <button v-if="currentMode == 3
                && !row.major_fact
                && row.assigned_to_cc_id == user().id
                && !row?.mission?.is_validated_by_cc
                && [2, 3, 4].includes(Number(row?.score))
                && is('cc')" class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <i class="las la-pen icon" />
                Traiter
            </button>

            <!-- CDCR -->
            <button v-if="(currentMode == 4
                && !(row?.major_fact_is_detected_by_id == user().id)
                && !row?.major_fact_is_dispatched_at
                && (row?.mission?.has_dcp_controllers ? row?.mission?.is_validated_by_cc && !row?.mission?.is_validated_by_cdcr : !row?.mission?.is_validated_by_cdcr)
                && row?.mission?.is_validated_by_cdc
                && [2, 3, 4].includes(Number(row?.score)))
                || (row?.major_fact && !row?.major_fact_is_dispatched_at && !(row?.major_fact_is_detected_by_id == user().id) && [2, 3, 4].includes(Number(row?.score)))
                && is('cdcr')" class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <i class="las la-pen icon" />
                Traiter
            </button>

            <!-- DCP -->
            <button v-if="(currentMode == 5
                && !(row?.major_fact_is_detected_by_id == user().id)
                && !row?.mission?.is_validated_by_dcp
                && !row.major_fact_is_rejected
                && row?.mission?.is_validated_by_cdcr
                && !row?.major_fact_is_dispatched_at
                && !row.regularization
                && [2, 3, 4].includes(Number(row?.score))
                || (row?.major_fact && !row?.major_fact_is_dispatched_at && !(row?.major_fact_is_detected_by_id == user().id) && [2, 3, 4].includes(Number(row?.score))))
                && is('dcp')" class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <i class="las la-pen icon" />
                Traiter
            </button>
            <button
                v-if="currentMode == 5 && !row?.major_fact_is_dispatched_at && !row.major_fact_is_rejected && row?.major_fact && row?.major_fact_is_dispatched_to_dcp_at && is('dcp')"
                class="btn btn-info has-icon" @click.prevent="notify(row)">
                <i class="las la-bell icon" />
                Notifier
            </button>
            <button
                v-if="currentMode == 5 && !row?.major_fact_is_dispatched_at && !row.major_fact_is_rejected && row.major_fact_is_detected_by_id !== user().id && row?.major_fact && is('dcp')"
                class="btn btn-danger has-icon" @click.prevent="reject(row)">
                <i class="las la-ban icon" />
                Rejeter
            </button>

            <!-- Agency director -->
            <button
                v-if="currentMode == 6 && row?.mission?.is_validated_by_dcp && !row?.major_fact && !row?.is_regularized && Number(row?.score) !== 1 && is('da')"
                class="btn btn-warning has-icon" @click="showForm(row, 'regularization')">
                <i class="las la-check icon" />
                Régulariser
            </button>
        </template>
    </NLModal>
</template>

<script>
import { mapGetters } from 'vuex'
import { hasRole, user } from '../plugins/user';
export default {
    name: 'MissionDetailModal',
    emits: [ 'close', 'showForm', 'success' ],
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
            currentMode: 1,
            currentUser: null,
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
                this.currentUser = user()
                this.$store.dispatch('details/fetch', this.rowSelected.id).then(() => {
                    this.row = this.detail.detail
                    this.isLoading = false
                    if (hasRole([ 'ci' ])) {
                        this.currentMode = 1 // Execution mode
                    } else if (hasRole('cdc')) {
                        this.currentMode = 2 // Revision mode
                    } else if (hasRole('cc')) {
                        this.currentMode = 3 // First processing mode
                    } else if (hasRole('cdcr')) {
                        this.currentMode = 4 // Second processing mode
                    } else if (hasRole('dcp')) {
                        this.currentMode = 5 // Third processing mode
                    } else {
                        this.currentMode = 6 // Readonly mode
                    }
                }).catch(error => this.$swal.catchError(error))
            }
        },
        /**
         * Notify major fact
         */
        notify() {
            this.$swal.confirm({ title: 'Notification fait majeur', message: 'Voulez-vous notifier les autorités concernées?' }).then(action => {
                if (action.isConfirmed) {
                    this.$api.post('major-facts/' + this.rowSelected.id).then(response => {
                        this.$swal.toast_success(response.data.message)
                        this.$emit('success')
                        this.close(true)
                    }).catch(error => {
                        this.$swal.alert_error(error)
                    })
                }
            })
        },
        /**
         * Reject major fact
         */
        reject() {
            this.$swal.confirm({ title: 'Rejet fait majeur', message: 'Voulez-vous rejeter ce fait majeur?' }).then(action => {
                if (action.isConfirmed) {
                    this.$api.put('major-facts/' + this.rowSelected.id).then(response => {
                        this.$swal.toast_success(response.data.message)
                        this.$emit('success')
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
