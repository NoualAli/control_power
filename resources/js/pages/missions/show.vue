<template>
  <ContentBody v-can="'view_mission'">
    <div class="d-flex justify-end align-center gap-3 my-2">
      <router-link :to="{ name: 'campaign', params: { campaignId: mission?.current.campaign.id } }" class="btn"
        v-can="'view_mission'">
        Campagne de contrôle
      </router-link>
      <router-link class="btn btn-warning" :to="{ name: 'missions-edit', params: { missionId: mission?.current.id } }"
        v-can="'edit_mission'" v-if="mission?.current?.remaining_days_before_start > 5">
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
                Contrôleurs:
              </span>
              <span>
                <ul class="d-inline-block ml-6">
                  <li v-for="controller in mission?.current?.controllers" :key="'controller-' + controller.id">
                    {{ controller.full_name }}
                  </li>
                </ul>
              </span>
            </div>
            <div class="col-12">
              <span class="text-bold">
                Progression:
              </span>
              <span>
                {{ mission?.current?.progress_status }}%
              </span>
            </div>
            <div class="col-12">
              <span class="text-bold">
                Statut:
              </span>
              <span>
                {{ mission?.current?.realisation_state }}
              </span>
            </div>
          </div>
        </div>
        <div class="col-12">
          <span class="text-bold">
            Moyenne:
          </span>
          <span>
            {{ mission?.current?.avg_score }}
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

    <!-- Processes List -->
    <div class="d-flex justify-between align-items">
      <h2>Processus de la mission</h2>
      <div>
        <div v-can="'create_opinion,validate_opinion'" class="create opinion">
          <button class="btn btn-info"
            v-if="!mission?.current.controller_opinion && !mission?.current.head_of_department_report && mission?.current.progress_status !== 100"
            @click="showOpinion" v-can="'create_opinion'">
            Ajouter votre avis
          </button>
          <button class="btn btn-info"
            v-if="mission?.current.progress_status !== 100 && mission?.current.head_of_department_report && mission?.current.head_of_department_report?.is_validated"
            @click="showReport" v-can="'create_opinion'">
            Rapport de la mission
          </button>
          <button class="btn btn-info"
            v-if="mission?.current.controller_opinion && mission?.current.progress_status !== 100" @click="showOpinion"
            v-can="'create_opinion'">
            Votre avis
          </button>
          <button class="btn btn-success"
            v-if="mission?.current.progress_status !== 100 && !mission?.current.controller_opinion?.is_validated && mission?.current.controller_opinion"
            @click.prevent="validateOpinion" v-can="'validate_opinion'">
            Valider la mission
          </button>
        </div>

        <div v-can="'create_report,validate_report'" class="create report">
          <button class="btn btn-info"
            v-if="mission?.current.progress_status !== 100 && !mission?.current.head_of_department_report && mission?.current.controller_opinion?.is_validated"
            @click="showReport">
            Ajouter votre rapport
          </button>
          <button class="btn btn-info"
            v-if="mission?.current.progress_status !== 100 && mission?.current.head_of_department_report && mission?.current.controller_opinion?.is_validated"
            @click="showReport">
            Votre rapport
          </button>
          <button class="btn btn-info"
            v-if="mission?.current.progress_status !== 100 && mission?.current.controller_opinion?.is_validated"
            @click="showOpinion">
            Avis du contrôleur
          </button>
          <button class="btn btn-success"
            v-if="mission?.current.progress_status !== 100 && mission?.current.controller_opinion?.is_validated && !mission?.current.head_of_department_report?.is_validated && mission?.current.head_of_department_report"
            @click.prevent="validateReport">
            Valider la mission
          </button>
        </div>

        <div v-can="'create_control_campaign'" class="has role">
          <button class="btn btn-info"
            v-if="mission?.current.progress_status !== 100 && mission?.current.head_of_department_report && mission?.current.head_of_department_report?.is_validated"
            @click="showReport">
            Rapport de la mission
          </button>
          <button class="btn btn-info"
            v-if="mission?.current.controller_opinion && mission?.current.progress_status !== 100" @click="showOpinion">
            Avis du contrôleur
          </button>
        </div>
      </div>
    </div>
    <NLDatatable :config="config" @show="show">
      <template v-slot:actions="item">
        <button class="btn btn-info has-icon" @click.stop="details(item)" v-can="'control_agency'"
          v-if="item.item.progress_status < 100">
          <i class="las la-tasks icon"></i>
        </button>
        <button class="btn btn-info has-icon" @click.stop="details(item)" v-can="'view_mission_detail'" v-else>
          <i class="las la-list-alt icon"></i>
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
              {{ controlPoint.name }}
            </div>
          </div>
        </div>
      </template>
      <template v-slot:footer v-can="'edit_mission'">
        <button class="btn btn-info has-icon" @click.stop="details(rowSelected)" v-can="'view_mission'"
          v-if="rowSelected?.progress_status == 100">
          <i class="las la-tasks icon"></i>
          Afficher
        </button>
        <button class="btn btn-info has-icon" @click.stop="details(rowSelected)" v-can="'control_agency'" v-else>
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
          v-if="!mission?.current.controller_opinion || forms.opinion.edit_mode">
          <div class="grid">
            <div class="col-12">
              <NLWyswyg :name="'opinion'" v-model="forms.opinion.opinion" :form="forms.opinion"
                label="Avis du contrôleur" labelRequired />
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
          <div class="col-12" v-html="mission?.current.controller_opinion.content"></div>
          <div class="col-12" v-if="mission?.current.controller_opinion?.is_validated">
            <b>Validé le:</b> <time>{{ mission?.current.controller_opinion.validated_at }}</time>
          </div>
        </div>
      </template>
      <template #footer>
        <button class="btn btn-success has-icon" @click.prevent="validateOpinion"
          v-if="!mission?.current.controller_opinion?.is_validated && mission?.current.controller_opinion && !forms.opinion.edit_mode"
          v-can="'create_opinion'">
          <i class="las la-check-circle icon"></i>
          Valider la mission
        </button>
        <button class="btn btn-warning has-icon" @click.prevent="enableEdition('opinion')"
          v-if="!mission?.current.controller_opinion?.is_validated && mission?.current.controller_opinion && !forms.opinion.edit_mode"
          v-can="'create_opinion'">
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
          v-if="!mission?.current.head_of_department_report || forms.report.edit_mode">
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
          <div class="col-12" v-html="mission?.current.head_of_department_report.content"></div>
          <div class="col-12" v-if="mission?.current.head_of_department_report?.is_validated">
            <b>Validé le:</b> <time>{{ mission?.current.head_of_department_report.validated_at }}</time>
          </div>
        </div>
      </template>
      <template #footer>
        <button class="btn btn-success has-icon" @click.prevent="validateReport"
          v-if="!mission?.current.head_of_department_report?.is_validated && mission?.current.head_of_department_report && !forms.report.edit_mode"
          v-can="'create_report'">
          <i class="las la-check-circle icon"></i>
          Valider la mission
        </button>
        <button class="btn btn-warning has-icon" @click.prevent="enableEdition('report')"
          v-if="!mission?.current.head_of_department_report?.is_validated && mission?.current.head_of_department_report && !forms.report.edit_mode"
          v-can="'create_report'">
          <i class="las la-edit icon"></i>
          Editer le rapport
        </button>
      </template>
    </NLModal>
  </ContentBody>
