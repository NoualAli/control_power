<template>
    <div v-if="can('edit_familly')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de famille" />
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
    middleware: [ 'auth', 'admin' ],
    computed: {
        ...mapGetters({
            family: 'families/current'
        })
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('families/fetch', { id: this.$route.params.family }).then(() => {
            const data = this.family.current
            this.form.fill(data)
            this.$store.dispatch('settings/updatePageLoading', false)
        })
    },
    data() {
        return {
            form: new Form({
                name: '',
                code: ''
            })
        }
    },
    methods: {
        update() {
<<<<<<< HEAD:resources/js/pages/admin/families/edit.vue
            this.form.put('families/' + this.$route.params.family).then(response => {
=======
            this.form.put('famillies/' + this.$route.params.familly).then(response => {
>>>>>>> master:resources/js/pages/admin/famillies/edit.vue
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$router.push({ name: 'families-index' })
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
