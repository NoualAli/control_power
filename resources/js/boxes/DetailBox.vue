<template>
    <!-- Uncontrolled -->
    <div class="box" v-if="!detail?.score && [1, 2].includes(mode)">
        <NLFlex alignItems="center">
            <NLComponentLoader :isLoading="internalLoading"></NLComponentLoader>
            <p class="text-bold">
                {{ detail.control_point }}
            </p>
            <NLFlex>
                <NLButton :type="Boolean(Number(detail.is_disabled)) ? 'success' : 'danger'"
                    :label="Boolean(Number(detail.is_disabled)) ? 'Activer' : 'Desactiver'"
                    v-if="mode == 1 && !detail?.score && user().id == mission.assigned_to_ci_id && !mission.is_validated_by_ci"
                    @click="toggleState()" />
                <NLButton type="info" label="Contrôler"
                    v-if="mode == 1 && !detail?.score && user().id == mission.assigned_to_ci_id && !Boolean(Number(detail.is_disabled))"
                    @click="showForm('edit')" />
            </NLFlex>
        </NLFlex>
    </div>

    <!-- Controlled -->
    <div v-if="detail.score" class="box border-1 border-solid"
        :class="[{ 'p-none': internalLoading, 'border-success': detail?.score == 1 && !Boolean(Number(detail?.major_fact)) }, { 'border-warning': [3, 4].includes(Number(detail?.score)) && !Boolean(Number(detail?.major_fact)) && !is(['ci', 'cdc', 'da']) }, { 'border-info': [2].includes(Number(detail?.score)) && !Boolean(Number(detail?.major_fact)) && !is(['ci', 'cdc', 'da']) }, { 'border-danger': Boolean(Number(detail?.major_fact)) }, { 'border-warning': [2, 3, 4].includes(Number(detail?.score)) && !Boolean(Number(detail?.major_fact)) && is(['ci', 'cdc', 'da']) }]">
        <NLGrid :class="[{ 'p-5': internalLoading }]">
            <NLComponentLoader :isLoading="internalLoading"></NLComponentLoader>
            <!-- Control Point name -->
            <NLColumn>
                <NLFlex lgJustifyContent="between">
                    <h3>{{ detail?.control_point }}</h3>
                    <div v-if="[2, 3, 4].includes(Number(detail?.score)) && is(['cdc', 'cc', 'cdcr', 'dcp'])">
                        <NLSwitch label="Contrôlé" v-model="isControlledForm.isControlled"
                            @switched="handleControlledPCF" :readonly="detail?.mission_is_validated" />
                    </div>
                </NLFlex>
            </NLColumn>

            <!-- Reference -->
            <NLColumn lg="2">
                <b>Référence:</b>
            </NLColumn>
            <NLColumn lg="10" class="text-bold">
                {{ detail?.reference }}
            </NLColumn>

            <!-- Score -->
            <NLColumn lg="2">
                <b>Appréciation:</b>
            </NLColumn>
            <NLColumn lg="10">
                {{ detail?.appreciation }}
            </NLColumn>

            <!-- Report -->
            <NLColumn lg="2">
                <b>Constat:</b>
            </NLColumn>
            <NLColumn lg="10" v-if="detail?.observation?.content" v-html="detail?.observation?.content || '-'">
            </NLColumn>
            <!-- Recovery plan -->
            <NLColumn lg="2" v-if="Number(detail?.score) !== 1">
                <b>Plan de redressement:</b>
            </NLColumn>
            <NLColumn lg="10" v-if="Number(detail?.score) !== 1" v-html="detail?.recovery_plan || '-'">
            </NLColumn>

            <!-- Regularization -->
            <NLColumn lg="2" v-if="mission?.is_validated_by_dcp && detail?.has_any_regularization">
                <b>Etat:</b>
            </NLColumn>
            <NLColumn lg="10" v-if="mission?.is_validated_by_dcp && detail?.has_any_regularization">
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
                    En attente de traitement
                </p>
            </NLColumn>

            <!-- Major fact -->
            <NLColumn v-if="Boolean(Number(detail?.major_fact))">
                <NLGrid>
                    <NLColumn :extraClass="'divider ' + (detail.major_fact ? 'is-danger' : 'is-warning')"
                        v-if="detail?.major_fact_is_detected_at && !is('da')" />
                    <NLColumn>
                        <NLFlex lgJustifyContent="start" lgAlignItems="center">
                            <h3>
                                Fait majeur
                            </h3>
                        </NLFlex>
                    </NLColumn>

                    <NLColumn lg="2" v-if="detail.major_fact_is_detected_at && !is('da')">
                        <b>Déclenché par:</b>
                    </NLColumn>
                    <NLColumn lg="10" v-if="detail.major_fact_is_detected_at && !is('da')">
                        {{ detail?.major_fact_is_detected_by_full_name }}
                    </NLColumn>

                    <NLColumn lg="2" v-if="detail.major_fact_is_detected_at && !is('da')">
                        <b>Date:</b>
                    </NLColumn>
                    <NLColumn lg="10" v-if="detail.major_fact_is_detected_at && !is('da')">
                        {{ detail?.major_fact_is_detected_at }}
                    </NLColumn>

                    <NLColumn lg="2" v-if="detail.major_fact_is_dispatched_to_dcp_by_full_name && !is('da')">
                        <b>Validé par (CDC):</b>
                    </NLColumn>

                    <NLColumn lg="10" v-if="detail.major_fact_is_dispatched_to_dcp_by_full_name && !is('da')">
                        {{ detail.major_fact_is_dispatched_to_dcp_by_full_name }}
                    </NLColumn>

                    <NLColumn lg="2" v-if="detail.major_fact_is_dispatched_to_dcp_at && !is('da')">
                        <b>Date (CDC):</b>
                    </NLColumn>

                    <NLColumn lg="10" v-if="detail.major_fact_is_dispatched_to_dcp_at && !is('da')">
                        {{ detail.major_fact_is_dispatched_to_dcp_at }}
                    </NLColumn>

                    <NLColumn lg="2" v-if="detail.major_fact_is_dispatched_by_full_name && !is('da')">
                        <b>Validé par (DCP):</b>
                    </NLColumn>

                    <NLColumn lg="10" v-if="detail.major_fact_is_dispatched_by_full_name && !is('da')">
                        {{ detail.major_fact_is_dispatched_by_full_name }}
                    </NLColumn>

                    <NLColumn lg="2" v-if="detail.major_fact_is_dispatched_at && !is('da')">
                        <b>Date (DCP):</b>
                    </NLColumn>

                    <NLColumn lg="10" v-if="detail.major_fact_is_dispatched_at && !is('da')">
                        {{ detail.major_fact_is_dispatched_at }}
                    </NLColumn>

                    <NLColumn lg="2"
                        v-if="(Boolean(Number(detail?.major_fact_is_rejected_at_dcp)) || Boolean(Number(detail?.major_fact_is_rejected_at_dre))) && !is('da')">
                        <b>Rejeté par:</b>
                    </NLColumn>

                    <NLColumn lg="10"
                        v-if="(Boolean(Number(detail?.major_fact_is_rejected_at_dcp)) || Boolean(Number(detail?.major_fact_is_rejected_at_dre))) && !is('da')">
                        {{ detail?.major_fact_is_rejected_by_full_name }}
                    </NLColumn>

                    <NLColumn lg="2"
                        v-if="(Boolean(Number(detail?.major_fact_is_rejected_at_dcp)) || Boolean(Number(detail?.major_fact_is_rejected_at_dre))) && !is('da')">
                        <b>Date:</b>
                    </NLColumn>

                    <NLColumn lg="10"
                        v-if="(Boolean(Number(detail?.major_fact_is_rejected_at_dcp)) || Boolean(Number(detail?.major_fact_is_rejected_at_dre))) && !is('da')">
                        {{ detail?.major_fact_is_rejected_at }}
                    </NLColumn>
                </NLGrid>
            </NLColumn>

            <!-- Actions -->
            <NLColumn extraClass="d-flex justify-end align-center">
                <NLFlex gap="2">
                    <button class="btn btn-info has-icon" @click="show()">
                        <NLIcon name="visibility" />
                        Voir plus
                    </button>

                    <!-- CI -->
                    <button
                        v-if="mode == 1 && !Boolean(Number(detail?.major_fact)) && !mission?.is_validated_by_ci && user().id == mission.assigned_to_ci_id"
                        class="btn btn-warning has-icon" @click="showForm('edit')">
                        <NLIcon name="edit" />
                        Modifier
                    </button>
                    <!-- CDC -->
                    <button
                        v-if="mode == 2 && !detail?.mission?.is_validated_by_cdc && !detail?.major_fact && is('cdc')"
                        class="btn btn-warning has-icon" @click="showForm('edit')">
                        <NLIcon name="edit" />
                        Modifier
                    </button>
                    <button
                        v-if="(mode == 2 && !detail?.mission?.is_validated_by_cdcr && !detail?.major_fact_is_dispatched_to_dcp && [2, 3, 4].includes(Number(detail?.score)) && detail?.major_fact && is('cdc'))"
                        class="btn btn-warning has-icon" @click="showForm('processing')">
                        <NLIcon name="edit" />
                        <span v-if="!detail.is_controlled_by_cdc || !detail?.major_fact">Modifier</span>
                        <span v-else>Traiter</span>
                    </button>
                    <button
                        v-if="mode == 2 && !detail?.major_fact_is_dispatched_to_dcp && !Boolean(Number(detail.major_fact_is_rejected_at_dre)) && detail?.major_fact && is('cdc')"
                        class="btn btn-info has-icon" @click.prevent="notify()">
                        <NLIcon name="notifications" />
                        Notifier
                    </button>
                    <button
                        v-if="mode == 2 && !detail?.major_fact_is_dispatched_to_dcp && !Boolean(Number(detail.major_fact_is_rejected_at_dre)) && detail.major_fact_is_detected_by_id !== user().id && detail?.major_fact && is('cdc')"
                        class="btn btn-danger has-icon" @click.prevent="reject()">
                        <i class="las la-ban icon" />
                        Rejeter
                    </button>

                    <!-- CDCR -->
                    <button v-if="mode == 4 &&
        !(detail?.major_fact_is_detected_by_id == user().id)
        && !detail?.major_fact_is_dispatched_at
        && (mission?.assigned_to_cc_id ? mission?.is_validated_by_cc && !mission?.is_validated_by_cdcr : !mission?.is_validated_by_cdcr)
        && [2, 3, 4].includes(Number(detail?.score))
        && is('cdcr')" class="btn btn-warning has-icon" @click="showForm('edit')">
                        <NLIcon name="edit" />
                        <span v-if="detail.is_controlled_by_cdcr">Modifier</span>
                        <span v-else>Traiter</span>
                    </button>

                    <!-- CC -->
                    <button v-if="mode == 3
        && !detail.major_fact
        && !detail?.major_fact_is_dispatched_at
        && mission.assigned_to_cc_id == user().id
        && !mission?.is_validated_by_cc
        && [2, 3, 4].includes(Number(detail?.score))
        && is('cc')" class="btn btn-warning has-icon" @click="showForm('edit')">
                        <NLIcon name="edit" />
                        <span v-if="detail.is_controlled_by_cc">Modifier</span>
                        <span v-else>Traiter</span>
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
                        class="btn btn-warning has-icon" @click="showForm('edit')">
                        <NLIcon name="edit" />
                        <span v-if="detail.is_controlled_by_dcp">Modifier</span>
                        <span v-else>Traiter</span>
                    </button>
                    <button v-if="mode == 5 && !detail?.major_fact_is_dispatched_at && detail?.major_fact && is('dcp')"
                        class="btn btn-info has-icon" @click.prevent="notify()">
                        <NLIcon name="notifications" />
                        Notifier
                    </button>

                    <!-- Agency director -->
                    <button
                        v-if="mission?.is_validated_by_dcp && !mission?.is_validated_by_der && !detail?.reg_is_regularized && Number(detail?.score) !== 1 && is('da')"
                        class="btn btn-warning has-icon" @click="showForm('regularization')">
                        <NLIcon name="done" />
                        Régulariser
                    </button>
                </NLFlex>
            </NLColumn>
        </NLGrid>
    </div>
