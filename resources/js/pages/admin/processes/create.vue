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
                <!-- Notes -->
                <NLColumn>
                    <NLFile :key="'notes-' + refresh" v-model="form.notes" :form="form" name="notes" label="Notes"
                        attachable-type="App\Models\Process" folder="references/Note"
                        @uploaded="(e) => handleMedia(e, 'notes')" @deleted="(e) => handleMedia(e, 'notes')"
                        @loaded="(e) => handleMedia(e, 'notes')" />
                </NLColumn>
                <!-- Circulaire -->
                <NLColumn>
                    <NLFile :key="'circulaires-' + refresh" v-model="form.circulaires" :form="form" name="circulaires"
                        label="Circulaires" attachable-type="App\Models\Process" folder="references/Circulaire"
                        @uploaded="(e) => handleMedia(e, 'circulaires')" @deleted="(e) => handleMedia(e, 'circulaires')"
                        @loaded="(e) => handleMedia(e, 'circulaires')" />
                </NLColumn>
                <!-- Lettres-circulaire -->
                <NLColumn>
                    <NLFile :key="'lettre_circulaires-' + refresh" v-model="form.lettreCirculaires" :form="form"
                        name="lettre_circulaires" label="Lettre-circulaire" attachable-type="App\Models\Process"
                        folder="references/Lettre-circulaire" @uploaded="(e) => handleMedia(e, 'lettreCirculaires')"
                        @deleted="(e) => handleMedia(e, 'lettreCirculaires')"
                        @loaded="(e) => handleMedia(e, 'lettreCirculaires')" />
                </NLColumn>
                <!-- Guide 1er niveau -->
                <NLColumn>
                    <NLFile :key="'guides_premier_niveau-' + refresh" v-model="form.guidesPremierNiveau" :form="form"
                        name="guides_premier_niveau" label="Guides 1er niveau" attachable-type="App\Models\Process"
                        folder="references/Guide 1er niveau" @uploaded="(e) => handleMedia(e, 'guidesPremierNiveau')"
                        @deleted="(e) => handleMedia(e, 'guidesPremierNiveau')"
                        @loaded="(e) => handleMedia(e, 'guidesPremierNiveau')" />
                </NLColumn>
                <!-- Others -->
                <NLColumn>
                    <NLFile :key="'autres-' + refresh" v-model="form.others" :form="form" name="autres" label="Autres"
                        attachable-type="App\Models\Process" folder="references/Autre"
                        @uploaded="(e) => handleMedia(e, 'others')" @deleted="(e) => handleMedia(e, 'others')"
                        @loaded="(e) => handleMedia(e, 'others')" />
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
                notes: {},
                circulaires: {},
                lettreCirculaires: {},
                guidesPremierNiveau: {},
                others: {},
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
        create() {
            this.form.post('processes').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.name = null
                    this.form.notes = {}
                    this.form.circulaires = {}
                    this.form.lettreCirculaires = {}
                    this.form.guidesPremierNiveau = {}
                    this.form.others = {}
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
