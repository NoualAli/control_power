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
                <NLColumn
                    v-if="data?.control_point?.has_major_fact && ([2, 3, 4]).includes(Number(form.score))
                        && !data.major_fact && (!Boolean(data?.controlled_by_ci_at) || !Boolean(data?.controlled_by_cdc_at) || !Boolean(data?.controlled_by_cdcr_at) || !Boolean(data?.controlled_by_cc_at) || !Boolean(data?.controlled_by_dcp_at))">
                    <NLSwitch type="is-danger" v-model="form.major_fact" :name="'major_fact'" :form="form"
                        label="Fait majeur" />
                </NLColumn>
                <NLColumn :lg="isContainerExpanded ? 8 : 12"
                    :class="{ 'col-lg-12': !isContainerExpanded, 'col-lg-8': isContainerExpanded }">
                    <NLGrid>
                        <!-- score -->
                        <NLColumn>
                            <NLSelect v-model="form.score" :name="'score'" label="Notation" :form="form"
                                :options="scoresList" label-required
                                v-if="[1, 2].includes(form.currentMode) && !data?.major_fact" />
                            <NLInput v-model="data.appreciation" label="Notation" :readonly="true" v-else />
                        </NLColumn>
                        <!-- Metadata -->
                        <NLColumn
                            v-if="data?.control_point?.fields?.length && Number(form.score) > 0 && [1, 2].includes(form.currentMode)"
                            extraClass="mb-4">
                            <div class="repeater">
                                <h2 class="mb-6">
                                    Informations supplémentaires
                                </h2>
                                <!-- Repeater row -->
                                <NLGrid v-for="( item, dataRow ) in  form.metadata" :key="'metadata-' + dataRow"
                                    extraClass="my-6 repeater-row">
                                    <NLColumn>
                                        <NLFlex alignItems="center">
                                            <b>Ligne n° {{ dataRow + 1 }}</b>

                                            <!-- Remove current row -->
                                            <i class="las la-trash-alt text-danger icon is-clickable"
                                                @click="removeRow(dataRow)"></i>
                                        </NLFlex>
                                    </NLColumn>
                                    <NLColumn>
                                        <NLGrid>
                                            <NLColumn>
                                                <NLGrid>
                                                    <div v-for="( input, index ) in  setupFields(data?.control_point.fields) "
                                                        :key="'metadata-input-' + input.name + '-' + dataRow + '-id'"
                                                        :class="input.style">
                                                        <!-- Defining different inputs -->
                                                        <NLInput v-if="isInput(input.type)"
                                                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            v-model="form.metadata[dataRow][index].value" :form="form"
                                                            :label="input.label" :placeholder="input.placeholder"
                                                            :type="input.type" :label-required="input.required"
                                                            :length="input.length"
                                                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            :helpText="input.help_text" />


                                                        <NLSelect v-if="input.type === 'select'"
                                                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            :options="input.options" :helpText="input.help_text"
                                                            v-model="form.metadata[dataRow][index].value" :form="form"
                                                            :label="input.label" :label-required="input.required"
                                                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            :placeholder="input.placeholder || 'Choisissez une option...'"
                                                            :multiple="input.multiple" />

                                                        <NLTextarea v-if="input.type === 'textarea'"
                                                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            v-model="form.metadata[dataRow][index].value" :form="form"
                                                            :label="input.label" :placeholder="input.placeholder"
                                                            :type="input.type" :label-required="input.required"
                                                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                            :length="input.length" :helpText="input.help_text" />
                                                    </div>
                                                </NLGrid>
                                            </NLColumn>
                                        </NLGrid>
                                    </NLColumn>
                                </NLGrid>
                                <!-- Add new row -->
                                <NLFlex lgAlignItems="center">
                                    <span class="btn has-icon" @click="addRow(data?.control_point.fields)"
                                        title="alt + '+'">
                                        <i class="las la-plus" />
                                    </span>
                                </NLFlex>
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
                                                    <th v-for="( heading, indexHeading ) in  currentMetadata.headings "
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
                                                            <span v-if="key !== 'label' && key !== 'additional_rules'"
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
                <NLColumn :lg="isContainerExpanded ? 4 : 12"
                    v-if="[1, 2].includes(form.currentMode) || (![1, 2].includes(form.currentMode) && Object.values(form.media).length)">
                    <NLFile @uploaded="handleMedia" @deleted="handleMedia" @loaded="handleMedia" v-model="form.media"
                        :name="'media'" label="Pièces jointes" attachable-type="App\Models\MissionDetail"
                        :folder="folderName" :attachable-id="form.detail" :form="form" multiple :canDelete="canDeleteMedia"
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
import NLForm from '../components/NLForm.vue';
import { Form } from 'vform';
import { mapGetters } from 'vuex';
import { hasRole } from '../plugins/user';
import { slugify } from '../plugins/helpers';
import NLComponentLoader from '../components/NLComponentLoader.vue'
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
        },
        folderName() {
            return 'Justificatifs/' + this.slugify(this.detail?.detail?.mission?.campaign?.reference) + '/' + this.slugify(this.detail?.detail?.mission?.reference);
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
            currentMetadata: [],
            scoresList: [],
            isLoading: false,
        }
    },
    methods: {
        /**
         * Force update form media
         */
        handleMedia(files) {
            this.form.media = files
        },
        /**
         * Handle keyboard shortcut
         */
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
        /**
         * Expand and reduce modal
         */
        handleDetailForm(e) {
            this.isContainerExpanded = e
        },
        /**
         * Close modal
         */
        close() {
            this.currentMission = {}
            this.currentMetadata = []
            this.scoresList = []
            this.isLoading = false
            this.form.reset()
            this.$emit('close')
        },
        /**
         * Init form and other data
         */
        initData() {
            this.isLoading = !this.isLoading
            this.$store.dispatch('details/fetch', this.data?.id).then(() => {
                const detail = this.detail.detail
                const metadata = detail.parsed_metadata?.metadata
                this.currentMetadata.headings = detail.parsed_metadata?.headings
                this.currentMetadata.keys = detail.parsed_metadata?.keys
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
                this.form.errors.errors = {}
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
                this.form.metadata = metadata
                this.isLoading = !this.isLoading
                this.setupScores(this.data?.control_point.scores)
                this.loadMissingMetadata()
            }).catch(error => this.$swal.catchError(error))
        },
        /**
         * Save detail
         */
        save() {
            this.formIsLoading = true
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
         * Init additional fields for each control point
         *
         * @param {Array} fields
         */
        setupFields(fields) {
            fields = fields?.map(field => {
                const type = field?.type
                const label = field?.label
                const name = field?.name
                const length = field?.max_length || null
                const style = 'col-12 col-lg-' + field?.columns
                const placeholder = field?.placeholder
                const help_text = field?.help_text
                const required = field?.required
                const additional_rules = field?.additional_rules || []
                const id = field.id
                let options = []
                let multiple = field.is_multiple
                if (field.options) {
                    let optionsArray = field.options.split(',')
                    optionsArray.forEach(option => {
                        options.push({ id: option, label: option })
                    })
                }
                return { type, label, name, length, style, id, placeholder, help_text, additional_rules, required, options, multiple }
            })
            return fields
        },
        /**
         * Load missing metadata in case if a new field was added in course of mission
         */
        loadMissingMetadata() {
            const fields = this.data?.control_point?.fields
            const fieldTypes = fields?.map(field => field.name)
            const existingKeys = [ ...this.currentMetadata.keys ]
            const unexistingKeys = fieldTypes?.filter(key => !existingKeys?.includes(key))
            const fieldsToLoad = fields?.filter(field => unexistingKeys?.includes(field.name))
            const metadata = this.form.metadata
            metadata.forEach(row => {
                fieldsToLoad.forEach(field => {
                    {
                        const element = field
                        const key = element.name
                        let is_multiple = element.is_multiple
                        let is_major_fact = false
                        let value = element.default !== undefined ? element.default : null
                        let label = element.label
                        let additional_rules = element.additional_rules
                        let id = element.id
                        row.push({ key, value, label, additional_rules, id, is_multiple, is_major_fact });
                    }
                })
            })
        },
        /**
         * Init scores for each control point
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
         * Add new row to additional informations
         *
         * @param {Number} fields Index du champs
         */
        addRow(fields) {
            fields = this.setupFields(fields)
            const schema = []
            for (let index = 0; index < fields.length; index++) {
                const element = fields[ index ]
                const key = element.name
                let is_multiple = element.multiple
                let is_major_fact = false
                let value = element.default !== undefined ? element.default : null
                let label = element.label
                let additional_rules = element.additional_rules
                let id = element.id
                value = element.is_multiple ? [] : null
                schema.push({ key, value, label, additional_rules, id, is_multiple, is_major_fact })
            }
            if (this.form.metadata) this.form.metadata.push(schema)
        },
        /**
         * Delete a row from additional informations
         *
         * @param {Number} row
         */
        removeRow(row) {
            this.$swal.confirm_destroy(`Voulez-vous vraiment supprimer la ligne n° ${row + 1}`).then(action => {
                if (action.isConfirmed) {
                    this.form.metadata.splice(row, 1)
                }
            })
        },
        /**
         * Check if value is a valid input type
         *
         * @param {String} value
         */
        isInput(value) {
            return [ 'text', 'date', 'datetime-local', 'time', 'week', 'number', 'tel', 'email', 'month', 'url' ].includes(value)
        },
    }
}
</script>
