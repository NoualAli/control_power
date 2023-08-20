<template>
    <div v-if="can('create_control_campaign')">
        <ContentBody>
            <NLForm :action="create" :form="form">
                <NLColumn>
                    <NLWyswyg v-model="form.description" :form="form" name="description" label="Description"
                        placeholder="Ajouter une description" label-required :length="3000" />
                </NLColumn>
                <NLColumn lg="4">
                    <NLInput name="reference" :value="nextReference?.nextReference" :form="form" label="Référence" readonly
                        label-required />
                </NLColumn>
                <NLColumn lg="4" md="6">
                    <NLInput v-model="form.start" :form="form" name="start" label="Date début" type="date" label-required />
                </NLColumn>
                <NLColumn lg="4" md="6">
                    <NLInput v-model="form.end" :form="form" name="end" label="Date fin" type="date" label-required />
                </NLColumn>
                <NLColumn>
                    <NLSelect v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF" :multiple="true"
                        placeholder="Choisissez un ou plusieurs PCF" no-options-text="Aucun PCF disponible"
                        loading-text="Chargement des PCF en cours..." label-required />
                </NLColumn>
                <NLColumn v-if="showValidation">
                    <NLSwitch v-model="form.validate" name="validate" :form="form" label="Validé" type="is-success" />
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
import { mapGetters } from 'vuex'
import { Form } from 'vform'
import { hasRole } from '~/plugins/user'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            pcfList: [],
            showValidation: false,
            form: new Form({
                description: '',
                start: null,
                end: null,
                validate: false,
                pcf: []
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
    methods: {
        /**
         * Ajoute une nouvelle campagne de contrôle
         */
        clear() {
            this.form.reset()
        },
        create() {
            this.form.post('campaigns').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                    this.fetchNextReference()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                console.log(error)
            })
        },
        /**
         * Récupère la liste des familles -> domaines -> processus
         */
        loadPFC() {
            this.$store.dispatch('families/fetchAll', true).then(() => {
                this.pcfList = this.families.all
                this.$store.dispatch('campaigns/fetchNextReference').then(() => this.$store.dispatch('settings/updatePageLoading', false))
            })
        }
    }
}
</script>
