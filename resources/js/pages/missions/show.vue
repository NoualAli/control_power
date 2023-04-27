<template>
  <ContentBody v-if="can('view_mission') && forcedRerenderKey !==-1" :key="forcedRerenderKey">
    <div class="d-flex justify-end align-center gap-3 my-2">
      <router-link
        v-if="can('view_control_campaign,view_page_control_campaigns')" :to="{ name: 'campaign', params: { campaignId: mission?.current.campaign.id } }"
        class="btn"
      >
        Campagne de contrôle
      </router-link>
      <router-link
        v-if="mission?.current?.remaining_days_before_start > 5 && can('edit_mission')" class="btn btn-warning"
        :to="{ name: 'missions-edit', params: { missionId: mission?.current.id } }"
      >
        <i class="las la-edit icon" />
      </router-link>
    </div>
    <!-- Mission informations -->
    <div class="box border-primary-dark border-1 mb-10">
      <div class="grid gap-6">
        <div class="col-4">
          <div class="grid gap-6">
            <div class="col-12">
              <span class="text-bold">
                Mission:
              </span>
              <span>
                {{ mission?.current?.reference }}
              </span>
            </div>
            <div class="col-12">
              <span class="text-bold">
                DRE:
              </span>
              <span>
                {{ mission?.current?.dre.full_name }}
              </span>
            </div>
            <div class="col-12">
              <span class="text-bold">
                Agence:
              </span>
              <span>
                {{ mission?.current?.agency.full_name }}
              </span>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="grid gap-6">
            <div class="col-12">
              <span class="text-bold">
                Campagne:
              </span>
              <span>
                {{ mission?.current?.campaign.reference }}
              </span>
            </div>
            <div class="col-12">
              <span class="text-bold">
                Début:
              </span>
              <span>
                {{ mission?.current?.start + ' / ' +
                  mission?.current?.remaining_days_before_start_str }}
              </span>
            </div>
            <div class="col-12">
              <span class="text-bold">
                Fin:
              </span>
              <span>
                {{ mission?.current?.end + ' / ' +
                  mission?.current?.remaining_days_before_end_str }}
              </span>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="grid gap-6">
            <div class="col-12">
              <span class="text-bold">
                Contrôleurs dre:
              </span>
              <span>
                <ul class="d-inline-block ml-6">
                  <li v-for="controller in mission?.current?.agency_controllers" :key="'dre_controller-' + controller.id">
                    {{ controller.full_name }}
                  </li>
                </ul>
              </span>
            </div>
            <div class="col-12">
              <span class="text-bold">
                Contrôleurs dcp:
              </span>
              <span>
                <ul class="d-inline-block ml-6">
                  <li v-for="controller in mission?.current?.dcp_controllers" :key="'dcp-controller-' + controller.id">
                    {{ controller.full_name }}
                  </li>
                </ul>
              </span>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-4">
          <span class="text-bold">
            Taux de progression:
          </span>
          <span>
            {{ mission?.current?.progress_status }}%
          </span>
        </div>
        <div class="col-12 col-lg-4">
          <span class="text-bold">
            Statut:
          </span>
          <span>
            {{ mission?.current?.realisation_state }}
          </span>
        </div>
        <div v-has-role="'cdc,cdcr,cc'" class="col-12 col-lg-4">
          <span class="text-bold">
            Moyenne:
          </span>
          <span>
            {{ mission?.current?.avg_score }}
          </span>
        </div>
        <!-- <div class="col-12 col-lg-4 d-none d-lg-block"></div> -->
        <div v-if="mission?.current?.cdcr_validation_at" class="col-12 col-lg-4">
          <span class="text-bold">
            1<sup>ère</sup> validation
          </span>
          <span>
            {{ mission?.current?.cdcr_validation_at }}
          </span>
        </div>
        <div v-if="mission?.current?.cdcr_validation_at" class="col-12 col-lg-4">
          <span class="text-bold">
            Validé par:
          </span>
          <span>
            {{ mission?.current?.cdcr_validator?.full_name }}
          </span>
        </div>
        <div class="col-12 col-lg-4 d-none d-lg-block" />
        <div v-if="mission?.current?.dcp_validation_at" class="col-12 col-lg-4">
          <span class="text-bold">
            2<sup>ème</sup> validation
          </span>
          <span>
            {{ mission?.current?.dcp_validation_at }}
          </span>
        </div>
        <div v-if="mission?.current?.dcp_validation_at" class="col-12 col-lg-4">
          <span class="text-bold">
            Validé par:
          </span>
          <span>
            {{ mission?.current?.dcp_validator?.full_name }}
          </span>
        </div>
        <div class="col-12">
          <span class="text-bold">
            Note:
          </span>
          <span>
            {{ mission?.current?.note || '-' }}
          </span>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="d-flex align-items gap-2">
      <!-- CDC -->

      <!-- Report actions -->
      <button
        v-if="mission?.current.progress_status == 100 && !mission?.current.dre_report && mission?.current.opinion?.is_validated && can('create_dre_report')"
        class="btn btn-info"
        @click="showReport"
      >
        Ajouter votre rapport
      </button>
      <button
        v-if="mission?.current.progress_status == 100 && mission?.current.opinion?.is_validated && !mission?.current.dre_report?.is_validated && mission?.current.dre_report && can('validate_dre_report')"
        class="btn btn-success"
        @click.prevent="validateReport"
      >
        Valider la mission
      </button>

      <!-- Read actions -->
      <button v-if="mission?.current.dre_report && can('create_dre_report')" class="btn btn-info" @click="showReport">
        Rapport de la mission
      </button>

      <!-- CI -->
      <button
        v-if="mission?.current.progress_status == 100 && !mission?.current.controller_opinion_is_validated && mission?.current?.controller_opinion_exist && can('validate_opinion')"
        class="btn btn-success"
        @click.prevent="validateOpinion"
      >
        Valider la mission
      </button>
      <button
        v-if="!mission?.current.controller_opinion_exist && !mission?.current?.dre_report_exist && mission?.current.progress_status == 100 && can('create_opinion')"
        class="btn btn-info"
        @click="showOpinion"
      >
        Ajouter votre avis
      </button>

      <button
        v-if="mission?.current.opinion?.is_validated && can('view_opinion')" class="btn btn-info"
        @click="showOpinion"
      >
        Avis sur la mission
      </button>
      <button
        v-if="mission?.current?.controller_opinion_exist && !mission?.current.opinion?.is_validated && can('create_opinion')"
        class="btn btn-info"
        @click="showOpinion"
      >
        Avis sur la mission
      </button>

      <!-- CDCR -->
      <button
        v-if="!mission?.current.cdcr_validation_at && can('make_first_validation')" class="btn btn-success"
        @click.prevent="validateMission(1)"
      >
        Valider la mission
      </button>
      <button
        v-if="!mission?.current.cdcr_validation_at && can('assign_mission_processing')" class="btn btn-success"
        @click.prevent="showDispatchForm"
      >
        Assigné
      </button>
      <button
        v-if="mission?.current.dre_report?.is_validated && can('make_first_validation,process_mission')"
        class="btn btn-info"
        @click="showReport"
      >
        Rapport de la mission
      </button>

      <!-- DCP -->
      <button
        v-if="mission?.current.cdcr_validation_at && !mission?.current.dcp_validation_at && can('make_second_validation')"
        class="btn btn-success"
        @click.prevent="validateMission(2)"
      >
        Valider la mission
      </button>
      <button
        v-if="mission?.current.dre_report?.is_validated && can('make_second_validation')" class="btn btn-info"
        @click="showReport"
      >
        Rapport de la mission
      </button>

      <div v-has-role="'dg,cdrcp,da,cc'">
        <button v-if="mission?.current.cdcr_validation_at" class="btn btn-info" @click="showReport">
          Rapport de la mission
        </button>
      </div>
    </div>

    <!-- Processes List -->
    <NLDatatable title="Processus de la mission" namespace="missions" state-key="processes" :config="config" @show="show">
      <template #actions="item">
        <button
          v-if="can('control_agency,view_mission_detail') && mission?.current?.remaining_days_before_start <= 0" class="btn btn-info has-icon"
          @click.stop="details(item)"
        >
          <i v-if="item.item.progress_status < 100 && !mission?.current.opinion" class="las la-tasks icon" />
          <i v-else class="las la-list-alt icon" />
        </button>
      </template>
    </NLDatatable>

    <!-- Process details (control points) -->
    <NLModal :show="rowSelected" @close="close">
      <template #title>
        <small class="tag is-info text-small">
          {{ rowSelected?.familly }}
        </small>
        <small class="tag is-primary-dark text-small mx-1">
          {{ rowSelected?.domain }}
        </small>
        <small class="tag is-warning text-small">
          {{ rowSelected?.name }}
        </small>
      </template>
      <template #default>
        <p class="text-bold mb-6">
          Points de contrôle
        </p>
        <div class="grid list">
          <div v-for="controlPoint in rowSelected?.controlPoints" :key="controlPoint.id" class="col-12 list-item">
            <div class="list-item-content">
              {{ controlPoint.label }}
            </div>
          </div>
        </div>
      </template>
      <template v-if="can('edit_mission')" #footer>
        <button
          v-if="rowSelected?.progress_status == 100 && can('view_mission')" class="btn btn-info has-icon"
          @click.stop="details(rowSelected)"
        >
          <i class="las la-tasks icon" />
          Afficher
        </button>
        <button v-else-if="can('control_agency')" class="btn btn-info has-icon" @click.stop="details(rowSelected)">
          <i class="las la-tasks icon" />
          Éffectuer
        </button>
      </template>
    </NLModal>

    <!-- Controller opinion -->
    <NLModal :show="modals.opinion" @close="modals.opinion = false">
      <template #title>
        <h2>Avis du contrôleur</h2>
      </template>
      <template #default>
        <form
          v-if="!mission?.current.opinion || forms.opinion.edit_mode" @submit.prevent="saveOpinion"
          @keydown="forms.opinion.onKeydown($event)"
        >
          <div class="grid">
            <div class="col-12">
              <NLWyswyg
                v-model="forms.opinion.opinion" :name="'opinion'" :form="forms.opinion" label="Avis du contrôleur"
                label-required
              />
            </div>
            <div class="col-12">
              <NLCheckbox
                v-model="forms.opinion.validated" name="validated" :form="forms.opinion"
                label="Validé la mission"
              />
            </div>
          </div>
          <!-- Submit Button -->
          <div class="d-flex justify-end align-center">
            <NLButton :loading="forms.opinion.busy" label="Save" />
          </div>
        </form>
        <div v-else class="grid">
          <div class="col-12" v-html="mission?.current.opinion.content" />
          <div v-if="mission?.current.opinion?.is_validated" class="col-12">
            <b>Validé le:</b> <time>{{ mission?.current.opinion.validated_at }}</time>
          </div>
        </div>
      </template>
      <template #footer>
        <button
          v-if="!mission?.current.opinion?.is_validated && mission?.current.opinion && !forms.opinion.edit_mode && can('create_opinion')" class="btn btn-success has-icon"
          @click.prevent="validateOpinion"
        >
          <i class="las la-check-circle icon" />
          Valider la mission
        </button>
        <button
          v-if="!mission?.current.opinion?.is_validated && mission?.current.opinion && !forms.opinion.edit_mode && can('create_opinion')" class="btn btn-warning has-icon"
          @click.prevent="enableEdition('opinion')"
        >
          <i class="las la-edit icon" />
          Editer l'avis
        </button>
      </template>
    </NLModal>

    <!-- Head of department report -->
    <NLModal :show="modals.report" @close="modals.report = false">
      <template #title>
        <h2>Rapport du chef de département</h2>
      </template>
      <template #default>
        <form
          v-if="!mission?.current.dre_report || forms.report.edit_mode" @submit.prevent="saveReport"
          @keydown="forms.report.onKeydown($event)"
        >
          <div class="grid">
            <div class="col-12">
              <NLWyswyg
                v-model="forms.report.report" :name="'report'" :form="forms.report"
                label="Rapport du chef de département" label-required
              />
            </div>
            <div class="col-12">
              <NLCheckbox
                v-model="forms.report.validated" name="validated" :form="forms.report"
                label="Validé la mission"
              />
            </div>
          </div>
          <!-- Submit Button -->
          <div class="d-flex justify-end align-center">
            <NLButton :loading="forms.report.busy" label="Save" />
          </div>
        </form>
        <div v-else class="grid">
          <div class="col-12" v-html="mission?.current.dre_report.content" />
          <div v-if="mission?.current.dre_report?.is_validated" class="col-12">
            <b>Validé le:</b> <time>{{ mission?.current.dre_report.validated_at }}</time>
          </div>
        </div>
      </template>
      <template #footer>
        <button
          v-if="mission?.current.opinion?.is_validated && mission?.current.dre_report && !mission?.current.dre_report?.is_validated && !forms.report.edit_mode && can('validate_dre_report')" class="btn btn-success has-icon"
          @click.prevent="validateReport"
        >
          <i class="las la-check-circle icon" />
          Valider la mission
        </button>
        <button
          v-if="mission?.current.opinion?.is_validated && mission?.current.dre_report && !mission?.current.dre_report?.is_validated && !forms.report.edit_mode && can('create_dre_report')" class="btn btn-warning has-icon"
          @click.prevent="enableEdition('report')"
        >
          <i class="las la-edit icon" />
          Editer le rapport
        </button>
      </template>
    </NLModal>

    <!-- Assign mission processing -->
    <NLModal :show="modals.dispatch" @close="modals.dispatch = false">
      <template #title>
        <h2>Assigné le traitement de la mission</h2>
      </template>
      <template #default>
        <form @submit.prevent="dispatchMission" @keydown="forms.dispatch.onKeydown($event)">
          <div class="grid">
            <div class="col-12">
              <NLSelect
                v-model="forms.dispatch.controllers" name="controllers" :form="forms.dispatch"
                :options="controllersList" label="Contrôleurs" placeholder="Choisissez un ou plusieurs contrôleurs"
                multiple label-required
              />
            </div>
          </div>
          <!-- Submit Button -->
          <div class="d-flex justify-end align-center">
            <NLButton :loading="forms.dispatch.busy" label="Save" />
          </div>
        </form>
      </template>
    </NLModal>
  </ContentBody>
