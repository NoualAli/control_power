<template @keypress="handleKeyboard">
    <NLModal :show="show" @isExpanded="handleDetailForm" @close="close">
        <template #title>
            <small>
                {{ data?.control_point.name }}
            </small>
        </template>
        <template #default>
            <NLForm :form="form" :action="save" v-if="!isLoading">
                <!-- Major fact -->
                <NLColumn v-if="data?.control_point?.has_major_fact && ([2, 3, 4]).includes(Number(form.score))">
                    <NLSwitch type="is-danger" v-model="form.major_fact" :name="'major_fact'" :form="form"
                        label="Fait majeur" />
                </NLColumn>
                <NLColumn :lg="isContainerExpanded ? 8 : 12"
                    :class="{ 'col-lg-12': !isContainerExpanded, 'col-lg-8': isContainerExpanded }">
                    <NLGrid>
                        <!-- score -->
                        <NLColumn>
                            <NLSelect v-model="form.score" :name="'score'" label="Notation" :form="form"
                                :options="scoresList" label-required v-if="[1, 2].includes(form.currentMode)" />
                            <NLInput v-model="data.appreciation" label="Notation" readonly v-else />
                        </NLColumn>
                        <!-- Metadata -->
                        <NLColumn
                            v-if="data?.control_point.fields && Number(form.score) > 0 && [1, 2].includes(form.currentMode)"
                            extraClass="mb-4">
                            <div class="repeater">
                                <h2 class="mb-6">
                                    Informations supplémentaires
                                </h2>
                                <!-- Repeater row -->
                                <NLGrid v-for="( item, dataRow ) in  form.metadata " :key="'metadata-' + dataRow"
                                    extraClass="my-6 repeater-row">
                                    <NLColumn>
                                        <NLGrid>
                                            <NLColumn sm="11" lg="11" md="11">
                                                <NLGrid>
                                                    <div v-for="( input, index ) in  setupFields(data?.control_point.fields) "
                                                        :key="'metadata-input-' + input.name + '-' + dataRow + '-id'"
                                                        :class="input.style">
                                                        <!-- Defining different inputs -->
                                                        <NLInput v-if="isInput(input.type)"
                                                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            v-model="form.metadata[dataRow][index][input.name]" :form="form"
                                                            :label="input.label" :placeholder="input.placeholder"
                                                            :type="input.type" :label-required="input.required"
                                                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name" />

                                                        <NLTextarea v-if="input.type === 'textarea'"
                                                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            v-model="form.metadata[dataRow][index][input.name]" :form="form"
                                                            :label="input.label" :placeholder="input.placeholder"
                                                            :type="input.type" :label-required="input.required"
                                                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            :length="input.length" />

                                                        <NLWyswyg v-if="input.type === 'wyswyg'"
                                                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            v-model="form.metadata[dataRow][index][input.name]" :form="form"
                                                            :label="input.label" :placeholder="input.placeholder"
                                                            :type="input.type" :label-required="input.required"
                                                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            :length="input.length" />

                                                        <NLSelect v-if="input.type === 'select'"
                                                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            v-model="form.metadata[dataRow][index][input.name]" :form="form"
                                                            :label="input.label" :type="input.type"
                                                            :label-required="input.required"
                                                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            :options="input.options"
                                                            :placeholder="input.placeholder || 'Choisissez une option...'"
                                                            :multiple="input.multiple" />
                                                    </div>
                                                </NLGrid>
                                            </NLColumn>
                                            <!-- Remove current row -->
                                            <NLColumn lg="1" md="1" sm="1" v-if="dataRow >= 0"
                                                extraClass="p-0 d-flex justify-start align-center">
                                                <div class="btn btn-danger" @click="removeRow(dataRow)">
                                                    <i class="las la-trash-alt icon"></i>
                                                </div>
                                            </NLColumn>
                                        </NLGrid>
                                    </NLColumn>
                                </NLGrid>
                                <!-- Add new row -->
                                <div class="d-flex justify-start align-center">
                                    <span class="btn" @click="addRow(data?.control_point.fields)" title="alt + '+'">
                                        <i class="las la-plus" />
                                    </span>
                                </div>
                            </div>
                        </NLColumn>

                        <NLColumn v-else-if="![1, 2].includes(form.currentMode) && data?.metadata" extraClass="list-item">
                            <div class="list-item-content no-bg grid">
                                <div class="col-12" :class="{ 'col-lg-4': !data?.metadata }">
                                    <b>Informations supplémentaires:</b>
                                </div>
                                <div class="col-12" :class="{ 'col-lg-8': !data?.metadata }">
                                    <div class="table-container" v-if="data?.metadata">
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
                                                <tr v-for="( data, row ) in  data?.metadata " :key="'metadata-row-' + row">
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
                                </div>
                            </div>
                        </NLColumn>

                        <!-- Report -->
                        <NLColumn>
                            <NLWyswyg :length="1000" v-model="form.report" :name="'report'" label="Constat" :form="form"
                                :placeholder="![1, 2, 3, 4].includes(Number(form.score)) && !form.major_fact ? 'Constat' : 'Ajouter votre constat'"
                                :label-required="[1, 2, 3, 4].includes(Number(form.score)) || form.major_fact"
                                :readonly="![1, 2].includes(form.currentMode)"
                                :disabled="![1, 2, 3, 4].includes(Number(form.score)) && !form.major_fact" />
                        </NLColumn>

                        <!-- Recovery plan -->
                        <NLColumn>
                            <NLWyswyg :length="1000" v-model="form.recovery_plan" :name="'recovery_plan'"
                                label="Plan de redressement" :form="form"
                                :placeholder="![2, 3, 4].includes(Number(form.score)) && !form.major_fact ? '' : 'Ajouter votre plan de redressement'"
                                :label-required="[2, 3, 4].includes(Number(form.score)) || form.major_fact"
                                :disabled="![2, 3, 4].includes(Number(form.score)) && !form.major_fact" />
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <!-- Media (attachements) -->
                <NLColumn :lg="isContainerExpanded ? 4 : 12">
                    <NLFile @uploaded="handleMedia" @deleted="handleMedia" @loaded="handleMedia" v-model="form.media"
                        :name="'media'" label="Pièces jointes" attachable-type="App\Models\MissionDetail"
                        :attachable-id="form.detail" :form="form" multiple :canDelete="canDeleteMedia"
                        :readonly="![1, 2].includes(form.currentMode)" />
                </NLColumn>
            </NLForm>
            <!-- Loader -->
            <NLComponentLoader :isLoading="isLoading" />
        </template>
        <!-- Submit Button -->
        <template #footer>
            <NLButton :loading="formIsLoading" label="Enregistrer" @click="save" v-if="!isLoading" />
        </template>
    </NLModal>
