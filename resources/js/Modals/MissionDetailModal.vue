<template>
    <NLModal :show="show" @close="close" :isLoading="isLoading">
        <template #title>
            <div class="tags is-even">
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
                <!-- Major fact -->
                <NLColumn
                    v-if="(row?.major_fact || (Boolean(row?.major_fact_is_rejected_at_dre) && Boolean(row?.major_fact_is_rejected_at_dcp))) && !is('da')">
                    <NLGrid gap="6" extraClass="box">
                        <NLColumn>
                            <h2>Fait majeur</h2>
                        </NLColumn>
                        <NLColumn extraClass="text-danger text-bold">
                            Fait majeur déclenché par {{ row?.major_fact_is_detected_by_full_name }}
                            le {{ row?.major_fact_is_detected_at }}
                        </NLColumn>
                        <NLColumn
                            v-if="Boolean(row?.major_fact_is_dispatched_to_dcp_at) && row?.major_fact_is_dispatched_to_dcp_by_full_name !== row?.major_fact_is_detected_by_full_name"
                            extraClass="text-bold">
                            Fait majeur validé par {{ row?.major_fact_is_dispatched_to_dcp_by_full_name }}
                            le {{ row?.major_fact_is_dispatched_to_dcp_at }}
                        </NLColumn>
                        <NLColumn
                            v-if="(Boolean(row?.major_fact_is_rejected_at_dre) && Boolean(row?.major_fact_is_rejected_at_dcp))"
                            extraClass="text-bold">
                            Fait majeur rejeter par {{ row?.major_fact_is_rejected_by_full_name }}
                            le {{ row?.major_fact_is_rejected_at }}
                        </NLColumn>
                        <NLColumn
                            v-if="Boolean(row?.major_fact_is_dispatched_at) && row?.major_fact_is_dispatched_by_full_name !== row?.major_fact_is_detected_by_full_name"
                            extraClass="text-bold">
                            Fait majeur validé par {{ row?.major_fact_is_dispatched_by_full_name }}
                            le {{ row?.major_fact_is_dispatched_at }}
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn>
                    <NLGrid gap="6" extraClass="box ">
                        <NLColumn>
                            <h2>Informations de base</h2>
                        </NLColumn>
                        <!-- Basic informations -->
                        <NLColumn v-if="row?.major_fact && row?.major_fact_is_dispatched_at && !is('da')">
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
                        <!-- Regularization -->
                        <NLColumn v-if="row?.mission?.is_validated_by_dcp">
                            <b>Régularisation:</b>
                            <span v-if="row?.reg_is_regularized">
                                Levée
                            </span>
                            <span v-else-if="row?.reg_is_rejected">
                                Rejetée
                            </span>
                            <span v-else-if="row?.reg_is_sanitation_in_progress">
                                En cours d'assainissement
                            </span>
                            <span v-else>
                                Non levée
                            </span>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Metadata -->
                <NLColumn v-if="row?.parsed_metadata?.lines" extraClass="list-item">
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
                    <!-- Report -->
                    <NLGrid gap="6" class="box ">
                        <NLColumn>
                            <h2>Constat</h2>
                        </NLColumn>
                        <NLColumn>
                            <span v-html="row?.observation?.content || '-'" class="content my-2 text-normal"></span>
                            <!-- <span class="text-bold">
                                {{ row?.observation?.creator_full_name || '' }}
                            </span> -->
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Recovery plan -->
                <NLColumn>
                    <NLGrid gap="6" class="box ">
                        <NLColumn>
                            <h2>Plan de redressement</h2>
                        </NLColumn>
                        <NLColumn>
                            <span v-html="row?.recovery_plan || '-'" class="content my-2 text-normal"></span>
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Media -->
                <NLColumn v-if="row?.media?.length">
                    <NLGrid gap="6" class="box ">
                        <NLColumn>
                            <h2>Pièces jointes</h2>
                        </NLColumn>
                        <NLColumn extraClass="list-item">
                            <NLFile v-model="files" label="" name="media" :can-delete="false" readonly />
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Regularization -->
                <NLColumn class="box" v-if="row.show_regularizations">
                    <h2>Historique des actions de régularisation</h2>
                    <NLGrid gap="6" v-if="row?.regularizations?.length" v-for="regularization in row?.regularizations"
                        class="p-4 has-border-radius-1 border-1 border-solid my-6"
                        :class="[{ 'border-success': regularization.is_regularized }, { 'border-info': !regularization.is_regularized }]">
                        <NLColumn v-if="Boolean(Number(regularization.is_rejected))"
                            class="border-warning p-4 has-border-radius-1 border-1 border-solid my-6">
                            <NLGrid>
                                <NLColumn>
                                    <label class="label">
                                        Commentaire du rejet
                                    </label>
                                    <div v-html="regularization.rejection_comment" class="mt-3"></div>
                                </NLColumn>
                                <NLColumn>
                                    <NLFlex lgJustifyContent="between" lgAlignItems="center" alignItems="center">
                                        <span>{{ regularization.rejector_full_name }}</span>
                                        <span>{{ regularization.rejected_at }}</span>
                                    </NLFlex>
                                </NLColumn>
                            </NLGrid>
                        </NLColumn>
                        <NLColumn>
                            <label class="label">
                                Etat
                            </label>
                            <p class="mt-3" v-if="regularization.is_regularized">
                                Levée
                            </p>
                            <p class="mt-3" v-else-if="regularization.is_rejected">
                                Rejetée
                            </p>
                            <p class="mt-3"
                                v-else-if="regularization.is_sanitation_in_progress && !regularization.is_rejected">
                                En cours d'assainissement
                            </p>
                            <p class="mt-3" v-else>
                                Non levée
                            </p>
                        </NLColumn>
                        <NLColumn>
                            <label class="label">
                                Action à engager
                            </label>
                            <div v-html="regularization.action_to_be_taken" class="mt-3"></div>
                        </NLColumn>
                        <NLColumn v-if="regularization.media.length">
                            <NLFile v-model="regularization.media_array" label="Pièces jointes" readonly isFlat />
                        </NLColumn>

                        <!-- Regularization actions -->
                        <NLColumn>
                            <NLFlex lgJustifyContent="between" lgAlignItems="center" alignItems="center">
                                <span>{{ regularization.creator_full_name }}</span>
                                <span>{{ regularization.created_at }}</span>
                            </NLFlex>
                        </NLColumn>
                        <NLColumn>
                            <NLFlex lgJustifyContent="between" lgAlignItems="center" alignItems="center">
                                <!-- Regularization actions -->
                                <NLFlex lgJustifyContent="end" lgAlignItems="center" alignItems="center">
                                    <button
                                        v-if="!regularization.is_rejected && !regularizationRejectionIsOpen && regularization.is_regularized && can('reject_regularization')"
                                        class="btn btn-danger has-icon"
                                        @click.stop="openRegularizationCommentForm(regularization)">
                                        <i class="las la-ban"></i>
                                        Rejeter
                                    </button>
                                    <!-- <button v-if="!derCommentFormIsOpen && is('der')" class="btn btn-info has-icon"
                                        @click.stop="openDerRegularizationCommentForm(regularization)">
                                        <i class="las la-comment"></i>
                                        Ajouter un commentaire
                                    </button> -->
                                </NLFlex>
                            </NLFlex>
                        </NLColumn>

                        <NLColumn
                            v-if="(regularizationRejectionIsOpen && regularization.id == regularizationRejectionForm.regularization_id) || (derCommentFormIsOpen && regularization.id == derCommentForm.regularization_id)">
                            <div class="divider"></div>
                        </NLColumn>

                        <!-- Regularization rejection form -->
                        <NLColumn
                            v-if="regularizationRejectionIsOpen && regularization.id == regularizationRejectionForm.regularization_id">
                            <NLForm :action="handleRegularizationRejection" :form="regularizationRejectionForm">
                                <NLColumn>
                                    <NLWyswyg v-model="regularizationRejectionForm.comment" name="comment"
                                        label="Commentaire" placeholder="Justifié le rejet de cette régularisation"
                                        :form="regularizationRejectionForm" :length="1000" label-required />
                                </NLColumn>
                                <NLColumn>
                                    <!-- Submit Button -->
                                    <div class="col-12 d-flex justify-end align-center">
                                        <NLButton :loading="regularizationRejectionForm.isBusy" label="Enregistrer"
                                            @click="handleRegularizationRejection" />
                                    </div>
                                </NLColumn>
                            </NLForm>
                        </NLColumn>

                        <!-- DER comment form -->
                        <!-- <NLColumn v-if="derCommentFormIsOpen && regularization.id == derCommentForm.regularization_id">
                            <NLForm :action="handleDerCommentForm" :form="derCommentForm">
                                <NLColumn>
                                    <NLWyswyg v-model="derCommentForm.comment" name="comment" label="Commentaire"
                                        placeholder="Ajoutez votre commentaire" :form="derCommentForm" :length="1000"
                                        label-required />
                                </NLColumn>
                                <NLColumn> -->
                        <!-- Submit Button -->
                        <!-- <div class="col-12 d-flex justify-end align-center">
                                        <NLButton :loading="regularizationRejectionForm.isBusy" label="Enregistrer"
                                            @click="handleDerCommentForm" />
                                    </div>
                                </NLColumn>
                            </NLForm>
                        </NLColumn> -->
                    </NLGrid>
                    <div class="text-center text-bold my-6" v-else>
                        Aucune entrée
                    </div>
                </NLColumn>
            </NLGrid>
        </template>
        <template #footer>
            <!-- CI -->
            <button
                v-if="currentMode == 1 && !row?.mission?.is_validated_by_ci && !row?.cdc_report && !row?.major_fact && is('ci') && user().id == row?.mission?.assigned_to_ci_id"
                class="btn btn-warning has-icon" @click="showForm(row, 'edit')">
                <NLIcon name="edit" />
                Modifier
            </button>

            <!-- CDC -->
            <button v-if="currentMode == 2 && !row?.mission?.is_validated_by_cdc && !row?.major_fact && is('cdc')"
                class="btn btn-warning has-icon" @click="showForm(row, 'edit')">
                <NLIcon name="edit" />
                Modifier
            </button>
            <button
                v-if="(currentMode == 2 && !row?.mission?.is_validated_by_dcp && !row?.mission?.is_validated_by_cdcr && !row?.major_fact_is_dispatched_to_dcp_at && !row.regularization && [2, 3, 4].includes(Number(row?.score)) && row?.major_fact && is('cdc'))"
                class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <NLIcon name="edit" />
                Traiter
            </button>
            <button
                v-if="currentMode == 2 && !row?.major_fact_is_dispatched_to_dcp_at && !row.major_fact_is_rejected_at_dre && row?.major_fact && is('cdc')"
                class="btn btn-info has-icon" @click.prevent="notify(row)">
                <NLIcon name="notifications" />
                Notifier
            </button>
            <button
                v-if="currentMode == 2 && !row?.major_fact_is_dispatched_to_dcp_at && !row.major_fact_is_rejected_at_dre && row.major_fact_is_detected_by_id !== user().id && row?.major_fact && is('cdc')"
                class="btn btn-danger has-icon" @click.prevent="reject(row)">
                <i class="las la-ban icon" />
                Rejeter
            </button>

            <!-- CC -->
            <button v-if="currentMode == 3
                && !row.major_fact
                && row?.mission?.assigned_to_cc_id == user().id
                && !row?.mission?.is_validated_by_cc
                && [2, 3, 4].includes(Number(row?.score))
                && is('cc')" class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <NLIcon name="edit" />
                Traiter
            </button>

            <!-- CDCR -->
            <button v-if="(currentMode == 4
                && !(row?.major_fact_is_detected_by_id == user().id)
                && !row?.major_fact_is_dispatched_at
                && (row?.mission?.assigned_to_cc_id ? row?.mission?.is_validated_by_cc && !row?.mission?.is_validated_by_cdcr : !row?.mission?.is_validated_by_cdcr)
                && row?.mission?.is_validated_by_cdc
                && [2, 3, 4].includes(Number(row?.score)))
                || (row?.major_fact && !row?.major_fact_is_dispatched_at && !(row?.major_fact_is_detected_by_id == user().id) && [2, 3, 4].includes(Number(row?.score)))
                && is('cdcr')" class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <NLIcon name="edit" />
                Traiter
            </button>
            <button
                v-if="currentMode == 4 && !row?.major_fact_is_dispatched_at && !row.major_fact_is_rejected_at_dcp && row.major_fact_is_detected_by_id !== user().id && row?.major_fact && is('cdcr')"
                class="btn btn-danger has-icon" @click.prevent="reject(row)">
                <i class="las la-ban icon" />
                Rejeter
            </button>

            <!-- DCP -->
            <button v-if="(currentMode == 5
                && !(row?.major_fact_is_detected_by_id == user().id)
                && !row?.mission?.is_validated_by_dcp
                && !row.major_fact_is_rejected_at_dcp
                && row?.mission?.is_validated_by_cdc
                && !row?.major_fact_is_dispatched_at
                && !row.regularization
                && [2, 3, 4].includes(Number(row?.score))
                || (row?.major_fact && !row?.major_fact_is_dispatched_at && !(row?.major_fact_is_detected_by_id == user().id) && [2, 3, 4].includes(Number(row?.score))))
                && is('dcp')" class="btn btn-warning has-icon" @click="showForm(row, 'processing')">
                <NLIcon name="edit" />
                Traiter
            </button>
            <button
                v-if="currentMode == 5 && !row?.major_fact_is_dispatched_at && !row.major_fact_is_rejected_at_dcp && row?.major_fact && row?.major_fact_is_dispatched_to_dcp_at && is('dcp')"
                class="btn btn-info has-icon" @click.prevent="notify(row)">
                <NLIcon name="notifications" />
                Notifier
            </button>
            <button
                v-if="currentMode == 5 && !row?.major_fact_is_dispatched_at && !row.major_fact_is_rejected_at_dcp && row.major_fact_is_detected_by_id !== user().id && row?.major_fact && is('dcp')"
                class="btn btn-danger has-icon" @click.prevent="reject(row)">
                <i class="las la-ban icon" />
                Rejeter
            </button>

            <!-- DA -->
            <button
                v-if="currentMode == 6 && row?.mission?.is_validated_by_dcp && !row?.reg_is_regularized && Number(row?.score) !== 1 && is('da')"
                class="btn btn-warning has-icon" @click="showForm(row, 'regularization')">
                <NLIcon name="check" />
                Régulariser
            </button>
        </template>
    </NLModal>
