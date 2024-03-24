<template>
    <ContentBody v-if="can('edit_category')">
        <NLForm :action="update" :form="form">
            <!-- Name -->
            <NLColumn lg="6" md="6">
                <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required />
            </NLColumn>
            <!-- Processus -->
            <NLColumn lg="6" md="6">
                <NLSelect v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF" :multiple="true"
                    placeholder="Choisissez un ou plusieurs PCF" no-options-text="Aucune PCF disponible"
                    loading-text="Chargement des PCF en cours..." label-required />
            </NLColumn>
            <NLColumn>
                <NLFlex lgJustifyContent="end">
                    <NLButton :loading="form.busy" label="Enregistrer" />
                </NLFlex>
            </NLColumn>
        </NLForm>
    </ContentBody>
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
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('categories/fetchConfig', this.$route.params.category).then(() => {
                this.pcfList = this.config.config.pcf
                this.form.name = this.config.config.category.name
                this.form.pcf = this.config.config.category.processes.map(process => process.id)
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        update() {
            this.form.put('structures/agency-categories/' + this.$route.params.category).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.initData()
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
