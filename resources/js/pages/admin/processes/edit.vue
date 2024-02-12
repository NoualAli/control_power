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
                <!-- Notes -->
                <NLColumn>
                    <NLFile v-model="form.notes" :form="form" name="notes" label="Notes"
                        attachable-type="App\Models\Process" folder="references/Note" :attachable-id="process.current.id"
                        @uploaded="(files) => handleMedia(files, 'notes')" @deleted="(files) => handleMedia(files, 'notes')"
                        @loaded="(files) => handleMedia(files, 'notes')" />
                </NLColumn>
                <!-- Circulaire -->
                <NLColumn>
                    <NLFile v-model="form.circulaires" :form="form" name="circulaires" label="Circulaires"
                        attachable-type="App\Models\Process" folder="references/Circulaire"
                        :attachable-id="process.current.id" @uploaded="(files) => handleMedia(files, 'circulaires')"
                        @deleted="(files) => handleMedia(files, 'circulaires')"
                        @loaded="(files) => handleMedia(files, 'circulaires')" />
                </NLColumn>
                <!-- Lettres-circulaire -->
                <NLColumn>
                    <NLFile v-model="form.lettreCirculaires" :form="form" name="lettre_circulaires"
                        label="Lettre-circulaire" attachable-type="App\Models\Process" folder="references/Lettre-circulaire"
                        :attachable-id="process.current.id" @uploaded="(files) => handleMedia(files, 'lettre_circulaires')"
                        @deleted="(files) => handleMedia(files, 'lettre_circulaires')"
                        @loaded="(files) => handleMedia(files, 'lettre_circulaires')" />
                </NLColumn>
                <!-- Guide 1er niveau -->
                <NLColumn>
                    <NLFile v-model="form.guidesPremierNiveau" :form="form" name="guides_premier_niveau"
                        label="Guides 1er niveau" attachable-type="App\Models\Process" folder="references/Guide 1er niveau"
                        :attachable-id="process.current.id"
                        @uploaded="(files) => handleMedia(files, 'guides_premier_niveau')"
                        @deleted="(files) => handleMedia(files, 'guides_premier_niveau')"
                        @loaded="(files) => handleMedia(files, 'guides_premier_niveau')" />
                </NLColumn>
                <!-- Others -->
                <NLColumn>
                    <NLFile v-model="form.others" :form="form" name="autres" label="Autres"
                        attachable-type="App\Models\Process" folder="references/Autre" :attachable-id="process.current.id"
                        @uploaded="(files) => handleMedia(files, 'autres')"
                        @deleted="(files) => handleMedia(files, 'autres')"
                        @loaded="(files) => handleMedia(files, 'autres')" />
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
            form: new Form({
                name: null,
                family_id: null,
                domain_id: null,
                notes: {},
                circulaires: {},
                lettreCirculaires: {},
                guidesPremierNiveau: {},
                others: {},
                media: {},
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
                this.form.notes = this.process.current.notes?.map((item) => item.id)
                this.form.circulaires = this.process.current.circulaires?.map((item) => item.id)
                this.form.lettreCirculaires = this.process.current.lettres_circulaire?.map((item) => item.id)
                this.form.guidesPremierNiveau = this.process.current.guides_premier_niveau?.map((item) => item.id)
                this.form.others = this.process.current.others?.map((item) => item.id)
                this.form.name = this.process.current.name
                this.form.family_id = this.process.current.family.id
                this.form.domain_id = this.process.current.domain_id
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
