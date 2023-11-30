<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div v-if="can('create_field')">
        <ContentHeader title="Ajouter une nouveau champ" />
        <ContentBody>
            <NLForm :action="create" :form="form">
                <NLColumn lg="3">
                    <NLSwitch label="Champ obligatoire ?" name="required" :form="form" v-model="form.required" />
                </NLColumn>
                <NLColumn lg="3">
                    <NLSwitch label="Champ distinct ?" name="distinct" :form="form" v-model="form.distinct" />
                </NLColumn>
                <NLColumn lg="3" v-if="showIntegerOrFloatField">
                    <NLSwitch label="Decimal" name="is_float_or_integer" :form="form" v-model="form.is_integer_or_float" />
                </NLColumn>
                <NLColumn lg="3" v-if="showIsMultipleField">
                    <NLSwitch label="Choix multiple" name="is_multiple" :form="form" v-model="form.is_multiple" />
                </NLColumn>
                <NLColumn></NLColumn>
                <NLColumn lg="4">
                    <NLSelect label="Type" name="type" :form="form" v-model="form.type" :options="fieldTypes"
                        placeholder="Veuillez choisir un type de champ" labelRequired />
                </NLColumn>
                <NLColumn lg="4">
                    <NLInput label="Label" name="label" :form="form" v-model="form.label"
                        placeholder="Veuillez saisir un label descriptif et pertinent" labelRequired :length="70" />
                </NLColumn>
                <NLColumn lg="4">
                    <NLInput label="Name" name="name" :form="form" v-model="form.name"
                        placeholder="Veuillez saisir un name pour le champ" labelRequired :length="25" />
                </NLColumn>
                <NLColumn lg="6" v-if="showOptionsField">
                    <NLTagInput label="Options" name="options" :form="form" v-model="form.options"
                        placeholder="Veuillez saisir les options à selectionnées" labelRequired
                        :helpText="'Ceci est un champ de type tags\nPour ajouter un nouveau tag il suffit de d\'appuyer sur une des touches:\n- Entrer\n- Tab\n- ,'" />
                </NLColumn>
                <NLColumn></NLColumn>
                <NLColumn lg="6">
                    <NLInput label="Placeholder" name="placeholder" :form="form" v-model="form.placeholder"
                        placeholder="Veuillez saisir un placeholder descriptif et pertinent pour le champs" :length="100" />
                </NLColumn>
                <NLColumn lg="6">
                    <NLInput label="Texte d'aide" name="help_text" :form="form" v-model="form.help_text"
                        placeholder="Veuillez saisir un text d'aide descriptif et pertinent pour le champs" :length="255" />
                </NLColumn>
                <NLColumn lg="4" v-if="showLengthField">
                    <NLInput type="number" label="Longueur (minimum)" name="min_length" :form="form"
                        v-model="form.min_length"
                        placeholder="Veuillez saisir la longueur minimum de caractères saisi pour le champ"
                        help_text="Si la longueur minimum n'est pas spécifiée alors la valeur 0 lui sera attribuer"
                        :length="4" />
                </NLColumn>
                <NLColumn lg="4" v-if="showLengthField">
                    <NLInput type="number" label="Longueur (maximum)" name="max_length" :form="form"
                        v-model="form.max_length"
                        placeholder="Veuillez saisir la longueure limite de caractères saisi pour le champ" labelRequired
                        :length="4" />
                </NLColumn>
                <NLColumn lg="4">
                    <NLSelect label="Colonnes" name="columns" :form="form" v-model="form.columns" :options="fieldColumns"
                        placeholder="Veuillez choisir le nombre de colonne que le champs peut occupé" />
                </NLColumn>
                <NLColumn lg="4" v-if="showValidationRulesField">
                    <NLSelect label="Règles de validation" name="validation_rules" :form="form"
                        v-model="form.validation_rules" :options="validationRulesList" multiple
                        placeholder="Veuillez choisir une ou plusieurs règles de validation" />
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
import NLSwitch from '../../../components/Inputs/NLSwitch'
import NLColumn from '../../../components/Grid/NLColumn'
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    components: {
        NLSwitch, NLColumn
    },
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
    data() {
        return {
            showLengthField: false,
            showOptionsField: false,
            showValidationRulesField: false,
            showIntegerOrFloatField: false,
            showIsMultipleField: false,
            fieldTypes: [
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
                    id: 'datetime-local',
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
            ],
            fieldColumns: [
                {
                    id: '1',
                    label: '1 Colonne'
                },
                {
                    id: '2',
                    label: '2 Colonnes'
                },
                {
                    id: '3',
                    label: '3 Colonnes'
                },
                {
                    id: '4',
                    label: '4 Colonnes'
                },
                {
                    id: '5',
                    label: '5 Colonnes'
                },
                {
                    id: '6',
                    label: '6 Colonnes'
                },
                {
                    id: '7',
                    label: '7 Colonnes'
                },
                {
                    id: '8',
                    label: '8 Colonnes'
                },
                {
                    id: '9',
                    label: '9 Colonnes'
                },
                {
                    id: '10',
                    label: '10 Colonnes'
                },
                {
                    id: '11',
                    label: '11 Colonnes'
                },
                {
                    id: '12',
                    label: '12 Colonnes'
                }
            ],
            validationRulesList: [],
            form: new Form({
                label: null,
                name: null,
                required: false,
                distinct: false,
                is_integer_or_float: false,
                is_multiple: false,
                type: null,
                placeholder: null,
                columns: null,
                max_length: 0,
                min_length: 0,
                options: [],
                validation_rules: [],
            })
        }
    },
    watch: {
        "form.type"(newVal, oldVal) {
            if (newVal == undefined) {
                this.showLengthField = false
            }
            if (newVal !== oldVal) {
                this.showLengthField = [ 'text', 'textarea', 'email', 'tel' ].includes(newVal)
                this.showOptionsField = newVal !== oldVal && newVal == 'select'
                this.showIsMultipleField = newVal !== oldVal && newVal == 'select'
                this.showValidationRulesField = [ 'text' ].includes(newVal)
                this.showIntegerOrFloatField = [ 'number' ].includes(newVal)

                this.form.is_multiple = this.showIsMultipleField ? this.form.is_multiple : false
                this.form.is_integer_or_float = this.showIntegerOrFloatField ? this.form.is_integer_or_float : false
                this.form.max_length = this.showLengthField ? this.form.max_length : null
                this.form.min_length = this.showLengthField ? this.form.min_length : null
                this.form.options = this.showOptionsField ? this.form.options : []
                this.form.validation_rules = this.showLengthField ? this.form.validation_rules : []
            }
        }
    },
    computed: {
        ...mapGetters({
            validationRules: 'settings/validationRules'
        })
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
            this.loadValidationRules()
        },

        /**
         * Récupère la liste des règles de validation
         */
        loadValidationRules() {
            this.$store.dispatch('settings/fetchValidationRules').then(() => {
                this.validationRulesList = this.validationRules.validationRules
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        /**
         * Ajout un nouveau point de contrôle
         */
        create() {
            this.form.post('fields').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                this.$swal.catchError(error)
            })
        }
    }
}
</script>
