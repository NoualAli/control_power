<template>
  <ContentBody v-can="'create_mission'">
    <form @submit.prevent="create" @keydown="form.onKeydown($event)">
      <div class="grid my-2">
        <!-- Control campaigns -->
        <div class="col-12 col-lg-6" v-if="!this.campaignId">
          <NLSelect name="control_campaign_id" label="Campagne de contrôle"
            placeholder="Veuillez choisir une campagne de contrôle" :options="campaignsList" :form="form"
            v-model="form.control_campaign_id" labelRequired />
        </div>
        <div class="col-12 col-lg-6" v-else>
          <NLInput name="campaign" label="Campagne de contrôle" v-model="currentCampaign" readonly />
        </div>
        <!-- Agencies -->
        <div class="col-12 col-lg-6">
          <NLSelect name="agencies" label="Agences" placeholder="Veuillez choisir une ou plusieurs agences"
            :options="agenciesList" :form="form" v-model="form.agencies" labelRequired :multiple="true" />
        </div>

        <!-- Controllers -->
        <div class="col-12">
          <NLSelect name="controllers" label="Contrôleurs" placeholder="Veuillez choisir un ou plusieurs contrôleurs"
            :options="controllersList" :form="form" v-model="form.controllers" labelRequired :multiple="true"
            loadingText="Chargement de la liste des contrôleurs en cours"
            noOptionsText="Vous n'avez aucun contrôleur de disponible pour le moment" />
        </div>

        <!-- Start date -->
        <div class="col-12 col-lg-6 col-tablet-6">
          <NLInput :form="form" v-model="form.start" name="start" label="Date début" type="date" labelRequired />
        </div>

        <!-- End date -->
        <div class="col-12 col-lg-6 col-tablet-6">
          <NLInput :form="form" v-model="form.end" name="end" label="Date fin" type="date" labelRequired />
        </div>

        <!-- Note -->
        <div class="col-12">
          <NLTextarea :form="form" v-model="form.note" name="note" label="Note" placeholder="Ajouter une note" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="d-flex justify-end align-center">
        <NLButton :loading="form.busy" label="Add" class="is-radius" />
      </div>
    </form>
  </ContentBody>
</template>

<script>
import NLSelect from '../../components/Inputs/NLSelect'
import { mapGetters } from 'vuex'
import Form from 'vform'
export default {
  components: { NLSelect },
  layout: 'backend',
  middleware: [ 'auth' ],
  metaInfo() {
    return { title: 'Répartition des missions de contrôle' }
  },
  data() {
    return {
      campaignId: null,
      form: new Form({
        note: null,
        start: null,
        end: null,
        agencies: null,
        controllers: null,
        control_campaign_id: null,
      }),
      currentCampaign: null,
      campaignsList: [],
      controllersList: [],
      agenciesList: [],
    }
  },
  watch: {
    "form.control_campaign_id": function (newVal, oldVal) {
      if (newVal !== oldVal && newVal !== null && newVal !== undefined) this.initData()
    }
  },
  breadcrumb() {
    if (this.$route.params.campaignId) {
      return {
        parent: 'campaign',
        label: 'Répartition des missions de contrôle de la campagne ' + this.currentCampaign
      }
    }
  },
  computed: mapGetters({
    config: 'missions/config',
  }),
  created() {
    this.initData()
  },
  methods: {
    /**
     * Initialise les données
     */
    initData() {
      if (this.$route.params.campaignId) {
        this.form.control_campaign_id = this.$route.params.campaignId
        this.campaignId = this.$route.params.campaignId
      }
      this.$store.dispatch('missions/fetchConfig', this.form.control_campaign_id).then(() => {
        this.agenciesList = this.config.config.agencies
        this.controllersList = this.config.config.controllers
        this.campaignsList = this.config.config.campaigns
        this.currentCampaign = this.config.config.currentCampaign.reference
      })
    },
    /**
     * Création de la mission
     */
    create() {
      this.form.post('/api/missions').then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.initData()
          this.form.reset()
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })
    }
  },
}
</script>
