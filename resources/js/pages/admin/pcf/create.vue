<template>
    <ContentBody>
        <NLForm :action="create" :form="form">
            <!-- Type -->
            <NLColumn lg="4" md="6">
                <NLSelect v-model="form.category" :form="form" name="category" label="Catégorie" :options="categories"
                    placeholder="Veuillez choisir le categorie du texte réglementaire" labelRequired />
            </NLColumn>

            <!-- N° -->
            <NLColumn lg="4" md="6">
                <NLInput v-model="form.number" :form="form" name="number" label="N°"
                    placeholder="Veuillez saisir le n° du texte réglementaire" />
            </NLColumn>

            <!-- Date -->
            <NLColumn lg="4" md="6">
                <NLInputDate v-model="form.date" :form="form" name="date" label="Date" />
            </NLColumn>

            <!-- Object -->
            <NLColumn>
                <NLInput v-model="form.object" :form="form" name="object" label="Objet"
                    placeholder="Veuillez saisir l'objet du texte réglementaire" length="255" />
            </NLColumn>

            <!-- PCF -->
            <NLColumn>
                <NLSelect v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF" :multiple="true"
                    placeholder="Choisissez un ou plusieurs PCF" no-options-text="Aucun PCF disponible"
                    loading-text="Chargement des PCF en cours..." label-required />
            </NLColumn>

            <!-- Media -->
            <NLColumn>
                <NLFile v-model="form.media" :folder="folder" :form="form" :key="refresh" name="media"
                    label="Texte réglementaire" placeholder="Glissez et déposez le texte réglementaire" labelRequired
                    v-if="folder" />
            </NLColumn>

            <NLColumn>
                <NLFlex lgJustifyContent="end">
                    <NLButton :loading="form.busy" label="Ajouter" />
                </NLFlex>
            </NLColumn>
        </NLForm>
    </ContentBody>
</template>

<script>
import Form from 'vform';
import ContentBody from '../../../components/ContentBody'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    components: { ContentBody },
    data() {
        return {
            form: new Form({
                media: null,
                object: null,
                date: null,
                number: null,
                category: null,
                pcf: [],
            }),
            refresh: 0,
            folder: null,
            pcfList: [],
            categories: [
                {
                    id: 'Note',
                    label: 'Note',
                },
                {
                    id: 'Circulaire',
                    label: 'Circulaire',
                },
                {
                    id: 'Lettre-circulaire',
                    label: 'Lettre-circulaire',
                },
                {
                    id: 'Guide 1er niveau',
                    label: 'Guide 1er niveau',
                },
            ]
        }
    },
    watch: {
        "form.category"(newVal, oldVal) {
            if (newVal && newVal !== oldVal) {
                this.folder = '/references/' + newVal
            }
        }
    },
    created() {
        this.fetchPcf()
    },
    methods: {
        fetchPcf() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$api.get('pcf/info/list').then(response => {
                this.pcfList = response?.data?.pcf
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(error => {
                this.$store.dispatch('settings/updatePageLoading', false)
                this.$swal.catchError(error)
            })
        },
        create() {
            this.form.post('pcf').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                    this.refresh += 0
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
