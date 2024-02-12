<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div v-if="can('edit_domain')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Familliies -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.family_id" :form="form" name="family_id" label="Famille"
                        :options="familliesList" label-required :multiple="false"
                        placeholder="Veuillez choisir une famille" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required
                        placeholder="Veuillez saisir le nom de domaine" />
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
    data() {
        return {
            familliesList: [],
            form: new Form({
                name: null,
                family_id: null
            })
        }
    },
    computed: {
        ...mapGetters({
            domain: 'domains/current',
            families: 'families/all'
        })
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('families/fetchAll', false).then(() => {
            this.familliesList = this.families.all
            this.$store.dispatch('domains/fetch', { id: this.$route.params.domain }).then(() => {
                const data = this.domain.current
                this.form.fill(data)
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        })
    },
    methods: {
        update() {
            this.form.put('domains/' + this.$route.params.domain).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$router.push({ name: 'domains-index' })
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
