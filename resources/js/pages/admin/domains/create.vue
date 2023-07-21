<template>
    <div v-if="can('create_domain')">
        <ContentHeader title="Ajouter un nouveau domaine" />
        <ContentBody>
            <NLForm :action="create" :form="form">
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
            famillies: 'famillies/all'
        })
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('famillies/fetchAll', false).then(() => {
            this.familliesList = this.famillies.all
            this.$store.dispatch('settings/updatePageLoading', false)
        })
    },
    methods: {
        create() {
            this.form.post('domains').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
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
