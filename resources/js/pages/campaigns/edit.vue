<template>
    <div v-if="forcedRerenderKey !== -1 && ((campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign')) || !campaign?.current?.validated_by_id)"
        :key="forcedRerenderKey">
        <ContentBody>
            <NLForm :action="update" :form="form">
                <NLColumn>
                    <NLWyswyg v-model="form.description" :form="form" name="description" label="Description"
                        placeholder="Ajouter une description" label-required :length="3000" />
                </NLColumn>
                <NLColumn lg="4">
                    <NLInput name="reference" :value="form.reference" :form="form" label="Référence" readonly
                        label-required />
                </NLColumn>
                <NLColumn lg="4" md="6">
                    <NLInput v-model="form.start_date" :form="form" name="start_date" label="Date début" type="date"
                        label-required />
                </NLColumn>
                <NLColumn lg="4" md="6">
                    <NLInput v-model="form.end_date" :form="form" name="end_date" label="Date fin" type="date"
                        label-required />
                </NLColumn>
                <NLColumn>
                    <NLSelect v-if="!readonly.pcf" v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF"
                        :multiple="true" placeholder="Choisissez un ou plusieurs PCF" no-options-text="Aucun PCF disponible"
                        loading-text="Chargement des PCF en cours..." label-required />
                </NLColumn>
                <!-- Submit Button -->
                <NLColumn>
                    <NLFlex lgJustifyContent="end">
                        <NLButton :loading="formIsLoading" label="Mettre à jour" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </ContentBody>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Form } from 'vform'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            forcedRerenderKey: -1,
            formIsLoading: false,
            pcfList: [],
            readonly: {
                start_date: true,
                end_date: true,
                pcf: true
            },
            form: new Form({
                description: '',
                reference: '',
                start: null,
                end: null,
                pcf: []
            })
        }
    },
    computed: mapGetters({
        families: 'families/all',
        campaign: 'campaigns/current'
    }),
    watch: {
        campaign: {
            immediate: true,
            deep: true,
            handler(newValue, oldValue) {
                if (newValue) {
                    this.forcedRerenderKey = newValue.current.id
                }
            }
        }
    },
    created() {
        this.initData()
    },
    // mounted () {
    //   this.initData()
    // },
    methods: {
        /**
         * Met à jour la campagne de contrôle
         */
        update() {
            // console.log(this.$route.params.campaignId)
            this.formIsLoading = true
            this.form.put('campaigns/' + this.$route.params.campaignId).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.$router.push({ name: 'campaign', params: { campaignId: this.$route.params.campaignId } })
                    this.formIsLoading = false
                } else {
                    this.$swal.alert_error(response.data.message)
                }
                this.formIsLoading = false
            }).catch(error => {
                console.log(error)
                this.formIsLoading = false
            })
        },
        /**
         * Récupère la liste des familles -> domaines -> processus
         */
        loadPFC() {
            this.$store.dispatch('families/fetchAll', true).then(() => {
                // console.log(typeof this.families.all)
                this.pcfList = this.families.all
            })
        },
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('campaigns/fetch', { campaignId: this.$route.params.campaignId, edit: true }).then(() => {
                if (this.campaign?.current?.validated_by_id) {
                    this.$router.push({ name: 'campaigns' })
                }
                this.readonly.start_date = this.campaign?.current?.remaining_days_before_start <= 5
                this.readonly.end_date = this.campaign?.current?.remaining_days_before_start <= 5
                this.readonly.pcf = this.campaign?.current?.remaining_days_before_start <= 5
                this.loadPFC()
                this.form.description = this.campaign?.current?.description
                this.form.reference = this.campaign?.current?.reference
                this.form.start_date = this.campaign?.current?.start_date.split('-').reverse().join('-')
                this.form.end_date = this.campaign?.current?.end_date.split('-').reverse().join('-')
                this.form.pcf = this.campaign?.current?.processes.map((process) => process.id)
                const length = this.$breadcrumbs.value.length
                if (this.$breadcrumbs.value[ length - 1 ].label === 'Détails campagne') {
                    this.$breadcrumbs.value[ length - 1 ].label = 'Détails campagne ' + this.campaign.current?.reference
                }
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(error => {
                this.$swal.alert_error(error)
            })
        }
    }
}
</script>
