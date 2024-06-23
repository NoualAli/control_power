<template>
    <div v-if="can('create_process')">
        <ContentHeader title="Ajouter un nouveau processus" />
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
                <!-- Name -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de processus" />
                </NLColumn>
                <!-- Regulations -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.regulations" :form="form" name="regulations" label="Textes réglementaires"
                        multiple placeholder="Veuillez choisir un ou plusieurs textes réglementaires"
                        :options="regulations" />
                </NLColumn>
                <!-- Display priority -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.display_priority" :form="form" name="display_priority"
                        label="Priorité d'affichage" label-required
                        placeholder="Veuillez saisir la priorité d'affichage" type="number"
                        :max="max_display_priority" />
                </NLColumn>
                <!-- Is disabled -->
                <NLColumn lg="4" md="4">
                    <NLSwitch v-model="form.is_active" :form="form" name="is_active" label="Actif" label-required />
                </NLColumn>
                <!-- Usable for agency -->
                <!-- <NLColumn lg="4" md="4">
                    <NLSwitch v-model="form.usable_for_agency" :form="form" name="usable_for_agency"
                        label="Utilisable pour agence" label-required />
                </NLColumn> -->
                <!-- Usable for DRE -->
                <!-- <NLColumn lg="4" md="4">
                    <NLSwitch v-model="form.usable_for_dre" :form="form" name="usable_for_dre"
                        label="Utilisable pour DRE" label-required />
                </NLColumn> -->
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
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            url: 'processes/concerns/config',
            refresh: 0,
            familliesList: [],
            domainsList: [],
            regulations: [],
            max_display_priority: 1,
            form: new Form({
                name: null,
                family_id: null,
                domain_id: null,
                regulations: [],
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
            family: 'families/domains'
        })
    },
    watch: {
        'form.family_id'(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                // this.initMaxDisplayPriorityValue()
                this.loadDomains(newVal)
            } else {
                this.domainsList = []
            }
        },
        'form.domain_id'(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.initMaxDisplayPriorityValue()
            }
        },
        'form.usable_for_agency'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.initMaxDisplayPriorityValue()
            }
        },
        'form.usable_for_dre'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.initMaxDisplayPriorityValue()
            }
        },
        'form.is_active'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.initMaxDisplayPriorityValue()
            }
        }
    },

    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('families/fetchAll', { withChildren: false, usableForAgencies: true, usableForDres: true }).then(() => {
                this.familliesList = this.families.all
                this.$api.get('pcf?fetchAll').then(response => {
                    this.regulations = response.data
                    this.$store.dispatch('settings/updatePageLoading', false)
                }).catch(error => {
                    this.$swal.catchError(error)
                    this.$store.dispatch('settings/updatePageLoading', false)
                })
            })
        },
        initMaxDisplayPriorityValue() {
            this.$api.get(this.url, { params: { family: this.form.family_id, domain: this.form.domain_id, usable_for_agency: this.form.usable_for_agency, usable_for_dre: this.form.usable_for_dre, is_active: this.form.is_active } }).then((response) => {
                this.form.display_priority = response.data.display_priority
                this.max_display_priority = response.data.display_priority
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(function (error) {
                this.$store.dispatch('settings/updatePageLoading', false)
                this.$swal.catchError(error)
            })
        },
        loadDomains(value) {
            if (value) {
                this.$store.dispatch('families/fetch', { id: value, onlyDomains: true }).then(() => {
                    this.domainsList = this.family.domains
                })
            } else {
                this.domainsList = []
            }
        },
        create() {
            this.form.post('processes').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.name = null
                    this.form.regulations = []
                    this.initMaxDisplayPriorityValue()
                    this.refresh += 1
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                this.$swal.catchError(error)
            })
        },
        handleMedia(files, type) {
            if (this.form.hasOwnProperty(type)) {
                this.form[ type ] = files
            }
        },
    }
}
</script>
