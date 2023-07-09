<template>
    <NLModal :show="show" @isExpanded="handleDetailForm" @close="() => this.$emit('close')">
        <template #title>
            <small>
                {{ title }}
            </small>
        </template>
        <template #default>
            <div v-if="!isLoading">
                <NLForm :form="form" :action="save">
                    <NLColumn>
                        <NLSelect v-model="form.controller" name="controllers" :form="form" :options="controllersList"
                            label="Contrôleur" placeholder="Choisissez un contrôleur"
                            no-options-text="Aucun contrôleur disponible"
                            loading-text="Chargement des contrôleurs en cours..." label-required />
                    </NLColumn>
                    <NLColumn>
                        <NLSelect v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF" :multiple="true"
                            placeholder="Choisissez un ou plusieurs PCF" no-options-text="Aucun PCF disponible"
                            loading-text="Chargement des PCF en cours..." label-required />
                    </NLColumn>
                </NLForm>
            </div>

            <!-- Loader -->
            <div class="component-loader-container" v-else>
                <div class="component-loader"></div>
                <div class="component-loader-text">
                    Chargement en cours
                </div>
            </div>
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
export default {
    name: 'MissionAssignationDetailsForm',
    emits: [ 'success', 'close' ],
    components: { NLForm },
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
                this.isLoading = false
            }
        }
    },
    data() {
        return {
            form: new Form({
                controller: null,
                pcf: [],
            }),
            isContainerExpanded: false,
            isLoading: false,
            controllersList: [],
            pcfList: [],
            controllersProcessesList: [],
        }
    },
    methods: {
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
            api.get('missions/' + this.mission.id + '/loadAssignationData/' + this.type).then((response) => {
                this.pcfList = response.data.pcfList
                this.controllersList = response.data.controllersList
            }).catch(error => console.log(error))
        },
        /**
         * Save assignation
         */
        save() {
            this.form.post('/api/missions/' + this.mission?.id + '/assign/' + this.type).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$emit('success')
                    this.form.reset()
                    this.initData()
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
