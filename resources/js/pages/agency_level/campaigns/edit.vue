<template>
    <ContentBody v-if="can('edit_control_campaign')">
        <NLForm :action="update" :form="form">
            <NLColumn>
                <h3>Référence: {{ form.reference }}</h3>
            </NLColumn>
            <NLColumn lg="4" md="6">
                <NLInputDate v-model="form.start_date" :form="form" name="start_date" label="Date de début" type="date"
                    label-required :min="minDateForStart" />
            </NLColumn>
            <NLColumn lg="4" md="6">
                <NLInputDate v-model="form.end_date" :form="form" name="end_date" label="Date de fin" type="date"
                    label-required :disabled="endDateIsDisabled" :min="minDateForEnd" />
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

            <!-- Submit Button -->
            <NLColumn>
                <NLFlex lgJustifyContent="end">
                    <NLButton :loading="formIsLoading" label="Mettre à jour" />
                </NLFlex>
            </NLColumn>
        </NLForm>
    </ContentBody>
</template>

<script>
import { mapGetters } from 'vuex'
import { Form } from 'vform'
import moment from 'moment';
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            formIsLoading: false,
            pcfList: [],
            readonly: {
                start_date: true,
                end_date: true,
                pcf: true,
            },
            originalData: {
                description: null,
                start_date: null,
                end_date: null,
                is_validated: false,
                pcf: [],
            },
            form: new Form({
                description: null,
                start_date: null,
                end_date: null,
                is_validated: false,
                pcf: [],
            }),
            minDateForEnd: null,
            endDateIsDisabled: true,
            minDateForStart: null
        }
    },
    computed: mapGetters({
        families: 'families/all',
        campaign: 'campaigns/current'
    }),
    watch: {
        "form.start_date"(newVal, oldVal) {
            if (newVal) {
                this.setMinDateForEnd(newVal)
            } else {
                this.minDateForEnd = null
                this.endDateIsDisabled = true
            }
        }
    },
    created() {
        this.initData()
    },
    methods: {
        /**
         * Set minimum start date for control campaign
         */
        setMinDateForStart() {
            this.$store.dispatch('campaigns/fetchCurrent', { latestCampaign: true, currentCampaign: false }).then(() => {
                if (this.lastCampaign?.current?.end_date) {
                    let date = moment(this.lastCampaign?.current?.end_date)
                    // Start date must be greatter than last control campaign end date and greatter than today
                    const endDate = moment(date, 'DD-MM-YYYY');
                    // Get the current date
                    const currentDate = moment();
                    // Check if the current date is greater than the end date of the last control campaign
                    if (currentDate.isAfter(endDate)) {
                        // Increment the day by 1 to get the minimum start date
                        const minStartDate = currentDate.add(1, 'day');
                        // Format the result as "YYYY-MM-DD"
                        const formattedMinStartDate = minStartDate.format('YYYY-MM-DD');

                        this.minDateForStart = formattedMinStartDate;
                    } else {
                        // If the current date is not greater than the end date, set the minimum start date to the end date
                        this.minDateForStart = moment(date, 'DD-MM-YYYY').add(1, 'day').format('YYYY-MM-DD');
                    }
                } else {
                    // Get today's date using Moment.js
                    const today = moment();

                    // Format the result as "YYYY-MM-DD"
                    const formattedDate = today.format('YYYY-MM-DD');

                    this.minDateForStart = formattedDate;
                }
            })
        },
        setMinDateForEnd(value) {
            // Parse the input date string
            const currentDate = moment(value, 'YYYY-MM-DD');

            // Increment the day by 1
            const incrementedDate = currentDate.add(1, 'day');

            // Format the result as "YYYY-MM-DD"
            const result = incrementedDate.format('YYYY-MM-DD');

            this.minDateForEnd = result
            this.endDateIsDisabled = false
        },
        /**
         * Met à jour la campagne de contrôle
         */
        update() {
            let cantLeave = this.checkIfCanLeave()
            if (cantLeave) {
                this.$swal.confirm({ message: 'Êtes-vous sûr de vouloir enregistrer ces informations ?' }).then(action => {
                    if (action.isConfirmed) {
                        this.formIsLoading = true
                        this.form.put('agency_level/campaigns/' + this.$route.params.campaignId).then(response => {
                            if (response.data.status) {
                                this.$swal.toast_success(response.data.message)
                                this.$router.push({ name: 'campaign', params: { campaignId: this.$route.params.campaignId } })
                                this.formIsLoading = false
                            } else {
                                this.$swal.alert_error(response.data.message)
                            }
                            this.formIsLoading = false
                        }).catch(error => {
                            this.$swal.catchError(error)
                            this.formIsLoading = false
                        })
                    }
                })
            } else {
                this.formIsLoading = false
                this.$router.push({ name: 'campaign', params: { campaignId: this.$route.params.campaignId } })
            }
        },
        /**
         * Check whatever if user changed form values or not
         */
        checkIfCanLeave() {
            let data = JSON.stringify({
                description: this.form.description,
                start_date: this.form.start_date,
                end_date: this.form.end_date,
                is_validated: this.form.is_validated,
                pcf: this.form.pcf,
            })
            let originalData = JSON.stringify(this.originalData)
            return data != originalData
        },
        /**
         * Récupère la liste des familles -> domaines -> processus
         */
        loadPFC() {
            this.$store.dispatch('families/fetchAll', true).then(() => {
                this.pcfList = this.families.all
            })
        },
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)

            this.$store.dispatch('agency_level/campaigns/fetch', { campaignId: this.$route.params.campaignId, edit: true }).then(() => {
                if (this.campaign?.current?.validated_by_id) {
                    this.$router.push({ name: 'campaigns' })
                }
                this.setMinDateForStart()

                this.loadPFC()
                this.form.description = this.campaign?.current?.description
                this.form.reference = this.campaign?.current?.reference
                this.form.start_date = moment(this.campaign?.current?.start_date, 'DD-MM-YYYY').format('YYYY-MM-DD')
                this.form.end_date = moment(this.campaign?.current?.end_date, 'DD-MM-YYYY').format('YYYY-MM-DD')
                this.form.pcf = this.campaign?.current?.processes.map((process) => process.id)

                this.originalData.description = this.campaign?.current?.description
                // this.originalData.reference = this.campaign?.current?.reference
                this.originalData.start_date = moment(this.campaign?.current?.start_date, 'DD-MM-YYYY').format('YYYY-MM-DD')
                this.originalData.end_date = moment(this.campaign?.current?.end_date, 'DD-MM-YYYY').format('YYYY-MM-DD')
                this.originalData.pcf = this.campaign?.current?.processes.map((process) => process.id)
                this.$store.dispatch('settings/updatePageLoading', false)
            }).catch(error => {
                this.$swal.alert_error(error)
            })
        }
    }
}
</script>
