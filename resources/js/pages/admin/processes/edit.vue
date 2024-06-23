<template>
    <div v-if="can('edit_process')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Familliies -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.family_id" :form="form" name="family_id" label="Famille"
                        :options="familliesList" labelRequired :multiple="false"
                        placeholder="Veuillez choisir une famille"
                        :readonly="!Boolean(Number(process?.current.is_deletable))" />
                </NLColumn>
                <!-- Domains -->
                <NLColumn lg="4" md="4">
                    <NLSelect v-model="form.domain_id" :form="form" name="domain_id" label="Domaine"
                        :options="domainsList" labelRequired :multiple="false" placeholder="Veuillez choisir un domaine"
                        :readonly="!Boolean(Number(process?.current.is_deletable))" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="4" md="4">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" labelRequired
                        placeholder="Veuillez saisir le nom de processus"
                        :readonly="!Boolean(Number(process?.current.is_deletable))" />
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
                        placeholder="Veuillez saisir la priorité d'affichage" type="number" />
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
                        <NLButton :loading="form.busy" label="Mettre à jour" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </ContentBody>
    </div>
</template>

<script>
import NLColumn from '../../../components/Grid/NLColumn'
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    components: { NLColumn },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    computed: {
        ...mapGetters({
            process: 'processes/current',
            family: 'families/domains',
            families: 'families/all'
        })
    },
    watch: {
        'form.family_id': function (newVal, oldVal) {
            if (newVal !== oldVal) { this.loadDomains(newVal) }
        }
    },
    created() {
        this.initData()
    },
    data() {
        return {
            familliesList: [],
            domainsList: [],
            regulations: [],
            form: new Form({
                name: null,
                family_id: null,
                domain_id: null,
                regulations: [],
                usable_for_agency: false,
                usable_for_dre: false,
                display_priority: 1,
                is_active: false,
                update_others_priority: false,
            })
        }
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('processes/fetch', { id: this.$route.params.process }).then(() => {
                this.$store.dispatch('families/fetchAll', { withChildren: false, usableForAgencies: true, usableForDres: true }).then(() => {
                    this.familliesList = this.families.all
                    this.loadDomains(this.form.family_id)
                })
                this.process.current.usable_for_agency = Boolean(Number(this.process.current.usable_for_agency))
                this.process.current.usable_for_dre = Boolean(Number(this.process.current.usable_for_dre))
                this.process.current.is_active = Boolean(Number(this.process.current.is_active))
                this.process.current.update_others_priority = Boolean(Number(this.process.current.update_others_priority))
                this.regulations = this.process?.current?.regulations
                this.form.regulations = this.process?.current?.regulations_id
                this.form.name = this.process?.current?.name
                this.form.family_id = this.process?.current?.family_id
                this.form.domain_id = this.process?.current?.domain_id
                this.form.usable_for_agency = this.process?.current?.usable_for_agency
                this.form.usable_for_dre = this.process?.current?.usable_for_dre
                this.form.is_active = this.process?.current?.is_active
                this.form.display_priority = this.process?.current?.display_priority
                this.$store.dispatch('settings/updatePageLoading', false)
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
        handleMedia(files, type) {
            if (this.form.hasOwnProperty(type)) {
                this.form[ type ] = files
            }
        },
        update() {
            this.$swal.confirm_update("Vous souhaitez mettre à jour l'ordre d'affichage des autres familles ?").then(action => {
                this.form.update_others_priority = action.isConfirmed
                this.form.put('processes/' + this.$route.params.process).then(response => {
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
