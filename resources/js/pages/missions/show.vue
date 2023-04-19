<template>
  <ContentBody v-if="can('view_mission')">
    <div class="d-flex justify-end align-center gap-3 my-2">
      <router-link :to="{ name: 'campaign', params: { campaignId: mission?.current.campaign.id } }" class="btn"
        v-if="can('view_control_campaign,view_page_control_campaigns')">
        Campagne de contrôle
      </router-link>
      <router-link class="btn btn-warning" :to="{ name: 'missions-edit', params: { missionId: mission?.current.id } }"
        v-if="mission?.current?.remaining_days_before_start > 5 && can('edit_mission')">
        <i class="las la-edit icon"></i>
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
        <div class="col-12 col-lg-4" v-has-role="'cdc,cdcr,cc'">
          <span class="text-bold">
            Moyenne:
          </span>
          <span>
            {{ mission?.current?.avg_score }}
          </span>
        </div>
        <!-- <div class="col-12 col-lg-4 d-none d-lg-block"></div> -->
        <div class="col-12 col-lg-4" v-if="mission?.current?.cdcr_validation_at">
          <span class="text-bold">
            1<sup>ère</sup> validation
          </span>
          <span>
            {{ mission?.current?.cdcr_validation_at }}
          </span>
        </div>
        <div class="col-12 col-lg-4" v-if="mission?.current?.cdcr_validation_at">
          <span class="text-bold">
            Validé par:
          </span>
          <span>
            {{ mission?.current?.cdcr_validator?.full_name }}
          </span>
        </div>
        <div class="col-12 col-lg-4 d-none d-lg-block"></div>
        <div class="col-12 col-lg-4" v-if="mission?.current?.dcp_validation_at">
          <span class="text-bold">
            2<sup>ème</sup> validation
          </span>
          <span>
            {{ mission?.current?.dcp_validation_at }}
          </span>
        </div>
        <div class="col-12 col-lg-4" v-if="mission?.current?.dcp_validation_at">
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

    <div class="box is-info" v-if="mission?.current?.remaining_days_before_start > 0">
      Nous vous informons que la mission débutera le <b>{{ mission?.current?.start }}</b> dans exactement <b>{{
        mission?.current?.remaining_days_before_start_str }}</b>
    </div>

    <!-- Actions -->
    <div class="d-flex align-items gap-2">
      <button class="btn btn-danger has-icon" @click="exportReport">
        <i class="las la-file-pdf icon"></i>
        Exporter le rapport
      </button>
      <!-- CDC -->

      <!-- Report actions -->
      <button class="btn btn-info"
        v-if="mission?.current.progress_status == 100 && !mission?.current.dre_report && mission?.current.opinion?.is_validated && can('create_dre_report')"
        @click="showReport">
        Ajouter votre rapport
      </button>
      <button class="btn btn-success"
        v-if="mission?.current.progress_status == 100 && mission?.current.opinion?.is_validated && !mission?.current.dre_report?.is_validated && mission?.current.dre_report && can('validate_dre_report')"
        @click.prevent="validateReport">
        Valider la mission
      </button>

      <!-- Read actions -->
      <button class="btn btn-info" v-if="mission?.current.dre_report && can('create_dre_report')" @click="showReport">
        Rapport de la mission
      </button>

      <!-- CI -->
      <button class="btn btn-success"
        v-if="mission?.current.progress_status == 100 && !mission?.current.controller_opinion_is_validated && mission?.current?.controller_opinion_exist && can('validate_opinion')"
        @click.prevent="validateOpinion">
        Valider la mission
      </button>
      <button class="btn btn-info"
        v-if="!mission?.current.controller_opinion_exist && !mission?.current?.dre_report_exist && mission?.current.progress_status == 100 && can('create_opinion')"
        @click="showOpinion">
        Ajouter votre avis
      </button>

      <button class="btn btn-info" v-if="mission?.current.opinion?.is_validated && can('view_opinion')"
        @click="showOpinion">
        Avis sur la mission
      </button>
      <button class="btn btn-info"
        v-if="mission?.current?.controller_opinion_exist && !mission?.current.opinion?.is_validated && can('create_opinion')"
        @click="showOpinion">
        Avis sur la mission
      </button>

      <!-- CDCR -->
      <button class="btn btn-success" v-if="!mission?.current.cdcr_validation_at && can('make_first_validation')"
        @click.prevent="validateMission(1)">
        Valider la mission
      </button>
      <button class="btn btn-success" v-if="!mission?.current.cdcr_validation_at && can('assign_mission_processing')"
        @click.prevent="showDispatchForm">
        Assigné
      </button>
      <button class="btn btn-info"
        v-if="mission?.current.dre_report?.is_validated && can('make_first_validation,process_mission')"
        @click="showReport">
        Rapport de la mission
      </button>

      <!-- DCP -->
      <button class="btn btn-success"
        v-if="mission?.current.cdcr_validation_at && !mission?.current.dcp_validation_at && can('make_second_validation')"
        @click.prevent="validateMission(2)">
        Valider la mission
      </button>
      <button class="btn btn-info" v-if="mission?.current.dre_report?.is_validated && can('make_second_validation')"
        @click="showReport">
        Rapport de la mission
      </button>

      <div v-has-role="'dg,cdrcp,da,cc'">
        <button class="btn btn-info" v-if="mission?.current.cdcr_validation_at" @click="showReport">
          Rapport de la mission
        </button>
      </div>
    </div>

    <!-- Processes List -->
    <NLDatatable title="Processus de la mission" namespace="missions" stateKey="processes" :config="config" @show="show">
      <template v-slot:actions="item">
        <button class="btn btn-info has-icon" @click.stop="details(item)"
          v-if="can('control_agency,view_mission_detail') && mission?.current?.remaining_days_before_start <= 0">
          <i class="las la-tasks icon" v-if="item.item.progress_status < 100 && !mission?.current.opinion"></i>
          <i class="las la-list-alt icon" v-else></i>
        </button>
      </template>
    </NLDatatable>

    <!-- Process details (control points) -->
    <NLModal :show="rowSelected" @close="close">
      <template v-slot:title>
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
      <template v-slot>
        <p class="text-bold mb-6">
          Points de contrôle
        </p>
        <div class="grid list">
          <div class="col-12 list-item" v-for="controlPoint in rowSelected?.controlPoints" :key="controlPoint.id">
            <div class="list-item-content">
              {{ controlPoint.label }}
            </div>
          </div>
        </div>
      </template>
      <template v-slot:footer v-if="can('edit_mission')">
        <button class="btn btn-info has-icon" @click.stop="details(rowSelected)"
          v-if="rowSelected?.progress_status == 100 && can('view_mission')">
          <i class="las la-tasks icon"></i>
          Afficher
        </button>
        <button class="btn btn-info has-icon" @click.stop="details(rowSelected)" v-else-if="can('control_agency')">
          <i class="las la-tasks icon"></i>
          Éffectuer
        </button>
      </template>
    </NLModal>

    <!-- Controller opinion -->
    <NLModal :show="modals.opinion" @close="modals.opinion = false">
      <template v-slot:title>
        <h2>Avis du contrôleur</h2>
      </template>
      <template v-slot>
        <form @submit.prevent="saveOpinion" @keydown="forms.opinion.onKeydown($event)"
          v-if="!mission?.current.opinion || forms.opinion.edit_mode">
          <div class="grid">
            <div class="col-12">
              <NLWyswyg :name="'opinion'" v-model="forms.opinion.opinion" :form="forms.opinion" label="Avis du contrôleur"
                labelRequired />
            </div>
            <div class="col-12">
              <NLCheckbox name="validated" :form="forms.opinion" label="Validé la mission"
                v-model="forms.opinion.validated" />
            </div>
          </div>
          <!-- Submit Button -->
          <div class="d-flex justify-end align-center">
            <NLButton :loading="forms.opinion.busy" label="Save" />
          </div>
        </form>
        <div class="grid" v-else>
          <div class="col-12" v-html="mission?.current.opinion.content"></div>
          <div class="col-12" v-if="mission?.current.opinion?.is_validated">
            <b>Validé le:</b> <time>{{ mission?.current.opinion.validated_at }}</time>
          </div>
        </div>
      </template>
      <template #footer>
        <button class="btn btn-success has-icon" @click.prevent="validateOpinion"
          v-if="!mission?.current.opinion?.is_validated && mission?.current.opinion && !forms.opinion.edit_mode && can('create_opinion')">
          <i class="las la-check-circle icon"></i>
          Valider la mission
        </button>
        <button class="btn btn-warning has-icon" @click.prevent="enableEdition('opinion')"
          v-if="!mission?.current.opinion?.is_validated && mission?.current.opinion && !forms.opinion.edit_mode && can('create_opinion')">
          <i class="las la-edit icon"></i>
          Editer l'avis
        </button>
      </template>
    </NLModal>

    <!-- Head of department report -->
    <NLModal :show="modals.report" @close="modals.report = false">
      <template v-slot:title>
        <h2>Rapport du chef de département</h2>
      </template>
      <template v-slot>
        <form @submit.prevent="saveReport" @keydown="forms.report.onKeydown($event)"
          v-if="!mission?.current.dre_report || forms.report.edit_mode">
          <div class="grid">
            <div class="col-12">
              <NLWyswyg :name="'report'" v-model="forms.report.report" :form="forms.report"
                label="Rapport du chef de département" labelRequired />
            </div>
            <div class="col-12">
              <NLCheckbox name="validated" :form="forms.report" label="Validé la mission"
                v-model="forms.report.validated" />
            </div>
          </div>
          <!-- Submit Button -->
          <div class="d-flex justify-end align-center">
            <NLButton :loading="forms.report.busy" label="Save" />
          </div>
        </form>
        <div class="grid" v-else>
          <div class="col-12" v-html="mission?.current.dre_report.content"></div>
          <div class="col-12" v-if="mission?.current.dre_report?.is_validated">
            <b>Validé le:</b> <time>{{ mission?.current.dre_report.validated_at }}</time>
          </div>
        </div>
      </template>
      <template #footer>
        <button class="btn btn-success has-icon" @click.prevent="validateReport"
          v-if="mission?.current.opinion?.is_validated && mission?.current.dre_report && !mission?.current.dre_report?.is_validated && !forms.report.edit_mode && can('validate_dre_report')">
          <i class="las la-check-circle icon"></i>
          Valider la mission
        </button>
        <button class="btn btn-warning has-icon" @click.prevent="enableEdition('report')"
          v-if="mission?.current.opinion?.is_validated && mission?.current.dre_report && !mission?.current.dre_report?.is_validated && !forms.report.edit_mode && can('create_dre_report')">
          <i class="las la-edit icon"></i>
          Editer le rapport
        </button>
      </template>
    </NLModal>

    <!-- Assign mission processing -->
    <NLModal :show="modals.dispatch" @close="modals.dispatch = false">
      <template v-slot:title>
        <h2>Assigné le traitement de la mission</h2>
      </template>
      <template v-slot>
        <form @submit.prevent="dispatchMission" @keydown="forms.dispatch.onKeydown($event)">
          <div class="grid">
            <div class="col-12">
              <NLSelect name="controllers" v-model="forms.dispatch.controllers" :form="forms.dispatch"
                :options="controllersList" label="Contrôleurs" placeholder="Choisissez un ou plusieurs contrôleurs"
                multiple labelRequired />
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
import NLDatatable from '../../components/NLDatatable';
import { mapGetters } from 'vuex';
import api from '../../plugins/api'
import { Form } from 'vform';
import { hasRole } from '../../plugins/user'
export default {
  layout: 'backend',
  middleware: [ 'auth' ],
  components: {
    NLDatatable
  },
  data() {
    return {
      controllersList: [],
      rowSelected: null,
      config: {
        data: null,
        namespace: 'missions',
        state_key: 'processes',
        rowKey: 'id',
        columns: [
          {
            label: "Famille",
            field: "familly"
          },
          {
            label: "Domaine",
            field: "domain"
          },
          {
            label: "Processus",
            field: "name"
          },
          {
            label: "Total points de contrôle",
            field: "control_points_count"
          },
          {
            label: "Moyenne",
            field: "avg_score",
            hide: !hasRole([ 'dcp', 'cdcr', 'cc' ]),
            isHtml: true,
            methods: {
              showField(item) {
                const score = item.avg_score
                let style = 'text-dark text-bold'
                if (score == 1) {
                  style = 'bg-success text-white text-bold'
                } else if (score == 2) {
                  style = 'bg-info text-white text-bold'
                } else if (score == 3) {
                  style = 'bg-warning text-bold'
                } else if (score == 4) {
                  style = 'bg-danger text-white text-bold'
                } else {
                  style = 'bg-grey text-dark text-bold'
                }
                return `<div class="container">
                  <div class="has-border-radius py-1 text-center ${style}">${score}</div>
                </div>`
              },
            }
          },
        ],
        actions: {
          show: true,
        }
      },
      modals: {
        opinion: false,
        report: false,
        dispatch: false,
      },
      forms: {
        opinion: new Form({
          opinion: null,
          id: null,
          type: 'Avis contrôleur',
          validated: false,
          edit_mode: true,
        }),
        report: new Form({
          report: null,
          id: null,
          type: 'Rapport',
          validated: false,
          edit_mode: true,
        }),
        dispatch: new Form({
          controllers: null,
        }),
        validations: {
          opinion: new Form({
            type: 'Avis contrôleur'
          }),
          report: new Form({
            type: 'Rapport'
          }),
        }
      }
    }
  },
  breadcrumb() {
    return {
      label: 'Mission ' + this.mission?.current?.reference
    }
  },
  computed: {
    ...mapGetters({
      mission: 'missions/current',
      processes: 'missions/processes',
      controlPoints: 'processes/controlPoints',
      users: 'users/all'
    }),
  },

  created() {
    this.initData()
  },

  methods: {
    exportReport() {
      api.get('missions/' + this.mission.current.id + '/export?type=pdf').then((response) => {
        console.log(response);
      })
    },
    /**
     * Validation de la mission par le dcp et cdcr
     *
     * @param {Numeric} step
     */
    validateMission(step) {
      swal.confirm({ title: 'Mission ' + this.mission.current.reference, message: 'Vous êtes sur de vouloir valider la mission ' + this.mission.current.reference }).then(action => {
        if (action.isConfirmed) {
          api.post('missions/' + this.mission.current.id + '/validate/' + step).then(response => {
            swal.toast_success(response.data.message)
            this.initData()
          }).catch(error => {
            console.log(error);
          })
        }
      })
    },
    /**
     * Assigne le traitement de la mission
     */
    dispatchMission() {
      this.forms.dispatch.put('/api/missions/' + this.mission.current.id + '/assign').then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.forms.dispatch.reset()
          this.initData()
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })
    },
    /**
     * Affiche le formulaire d'assignation du traitement de la mission
     */
    showDispatchForm() {
      let filters = {
        roles_codes: 'cc'
      }
      this.$store.dispatch('users/fetchAll', filters).then(() => {
        this.controllersList = this.users.all
        this.forms.dispatch.controllers = this.mission.current.dcp_controllers.map(controller => controller.id);
        this.modals.dispatch = true
      })
    },
    /**
     * Enregistre l'avis du contrôleur
     */
    saveReport() {
      this.forms.report.post('/api/missions/reports/' + this.mission.current.id).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.forms.opinion.reset()
          this.initData()
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })
    },
    /**
     * Valide l'avis du contrôleur
     */
    validateReport() {
      swal.confirm({ title: 'Mission ' + this.mission.current.reference, message: 'Vous êtes sur de vouloir valider la mission ' + this.mission.current.reference }).then((action) => {
        if (action.isConfirmed) {
          this.forms.validations.report.put('/api/missions/reports/' + this.mission.current.id).then(response => {
            if (response.data.status) {
              swal.toast_success(response.data.message)
              this.initData()
            } else {
              swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error);
          })
        }
      })
    },
    /**
     * Affiche le rapport de la mission
     */
    showReport() {
      this.modals.report = true
    },
    /**
     * Affiche l'avis du contrôleur
     */
    showOpinion() {
      this.modals.opinion = true
    },
    /**
     * Enregistre l'avis du contrôleur
     */
    saveOpinion() {
      this.forms.opinion.post('/api/missions/reports/' + this.mission.current.id).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.forms.opinion.reset()
          this.initData()
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })
    },
    /**
     * Valide l'avis du contrôleur
     */
    validateOpinion() {
      swal.confirm({ title: 'Mission ' + this.mission.current.reference, message: 'Vous êtes sur de vouloir valider la mission ' + this.mission.current.reference }).then((action) => {
        if (action.isConfirmed) {
          this.forms.validations.opinion.put('/api/missions/reports/' + this.mission.current.id).then(response => {
            if (response.data.status) {
              swal.toast_success(response.data.message)
              this.initData()
            } else {
              swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error);
          })
        }
      })
    },
    /**
     * Bascule vers le mode edition
     *
     * @param {String} type
     */
    enableEdition(type) {
      if (type == 'opinion') {
        this.forms.opinion.edit_mode = true
        this.forms.opinion.opinion = this.mission.current.opinion.content
        this.forms.opinion.id = this.mission.current.opinion.id
      } else if (type == 'report') {
        this.forms.report.edit_mode = true
        this.forms.report.report = this.mission.current.dre_report.content
        this.forms.report.id = this.mission.current.dre_report.id
      }
    },
    /**
     * Initialise les données
     */
    initData() {
      this.close()
      this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId }).catch(error => swal.alert_error(error))
      this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId, onlyProcesses: true }).then(() => {
        this.config.data = this.processes?.processes
      }).catch(error => swal.alert_error(error))
      this.forms.opinion.edit_mode = false
      this.forms.report.edit_mode = false
      this.modals.dispatch = false
    },
    /**
     * Redérige vers la page des détails de la mission
     *
     * @param {Object} item
     */
    details(item) {
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
    destroy() {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('missions/' + this.mission?.current.id).then(response => {
            if (response.data.status) {
              this.initData()
              swal.toast_success(response.data.message)
            } else {
              swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error);
          })
        }
      })
    },

    /**
     * Affiche le processus sélectionné dans son modal
     * @param {Object} item
     */
    show(item) {
      this.$store.dispatch('processes/fetch', { id: item.id, onlyControlPoints: true }).then(() => {
        item.controlPoints = this.controlPoints.controlPoints
        this.rowSelected = item
      })
    },
    /**
     * Ferme le modal
     */
    close() {
      this.rowSelected = null
    },
  },
}
</script>
