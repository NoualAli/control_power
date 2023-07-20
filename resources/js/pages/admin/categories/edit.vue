<template>
    <div v-if="can('create_agency')">
        <ContentHeader title="Ajouter une nouvelle catégorie" />
        <ContentBody>
            <form @submit.prevent="create" @keydown="form.onKeydown($event)">
                <div class="grid gap-10 my-4">
                    <!-- Name -->
                    <div class="col-12 col-md-6">
                        <NLInput v-model="form.name" :form="form" name="name" label="Name" label-required />
                    </div>
                    <!-- Processus -->
                    <div class="col-12 col-md-6">
                        <NLSelect v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF" :multiple="true"
                            placeholder="Choisissez un ou plusieurs PCF" no-options-text="Aucune PCF disponible"
                            loading-text="Chargement des PCF en cours..." label-required />
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="d-flex justify-end align-center">
                    <NLButton :loading="form.busy" label="Enregistrer" class="is-radius" />
                </div>
            </form>
        </ContentBody>
    </div>
</template>

<script>
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
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
        create() {
            this.form.put('/api/categories/' + this.$route.params.category).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.initData()
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
