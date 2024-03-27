<template>
    <div v-if="can('create_family')">
        <ContentHeader title="Ajouter une nouvelle famille" />
        <ContentBody>
            <NLForm :action="create" :form="form">
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
                usable_for_agency: false,
                usable_for_dre: false,
            })
        }
    },
    methods: {
        create() {
            this.form.post('families').then(response => {
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
