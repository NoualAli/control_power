<template>
    <div v-if="can('create_agency')">
        <ContentHeader title="Ajouter une nouvelle agence" />
        <ContentBody>
            <NLForm :action="create" :form="form">
                <NLColumn>
                    <NLSwitch v-model="form.is_for_testing" name="is_for_testing" :form="form" label="Agence TEST"
                        type="is-success" />
                </NLColumn>
                <!-- Code -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.code" type="number" :form="form" name="code" label="Code" label-required />
                </NLColumn>
                <!-- Name -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.name" :form="form" name="name" label="Nom" label-required />
                </NLColumn>
                <!-- Dre -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.dre_id" :form="form" name="dre_id" label="Dre" :options="dresList"
                        label-required :multiple="false" />
                </NLColumn>
                <!-- Category -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.category_id" :form="form" name="category_id" label="Catégorie"
                        :options="categoriesList" label-required :multiple="false" />
                </NLColumn>
                <!-- PCF -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.pcf_usable" :form="form" name="pcf_usable" label="PCF exceptionnel (à utiliser)"
                        :options="pcfList" :multiple="true" />
                </NLColumn>

                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.pcf_unusable" :form="form" name="pcf_unusable"
                        label="PCF exceptionnel (à ne pas utiliser)" :options="pcfList" :multiple="true" />
                </NLColumn>
                <!-- Submit Button -->
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
import NLForm from '../../../components/NLForm'
import { Form } from 'vform'
import { mapGetters } from 'vuex'

export default {
    components: { NLForm },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            dresList: [],
            categoriesList: [],
            pcfList: [],
            form: new Form({
                name: null,
                code: null,
                dre_id: null,
                category_id: null,
                pcf_usable: [],
                pcf_unusable: [],
                is_for_testing: false,
            })
        }
    },
    computed: {
        ...mapGetters({
            config: 'agencies/config'
        })
    },
    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('agencies/fetchConfig').then(() => {
                this.dresList = this.config.config.dres
                this.categoriesList = this.config.config.categories
                this.pcfList = this.config.config.pcf
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        create() {
            this.form.post('agencies').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
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
