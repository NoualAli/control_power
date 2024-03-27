<template>
    <div v-if="can('edit_family')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de famille" />
                </NLColumn>
                <NLColumn lg="6" md="6"></NLColumn>

                <NLColumn lg="6" md="6">
                    <NLSwitch v-model="form.usable_for_agency" :form="form" name="usable_for_agency"
                        label="Utilisable pour agence" label-required />
                </NLColumn>
                <NLColumn lg="6" md="6">
                    <NLSwitch v-model="form.usable_for_dre" :form="form" name="usable_for_dre"
                        label="Utilisable pour DRE" label-required />
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
                name: null,
                usable_for_agency: false,
                usable_for_dre: false,
            })
        }
    },
    methods: {
        update() {
            this.form.put('families/' + this.$route.params.family).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$router.push({ name: 'families-index' })
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
