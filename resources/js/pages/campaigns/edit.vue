<template>
  <div v-if="campaign?.current.remaining_days_before_start > 5 && can('edit_control_campaign')">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <!-- Control campaign base informations -->
        <div class="grid">
          <div class="col-12">
            <NLTextarea :form="form" v-model="form.description" name="description" label="Description"
              placeholder="Ajouter une description" labelRequired />
          </div>
          <div class="col-12 col-lg-4">
            <NLInput name="reference" :value="form.reference" :form="form" label="Référence" readonly labelRequired />
          </div>
          <div class="col-12 col-lg-4 col-tablet-6">
            <NLInput :form="form" v-model="form.start" name="start" label="Date début" type="date" labelRequired />
          </div>
          <div class="col-12 col-lg-4 col-tablet-6">
            <NLInput :form="form" v-model="form.end" name="end" label="Date fin" type="date" labelRequired />
          </div>
          <div class="col-12">
            <NLSelect :form="form" v-model="form.pcf" name="pcf" :options="pcfList" label="PCF" :multiple="true"
              placeholder="Choisissez un ou plusieurs PCF" noOptionsText="Aucun PCF disponible"
              loadingText="Chargement des PCF en cours..." labelRequired v-if="!readonly.pcf" />
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
import { Form } from 'vform';
import { hasRole } from '../../plugins/user';
export default {
  middleware: [ 'auth' ],
  layout: 'backend',
  data() {
    return {
      pcfList: [],
      readonly: {
        start: true,
        end: true,
        pcf: true,
      },
      form: new Form({
        description: '',
        reference: '',
        start: null,
        end: null,
        pcf: [],
      }),
    }
  },
  computed: mapGetters({
    famillies: 'famillies/all',
    campaign: 'campaigns/current',
  }),
  methods: {
    /**
     * Met à jour la campagne de contrôle
     */
    update() {
      this.form.put('/api/campaigns/' + this.$route.params.campaignId).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.initData()
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })
    },
    /**
     * Récupère la liste des familles -> domaines -> processus
     */
    loadPFC() {
      this.$store.dispatch('famillies/fetchAll', { withChildren: true }).then(() => {
        this.pcfList = this.famillies.all
      });
    },
    initData() {
      this.$store.dispatch('campaigns/fetch', { campaignId: this.$route.params.campaignId, edit: true }).then(() => {
        if (this.campaign.current.remaining_days_before_start <= 0) {
          this.$router.push({ name: 'campaigns' })
        }
        this.readonly.start = this.campaign.current.remaining_days_before_start <= 5
        this.readonly.end = this.campaign.current.remaining_days_before_start <= 5
        this.readonly.pcf = this.campaign.current.remaining_days_before_start <= 5
        this.loadPFC()
        this.form.description = this.campaign.current.description
        this.form.reference = this.campaign.current.reference
        this.form.start = this.campaign.current.start.split('-').reverse().join('-')
        this.form.end = this.campaign.current.end.split('-').reverse().join('-')
        this.form.pcf = this.campaign.current.processes.map((process) => process.id)
      }).catch(error => {
        swal.alert_error(error)
      })
    }
  },
  created() {
    this.initData()
  },
}
</script>