</template>

<script>
import NLDatatable from '../../components/NLDatatable';
import { mapGetters } from 'vuex';
import api from '../../plugins/api'
import { Form } from 'vform';
export default {
  layout: 'backend',
  middleware: [ 'auth' ],
  components: {
    NLDatatable
  },
  data() {
    return {
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
            methods: {
              style: (item) => {
                const score = item.avg_score
                if (score == 1) {
                  return 'bg-success text-white text-bold'
                } else if (score == 2) {
                  return 'bg-info text-white text-bold'
                } else if (score == 3) {
                  return 'bg-warning text-bold'
                } else if (score == 4) {
                  return 'bg-danger text-white text-bold'
                }
              }
            }
          },
          {
            label: "Progression",
            field: "progress_status",
            methods: {
              showField: (item) => {
                return item.progress_status + '%'
              }
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
  breadcrumb() {
    return {
      label: 'Mission ' + this.mission?.current?.reference
    }
  },
  computed: {
    ...mapGetters({
      mission: 'missions/current',
      processes: 'missions/processes'
    }),
  },

  created() {
    this.initData()
  },

  methods: {
    /**
     * Affiche l'avis du contrôleur
     */
    showReport() {
      this.modals.report = true
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
      swal.confirm_update().then((action) => {
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
      swal.confirm_update().then((action) => {
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
        this.forms.opinion.opinion = this.mission.current.controller_opinion.content
        this.forms.opinion.id = this.mission.current.controller_opinion.id
      } else if (type == 'report') {
        this.forms.report.edit_mode = true
        this.forms.report.report = this.mission.current.head_of_department_report.content
        this.forms.report.id = this.mission.current.head_of_department_report.id
      }
    },
    /**
     * Initialise les données
     */
    initData() {
      this.close()
      this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId })
      this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId, onlyProcesses: true }).then(() => this.config.data = this.processes.processes)
      this.forms.opinion.edit_mode = false
      this.forms.report.edit_mode = false
    },
    /**
     * Redérige vers la page des détails de la mission
     *
     * @param {Object} item
     */
    details(item) {
      item = item?.item?.id ? item.item : item
      this.$router.push({ name: "missions-details", params: { missionId: this.mission.current.id, processId: item.id } })
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
      this.rowSelected = item
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
