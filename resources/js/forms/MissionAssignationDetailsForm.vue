<template>
    <NLModal :show="show" @isExpanded="handleDetailForm" @close="close">
        <template #title>
            <small>
                {{ title }}
            </small>
        </template>
        <template #default>
            <NLForm :form="form" :action="save" v-if="!isLoading">
                <NLColumn>
                    <NLSelect v-model="form.controller" name="controllers" :form="form" :options="controllersList"
                        label="Contrôleur" placeholder="Choisissez un contrôleur"
                        no-options-text="Aucun contrôleur disponible" loading-text="Chargement des contrôleurs en cours..."
                        label-required />
                </NLColumn>
                <NLColumn>
                    <NLSelect v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF" :multiple="true"
                        placeholder="Choisissez un ou plusieurs PCF" no-options-text="Aucun PCF disponible"
                        loading-text="Chargement des PCF en cours..." label-required :disableBranchNodes="true" />
                </NLColumn>
            </NLForm>
            <NLDatatable :columns="columns" title="PCF assignés"
                :customUrl="'/missions/' + this.mission.id + '/assigned-processes/' + form.controller" urlPrefix=""
                :key="forceReload" v-if="form.controller">
                <template #actions-before="{ item, callback }" v-if="is('cdcr')">
                    <button class="btn btn-danger has-icon" @click.stop="callback(detachProcess, item)">
                        <i class="las la-unlink icon" />
                    </button>
                </template>
            </NLDatatable>
            <!-- Loader -->
            <NLComponentLoader :isLoading="isLoading"></NLComponentLoader>
        </template>
        <template #footer>
            <!-- Submit Button -->
            <NLButton :loading="form.busy" label="Enregistrer" @click.stop="save" />
        </template>
    </NLModal>
</template>

<script>
import api from '../plugins/api'
import NLForm from '../components/NLForm'
import { Form } from 'vform'
import NLComponentLoader from '../components/NLComponentLoader'
import { confirm_destroy } from '../plugins/swal'
export default {
    name: 'MissionAssignationDetailsForm',
    emits: [ 'success', 'close' ],
    components: { NLForm, NLComponentLoader },
    props: {
        title: { type: String, default: null },
        mission: { type: [ Object ], required: true },
        show: { type: Boolean, default: false },
        type: { type: String }
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
            } else {
                this.form.reset()
                this.isLoading = true
            }
        },
        "form.controller"(newValue, oldValue) {
            if (this.newValue !== oldValue) {
                this.forceReload += 1
                return
            }
            // console.log(newValue, oldValue);
        }
    },
    data() {
        return {
            form: new Form({
                controller: null,
                pcf: [],
            }),
            isContainerExpanded: false,
            isLoading: true,
            controllersList: [],
            pcfList: [],
            forceReload: 1,
            columns: [
                {
                    label: 'Famille',
                    field: 'family_name'
                },
                {
                    label: 'Domaine',
                    field: 'domain_name'
                },
                {
                    label: 'Processus',
                    field: 'process_name'
                }
            ]
        }
    },
    methods: {
        /**
         * Remove specified process assignation
         *
         * @param {Object} item
         */
        detachProcess(item) {
            confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('missions/' + this.mission.id + '/assign/' + item.process_id + '/' + this.form.controller + '/' + this.type).then(response => {
                        this.$swal.toast_success(response?.data?.message)
                        this.forceReload += 1
                        this.fetchNotDispatchedPCF()
                    }).catch(error => {
                        this.$swal.alert_error()
                    })
                }
            })
        },
        /**
         * Close modal
         */
        close() {
            this.isContainerExpanded = false
            this.isLoading = false
            this.controllersList = []
            this.pcfList = []
            this.form.reset()
            this.$emit('close')
        },
        /**
         * Handle container expansion
         *
         * @param {Object} e
         */
        handleDetailForm(e) {
            this.isContainerExpanded = e
        },

        /**
         * Initialize data
         */
        initData() {
            this.isLoading = true
            this.currentMission = this.mission
            api.get('missions/' + this.mission.id + '/loadAssignationData/' + this.type).then((response) => {
                this.pcfList = response.data.pcfList
                this.controllersList = response.data.controllersList
                this.isLoading = false
            }).catch(error => console.log(error))
        },

        /**
         * Fetch not yet dispatched PCF
         */
        fetchNotDispatchedPCF() {
            this.isLoading = true
            api.get('missions/' + this.mission.id + '/not-dispatched-processes/' + this.type).then((response) => {
                this.pcfList = response.data
                this.isLoading = false
            }).catch(error => console.log(error))
        },

        /**
         * Save assignation
         */
        save() {
            this.form.post('missions/' + this.mission?.id + '/assign/' + this.type).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$emit('success')
                    this.form.reset()
                    this.initData()
                    this.forceReload += 1
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                console.log(error)
            })
        },
    }
}
</script>
