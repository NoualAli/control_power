<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div v-if="can('create_control_point')">
        <ContentHeader title="Ajouter une nouveau point de contrôle" />
        <ContentBody>
            <NLForm :action="create" :form="form">
                <!-- Familliies -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.familly_id" :form="form" name="familly_id" label="Famille"
                        :options="familliesList" label-required :multiple="false" />
                </NLColumn>
                <!-- Domains -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.domain_id" :form="form" name="domain_id" label="Domaine" :options="domainsList"
                        label-required :multiple="false" />
                </NLColumn>
                <!-- Processes -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.process_id" :form="form" name="process_id" label="Processus"
                        :options="processesList" label-required :multiple="false" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required />
                </NLColumn>
                <!-- Major fact -->
                <NLColumn>
                    <NLSwitch v-model="form.has_major_fact" name="has_major_fact" :form="form" label="Fait majeur" />
                </NLColumn>
                <!-- Major fact types -->
                <NLColumn v-if="form.has_major_fact">
                    <NLRepeater name="major_fact_types" :row-schema="majorFactTypesSchema" :form="form"
                        title="Types des faits majeur" add-button-label="Ajouter un type" />
                </NLColumn>
                <!-- Scores -->
                <NLColumn>
                    <NLRepeater name="scores" :row-schema="scoresSchema" :form="form" title="Notation"
                        add-button-label="Ajouter une notation" />
                </NLColumn>
                <!-- Fields -->
                <NLColumn>
                    <NLRepeater name="fields" :row-schema="fieldsSchema" :form="form" title="Metadata"
                        add-button-label="Ajouter un champs" />
                </NLColumn>
                <NLColumn>
                    <NLFlex lgJustifyContent="end">
                        <NLButton :loading="form.busy" label="Ajouter" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </ContentBody>
    </div>
</template>

