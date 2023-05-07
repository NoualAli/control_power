<template>
  <div v-if="forcedRerenderKey!==-1 && ((campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign')) || !campaign?.current?.validated_by_id)" :key="forcedRerenderKey">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <!-- Control campaign base informations -->
        <div class="grid">
          <div class="col-12">
            <NLWyswyg
              v-model="form.description" :form="form" name="description" label="Description"
              placeholder="Ajouter une description" label-required
            />
          </div>
          <div class="col-12 col-lg-4">
            <NLInput name="reference" :value="form.reference" :form="form" label="Référence" readonly label-required />
          </div>
          <div class="col-12 col-lg-4 col-tablet-6">
            <NLInput v-model="form.start" :form="form" name="start" label="Date début" type="date" label-required />
          </div>
          <div class="col-12 col-lg-4 col-tablet-6">
            <NLInput v-model="form.end" :form="form" name="end" label="Date fin" type="date" label-required />
          </div>
          <div class="col-12">
            <NLSelect
              v-if="!readonly.pcf" v-model="form.pcf" :form="form" name="pcf" :options="pcfList" label="PCF"
              :multiple="true" placeholder="Choisissez un ou plusieurs PCF"
              no-options-text="Aucun PCF disponible" loading-text="Chargement des PCF en cours..." label-required
            />
          </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="form.busy" label="Update" class="is-radius" />
        </div>
      </form>
    </ContentBody>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Form } from 'vform'
export default {
  layout: 'backend',
  middleware: ['auth'],
  data () {
    return {
      forcedRerenderKey: -1,
      pcfList: [],
      readonly: {
        start: true,
        end: true,
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
    famillies: 'famillies/all',
    campaign: 'campaigns/current'
  }),
  watch: {
    campaign: {
      immediate: true,
      deep: true,
      handler (newValue, oldValue) {
        if (newValue) {
          this.forcedRerenderKey = newValue.current.id
        }
      }
    }
  },
  created () {
    this.initData()
  },
  // mounted () {
  //   this.initData()
  // },
  methods: {
    /**
     * Met à jour la campagne de contrôle
     */
    update () {
      // console.log(this.$route.params.campaignId)

      this.form.put('/api/campaigns/' + this.$route.params.campaignId).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.$router.push({ name: 'campaign', params: { campaignId: this.$route.params.campaignId } })
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
    loadPFC () {
      this.$store.dispatch('famillies/fetchAll', true).then(() => {
        // console.log(typeof this.famillies.all)
        this.pcfList = this.famillies.all
      })
    },
    initData () {
      this.$store.dispatch('campaigns/fetch', { campaignId: this.$route.params.campaignId, edit: true }).then(() => {
        if (this.campaign?.current?.validated_by_id) {
          this.$router.push({ name: 'campaigns' })
        }
        this.readonly.start = this.campaign?.current?.remaining_days_before_start <= 5
        this.readonly.end = this.campaign?.current?.remaining_days_before_start <= 5
        this.readonly.pcf = this.campaign?.current?.remaining_days_before_start <= 5
        this.loadPFC()
        this.form.description = this.campaign?.current?.description
        this.form.reference = this.campaign?.current?.reference
        this.form.start = this.campaign?.current?.start.split('-').reverse().join('-')
        this.form.end = this.campaign?.current?.end.split('-').reverse().join('-')
        this.form.pcf = this.campaign?.current?.processes.map((process) => process.id)
        const length = this.$breadcrumbs.value.length
        if (this.$breadcrumbs.value[length - 1].label === 'Détails campagne') {
          this.$breadcrumbs.value[length - 1].label = 'Détails campagne ' + this.campaign.current?.reference
        }
      }).catch(error => {
        this.$swal.alert_error(error)
      })
    }
  }
}
</script>
