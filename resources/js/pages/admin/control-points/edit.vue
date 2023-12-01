<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div v-if="can('edit_control_point')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Familliies -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.family_id" :form="form" name="family_id" label="Famille"
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
                        <NLButton :loading="form.busy" label="Mettre à jour" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </ContentBody>
    </div>
</template>

<script>
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
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
            family: 'families/domains',
            domain: 'domains/processes',
            families: 'families/all',
            controlPoint: 'controlPoints/current',
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
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('controlPoints/fetch', this.$route.params.controlPoint).then(() => {
                this.$store.dispatch('fields/fetchAll').then(() => {
                    this.fieldsList = this.fields.all
                })
                this.loadFamillies()
                this.form.name = this.controlPoint.current.name
                this.form.family_id = this.controlPoint.current.family.id
                this.form.domain_id = this.controlPoint.current.domain.id
                this.form.process_id = this.controlPoint.current.process.id
                this.form.has_major_fact = this.controlPoint.current.has_major_fact
                this.form.scores = this.controlPoint.current.scores ? this.controlPoint.current.scores : []
                this.form.sampling_fields = this.controlPoint.current.fields ? this.controlPoint.current.fields.map((field) => field.id) : []
            })
        },
        /**
     * Récupère la liste des familles
     */
        loadFamillies() {
            this.$store.dispatch('families/fetchAll', false).then(() => {
                this.familliesList = this.families.all
                this.loadDomains(this.form.family_id)
                this.loadProcesses(this.form.domain_id)
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
        update() {
            this.form.put('control-points/' + this.$route.params.controlPoint).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
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
