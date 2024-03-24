<template>
    <ContentBody v-if="can('edit_agency')">
        <NLForm :action="update" :form="form">
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
                <NLSelect v-model="form.dre_id" :form="form" name="dre_id" label="DRE" :options="dresList"
                    label-required :multiple="false" />
            </NLColumn>
            <!-- Categories -->
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
    data() {
        return {
            dresList: [],
            categoriesList: [],
            pcfList: [],
            agency: null,
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
            this.$store.dispatch('agencies/fetchConfig', this.$route.params.agency).then(() => {
                this.agency = this.config.config.agency
                this.dresList = this.config.config.dres
                this.categoriesList = this.config.config.categories
                this.pcfList = this.config.config.pcf

                this.form.name = this.agency.name
                this.form.code = this.agency.code
                this.form.dre_id = this.agency.dre_id
                this.form.category_id = this.agency.category_id
                this.form.pcf_usable = this.agency.usableProcesses.map(process => process.id)
                this.form.pcf_unusable = this.agency.unusableProcesses.map(process => process.id)
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        update() {
            this.form.put('structures/agencies/' + this.$route.params.agency).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.initData()
                    // this.$router.push({ name: 'agencies-index' })
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
