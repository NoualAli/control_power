<template>
  <div v-if="can('view_control_campaign')">
    <div class="d-flex justify-between align-center">
      <div class="w-100 d-flex justify-end align-center">
        <router-link v-if="can('create_control_campaign')" class="btn btn-info" :to="{ name: 'campaigns-create' }">
          Ajouter
        </router-link>
      </div>
    </div>
    <ContentBody>
      <NLDatatable
        namespace="campaigns" :config="config" :filters="filters" @delete="destroy" @show="show" @edit="edit"
        @filterReset="resetData()"
      >
        <template #actions="item">
          <button
            v-if="!item?.item?.validated_by_id && can('validate_control_campaign')" class="btn btn-info has-icon"
            @click.stop="validate(item.item)"
          >
            <i class="las la-check icon" />
          </button>
        </template>
      </NLDatatable>
    </ContentBody>
  </div>
</template>

<script>
import ContentBody from '../../components/ContentBody'
import NLDatatable from '../../components/NLDatatable'
import { mapGetters } from 'vuex'
import { hasRole } from '../../plugins/user'
import api from '../../plugins/api'

export default {
  components: {
    ContentBody, NLDatatable
  },
  layout: 'backend',
  middleware: ['auth'],
  data () {
    return {
      rowSelected: null,
      config: {
        data: null,
        columns: [
          {
            label: 'Référence',
            field: 'reference',
            orderable: true
          },
          {
            label: 'Date début',
            field: 'start',
            orderable: true
          },
          {
            label: 'Date fin',
            field: 'end',
            orderable: true
          },
          {
            label: 'Début',
            field: 'remaining_days_before_start_str'
          },
          {
            label: 'Fin',
            field: 'remaining_days_before_end_str'
          },
          {
            label: 'Etat',
            field: 'validated_by_id',
            hide: !hasRole(['dcp', 'cdcr']),
            methods: {
              showField (item) {
                return item.validated_by_id ? 'Validé' : 'En attente de validation'
              }
            }
          }
        ],
        actions: {
          show: true,
          edit: (item) => {
            return this.can('edit_control_campaign') && item.remaining_days_before_start > 5 && !item.validated_by_id && this.is('dcp')
          },
          delete: (item) => {
            return this.can('delete_control_campaign') && item.remaining_days_before_start > 5 && !item.validated_by_id && this.is('dcp')
          }
        }
      },
      filters: {
        reference: {
          label: 'Année',
          data: null,
          value: null
        },
        validated: {
          label: 'Etat',
          hide: !hasRole(['dcp', 'cdcr']),
          data: [
            {
              id: 0,
              label: 'En attente de validation'
            },
            {
              id: 1,
              label: 'Validé'
            }
          ],
          value: null
        },
        between: {
          value: [],
          type: 'date-range',
          cols: 'col-lg-4',
          attributes: {
            start: {
              cols: 'col-lg-6',
              label: 'De',
              value: null
            },
            end: {
              cols: 'col-lg-6',
              label: 'À',
              value: null
            }
          }
        }
      }
    }
  },
  computed: {
    ...mapGetters({
      controlCampaigns: 'campaigns/paginated'
    })
  },
  created () {
    this.initFilters()
    this.initData()
  },
  methods: {
    resetData () {
      this.initFilters(false)
      this.initData()
    },
    initYearsList () {
      let start = 2023
      const currentYear = new Date().getFullYear()
      const years = []
      for (start; start <= currentYear; start++) {
        years.push({ id: start, label: start })
      }
      this.filters.reference.data = years
    },
    /**
     * Affiche une campagne de contrôle
     *
     * @param {Object} item
     */
    show (item) {
      this.$router.push({ name: 'campaign', params: { campaignId: item.id } })
    },

    /**
     *
     * @param {Object} item
     */
    edit (item) {
      this.$router.push({ name: 'campaigns-edit', params: { campaignId: item.id } })
    },
    /**
     * Valide une campagne de contrôle
     *
     * @param {Object} item
     */
    validate (item) {
      this.$swal.confirm({ title: 'Validation', message: 'Validation de la campagne de contrôle ' + item.reference, icon: 'success' }).then(response => {
        if (response.isConfirmed) {
          api.put('campaigns/' + item.id + '/validate').then(response => {
            if (response.data.status) {
              this.initData()
              this.$swal.toast_success(response.data.message)
            } else {
              this.$swal.toast_error(response.data.message)
            }
          })
        }
      }).catch(error => {
        this.$swal.alert_error(error)
      })
    },
    /**
     * Supprime une campagne de contrôle
     *
     * @param {Object} item
     */
    destroy (item) {
      this.$swal.confirm_destroy().then(response => {
        if (response.isConfirmed) {
          api.delete('campaigns/' + item.id).then(response => {
            if (response.data.status) {
              this.initData()
              this.$swal.toast_success(response.data.message)
            } else {
              this.$swal.toast_error(response.data.message)
            }
          })
        }
      }).catch(error => {
        this.$swal.alert_error(error)
      })
    },

    /**
     * Initialise les données
     */
    initData () {
      this.$store.dispatch('campaigns/fetchPaginated').then(() => {
        this.config.data = this.controlCampaigns.paginated
      })
    },
    initFilters (reloadFilters = true) {
      if (reloadFilters) {
        this.initYearsList()
      }
    }
  }
}
</script>
