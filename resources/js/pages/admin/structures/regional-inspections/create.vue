<template>
    <div v-if="can('create_regional_inspection')">
        <ContentHeader title="Ajouter une nouvelle inspection régionale" />
        <ContentBody>
            <NLForm :action="create" :form="form">
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
                        <NLButton :loading="form.busy" label="Ajouter" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </ContentBody>
    </div>
</template>

<script>
import { Form } from 'vform'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
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
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$api.get('structures/dre?fetchAll').then(response => {
            this.dresList = response.data
            this.$store.dispatch('settings/updatePageLoading', false)
        }).catch(error => {
            this.$store.dispatch('settings/updatePageLoading', false)
            this.$swal.catchError(error)
        })
    },
    methods: {
        create() {
            this.form.post('structures/regional-inspections').then(response => {
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
