<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div v-if="can('edit_control_point')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Familliies -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.family_id" :form="form" name="family_id" label="Famille"
                        :options="familliesList" label-required :multiple="false"
                        placeholder="Veuillez choisir une famille"
                        :readonly="!Boolean(Number(controlPoint?.current.is_deletable))" />
                </NLColumn>
                <!-- Domains -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.domain_id" :form="form" name="domain_id" label="Domaine"
                        :options="domainsList" label-required :multiple="false"
                        placeholder="Veuillez choisir un domaine"
                        :readonly="!Boolean(Number(controlPoint?.current.is_deletable))" />
                </NLColumn>
                <!-- Processes -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.process_id" :form="form" name="process_id" label="Processus"
                        :options="processesList" label-required :multiple="false"
                        placeholder="Veuillez choisir un processus"
                        :readonly="!Boolean(Number(controlPoint?.current.is_deletable))" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de point de contrôle" :length="255"
                        :readonly="!Boolean(Number(controlPoint?.current.is_deletable))" />
                </NLColumn>
                <!-- Sampling Fields -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.sampling_fields" :form="form" name="sampling_fields"
                        label="Champs d'échantillonnage" :options="fieldsList" multiple
                        :readonly="!Boolean(Number(controlPoint?.current.is_deletable))" />
                </NLColumn>
                <!-- Display priority -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.display_priority" :form="form" name="display_priority"
                        label="Priorité d'affichage" label-required
                        placeholder="Veuillez saisir la priorité d'affichage" type="number" />
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
                    <NLRepeater name="scores" :row-schema="scoresSchema" :form="form" title="Notations"
                        add-button-label="Ajouter une notation"
                        :readonly="!Boolean(Number(controlPoint?.current.is_deletable))" />
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
            url: 'control-points/concerns/config',
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
                usable_for_agency: false,
                usable_for_dre: false,
                is_active: false,
                display_priority: 1,
                update_others_priority: false,
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
            if (newVal !== oldVal && newVal) {
                this.loadDomains(newVal)
            } else {
                this.domainsList = []
                this.form.domain_id = null
                this.form.process_id = null
            }
        },
        'form.domain_id'(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.loadProcesses(newVal)
            } else {
                this.processesList = []
                this.form.process_id = null
            }
        },
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
                this.controlPoint.current.usable_for_agency = Boolean(Number(this.controlPoint.current.usable_for_agency))
                this.controlPoint.current.usable_for_dre = Boolean(Number(this.controlPoint.current.usable_for_dre))
                this.controlPoint.current.is_active = Boolean(Number(this.controlPoint.current.is_active))
                this.controlPoint.current.update_others_priority = Boolean(Number(this.controlPoint.current.update_others_priority))
                this.form.name = this.controlPoint.current.name
                this.form.family_id = this.controlPoint.current.family.id
                this.form.domain_id = this.controlPoint.current.domain.id
                this.form.process_id = this.controlPoint.current.process.id
                this.form.has_major_fact = this.controlPoint.current.has_major_fact
                this.form.display_priority = this.controlPoint.current.display_priority
                this.form.is_active = this.controlPoint.current.is_active
                this.form.usable_for_agency = this.controlPoint.current.usable_for_agency
                this.form.usable_for_dre = this.controlPoint.current.usable_for_dre
                this.form.scores = this.controlPoint.current.scores ? this.controlPoint.current.scores : []
                this.form.sampling_fields = this.controlPoint.current.fields ? this.controlPoint.current.fields.map((field) => field.id) : []
            })
        },
        /**
     * Récupère la liste des familles
     */
        loadFamillies() {
            this.$store.dispatch('families/fetchAll', { withChildren: false, usableForAgencies: true, usableForDres: true }).then(() => {
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
            this.$swal.confirm_update("Vous souhaitez mettre à jour l'ordre d'affichage des autres familles ?").then(action => {
                this.form.update_others_priority = action.isConfirmed
                this.form.put('control-points/' + this.$route.params.controlPoint).then(response => {
                    if (response.data.status) {
                        this.$swal.toast_success(response.data.message)
                    } else {
                        this.$swal.alert_error(response.data.message)
                    }
                }).catch(error => {
                    this.$swal.catchError(error)
                })
            })
        }
    }
}
</script>
