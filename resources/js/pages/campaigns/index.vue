<template>
  <div v-can="'view_control_campaign'">
    <div class="d-flex justify-between align-center">
      <div class="filter-bar w-100">
        <div class="grid mt-6">
          <div class="col-12 col-lg-4">
            <div class="d-flex align-center justify-between gap-4">
              <i class="las la-filter icon text-primary-dark"></i>
              <NLSelect name="filter['reference']" :options="yearsList" v-model="filterFields.reference"
                placeholder="Veuillez choisir une année" :multiple="false" />
            </div>
          </div>
        </div>
        <button class="btn btn-danger" @click="resetFilter" v-if="filterFields.reference">
          Annuler
        </button>
      </div>
      <div class="w-100 d-flex justify-end align-center">
        <router-link class="btn btn-info" :to="{ name: 'campaigns-create' }" v-can="'create_control_campaign'">
          Ajouter
        </router-link>
      </div>
    </div>
    <ContentBody>
      <NLDatatable namespace="campaigns" :config="config" @delete="destroy" @show="show" @edit="edit"
        :filters="getFilters" />
    </ContentBody>
  </div>
</template>

<script>
import ContentBody from '../../components/ContentBody'
import NLDatatable from '../../components/NLDatatable'
import { mapGetters } from 'vuex'
import { user } from '../../plugins/user'
import api from '../../plugins/api'
export default {
  components: {
    ContentBody, NLDatatable
  },
  layout: 'backend',
  middleware: [ 'auth' ],
  metaInfo() {
    return { title: 'Suivi du planning annuel' }
  },
  data() {
    return {
      filterFields: {
        reference: null
      },
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
            field: 'remaining_days_before_start_str',
          },
          {
            label: 'Fin',
            field: 'remaining_days_before_end_str',
          },
        ],
        actions: {
          show: true,
          edit: (item) => {
            return user().authorizations.edit_control_campaign && item.remaining_days_before_start > 5
          },
          delete: (item) => {
            return user().authorizations.delete_control_campaign && item.remaining_days_before_start > 5
          },
        }
      },
    }

  },
  computed: {
    ...mapGetters({
      controlCampaigns: 'campaigns/paginated',
    }),
    getFilters() {
      return this.filterFields
    },
    yearsList() {
      let start = 2020
      const currentYear = new Date().getFullYear()
      let years = []
      for (start; start <= currentYear; start++) {
        years.push({ id: start, label: start })
      }
      return years
    }
  },
  methods: {
    /**
     * Affiche une campagne de contrôle
     *
     * @param {Object} item
     */
    show(item) {
      this.$router.push({ name: 'campaign', params: { campaignId: item.id } })
    },

    /**
     *
     * @param {Object} item
     */
    edit(item) {
      this.$router.push({ name: 'campaigns-edit', params: { campaignId: item.id } })
    },

    /**
     * Supprime une campagne de contrôle
     *
     * @param {Object} item
     */
    destroy(item) {
      swal.confirm_destroy().then(response => {
        if (response.isConfirmed) {
          api.delete('campaigns/' + item.id).then(response => {
            if (response.data.status) {
              this.initData()
              swal.toast_success(response.data.message)
            } else {
              swal.toast_error(response.data.message)
            }
          })
        }
      }).catch(error => {
        swal.alert_error()
      })
    },

    /**
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('campaigns/fetchPaginated').then(() => {
        this.config.data = this.controlCampaigns.paginated
      })
    },

    /**
     * Annule le filtre
     */
    resetFilter() {
      for (const key in this.filterFields) {
        if (Object.hasOwnProperty.call(this.filterFields, key)) {
          this.filterFields[ key ] = null;
        }
      }
      this.initData()
    },

    /**
     * Applique le filtre
     */
    filter() {
      this.$store.dispatch('campaigns/filter', this.filterFields)
        .then(() => {
          this.config.data = this.controlCampaigns.paginated
        })
    },
  },
  watch: {
    'filterFields.reference': function (newVal, oldVal) {
      if (newVal == '' || newVal == null || newVal == undefined && newVal !== oldVal) {
        this.resetFilter()
      } else {
        this.filter()
      }
    },
  },
  created() {
    this.initData()
  }
}
</script>
