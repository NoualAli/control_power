<template>
    <ContentBody v-if="can('create_control_campaign')">
        <NLForm :action="create" :form="form">
            <NLColumn>
                <h3>Référence: {{ nextReference?.nextReference }}</h3>
            </NLColumn>
            <NLColumn lg="4" md="6">
                <NLInputDate v-model="form.start_date" :form="form" name="start_date" label="Date de début" type="date"
                    label-required :min="minDateForStart" />
                <!-- {{ minDateForStart }} -->
            </NLColumn>
            <NLColumn lg="4" md="6">
                <NLInputDate v-model="form.end_date" :form="form" name="end_date" label="Date de fin" type="date"
                    label-required :disabled="endDateIsDisabled" :min="minDateForEnd" />
                <!-- {{ minDateForEnd }} -->
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
                <NLSwitch v-model="form.is_validated" name="is_validated" :form="form" label="Validé" type="is-success" />
            </NLColumn>
            <!-- <NLColumn lg="6">
                <NLSwitch v-model="form.is_for_testing" name="is_for_testing" :form="form" label="Campagne de contrôle TEST"
                    type="is-success" />
            </NLColumn> -->
            <!-- Submit Button -->
            <NLColumn>
                <NLFlex lgJustifyContent="end">
                    <NLButton :loading="formIsLoading" label="Ajouter" />
                </NLFlex>
            </NLColumn>
        </NLForm>
    </ContentBody>
</template>

<script>
import NLColumn from '../../components/Grid/NLColumn'
import { mapGetters } from 'vuex'
import { Form } from 'vform'
import { hasRole } from '~/plugins/user'
import moment from 'moment';
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
                description: null,
                start_date: null,
                end_date: null,
                is_validated: false,
                pcf: [],
                is_for_testing: false
            }),
            minDateForEnd: null,
            endDateIsDisabled: true,
            minDateForStart: null
        }
    },

    computed: {
        ...mapGetters({
            families: 'families/all',
            nextReference: 'campaigns/nextReference',
            lastCampaign: 'campaigns/current'
        }),
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.loadPFC()
        this.showValidation = hasRole('dcp')
        this.setMinDateForStart()
    },
    watch: {
        'form.is_for_testing'(newVal, oldVal) {
            this.fetchNextReference()
            this.minDateForStart = moment().format('YYYY-MM-DD')
        },
        'form.is_validated'(newVal, oldVal) {
            this.fetchNextReference()
        },
        "form.start_date"(newVal, oldVal) {
            if (newVal) {
                this.form.end_date = null
                // Parse the input date string
                const currentDate = moment(newVal, 'YYYY-MM-DD');

                // Increment the day by 1
                const incrementedDate = currentDate.add(1, 'day');

                // Format the result as "YYYY-MM-DD"
                const result = incrementedDate.format('YYYY-MM-DD');

                this.minDateForEnd = result
                this.endDateIsDisabled = false
            } else {
                this.minDateForEnd = null
                this.endDateIsDisabled = true
            }
        }
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
        /**
         * Create new control campaign
         */
        create() {
            this.formIsLoading = true
            this.form.post('campaigns').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                    this.fetchNextReference()
                    this.setMinDateForStart()
                    this.formIsLoading = false
                } else {
                    this.$swal.alert_error(response.data.message)
                    this.formIsLoading = false
                }
                this.formIsLoading = false
            }).catch(error => {
                this.formIsLoading = false
                this.$swal.catchError(error)
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
        /**
         * Fetch next reference
         */
        fetchNextReference() {
            this.$store.dispatch('campaigns/fetchNextReference', { isValidated: this.form.is_validated, isForTesting: this.form.is_for_testing }).then(() => this.$store.dispatch('settings/updatePageLoading', false))
        }
    }
}
</script>
