<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div v-if="can('create_control_point')">
        <ContentHeader title="Ajouter une nouveau point de contrôle" />
        <ContentBody>
            <NLForm :action="create" :form="form">
                <!-- Familliies -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.family_id" :form="form" name="family_id" label="Famille"
                        :options="familliesList" label-required :multiple="false"
                        placeholder="Veuillez choisir une famille" />
                </NLColumn>
                <!-- Domains -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.domain_id" :form="form" name="domain_id" label="Domaine" :options="domainsList"
                        label-required :multiple="false" placeholder="Veuillez choisir un domaine" />
                </NLColumn>
                <!-- Processes -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.process_id" :form="form" name="process_id" label="Processus"
                        :options="processesList" label-required :multiple="false"
                        placeholder="Veuillez choisir un processus" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de point de contrôle" />
                </NLColumn>
                <!-- Major fact -->
                <NLColumn>
                    <NLSwitch v-model="form.has_major_fact" name="has_major_fact" :form="form" label="Fait majeur" />
                </NLColumn>
                <!-- Sampling Fields -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.sampling_fields" :form="form" name="sampling_fields"
                        label="Champs d'échantillonnage" :options="fieldsList" multiple />
                </NLColumn>
                <!-- Scores -->
                <NLColumn>
                    <NLRepeater name="scores" :row-schema="scoresSchema" :form="form" title="Notation"
                        add-button-label="Ajouter une notation" />
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
    middleware: [ 'auth' ],
    data() {
        return {
            familliesList: [],
            domainsList: [],
            processesList: [],
            fieldsList: [],
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
            form: new Form({
                name: null,
                family_id: null,
                domain_id: null,
                process_id: null,
                has_major_fact: false,
                scores: [],
                sampling_fields: [],
            })
        }
    },
    computed: {
        ...mapGetters({
            families: 'families/all',
            family: 'families/domains',
            domain: 'domains/processes',
            fields: 'fields/all'
        })
    },
    watch: {
        'form.family_id': function (newVal, oldVal) {
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
            this.$store.dispatch('fields/fetchAll').then(() => {
                this.fieldsList = this.fields.all
            })
        },
        /**
         * Récupère la liste des familles
         */
        loadFamillies() {
            this.$store.dispatch('families/fetchAll', false).then(() => {
                this.familliesList = this.families.all
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        /**
         * Récupère la liste des domains
         * @param {*} value
         */
        loadDomains(value) {
            if (value) {
                this.$store.dispatch('families/fetch', { id: value, onlyDomains: true }).then(() => {
                    this.domainsList = this.family.domains
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
         * Ajout un nouveau point de contrôle
         */
        create() {
            this.form.post('control-points').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
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
