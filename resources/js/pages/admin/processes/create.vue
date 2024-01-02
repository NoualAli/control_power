<template>
    <div v-if="can('create_process')">
        <ContentHeader title="Ajouter un nouveau processus" />
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
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de processus" />
                </NLColumn>
                <!-- Docs -->
                <NLColumn>
                    <NLFile :key="refresh" v-model="form.media" :form="form" name="media" label="Documentation"
                        attachable-type="App\Models\Process" @uploaded="handleMedia" @deleted="handleMedia"
                        @loaded="handleMedia" />
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
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            refresh: 0,
            familliesList: [],
            domainsList: [],
            form: new Form({
                name: null,
                family_id: null,
                domain_id: null,
                media: {},
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
        'form.family_id': function (newVal, oldVal) {
            if (newVal !== oldVal) { this.loadDomains(newVal) }
        }
    },

    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('families/fetchAll', false).then(() => {
                this.familliesList = this.families.all
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
        handleMedia(files) {
            this.form.media = files
        },
        create() {
            this.form.post('processes').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.name = null
                    this.form.media = {}
                    this.refresh += 1
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
