<template>
    <div v-if="can('create_category')">
        <ContentHeader title="Ajouter une nouvelle catégorie" />
        <ContentBody>
            <NLForm :action="create" :form="form">
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required />
                </NLColumn>
                <!-- Processus -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF" :multiple="true"
                        placeholder="Choisissez un ou plusieurs PCF" no-options-text="Aucun PCF disponible"
                        loading-text="Chargement des PCF en cours..." label-required />
                </NLColumn>
                <!-- Submit Button -->
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
    computed: {
        ...mapGetters({
            config: 'categories/config'
        })
    },
    data() {
        return {
            pcfList: [],
            form: new Form({
                name: null,
                pcf: []
            })
        }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('categories/fetchConfig').then(() => {
            this.pcfList = this.config.config.pcf
            this.$store.dispatch('settings/updatePageLoading', false)
        })
    },
    methods: {
        create() {
            this.form.post('categories').then(response => {
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
