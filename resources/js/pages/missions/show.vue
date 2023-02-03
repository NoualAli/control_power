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
      <button class="btn btn-info" v-if="mission?.current.progress_status !== 100" v-can="'add_opinion'"
        @click="showOpinion">
        Ajouter votre avis
      </button>
      <button class="btn btn-info"
        v-if="mission?.current.progress_status == 100 && mission?.current.controller_opinion">
        Avis du contrôleur
      </button>
      <button class="btn btn-success" v-can="'validated_mission'"
        v-if="mission?.current.progress_status == 100 && !mission?.current.validated_at">
        Valider la mission
      </button>
    </div>
    <NLDatatable :config="config" @show="show">
      <template v-slot:actions="item" v-can="'edit_mission'">
        <button class="btn btn-info has-icon" @click.stop="details(item)">
          <i class="las la-tasks icon"></i>
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
        <button class="btn btn-info has-icon" @click.stop="details(rowSelected)">
          <i class="las la-tasks icon"></i>
          <span v-if="rowSelected?.progress_status == 100">
            Afficher
          </span>
          <span v-else>
            Éffectuer
          </span>
        </button>
      </template>
    </NLModal>

    <NLModal :show="modals.opinion" @close="modals.opinion = false">
      <template v-slot:title>
        <h2>Avis contrôleur</h2>
      </template>
      <template v-slot>
        <form @submit.prevent="saveOpinion" @keydown="forms.opinion.onKeydown($event)">
          <div class="grid">
            <div class="col-12">
              <NLWyswyg :name="'opinion'" v-model="forms.opinion.opinion" :form="forms.opinion" label="Avis" />
            </div>
          </div>
          <!-- Submit Button -->
          <div class="d-flex justify-end align-center gap-2">
            <NLButton :loading="forms.opinion.busy" label="Save" />
            <NLButton :loading="forms.opinion.busy" label="Save and validate" validate />
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
                } else {
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
          type: 'Avis contrôleur',
          validate: false,
        }),
        report: new Form({
          report: null,
          type: 'Rapport',
          validate: false,
        }),
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
    showOpinion() {
      this.modals.opinion = true
    },
    saveOpinion(e) {
      console.log(e);
    },
    /**
     * Initialise les données
     */
    initData() {
      this.close()
      this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId })
      this.$store.dispatch('missions/fetch', { missionId: this.$route.params.missionId, onlyProcesses: true }).then(() => this.config.data = this.processes.processes)
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
