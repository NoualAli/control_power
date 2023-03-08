<template>
  <ContentBody v-if="mission?.current?.remaining_days_before_start > 5 && can('edit_mission')">
    <ContentHeader>
      <template #actions>
        <button class="btn btn-info has-icon" @click.prevent="cdcModalIsOpen = true">
          <i class="las la-exclamation-circle icon"></i>
          Campagne de contrôle
        </button>
      </template>
    </ContentHeader>

    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <div class="grid my-2">
        <!-- Campaign -->
        <div class="col-12 col-lg-6">
          <NLInput name="campaign" label="Campagne de contrôle" v-model="form.campaign" readonly />
        </div>
        <!-- Agency -->
        <div class="col-12 col-lg-6">
          <NLInput name="agency" label="Agences" v-model="form.agency" readonly />
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
        <NLButton :loading="form.busy" label="Update" class="is-radius" />
      </div>
    </form>
    <!-- Control campaign informations -->
    <NLModal :show="cdcModalIsOpen" @close="cdcModalIsOpen = false">
      <template #title>
        {{ currentCampaign?.reference }}
      </template>
      <template>
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
import NLSelect from '../../components/Inputs/NLSelect'
import { mapGetters } from 'vuex'
import Form from 'vform'
export default {
  components: { NLSelect },
  layout: 'backend',
  middleware: [ 'auth' ],
  metaInfo() {
    return { title: 'Edition mission de contrôle' }
  },
  breadcrumb() {
    return {
      label: 'Edition mission ' + this.currentCampaign?.reference
    }
  },
  data() {
    return {
      form: new Form({
        note: null,
        start: null,
        end: null,
        agency: null,
        campaign: null,
        controllers: null,
      }),
      controllersList: [],
      cdcModalIsOpen: false,
      currentCampaign: null,
    }
  },
  computed: mapGetters({
    config: 'missions/config',
    mission: 'missions/current',
  }),
  created() {
    this.initData()
  },
  methods: {
    /**
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId, edit: true }).then(() => {
        if (this.mission.current.remaining_days_before_start > 5) {
          this.$store.dispatch('missions/fetchConfig', this.mission.current.campaign.id).then(() => {
            this.controllersList = this.config.config.controllers
          })
          this.form.agency = this.mission.current.agency.name
          this.form.campaign = this.mission.current.campaign.reference
          this.currentCampaign = this.mission.current.campaign
          this.form.controllers = this.mission.current.agency_controllers.map((controller) => controller.id)
          this.form.start = this.mission.current.start.split('-').reverse().join('-')
          this.form.end = this.mission.current.end.split('-').reverse().join('-')
          this.form.note = this.mission.current.note
        }
      }).catch(error => {
        // this.$router.push({ name: 'missions' })
        swal.alert_error(error)
      })
    },
    /**
     * Mise à jour de la mission
     */
    update() {
      this.form.put('/api/missions/' + this.mission.current.id).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        swal.alert_status(error)
      })
    }
  },
}
</script>
