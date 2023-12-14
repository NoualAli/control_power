<template>
    <div v-if="can('create_control_campaign')">
        <ContentBody>
            <NLForm :action="create" :form="form">
                <NLColumn>
                    <h3>Référence: {{ nextReference?.nextReference }}</h3>
                </NLColumn>
                <NLColumn lg="4" md="6">
                    <NLInput v-model="form.start_date" :form="form" name="start_date" label="Date de début" type="date"
                        label-required />
                </NLColumn>
                <NLColumn lg="4" md="6">
                    <NLInput v-model="form.end_date" :form="form" name="end_date" label="Date de fin" type="date"
                        label-required />
                </NLColumn>
                <NLColumn>
                    <NLSelect v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF" :multiple="true"
                        placeholder="Choisissez un ou plusieurs PCF" no-options-text="Aucun PCF disponible"
                        loading-text="Chargement des PCF en cours..." label-required />
                </NLColumn>
                <NLColumn>
                    <NLWyswyg v-model="form.description" :form="form" name="description" label="Description"
                        placeholder="Ajouter une description" label-required :length="3000" />
                </NLColumn>
                <NLColumn v-if="showValidation" lg="6">
                    <NLSwitch v-model="form.is_validated" name="is_validated" :form="form" label="Validé"
                        type="is-success" />
                </NLColumn>
                <NLColumn lg="6">
                    <NLSwitch v-model="form.is_for_testing" name="is_for_testing" :form="form"
                        label="Campagne de contrôle TEST" type="is-success" />
                </NLColumn>
                <!-- Submit Button -->
                <NLColumn>
                    <NLFlex lgJustifyContent="end">
                        <NLButton :loading="formIsLoading" label="Ajouter" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </ContentBody>
    </div>
</template>

<script>
import NLColumn from '../../components/Grid/NLColumn'
import { mapGetters } from 'vuex'
import { Form } from 'vform'
import { hasRole } from '~/plugins/user'
export default {
    components: { NLColumn },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            formIsLoading: false,
            pcfList: [],
            showValidation: false,
            form: new Form({
                description: '',
                start_date: null,
                end_date: null,
                is_validated: false,
                pcf: [],
                is_for_testing: false
            })
        }
    },
    computed: mapGetters({
        families: 'families/all',
        nextReference: 'campaigns/nextReference'
    }),
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.loadPFC()
        this.showValidation = hasRole('dcp')
    },
    watch: {
        'form.is_for_testing'(newVal, oldVal) {
            this.fetchNextReference()
        },
        'form.is_validated'(newVal, oldVal) {
            this.fetchNextReference()
        }
    },
    methods: {
        /**
         * Ajoute une nouvelle campagne de contrôle
         */
        clear() {
            this.form.reset()
        },
        create() {
            this.formIsLoading = true
            this.form.post('campaigns').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                    this.fetchNextReference()
                    this.formIsLoading = false
                } else {
                    this.$swal.alert_error(response.data.message)
                    this.formIsLoading = false
                }
                this.formIsLoading = false
            }).catch(error => {
                this.formIsLoading = false
                console.log(error)
            })
        },
        /**
         * Récupère la liste des familles -> domaines -> processus
         */
        loadPFC() {
            this.$store.dispatch('families/fetchAll', true).then(() => {
                this.pcfList = this.families.all
                this.fetchNextReference()
            })
        },
        fetchNextReference() {
            this.$store.dispatch('campaigns/fetchNextReference', { isValidated: this.form.is_validated, isForTesting: this.form.is_for_testing }).then(() => this.$store.dispatch('settings/updatePageLoading', false))
        }
    }
}
</script>
