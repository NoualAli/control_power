<template>
    <div v-if="can('edit_process')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Familliies -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.family_id" :form="form" name="family_id" label="Famille"
                        :options="familliesList" labelRequired :multiple="false"
                        placeholder="Veuillez choisir une famille" />
                </NLColumn>
                <!-- Domains -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.domain_id" :form="form" name="domain_id" label="Domaine" :options="domainsList"
                        labelRequired :multiple="false" placeholder="Veuillez choisir un domaine" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" labelRequired
                        placeholder="Veuillez saisir le nom de processus" />
                </NLColumn>
                <!-- Regulations -->
                <NLColumn>
                    <NLSelect v-model="form.regulations" :form="form" name="regulations" label="Textes réglementaires"
                        multiple placeholder="Veuillez choisir un ou plusieurs textes réglementaires"
                        :options="regulations" />
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
                regulations: []
            })
        }
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('processes/fetch', { id: this.$route.params.process }).then(() => {
                this.$store.dispatch('families/fetchAll', false).then(() => {
                    this.familliesList = this.families.all
                    this.loadDomains(this.form.family_id)
                })
                this.regulations = this.process?.current?.regulations
                this.form.regulations = this.process?.current?.regulations_id
                this.form.name = this.process?.current?.name
                this.form.family_id = this.process?.current?.family?.id
                this.form.domain_id = this.process?.current?.domain_id
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
            this.form.put('processes/' + this.$route.params.process).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
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