</template>

<script>
import Form from 'vform'
import NLColumn from '../components/Grid/NLColumn'
import NLGrid from '../components/Grid/NLGrid'
import NLComponentLoader from '~/components/NLComponentLoader'
import { hasRole, user } from '~/plugins/user'
export default {
    name: 'DetailBox',
    components: {
        NLColumn,
        NLGrid, NLComponentLoader
    },
    props: {
        detail: { type: Object, required: true },
        mission: { type: Object, required: true },
        mode: { type: Number, required: true },
        isLoading: { type: Boolean, default: false },
    },
    emits: [ 'show', 'showForm', 'notify', 'reject', 'success', 'controlled' ],
    data() {
        return {
            internalLoading: false,
            currentAction: null,
            isControlledForm: new Form({
                isControlled: false,
            })
        }
    },
    updated() {
        this.internalLoading = this.isLoading
        this.checkIfIsControlled()
    },
    created() {
        this.internalLoading = this.isLoading
        this.checkIfIsControlled()
    },
    methods: {
        /**
         * Check if control point is controlled or not
         */
        checkIfIsControlled() {
            if (hasRole('cdc')) {
                this.isControlledForm.isControlled = this.detail?.is_controlled_by_cdc
            } else if (hasRole('cc')) {
                this.isControlledForm.isControlled = this.detail?.is_controlled_by_cc
            } else if (hasRole('cdcr')) {
                this.isControlledForm.isControlled = this.detail?.is_controlled_by_cdcr
            } else if (hasRole('dcp')) {
                this.isControlledForm.isControlled = this.detail?.is_controlled_by_dcp
            } else if (hasRole('da')) {
                this.isControlledForm.isControlled = this.detail?.is_reg_is_regularized
            }
        },

        /**
         * Handle control value
         *
         * @param {Boolean} value
         */
        handleControlledPCF(value) {
            let state = value ? 'Oui' : 'Non'
            let url = `missions/details/${this.detail.id}/${state}`
            if (!value) {
                this.$swal.confirm_update("Êtes-vous sûr de vouloir marqué ce point comme étant non contrôlé ?").then(action => {
                    if (action.isConfirmed) {
                        this.internalLoading = true
                        this.$alapi.put(url).then(response => {
                            if (response.data.status) {
                                if (value !== this.isControlledForm.isControlled) {
                                    this.$emit('controlled', this.detail)
                                    this.$swal.toast_success(response.data.message)
                                }
                            } else {
                                this.$swal.alert_error(response.data.message)
                            }
                        }).catch(error => {
                            this.$swal.catchError(error)
                        })
                    } else {
                        this.isControlledForm.isControlled = true
                    }
                })
            } else {
                this.internalLoading = true
                this.$alapi.put(url).then(response => {
                    if (response.data.status) {
                        if (value !== this.isControlledForm.isControlled) {
                            this.$swal.toast_success(response.data.message)
                            this.$emit('controlled', this.detail)
                        }
                    } else {
                        this.$swal.alert_error(response.data.message)
                    }
                }).catch(error => {
                    this.$swal.catchError(error)
                })
            }
        },

        /**
         * Toggle detail state
         */
        toggleState() {
            let detail = this.detail
            let message = Boolean(Number(detail.is_disabled)) ? "Êtes-vous sûr de vouloir activer ce point de contrôle ?" : "Êtes-vous sûr de vouloir désactiver ce point de contrôle ?"
            let title = "Confirmation"
            this.$swal.confirm({ message, title }).then(action => {
                if (action.isConfirmed) {
                    this.internalLoading = true
                    this.$alapi.put('missions/details/' + detail.id).then(response => {
                        if (response.data.status) {
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                        this.internalLoading = false
                        this.$emit('success')
                    }).catch(error => {
                        this.internalLoading = false
                        this.$swal.catchError(error)
                    })
                }
            })
        },

        /**
         * Emit show event
         */
        show() {
            this.$emit('show', this.detail)
        },

        /**
         * Emit showForm event
         *
         * @param {String} type
         */
        showForm(type) {
            this.$emit('showForm', { row: this.detail, type })
        },

        /**
         * Emit notify event
         */
        notify() {
            this.$emit('notify', this.detail)
        },

        /**
         * Emit reject event
         */
        reject() {
            this.$emit('reject', this.detail)
        }
    }
}
</script>
