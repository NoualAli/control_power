<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div v-if="can('create_control_point')">
        <ContentHeader title="Ajouter une nouveau point de contrôle" />
        <ContentBody>
            <NLForm :action="create" :form="form">
                <!-- Familliies -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.family_id" :form="form" name="family_id" label="Famille"
                        :options="familliesList" label-required :multiple="false"
                        placeholder="Veuillez choisir une famille" />
                </NLColumn>
                <!-- Domains -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.domain_id" :form="form" name="domain_id" label="Domaine"
                        :options="domainsList" label-required :multiple="false"
                        placeholder="Veuillez choisir un domaine" />
                </NLColumn>
                <!-- Processes -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.process_id" :form="form" name="process_id" label="Processus"
                        :options="processesList" label-required :multiple="false"
                        placeholder="Veuillez choisir un processus" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de point de contrôle" :length="255" />
                </NLColumn>
                <!-- Sampling Fields -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.sampling_fields" :form="form" name="sampling_fields"
                        label="Champs d'échantillonnage" :options="fieldsList" multiple />
                </NLColumn>
                <!-- Display priority -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.display_priority" :form="form" name="display_priority"
                        label="Priorité d'affichage" label-required
                        placeholder="Veuillez saisir la priorité d'affichage" type="number"
                        :max="max_display_priority" />
                </NLColumn>
                <!-- Is disabled -->
                <NLColumn lg="3" md="3">
                    <NLSwitch v-model="form.is_active" :form="form" name="is_active" label="Actif" labelRequired />
                </NLColumn>
                <!-- Usable for agency -->
                <!-- <NLColumn lg="3" md="3">
                    <NLSwitch v-model="form.usable_for_agency" :form="form" name="usable_for_agency"
                        label="Utilisable pour agence" />
                </NLColumn> -->
                <!-- Usable for DRE -->
                <!-- <NLColumn lg="3" md="3">
                    <NLSwitch v-model="form.usable_for_dre" :form="form" name="usable_for_dre"
                        label="Utilisable pour DRE" />
                </NLColumn> -->
                <!-- Major fact -->
                <NLColumn lg="3" md="3">
                    <NLSwitch v-model="form.has_major_fact" name="has_major_fact" :form="form" label="Fait majeur"
                        labelRequired />
                </NLColumn>
                <NLColumn lg="6" md="6"></NLColumn>
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
import NLColumn from '../../../components/Grid/NLColumn'
import NLRepeater from '../../../components/Inputs/NLRepeater'
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    components: {
        NLColumn,
        NLRepeater
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            url: 'control-points/concerns/config',
            max_display_priority: 1,
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
                usable_for_agency: true,
                usable_for_dre: false,
                is_active: false,
                display_priority: 1,
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
            if (newVal !== oldVal && newVal) {
                this.loadDomains(newVal)
                if (this.form.domain_id && this.form.process_id) {
                    this.initMaxDisplayPriorityValue()
                }
            } else {
                this.domainsList = []
                this.form.domain_id = null
                this.form.process_id = null
            }
        },
        'form.domain_id'(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.loadProcesses(newVal)
                if (this.form.family_id && this.form.process_id) {
                    this.initMaxDisplayPriorityValue()
                }
            } else {
                this.processesList = []
                this.form.process_id = null
            }
        },
        'form.process_id'(newVal, oldVal) {
            if (newVal !== oldVal && newVal && this.form.family_id && this.form.domain_id) {
                this.initMaxDisplayPriorityValue()
            }
        },
        'form.usable_for_agency'(newVal, oldVal) {
            if (newVal !== oldVal && this.form.family_id && this.form.domain_id && this.form.process_id) {
                this.initMaxDisplayPriorityValue()
            }
        },
        'form.usable_for_dre'(newVal, oldVal) {
            if (newVal !== oldVal && this.form.family_id && this.form.domain_id && this.form.process_id) {
                this.initMaxDisplayPriorityValue()
            }
        },
        'form.is_active'(newVal, oldVal) {
            if (newVal !== oldVal && this.form.family_id && this.form.domain_id && this.form.process_id) {
                this.initMaxDisplayPriorityValue()
            }
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
        initMaxDisplayPriorityValue() {
            this.$api.get(this.url, { params: { family: this.form.family_id, domain: this.form.domain_id, process: this.form.process_id, usable_for_agency: this.form.usable_for_agency, usable_for_dre: this.form.usable_for_dre, is_active: this.form.is_active } }).then((response) => {
                this.form.display_priority = response.data.display_priority
                this.max_display_priority = response.data.display_priority
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(function (error) {
                this.$store.dispatch('settings/updatePageLoading', false)
                this.$swal.catchError(error)
            })
        },
        /**
         * Récupère la liste des familles
         */
        loadFamillies() {
            this.$store.dispatch('families/fetchAll', { withChildren: false, usableForAgencies: true, usableForDres: true }).then(() => {
                this.familliesList = this.families.all
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        /**
         * Récupère la liste des domains
         * @param {*} value
         */
        loadDomains(value) {
            this.domainsList = []
            this.processesList = []
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
            this.processesList = []
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
                this.$swal.catchError(error)
            })
        }
    }
}
</script>
