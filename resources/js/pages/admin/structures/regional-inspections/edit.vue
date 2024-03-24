<template>
    <ContentBody v-if="can('edit_regional_inspection')">
        <NLForm :action="update" :form="form">
            <!-- Code -->
            <NLColumn lg="6" md="6">
                <NLInput v-model="form.code" type="number" :form="form" name="code" label="Code" label-required />
            </NLColumn>
            <!-- Name -->
            <NLColumn lg="6" md="6">
                <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required />
            </NLColumn>
            <!-- DRE -->
            <NLColumn lg="6" md="6">
                <NLSelect v-model="form.dres" :form="form" name="dres" label="DRE" :options="dresList" multiple />
            </NLColumn>
            <NLColumn>
                <NLFlex lgJustifyContent="end">
                    <NLButton :loading="form.busy" label="Mettre à jour" />
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
            regionalInspection: 'regionalInspections/current'
        })
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$api.get('structures/dre?fetchAll').then(response => {
            this.dresList = response.data
            this.$store.dispatch('regionalInspections/fetch', this.$route.params.regionalInspection).then(() => {
                const data = this.regionalInspection.current
                this.form.fill(data)
                this.form.dres = data.dres.map(dre => dre.id)
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        }).catch(error => {
            this.$store.dispatch('settings/updatePageLoading', false)
            this.$swal.catchError(error)
        })
    },
    data() {
        return {
            form: new Form({
                name: null,
                code: null,
                dres: [],
            }),
            dresList: [],
        }
    },
    methods: {
        update() {
            this.form.put('structures/regional-inspections/' + this.$route.params.regionalInspection).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$router.push({ name: 'regional-inspection-index' })
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