</template>

<script>
import NLForm from '../components/NLForm';
import { Form } from 'vform';
import { mapGetters } from 'vuex';
import { hasRole } from '../plugins/user';
import NLComponentLoader from '../components/NLComponentLoader'
export default {
    name: 'MissionDetailForm',
    emits: [ 'success', 'close' ],
    components: { NLForm, NLComponentLoader },
    props: {
        data: { type: [ Object, null ], required: true },
        show: { type: Boolean, default: false },
    },

    computed: {
        ...mapGetters({
            detail: 'details/detail',
        }),
        canDeleteMedia() {
            if (this.form.currentMode == 1) {
                return !this.currentMission.is_validated_by_ci
            } else if (this.form.currentMode == 2) {
                return !this.currentMission.is_validated_by_cdc
            } else if (this.form.currentMode == 3) {
                return !this.currentMission.is_validated_by_cdcr
            } else if (this.form.currentMode == 4) {
                return !this.currentMission.is_validated_by_dcp
            }
            return false
        }
    },
    mounted() {
        this.handleKeyboard()
    },
    watch: {
        'form.major_fact': function (newValue, oldValue) {
            if (newValue) {
                this.form.score = this.scoresList[ this.scoresList.length - 1 ].id
            }
        },
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
            } else {
                this.currentMission = {}
                this.currentMetadata = {}
                this.scoresList = []
                this.isLoading = false
            }
        }
    },
    data() {
        return {
            formIsLoading: false,
            form: new Form({
                currentMode: 1,
                mission: null,
                process: null,
                media: {},
                detail: null,
                report: null,
                recovery_plan: null,
                score: null,
                major_fact: null,
                metadata: []
            }),
            currentMission: {},
            isContainerExpanded: false,
            currentMetadata: {},
            scoresList: [],
            isLoading: false,
        }
    },
    methods: {
        handleMedia(files) {
            this.form.media = files
        },

        handleKeyboard() {
            window.addEventListener('keyup', e => {
                if (this.data?.control_point?.fields && Number(this.form.score) > 1 && [ 1, 2 ].includes(this.form.currentMode)) {
                    if (e.key == '+' && e.altKey) {
                        e.preventDefault()
                        this.addRow(this.data?.control_point.fields)
                    }
                    if (e.key == '-' && e.altKey) {
                        e.preventDefault()
                        const totalData = Object.values(this.form.metadata).length
                        if (totalData) {
                            const index = totalData - 1
                            this.removeRow(index)
                        }
                    }
                }
            })
        },
        handleDetailForm(e) {
            this.isContainerExpanded = e
        },
        close() {
            this.currentMission = {}
            this.currentMetadata = {}
            this.scoresList = []
            this.isLoading = false
            this.form.reset()
            this.$emit('close')
        },
        /**
         * Initialize form
         */
        initData() {
            this.isLoading = !this.isLoading
            this.$store.dispatch('details/fetch', this.data?.id).then(() => {
                const detail = this.detail.detail
                this.currentMetadata.keys = typeof detail?.parsed_metadata == 'object' && Object.values(detail?.parsed_metadata).length ? Object.keys(detail?.parsed_metadata) : null
                if (hasRole([ 'ci' ])) {
                    this.form.currentMode = 1 // Execution mode
                } else if (hasRole('cdc')) {
                    this.form.currentMode = 2 // Revision mode
                } else if (hasRole('cc')) {
                    this.form.currentMode = 3 // First processing mode
                } else if (hasRole('cdcr')) {
                    this.form.currentMode = 4 // Second processing mode
                } else if (hasRole('dcp')) {
                    this.form.currentMode = 5 // Third processing mode
                } else {
                    this.form.currentMode = 6 // Readonly mode
                }

                this.currentMission = detail.mission
                this.form.mission = detail.mission_id
                this.form.process = Number(detail.control_point.process_id)
                this.form.detail = detail.id
                this.form.media = detail.media.length ? detail.media.map(file => file.id) : []
                this.form.detail = detail.id
                this.form.report = detail.report
                this.form.recovery_plan = detail.recovery_plan
                this.form.score = detail.score ? parseInt(detail.score) : null
                this.form.major_fact = !!detail.major_fact
                this.form.metadata = detail.metadata || []
                this.isLoading = !this.isLoading
                this.setupScores(this.data?.control_point.scores)
            }).catch(error => console.log(error))
        },
        /**
         * Save detail
         */
        save() {
<<<<<<< HEAD
            this.formIsLoading = true
=======
>>>>>>> master
            this.form.post('missions/details/' + this.data.mission_id).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$emit('success', response)
                } else {
                    this.$swal.alert_error(response.data.message)
                }
                this.formIsLoading = false
            }).catch(error => {
                let message = error.message
                if (error.response.status === 422) {
                    message = 'Les données fournies sont invalides.'
                }
                this.$swal.toast_error(message)
                this.formIsLoading = false

            })
        },
        /**
         * Initialise les champs supplémentaire pour chaque point de contrôle
         *
         * @param {Array} fields
         */
        setupFields(fields) {
            return fields?.map(field => {
                const type = Object.prototype.hasOwnProperty.call(field, 0) ? field[ 0 ].type : ''
                const label = Object.prototype.hasOwnProperty.call(field, 1) ? field[ 1 ].label : ''
                const name = Object.prototype.hasOwnProperty.call(field, 2) ? field[ 2 ].name : ''
                const length = Object.prototype.hasOwnProperty.call(field, 3) ? field[ 3 ].length : null
                const style = Object.prototype.hasOwnProperty.call(field, 4) ? field[ 4 ].style : ''
                const id = Object.prototype.hasOwnProperty.call(field, 5) ? field[ 5 ].id : ''
                const placeholder = Object.prototype.hasOwnProperty.call(field, 6) ? field[ 6 ].placeholder : ''
                const help_text = Object.prototype.hasOwnProperty.call(field, 7) ? field[ 7 ].help_text : ''
                const rules = Object.prototype.hasOwnProperty.call(field, 8) ? field[ 8 ].rules : []
                return { type, label, name, length, style, id, placeholder, help_text, rules }
            })
        },
        /**
         * Initialise les notations pour chaque point de contrôle
         *
         * @param {Array|null} scores
         */
        setupScores(scores) {
            if (typeof scores === 'object') {
                this.scoresList = scores?.map(score => {
                    return {
                        id: score[ 0 ].score,
                        label: score[ 1 ].label
                    }
                })
            }
        },
        /**
         * Ajouter une ligne dans le répéteur
         *
         * @param {Number} fields Index du champs
         */
        addRow(fields) {
            fields = this.setupFields(fields)
            const schema = []
            for (let index = 0; index < fields.length; index++) {
                const element = fields[ index ]
                const name = element.name
                let defaultValue = element.default !== undefined ? element.default : ''
                defaultValue = element.multiple ? [] : ''
                schema.push({ [ name ]: defaultValue, label: element.label, rules: element.rules })
            }
            if (this.form.metadata) this.form.metadata.push(schema)
        },
        /**
         * Supprimer une ligne du répéteur
         *
         * @param {Number} row
         * @param {Number} field
         */
        removeRow(field) {
            this.form.metadata.splice(field, 1)
        },
        /**
         * Vérifie que la valeur est un input valide
         *
         * @param {String} value
         */
        isInput(value) {
            return [ 'text', 'date', 'datetime', 'time', 'week', 'number', 'tel', 'email', 'month', 'url' ].includes(value)
        },
    }
}
</script>
