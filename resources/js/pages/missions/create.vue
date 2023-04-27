<template>
  <ContentBody v-if="can('create_mission')">
    <ContentHeader>
      <template #actions>
        <button class="btn btn-info has-icon" @click.prevent="cdcModalIsOpen = true">
          <i class="las la-exclamation-circle icon" />
          Campagne de contrôle
        </button>
      </template>
    </ContentHeader>
    <form @submit.prevent="create" @keydown="form.onKeydown($event)">
      <div class="grid my-2">
        <!-- Control campaigns -->
        <div v-if="!campaignId" class="col-12 col-lg-6">
          <NLSelect
            v-model="form.control_campaign_id" name="control_campaign_id"
            label="Campagne de contrôle" placeholder="Veuillez choisir une campagne de contrôle" :options="campaignsList"
            :form="form" label-required
          />
        </div>
        <div v-else class="col-12 col-lg-6">
          <NLInput v-model="currentCampaignReference" name="campaign" label="Campagne de contrôle" readonly />
        </div>
        <!-- Agencies -->
        <div class="col-12 col-lg-6">
          <NLSelect
            v-model="form.agencies" name="agencies" label="Agences"
            placeholder="Veuillez choisir une ou plusieurs agences" :options="agenciesList" :form="form" label-required :multiple="true"
          />
        </div>

        <!-- Controllers -->
        <div class="col-12">
          <NLSelect
            v-model="form.controllers" name="controllers" label="Contrôleurs"
            placeholder="Veuillez choisir un ou plusieurs contrôleurs" :options="controllersList" :form="form" label-required :multiple="true"
            loading-text="Chargement de la liste des contrôleurs en cours"
            no-options-text="Vous n'avez aucun contrôleur de disponible pour le moment"
          />
        </div>

        <!-- Start date -->
        <div class="col-12 col-lg-6 col-tablet-6">
          <NLInput v-model="form.start" :form="form" name="start" label="Date début" type="date" label-required />
        </div>

        <!-- End date -->
        <div class="col-12 col-lg-6 col-tablet-6">
          <NLInput v-model="form.end" :form="form" name="end" label="Date fin" type="date" label-required />
        </div>

        <!-- Note -->
        <div class="col-12">
          <NLTextarea v-model="form.note" :form="form" name="note" label="Note" placeholder="Ajouter une note" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="d-flex justify-end align-center">
        <NLButton :loading="form.busy" label="Add" class="is-radius" />
      </div>
    </form>
    <!-- Control campaign informations -->
    <NLModal :show="cdcModalIsOpen" @close="cdcModalIsOpen = false">
      <template #title>
        {{ currentCampaign?.reference }}
      </template>
      <template #default>
        <div class="list grid gap-12">
          <div class="col-12 col-lg-6 list-item">
            <span class="list-item-label">
              Début
            </span>
            <span class="list-item-content">
              {{ currentCampaign?.start + ' / ' +
                currentCampaign?.remaining_days_before_start_str }}
            </span>
          </div>
          <div class="col-12 col-lg-6 list-item">
            <span class="list-item-label">
              Fin
            </span>
            <span class="list-item-content">
              {{ currentCampaign?.end + ' / ' +
                currentCampaign?.remaining_days_before_end_str }}
            </span>
          </div>
          <div class="col-12 list-item">
            <span class="list-item-label">
              Description:
            </span>
            <span class="list-item-content">
              {{ currentCampaign?.description }}
            </span>
          </div>
        </div>
      </template>
    </NLModal>
  </ContentBody>
</template>

<script>
import ContentHeader from '../../components/ContentHeader'
import NLSelect from '../../components/Inputs/NLSelect'
import { mapGetters } from 'vuex'
import Form from 'vform'
export default {
  components: {
    ContentHeader, NLSelect
  },
  layout: 'backend',
  middleware: ['auth'],
  data () {
    return {
      campaignId: null,
      form: new Form({
        note: null,
        start: null,
        end: null,
        agencies: null,
        controllers: null,
        control_campaign_id: null
      }),
      currentCampaign: null,
      campaignsList: [],
      controllersList: [],
      agenciesList: [],
      cdcModalIsOpen: false,
      currentCampaignReference: null
    }
  },
  computed: mapGetters({
    config: 'missions/config'
  }),
  watch: {
    'form.control_campaign_id': function (newVal, oldVal) {
      if (newVal !== oldVal && newVal !== null && newVal !== undefined) this.initData()
    },
    currentCampaignReference: function (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.currentCampaignReference = newVal
      }
    }
  },

  created () {
    this.initData()
  },
  mounted () {
    this.initData()
  },
  methods: {
    /**
     * Initialise les données
     */
    initData () {
      if (this.$route.params.campaignId) {
        this.form.control_campaign_id = this.$route.params.campaignId
        this.campaignId = this.$route.params.campaignId
      }
      this.$store.dispatch('missions/fetchConfig', this.form.control_campaign_id).then(() => {
        this.agenciesList = this.config.config.agencies
        this.controllersList = this.config.config.controllers
        this.campaignsList = this.config.config.campaigns
        this.currentCampaign = this.config.config.currentCampaign
        this.currentCampaignReference = this.config.config.currentCampaign.reference
        const length = this.$breadcrumbs.value.length
        if (this.$breadcrumbs.value[length - 1].lable === 'Répartition des missions de contrôle de la campagne') {
          this.$breadcrumbs.value[length - 1].lable = 'Répartition des missions de contrôle de la campagne ' + this.currentCampaignReference
          this.$breadcrumbs.value[length - 1].parent = 'campaign'
        }
      })
    },
    resetForm () {
      this.form.note = null
      this.form.start = null
      this.form.end = null
      this.form.agencies = null
      this.form.controllers = null
    },
    /**
     * Création de la mission
     */
    create () {
      this.form.post('/api/missions').then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.initData()
          this.resetForm()
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
