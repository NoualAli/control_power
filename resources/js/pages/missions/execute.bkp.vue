<template>
    <ContentBody v-if="can('control_agency,create_cdc_report,validate_cdc_report')">
        <div class="container">
            <div class="grid">
                <div class="col-1" />
                <div class="col-11">
                    <h2 v-if="process" :key="process">
                        {{ process?.familly?.name }} / {{ process?.domain?.name }} / {{ process?.name }}
                    </h2>
                </div>
                <div class="col-1" />
                <div class="col-11">
                    <Alert v-if="form.errors.any()" type="is-danger">
                        <p class="text-white">
                            Il y a {{ formErrorsCount }}
                            {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
                        </p>
                    </Alert>
                </div>
            </div>
            <form enctype="multipart/form-data" @submit.prevent="create" @keydown="form.onKeydown($event)">
                <div v-for="(detail, row) in details" :key="'detail-' + row" class="form-row">
                    <div class="grid my-2">
                        <div class="col-1" />
                        <div class="col-11">
                            <div class="control-point">
                                {{ detail?.control_point.name }}
                            </div>
                        </div>
                        <div class="col-1" />
                        <div class="col-12 col-lg-8 grid">
                            <!-- Major fact -->
                            <div v-if="detail?.control_point.has_major_fact && [4, 3, 2].includes(form.rows[row].score)"
                                class="col-12">
                                <NLSwitch type="is-danger" v-model="form.rows[row].major_fact"
                                    :name="'rows.' + row + '.major_fact'" :form="form" label="Fait majeur" />
                            </div>
                            <div class="col-12">
                                <NLSelect v-model="form.rows[row].score" :name="'rows.' + row + '.score'" label="Notation"
                                    :form="form" :options="setupScores(detail.control_point.scores)" label-required />
                            </div>

                            <!-- Metadata -->
                            <div v-if="detail.control_point.fields && ![null, undefined, ''].includes(form.rows[row].score) && !['object', 'array'].includes(typeof form.rows[row].score)"
                                class="col-12">
                                <div class="repeater">
                                    <h2 class="mb-6">
                                        Informations supplémentaires
                                    </h2>
                                    <!-- Repeater row -->
                                    <div v-for="(item, dataRow) in form.rows[row].metadata"
                                        :key="'metadata-' + dataRow + 'row-' + row" class="grid my-6 repeater-row">
                                        <div class="col-12">
                                            <div class="grid gap-2">
                                                <div class="col-11">
                                                    <div class="grid">
                                                        <div v-for="(input, index) in setupFields(detail.control_point.fields)"
                                                            :key="'metadata-input-' + input.name + '-' + dataRow + '-id'"
                                                            :class="input.style">
                                                            <!-- Defining different inputs -->
                                                            <NLInput v-if="isInput(input.type)"
                                                                :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                                                v-model="form.rows[row].metadata[dataRow][index][input.name]"
                                                                :form="form" :label="input.label"
                                                                :placeholder="input.placeholder" :type="input.type"
                                                                :label-required="input.required"
                                                                :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                                                :help-text="input.help_text" />

                                                            <NLTextarea v-if="input.type == 'textarea'"
                                                                :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                                                v-model="form.rows[row].metadata[dataRow][index][input.name]"
                                                                :form="form" :label="input.label"
                                                                :placeholder="input.placeholder" :type="input.type"
                                                                :label-required="input.required"
                                                                :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                                                :length="input.length" :help-text="input.help_text" />

                                                            <NLWyswyg v-if="input.type == 'wyswyg'"
                                                                :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                                                v-model="form.rows[row].metadata[dataRow][index][input.name]"
                                                                :form="form" :label="input.label"
                                                                :placeholder="input.placeholder" :type="input.type"
                                                                :label-required="input.required"
                                                                :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                                                :length="input.length" :help-text="input.help_text" />

                                                            <NLSelect v-if="input.type == 'select'"
                                                                :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                                                v-model="form.rows[row].metadata[dataRow][index][input.name]"
                                                                :form="form" :label="input.label" :type="input.type"
                                                                :label-required="input.required"
                                                                :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                                                :options="input.options"
                                                                :placeholder="input.placeholder || 'Choisissez une option...'"
                                                                :multiple="input.multiple" :help-text="input.help_text" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Remove current row -->
                                                <div v-if="row >= 0" class="col-1 p-0 d-flex justify-start align-center">
                                                    <div class="btn btn-danger" @click="removeRow(row, dataRow)">
                                                        Supprimer
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add new row -->
                                    <div class="d-flex justify-start align-center">
                                        <span class="btn" @click="addRow(row, detail.control_point.fields)">
                                            <i class="las la-plus" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Report -->
                            <div class="col-12">
                                <NLTextarea v-model="form.rows[row].report" :name="'rows.' + row + '.report'"
                                    label="Constat" :form="form"
                                    :placeholder="[null, undefined, ''].includes(form.rows[row].score) || ['object', 'array'].includes(typeof form.rows[row].score) && !form.rows[row].major_fact ? '' : 'Ajouter votre constat'"
                                    :label-required="![null, undefined, ''].includes(form.rows[row].score) && !['object', 'array'].includes(typeof form.rows[row].score) || form.rows[row].major_fact"
                                    :disabled="[null, undefined, ''].includes(form.rows[row].score) || ['object', 'array'].includes(typeof form.rows[row].score) && !form.rows[row].major_fact" />
                            </div>
                            <!-- Recovery plan -->
                            <div class="col-12">
                                <NLTextarea v-model="form.rows[row].recovery_plan" :name="'rows.' + row + '.recovery_plan'"
                                    label="Plan de redressement" :form="form"
                                    :placeholder="form.rows[row].score == 1 || [null, undefined, ''].includes(form.rows[row].score) || ['object', 'array'].includes(typeof form.rows[row].score) && !form.rows[row].major_fact ? '' : 'Ajouter votre plan de redressement'"
                                    :label-required="form.rows[row].score > 1 || form.rows[row].major_fact"
                                    :disabled="form.rows[row].score == 1 || [null, undefined, ''].includes(form.rows[row].score) || ['object', 'array'].includes(typeof form.rows[row].score) && !form.rows[row].major_fact" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <!-- Media (attachements) -->
                            <NLFile v-model="form.rows[row].media" :name="'rows.' + row + '.media'" label="Pièces jointes"
                                attachable-type="App\Models\MissionDetail" :attachable-id="form.rows[row].detail"
                                :form="form" multiple />
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-end align-center">
                    <NLButton v-if="!form.process_mode" :loading="form.busy" label="Enregistrer" class="is-radius" />
                    <NLButton v-else :loading="form.busy" label="Valider" class="is-radius" />
                </div>
            </form>
        </div>
    </ContentBody>
</template>

<script>
// import ContentHeader from '../../components/ContentHeader'
import ContentBody from '../../components/ContentBody'
import { mapGetters } from 'vuex'
import Form from 'vform'
import Alert from '../../components/Alert'
export default {
    components: {
        // ContentHeader,
        ContentBody,
        Alert
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],

    data() {
        return {
            details: [],
            process: null,
            form: new Form({
                process_mode: false,
                mission: null,
                process: null,
                rows: []
            })

        }
    },
    computed: {
        formErrorsCount() {
            return Object.entries(this.form.errors.all()).length
        },
        ...mapGetters({
            config: 'details/config'
        })
    },
    created() {
        this.initData()
    },
    mounted() {
        // this.initData()
    },
    methods: {
        /**
         * Initialise les données
         */
        initData() {
            const length = this.$breadcrumbs.value.length
            // this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId }).then(() => {
            // }).catch(error => this.$swal.alert_error(error))
            this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId }).then(() => {
                this.details = this.config.config.details
                this.mission = this.config.config.mission
                this.process = this.config.config.process
                // this.modals.show = false
                // this.modals.edit = false
                if (this.$breadcrumbs.value[ length - 3 ].label === 'Mission') { this.$breadcrumbs.value[ length - 3 ].label = 'Mission ' + this.mission?.reference }
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Exécution de la mission') {
                    // this.$breadcrumbs.value[length - 3].label = ''
                    this.$breadcrumbs.value[ length - 2 ].label = ''
                    this.$breadcrumbs.value[ length - 1 ].label = this.process?.name
                }
                this.initForm()
            })
        },
        /**
         * Initialise le formulaire
         */
        initForm() {
            this.form.mission = this.$route.params.missionId
            this.form.process = this.$route.params.processId
            //   console.log(this.form)
            this.details.forEach(detail => {
                this.form.rows.push({
                    media: detail.media.length ? detail.media.map(file => file.id) : [],
                    detail: detail.id,
                    report: detail.report,
                    recovery_plan: detail.recovery_plan,
                    score: detail.score,
                    major_fact: !!detail.major_fact,
                    major_fact_type: detail.major_fact_type ? detail.major_fact_type : [],
                    metadata: detail.metadata || [],
                    process_mode: this.form.process_mode
                })
            })
        },
        /**
         * Initialise les champs supplémentaire pour chaque point de contrôle
         *
         * @param {Array} fields
         */
        setupFields(fields) {
            //   console.log(fields)

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
            // eslint-disable-next-line eqeqeq
            if (typeof scores == 'object') {
                return scores?.map(score => {
                    return {
                        id: score[ 0 ].score,
                        label: score[ 1 ].label
                    }
                })
            }
            return []
        },
        /**
     * Initialise les notations pour chaque point de contrôle
     *
     * @param {Array|null} majorFactTypes
     */
        setupMajorFactTypes(majorFactTypes) {
            // eslint-disable-next-line eqeqeq
            if (typeof majorFactTypes == 'object') {
                return majorFactTypes?.map(type => {
                    return {
                        id: type[ 0 ].type,
                        label: type[ 0 ].type
                    }
                })
            }

            return []
        },
        /**
         * Création de la mission
         */
        create() {
            //   console.log(this.form)
            this.form.post('/api/missions/details/' + this.$route.params.missionId).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$router.push({ name: 'mission', params: { missionId: this.$route.params.missionId } })
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                let message = error.message
                if (error.response.status === 422) {
                    message = 'Les données fournies sont invalides.'
                }
                this.$swal.toast_error(message)
            })
        },
        /**
         * Ajouter une ligne dans le répéteur
         *
         * @param {Number} row Index de la ligne
         * @param {Number} fields Index du champs
         */
        addRow(row, fields) {
            fields = this.setupFields(fields)
            const schema = []
            for (let index = 0; index < fields.length; index++) {
                const element = fields[ index ]
                const name = element.name
                let defaultValue = element.default !== undefined ? element.default : ''
                defaultValue = element.multiple ? [] : ''
                schema.push({ [ name ]: defaultValue, label: element.label, rules: element.rules })
            }
            console.log(schema)
            if (this.form.rows[ row ].metadata) this.form.rows[ row ].metadata.push(schema)
        },
        /**
         * Supprimer une ligne du répéteur
         *
         * @param {Number} row
         * @param {Number} field
         */
        removeRow(row, field) {
            this.form.rows[ row ].metadata.splice(field, 1)
        },
        /**
         * Vérifie que la valeur est un input valide
         *
         * @param {String} value
         */
        isInput(value) {
            return [ 'text', 'date', 'datetime', 'time', 'week', 'number', 'tel', 'email', 'month', 'url' ].includes(value)
        }
    }
}
</script>
