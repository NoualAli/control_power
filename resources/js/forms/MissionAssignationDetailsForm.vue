<template>
    <div class="box my-10" v-if="show">
        <NLGrid>
            <NLColumn>
                <h2>
                    {{ title }}
                </h2>
            </NLColumn>
            <NLColumn>
                <NLForm :form="form" :action="save" v-if="!isLoading" :hasBox="false">
                    <NLColumn>
                        <NLSelect v-model="form.controller" name="controllers" :form="form" :options="controllersList"
                            label="Contrôleur" placeholder="Choisissez un contrôleur"
                            no-options-text="Aucun contrôleur disponible"
                            loading-text="Chargement des contrôleurs en cours..." />
                    </NLColumn>
                    <NLColumn>
                        <NLButton :loading="formIsLoading" label="Enregistrer" @click.stop="save" />
                    </NLColumn>
                    <NLComponentLoader :isLoading="isLoading"></NLComponentLoader>
                </NLForm>
            </NLColumn>
        </NLGrid>
    </div>
</template>

<script>
import api from '../plugins/api'
import NLForm from '../components/NLForm'
import { Form } from 'vform'
import NLComponentLoader from '../components/NLComponentLoader'
import { confirm } from '../plugins/swal'
import { hasRole } from '../plugins/user'
export default {
    name: 'MissionAssignationDetailsForm',
    emits: [ 'success', 'close' ],
    components: { NLForm, NLComponentLoader },
    props: {
        // title: { type: String, default: null },
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
                this.refresh += 1
                if (newValue == this.mission.assigned_to_cc_id) {
                    this.form.is_validator = true
                } else {
                    this.form.is_validator = false
                }
                return
            }
        }
    },
    computed: {
        title() {
            if (hasRole('cdcr')) {
                return 'Déléguer le traitement des anomalies de la mission ' + this.mission?.reference
            } else if (hasRole('der')) {
                return 'Déléguer la mission ' + this.mission?.reference
            }
        }
    },
    data() {
        return {
            formIsLoading: false,
            form: new Form({
                controller: null,
                pcf: [],
                is_validator: false,
            }),
            isContainerExpanded: false,
            isLoading: true,
            controllersList: [],
            pcfList: [],
            refresh: 0,
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
    // mounted() {
    //     this.initData()
    // },
    methods: {
        /**
         * Remove specified process assignation
         *
         * @param {Object} item
         */
        detachProcess(item) {
            confirm({ message: "Êtes-vous sûr de vouloir détaché le processus <b>" + item?.process_name + "</b>" }).then((action) => {
                if (action.isConfirmed) {
                    api.delete('missions/' + this.mission.id + '/assign/' + item.process_id + '/' + this.form.controller + '/' + this.type).then(response => {
                        this.$swal.toast_success(response?.data?.message)
                        this.refresh += 1
                        this.$emit('success')
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
                if ([ 'cc', 'cder' ].includes(this.type)) {
                    this.form.controller = response.data.controller
                } else {
                    this.pcfList = response.data.pcfList
                }
                this.controllersList = response.data.controllersList
                this.isLoading = false
            }).catch(error => {
                if (error?.response?.status == 422) {
                    this.$swal.alert_error(error?.response?.data?.message)
                } else {
                    this.$swal.catchError(error, false)
                }
            })
        },

        /**
         * Fetch not yet dispatched PCF
         */
        fetchNotDispatchedPCF() {
            this.isLoading = true
            api.get('missions/' + this.mission.id + '/not-dispatched-processes/' + this.type).then((response) => {
                this.pcfList = response.data
                this.isLoading = false
            }).catch(error => this.$swal.catchError(error))
        },

        /**
         * Save assignation
         */
        save() {
            this.formIsLoading = true
            this.form.post('missions/' + this.mission?.id + '/assign/' + this.type).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$emit('success')
                    this.form.reset()
                    this.initData()
                    this.refresh += 1
                } else {
                    this.$swal.alert_error(response.data.message)
                }
                this.formIsLoading = false
            }).catch(error => {
                this.$swal.catchError(error)
                this.formIsLoading = false
            })
        },
    }
}
</script>