</template>

<script>
import NLDatatable from '../../components/NLDatatable'
import { mapGetters } from 'vuex'
import api from '../../plugins/api'
import { Form } from 'vform'
import { hasRole } from '../../plugins/user'
export default {
  components: {
    NLDatatable
  },
  layout: 'backend',
  middleware: ['auth'],
  data () {
    return {
      forcedRerenderKey: -1,
      controllersList: [],
      rowSelected: null,
      config: {
        data: null,
        namespace: 'missions',
        state_key: 'processes',
        rowKey: 'id',
        columns: [
          {
            label: 'Famille',
            field: 'familly'
          },
          {
            label: 'Domaine',
            field: 'domain'
          },
          {
            label: 'Processus',
            field: 'name'
          },
          {
            label: 'Total points de contrôle',
            field: 'control_points_count'
          },
          {
            label: 'Moyenne',
            field: 'avg_score',
            hide: !hasRole(['dcp', 'cdcr', 'cc']),
            methods: {
              style: (item) => {
                const score = item.avg_score
                if (score === 1) {
                  return 'bg-success text-white text-bold'
                } else if (score === 2) {
                  return 'bg-info text-white text-bold'
                } else if (score === 3) {
                  return 'bg-warning text-bold'
                } else if (score === 4) {
                  return 'bg-danger text-white text-bold'
                }
              }
            }
          }
        ],
        actions: {
          show: true
        }
      },
      modals: {
        opinion: false,
        report: false,
        dispatch: false
      },
      forms: {
        opinion: new Form({
          opinion: null,
          id: null,
          type: 'Avis contrôleur',
          validated: false,
          edit_mode: true
        }),
        report: new Form({
          report: null,
          id: null,
          type: 'Rapport',
          validated: false,
          edit_mode: true
        }),
        dispatch: new Form({
          controllers: null
        }),
        validations: {
          opinion: new Form({
            type: 'Avis contrôleur'
          }),
          report: new Form({
            type: 'Rapport'
          })
        }
      }
    }
  },
  computed: {
    ...mapGetters({
      mission: 'missions/current',
      processes: 'missions/processes',
      controlPoints: 'processes/controlPoints',
      users: 'users/all'
    })
  },
  watch: {
    mission: {
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
  mounted () {
    this.initData()
  },
  methods: {
    validateMission (step) {
      this.$swal.confirm({ title: 'Mission ' + this.mission.current.reference, message: 'Vous êtes sur de vouloir valider la mission ' + this.mission.current.reference }).then(action => {
        if (action.isConfirmed) {
          api.post('missions/' + this.mission.current.id + '/validate/' + step).then(response => {
            this.$swal.toast_success(response.data.message)
            this.initData()
          }).catch(error => {
            console.log(error)
          })
        }
      })
    },
    /**
     * Assigne le traitement de la mission
     */
    dispatchMission () {
      this.forms.dispatch.put('/api/missions/' + this.mission.current.id + '/assign').then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.forms.dispatch.reset()
          this.initData()
        } else {
          this.$swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error)
      })
    },
    /**
     * Affiche le formulaire d'assignation du traitement de la mission
     */
    showDispatchForm () {
      const filters = {
        roles_codes: 'cc'
      }
      this.$store.dispatch('users/fetchAll', filters).then(() => {
        this.controllersList = this.users.all
        this.forms.dispatch.controllers = this.mission.current.dcp_controllers.map(controller => controller.id)
        this.modals.dispatch = true
      })
    },
    /**
     * Enregistre l'avis du contrôleur
     */
    saveReport () {
      this.forms.report.post('/api/missions/reports/' + this.mission.current.id).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.forms.opinion.reset()
          this.initData()
        } else {
          this.$swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error)
      })
    },
    /**
     * Valide l'avis du contrôleur
     */
    validateReport () {
      this.$swal.confirm({ title: 'Mission ' + this.mission.current.reference, message: 'Vous êtes sur de vouloir valider la mission ' + this.mission.current.reference }).then((action) => {
        if (action.isConfirmed) {
          this.forms.validations.report.put('/api/missions/reports/' + this.mission.current.id).then(response => {
            if (response.data.status) {
              this.$swal.toast_success(response.data.message)
              this.initData()
            } else {
              this.$swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error)
          })
        }
      })
    },
    /**
     * Affiche le rapport de la mission
     */
    showReport () {
      this.modals.report = true
    },
    /**
     * Affiche l'avis du contrôleur
     */
    showOpinion () {
      this.modals.opinion = true
    },
    /**
     * Enregistre l'avis du contrôleur
     */
    saveOpinion () {
      this.forms.opinion.post('/api/missions/reports/' + this.mission.current.id).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.forms.opinion.reset()
          this.initData()
        } else {
          this.$swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error)
      })
    },
    /**
     * Valide l'avis du contrôleur
     */
    validateOpinion () {
      this.$swal.confirm({ title: 'Mission ' + this.mission.current.reference, message: 'Vous êtes sur de vouloir valider la mission ' + this.mission.current.reference }).then((action) => {
        if (action.isConfirmed) {
          this.forms.validations.opinion.put('/api/missions/reports/' + this.mission.current.id).then(response => {
            if (response.data.status) {
              this.$swal.toast_success(response.data.message)
              this.initData()
            } else {
              this.$swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error)
          })
        }
      })
    },
    /**
     * Bascule vers le mode edition
     *
     * @param {String} type
     */
    enableEdition (type) {
      if (type === 'opinion') {
        this.forms.opinion.edit_mode = true
        this.forms.opinion.opinion = this.mission.current.opinion.content
        this.forms.opinion.id = this.mission.current.opinion.id
      } else if (type === 'report') {
        this.forms.report.edit_mode = true
        this.forms.report.report = this.mission.current.dre_report.content
        this.forms.report.id = this.mission.current.dre_report.id
      }
    },
    /**
     * Initialise les données
     */
    // breadcrumb and avoiding the rerender can be achieved by using init data
    initData () {
      this.close()
      this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId }).then(() => {
        const length = this.$breadcrumbs.value.length
        if (this.$breadcrumbs.value[length - 1].label === 'Mission') { this.$breadcrumbs.value[length - 1].label = 'Mission ' + this.mission?.current?.reference }
      }).catch(error => this.$swal.alert_error(error))
      this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId, onlyProcesses: true }).then(() => {
        this.config.data = this.processes?.processes
      }).catch(error => this.$swal.alert_error(error))
      this.forms.opinion.edit_mode = false
      this.forms.report.edit_mode = false
      this.modals.dispatch = false
    },
    /**
     * Redérige vers la page des détails de la mission
     *
     * @param {Object} item
     */
    details (item) {
      item = item?.item?.id ? item.item : item
      let name = 'mission-details'
      if (item.progress_status < 100 && !this.mission?.current.opinion) {
        name = 'mission-details-execute'
      }
      this.$router.push({ name, params: { missionId: this.mission.current.id, processId: item.id } })
    },
    /**
     * Supprime la mission
     */
    destroy () {
      this.$swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('missions/' + this.mission?.current.id).then(response => {
            if (response.data.status) {
              this.initData()
              this.$swal.toast_success(response.data.message)
            } else {
              this.$swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error)
          })
        }
      })
    },

    /**
     * Affiche le processus sélectionné dans son modal
     * @param {Object} item
     */
    show (item) {
      this.$store.dispatch('processes/fetch', { id: item.id, onlyControlPoints: true }).then(() => {
        item.controlPoints = this.controlPoints.controlPoints
        this.rowSelected = item
      })
    },
    /**
     * Ferme le modal
     */
    close () {
      this.rowSelected = null
    }
  }
}
</script>
