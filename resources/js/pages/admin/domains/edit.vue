<!-- eslint-disable vue/multi-word-component-names -->
<template>
    <div v-if="can('edit_domain')">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <!-- Familliies -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.familly_id" :form="form" name="familly_id" label="Famille"
                        :options="familliesList" label-required :multiple="false" />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required />
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
    data() {
        return {
            familliesList: [],
            form: new Form({
                name: null,
                familly_id: null
            })
        }
    },
    computed: {
        ...mapGetters({
            domain: 'domains/current',
            famillies: 'famillies/all'
        })
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('famillies/fetchAll', false).then(() => {
            this.familliesList = this.famillies.all
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
                console.log(error)
            })
        }
    }
}
</script>