<script>
import NLRepeater from '../../../components/Inputs/NLRepeater'
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    components: {
        NLRepeater
    },
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
    data() {
        return {
            familliesList: [],
            domainsList: [],
            processesList: [],
            validationRulesList: [],
            majorFactTypesSchema: [
                {
                    type: 'text',
                    label: 'Type',
                    name: 'type',
                    placeholder: 'Veuillez saisir le type',
                    required: true,
                    style: 'col-12'
                }
            ],
            scoresSchema: [
                {
                    type: 'number',
                    label: 'Note',
                    name: 'score',
                    placeholder: 'Veuillez saisir la note',
                    required: true,
                    style: 'col-12 col-lg-6'
                },
                {
                    type: 'text',
                    label: 'Label',
                    name: 'label',
                    placeholder: 'Veuillez saisir le label à afficher',
                    required: true,
                    style: 'col-12 col-lg-6'
                }
            ],
            fieldsSchema: [
                {
                    type: 'select',
                    label: 'Type',
                    name: 'type',
                    required: true,
                    style: 'col-12 col-lg-3',
                    placeholder: 'Veuillez choisir un type',
                    options: [
                        {
                            id: 'text',
                            label: 'Text'
                        },
                        {
                            id: 'textarea',
                            label: 'Textarea'
                        },
                        {
                            id: 'number',
                            label: 'Number'
                        },
                        {
                            id: 'select',
                            label: 'Select'
                        },
                        {
                            id: 'date',
                            label: 'Date'
                        },
                        {
                            id: 'datetime',
                            label: 'DateTime'
                        },
                        {
                            id: 'month',
                            label: 'Month'
                        },
                        {
                            id: 'week',
                            label: 'Week'
                        },
                        {
                            id: 'time',
                            label: 'Time'
                        },
                        {
                            id: 'email',
                            label: 'Email'
                        },
                        {
                            id: 'tel',
                            label: 'Tel'
                        }
                    ]
                },
                {
                    type: 'text',
                    label: 'Label',
                    name: 'label',
                    placeholder: 'Veuillez saisir le label du champs',
                    required: true,
                    style: 'col-12 col-lg-3'
                },
                {
                    type: 'text',
                    label: 'Nom',
                    name: 'name',
                    placeholder: 'Veuillez saisir le nom du champs dans la base de données',
                    required: true,
                    style: 'col-12 col-lg-3'
                },
                {
                    type: 'number',
                    label: 'Taille',
                    name: 'length',
                    placeholder: 'Veuillez saisir la taille du champs dans la base de données',
                    required: true,
                    default: 255,
                    style: 'col-12 col-lg-3'
                },
                {
                    type: 'select',
                    label: 'Nombre de colonnes',
                    name: 'style',
                    required: true,
                    style: 'col-12 col-lg-3',
                    placeholder: 'Veuillez choisir le nombre de colonne',
                    options: [
                        {
                            id: 'col-12 col-lg-1',
                            label: '1'
                        },
                        {
                            id: 'col-12 col-lg-2',
                            label: '2'
                        },
                        {
                            id: 'col-12 col-lg-3',
                            label: '3'
                        },
                        {
                            id: 'col-12 col-lg-4',
                            label: '4'
                        },
                        {
                            id: 'col-12 col-lg-5',
                            label: '5'
                        },
                        {
                            id: 'col-12 col-lg-6',
                            label: '6'
                        },
                        {
                            id: 'col-12 col-lg-7',
                            label: '7'
                        },
                        {
                            id: 'col-12 col-lg-8',
                            label: '8'
                        },
                        {
                            id: 'col-12 col-lg-9',
                            label: '9'
                        },
                        {
                            id: 'col-12 col-lg-10',
                            label: '10'
                        },
                        {
                            id: 'col-12 col-lg-11',
                            label: '11'
                        },
                        {
                            id: 'col-12 col-lg-12',
                            label: '12'
                        }
                    ]
                },
                {
                    type: 'text',
                    label: 'Identifiant',
                    name: 'id',
                    placeholder: 'Veuillez saisir l\'identifiant du champs',
                    style: 'col-12 col-lg-3'
                },
                {
                    type: 'text',
                    label: 'Placeholder',
                    name: 'placeholder',
                    placeholder: 'Veuillez saisir le placeholder du champs',
                    style: 'col-12 col-lg-3'
                },
                {
                    type: 'text',
                    label: 'Texte d\'aide',
                    name: 'help_text',
                    placeholder: 'Veuillez saisir le texte d\'aide du champs',
                    style: 'col-12 col-lg-3'
                },
                {
                    type: 'select',
                    label: 'Règles de validation',
                    name: 'rules',
                    required: true,
                    style: 'col-12',
                    multiple: true,
                    placeholder: 'Veuillez choisir une ou plusieurs règles de validation'
                }
            ],
            form: new Form({
                name: null,
                familly_id: null,
                domain_id: null,
                process_id: null,
                scores: [],
                fields: [],
                major_fact_types: [],
                has_major_fact: false
            })
        }
    },
    computed: {
        ...mapGetters({
            famillies: 'famillies/all',
            familly: 'famillies/domains',
            domain: 'domains/processes',
            validationRules: 'settings/validationRules'
        })
    },
    watch: {
        'form.familly_id': function (newVal, oldVal) {
            if (newVal !== oldVal) { this.loadDomains(newVal) }
        },
        'form.domain_id': function (newVal, oldVal) {
            if (newVal !== oldVal) { this.loadProcesses(newVal) }
        }
    },
    created() {
        this.initData()
    },
    methods: {
        /**
         * Initialise les données
         */
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.domainsList = []
            this.processesList = []
            this.loadFamillies()
            this.loadValidationRules()
        },
        /**
         * Récupère la liste des familles
         */
        loadFamillies() {
            this.$store.dispatch('famillies/fetchAll', false).then(() => {
                this.familliesList = this.famillies.all
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        /**
         * Récupère la liste des domains
         * @param {*} value
         */
        loadDomains(value) {
            if (value) {
                this.$store.dispatch('famillies/fetch', { id: value, onlyDomains: true }).then(() => {
                    this.domainsList = this.familly.domains
                })
            } else {
                this.domainsList = []
            }
        },
        /**
         * Récupère la liste des processus
         * @param {*} value
         */
        loadProcesses(value) {
            if (value) {
                this.$store.dispatch('domains/fetch', { id: value, onlyProcesses: true }).then(() => {
                    this.processesList = this.domain.processes
                })
            } else {
                this.processesList = []
            }
        },
        /**
         * Récupère la liste des règles de validation
         */
        loadValidationRules() {
            this.$store.dispatch('settings/fetchValidationRules').then(() => {
                this.validationRulesList = this.validationRules.validationRules
                this.fieldsSchema[ this.fieldsSchema.length - 1 ].options = this.validationRulesList
            })
        },
        /**
         * Ajout un nouveau point de contrôle
         */
        create() {
            this.form.post('control-points').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    // this.form.reset()
                    // this.initData()
                    this.form.name = null
                    // this.form.familly_id = null
                    // this.form.domain_id = null
                    // this.form.process_id = null
                    this.form.scores = []
                    this.form.fields = []
                    this.form.major_fact_types = []
                    this.form.has_major_fact = false
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