</template>

<script>
import { mapGetters } from 'vuex'
import { hasRole, user } from '../plugins/user';
import Form from 'vform';
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
                this.closeRgularizationCommentForm()
            }
        }
    },
    // mounted() {
    //     this.initData()
    // },
    data() {
        return {
            row: null,
            regularizationRejectionIsOpen: false,
            // derCommentFormIsOpen: false,
            currentMetadata: {
                keys: null
            },
            isLoading: false,
            currentMode: 1,
            currentUser: null,
            regularizationRejectionForm: new Form({
                comment: null,
                regularization_id: null,
            }),
            // derCommentForm: new Form({
            //     comment: null,
            //     regularization_id: null,
            // }),
        }
    },

    methods: {
        openRegularizationCommentForm(regularization) {
            this.regularizationRejectionIsOpen = true
            this.regularizationRejectionForm.regularization_id = regularization?.id
        },
        closeRgularizationCommentForm() {
            this.regularizationRejectionIsOpen = false
            this.regularizationRejectionForm.reset()
        },
        // openDerRegularizationCommentForm(regularization) {
        //     this.derCommentFormIsOpen = true
        //     this.derCommentForm.regularization_id = regularization?.id
        // },
        // closeDerRegularizationCommentForm() {
        //     this.derCommentFormIsOpen = false
        //     this.derCommentForm.reset()
        // },
        handleRegularizationRejection() {
            this.$swal.confirm_update("Êtes-vous sûr de vouloir rejeter cette régularisation?").then((action) => {
                if (action.isConfirmed) {
                    this.regularizationRejectionForm.put("regularize/" + this.regularizationRejectionForm.regularization_id + '/reject')
                        .then(response => {
                            if (response.status) {
                                this.closeRgularizationCommentForm()
                                this.$emit('success', response)
                                this.initData()
                                this.$swal.toast_success(response.data.message)
                            } else {
                                this.$swal.alert_error(response.data.message)
                            }
                        }).catch(error => this.$swal.catchError(error))
                }
            })
        },
        // handleRegularizationValidation(regularization) {
        //     this.$swal.confirm_update("Êtes-vous sûr de vouloir valider cette régularisation?").then((action) => {
        //         if (action.isConfirmed) {
        //             this.$api.put("regularize/" + regularization.id + '/accept')
        //                 .then(response => {
        //                     if (response.status) {
        //                         this.$emit('success', response)
        //                         this.initData()
        //                         this.$swal.toast_success(response.data.message)
        //                     } else {
        //                         this.$swal.alert_error(response.data.message)
        //                     }
        //                 }).catch(error => this.$swal.catchError(error))
        //         }
        //     })
        // },
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
         *  Initialize data
         */
        initData() {
            this.isLoading = true
            if (this.rowSelected?.id && this.isLoading) {
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
