<template>
  <ContentBody v-if="can('view_control_campaign')">
    <div class="d-flex justify-end align-center gap-3 my-2">
      <router-link :to="{ name: 'campaign-missions', params: { campaignId: campaign?.current?.id } }" class="btn"
        v-if="can('view_mission')">
        Missions
      </router-link>
      <router-link class="btn btn-warning" :to="{ name: 'campaigns-edit', params: { campaignId: campaign?.current?.id } }"
        v-if="campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign') && !campaign?.current.validated_by_id && is('dcp')">
        <i class="las la-edit icon"></i>
      </router-link>
      <button class="btn btn-danger" @click.stop="destroy"
        v-if="campaign?.current?.remaining_days_before_start > 5 && can('delete_control_campaign') && !campaign?.current.validated_by_id && is('dcp')">
        <i class="las la-trash icon"></i>
      </button>
      <button class="btn btn-info has-icon" @click.stop="validate(campaign?.current)"
        v-if="!campaign?.current?.validated_by_id && can('validate_control_campaign')">
        <i class="las la-check icon"></i>
      </button>
    </div>
    <!-- Control campaign informations -->
    <div class="box mb-10 border-primary-dark border-1">
      <div class="grid gap-12">
        <div class="col-12 col-lg-4">
          <span class="text-bold">
            Référence:
          </span>
          <span class="text-bold">
            {{ campaign?.current?.reference }}
          </span>
        </div>
        <div class="col-12 col-lg-4" v-has-role="'cdcr,dcp'">
          <span class="text-bold">
            Etat:
          </span>
          <span>
            {{ campaign?.current?.validated_by_id ? 'Validé' : 'En attente de validation' }}
          </span>
        </div>
        <div class="col-12 col-lg-4">
          <div class="grid">
            <div class="col-12 grid">
              <div class="col-12 col-lg-6">
                <span class="text-bold">
                  Début:
                </span>
                <span>
                  {{ campaign?.current?.start + ' / ' +
                    campaign?.current?.remaining_days_before_start_str }}
                </span>
              </div>
              <div class="col-12 col-lg-6">
                <span class="text-bold">
                  Fin:
                </span>
                <span>
                  {{ campaign?.current?.end + ' / ' +
                    campaign?.current?.remaining_days_before_end_str }}
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <span class="text-bold">
            Description:
          </span>
          <span>
            {{ campaign?.current?.description }}
          </span>
        </div>
      </div>
    </div>

    <!-- Processes List -->
    <NLDatatable namespace="campaigns" stateKey="current" :config="config" @show="show" @delete="destroy"
      title="Liste des processus de la campagne de contrôle">
      <template v-slot:actions="item">
        <button class="btn btn-danger has-icon" @click.stop="detachProcess(item.item)"
          v-if="campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign') && !campaign?.current.validated_by_id && config.data?.meta?.total > 1 && is('dcp')">
          <i class="las la-unlink icon"></i>
        </button>
      </template>
    </NLDatatable>

    <!-- Process details (control points) -->
    <NLModal :show="rowSelected" @close="close">
      <template v-slot:title>
        <small class="tag is-info text-small">
          {{ rowSelected?.familly_name }}
        </small>
        <small class="tag is-primary-dark text-small mx-1">
          {{ rowSelected?.domain_name }}
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
          <div class="col-12 list-item" v-for="controlPoint in process?.controlPoints" :key="controlPoint.id">
            <div class="list-item-content">
              {{ controlPoint.label }}
            </div>
          </div>
        </div>
      </template>
      <template v-slot:footer
        v-if="campaign?.current?.remaining_days_before_start > 5 && can('edit_control_campaign') && config.data?.meta?.total > 1 && is('dcp')">
        <button class="btn btn-danger has-icon"
          @click.stop="destroy(rowSelected, campaign?.current) && config.data?.meta?.total > 1">
          <i class="las la-unlink icon"></i>
          Détacher
        </button>
      </template>
    </NLModal>
  </ContentBody>
</template>

<script>
import NLDatatable from '../../components/NLDatatable';
import { mapGetters } from 'vuex';
import api from '../../plugins/api'
export default {
  layout: 'backend',
  middleware: [ 'auth' ],
  components: {
    NLDatatable
  },
  breadcrumb() {
    return {
      label: 'Détails campagne ' + this.campaign?.current?.reference
    }
  },
  data() {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: "Famille",
            field: "familly_name"
          },
          {
            label: "Domaine",
            field: "domain_name"
          },
          {
            label: "Processus",
            field: "name"
          },
          {
            label: "Total points de contrôle",
            field: "control_points_count"
          },
        ],
        actions: {
          show: true,
        }
      },
    }
  },
  computed: {
    ...mapGetters({
      processes: 'campaigns/processes',
      process: 'processes/controlPoints',
      campaign: 'campaigns/current',
    }),
  },

  created() {
    this.initData()
  },

  methods: {
    initData() {
      this.close()
      const campaignId = this.$route.params.campaignId
      this.$store.dispatch('campaigns/fetch', { campaignId })
      this.$store.dispatch('campaigns/fetchProcesses', campaignId).then(() => this.config.data = this.processes.processes)
    },
    loadControlPoints(process) {
      this.$store.dispatch('processes/fetch', { id: process.id, onlyControlPoints: true }).then(() => this.control_points = this.process.controlPoints)
    },
    /**
     * Valide une campagne de contrôle
     *
     * @param {Object} item
     */
    validate(item) {
      swal.confirm({ title: 'Validation', message: 'Validation de la campagne de contrôle ' + item.reference, icon: 'success' }).then(response => {
        if (response.isConfirmed) {
          api.put('campaigns/' + item.id + '/validate').then(response => {
            if (response.data.status) {
              this.initData()
              swal.toast_success(response.data.message)
            } else {
              swal.toast_error(response.data.message)
            }
          })
        }
      }).catch(error => {
        swal.alert_error(error)
      })
    },
    /**
     * Delete campaign
     */
    destroy() {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('campaigns/' + this.campaign?.current?.id).then(response => {
            if (response.data.status) {
              swal.toast_success(response.data.message)
              this.$router.push({ name: 'campaigns' })
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
     * Detach specific process from campaign
     *
     * @param {Object} process
     */
    detachProcess(process) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('campaigns/' + this.campaign?.current?.id + '/process/' + process.id).then(response => {
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
    show(item) {
      this.rowSelected = item
      this.loadControlPoints(item)
    },
    close() {
      this.rowSelected = null
    },
  },
}
</script>
