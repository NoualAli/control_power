<template>
    <div v-if="can('create_dre')">
        <ContentHeader title="Ajouter une nouvelle DRE" />
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
    middleware: [ 'auth', 'admin' ],
    data() {
        return {
            form: new Form({
                name: '',
                code: ''
            })
        }
    },
    methods: {
        create() {
            this.form.post('dre').then(response => {
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
