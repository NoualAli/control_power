<template>
  <div v-if="can('view_mission')">
    <ContentHeader v-if="campaignId">
      <template #actions>
        <router-link
          v-if="can('create_mission')" :to="{ name: 'missions-create', params: { campaignId } }"
          class="btn btn-info"
        >
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable
        :filters="filters" namespace="missions" :config="config" @show="show" @delete="destroy" @edit="edit"
        @filterReset="resetData"
      />
    </ContentBody>
  </div>
</template>

<script>
import ContentHeader from '../../components/ContentHeader'
import ContentBody from '../../components/ContentBody'
import { mapGetters } from 'vuex'
import { hasRole } from '../../plugins/user'
export default {
  components: {
    ContentHeader, ContentBody
  },
  layout: 'backend',
  middleware: ['auth'],
  data () {
    return {
      // initiated: false,
      rowSelected: null,
      campaignId: null,
      config: {
        data: null,
        columns: [
          {
            label: 'CDC-ID',
            field: 'campaign'
          },
          {
            label: 'Référence',
            field: 'reference'
          },
          {
            label: 'Dre',
            field: 'dre'
          },
          {
            label: 'Agence',
            field: 'agency'
          },
          {
            label: 'Contrôle sur place par',
            field: 'agency_controllers_str'
          },
          {
            label: 'Date début',
            field: 'start'
          },
          {
            label: 'Date fin',
            field: 'end'
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
                } else {
                  return 'bg-danger text-white text-bold'
                }
              }
            }
          },
          {
            label: 'État',
            field: 'state',
            isHtml: true,
            methods: {
              showField (item) {
                let state = 'inProgress'
                if (item.state === 'EN COURS') {
                  state = 'inProgress'
                } else if (item.state === 'À RÉALISER') {
                  state = 'todo'
                } else if (item.state === 'RÉALISÉ') {
                  state = 'done'
                } else if (item.state === 'EN RETARD') {
                  state = 'late'
                } else if (item.state === 'Validé et envoyé') {
                  state = 'validated'
                } else if (item.state === 'En attente de validation') {
                  state = 'wating-validation'
                }
                return `<div class="container" title="${item.state}">
                  <div class="mission-state ${state}"></div>
                </div>`
              }
              // style: (item) => {
              //   if (item.state === 'EN COURS') {
              //     return 'mission-state bg-warning text-bold text-small'
              //   } else if (item.state === 'À RÉALISER') {
              //     return 'mission-state bg-info text-white text-bold text-small'
              //   } else if (item.state === 'RÉALISÉ') {
              //     return 'mission-state bg-success text-white text-bold text-small'
              //   } else if (item.state === 'EN RETARD') {
              //     return 'mission-state bg-danger text-white text-bold text-small'
              //   } else if (item.state === 'Validé et envoyé') {
              //     return 'mission-state bg-success text-white text-bold text-small'
              //   } else if (item.state === 'En attente de validation') {
              //     return 'mission-state bg-danger text-white text-bold text-small'
              //   }
              // }
            }
          },
          {
            label: 'Taux de progression',
            field: 'progress_status',
            methods: {
              showField (item) {
                return item.progress_status + '%'
              }
            }
          }
        ],
        actions: {
          show: (item) => {
            return this.can('view_mission')
          },
          edit: (item) => {
            return this.can('edit_mission') && item.remaining_days_before_start > 5
          },
          delete: (item) => {
            return this.can('delete_mission') && item.remaining_days_before_start > 5
          }
        }
      },
      filters: {
        campaign: {
          label: 'Campagne de contrôle',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        dre: {
          label: 'DRE',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        agency: {
          label: 'Agence',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        dre_controllers: {
          label: 'Contrôleurs',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        between: {
          cols: 'col-lg-3',
          value: [],
          type: 'date-range',
          // cols: 'col-lg-6',
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
  computed: mapGetters({
    missions: 'missions/paginated',
    campaign: 'campaigns/current',
    filtersData: 'missions/filters'
  }),
  created () {
    this.initFilters()
    this.initData()
  },
  // mounted () {
  //   this.initFilters()
  //   this.initData()
  // },

  methods: {
    resetData () {
      // this.initFilters(false)
      this.initData()
    },
    initData () {
      let mission = null
      const length = this.$breadcrumbs.value.length
      if (this.$route.params.campaignId) {
        this.$store.dispatch('campaigns/fetch', { campaignId: this.$route.params.campaignId }).then((data) => {
          if (this.$breadcrumbs.value[length - 2].label === 'Détails campagne') {
            this.$breadcrumbs.value[length - 2].label = 'Détails campagne ' + data.reference
          }
        })
        mission = this.$store.dispatch('missions/fetchPaginated', this.$route.params.campaignId)
      } else {
        mission = this.$store.dispatch('missions/fetchPaginated')
      }

      // this.$breadcrumbs.value[length - 1].label = 'Missions'
      mission.then(() => {
        this.config.data = this.missions.paginated
      })
    },
    /**
     * Initialise les filtres
     */
    initFilters () {
      this.$store.dispatch('missions/fetchFilters').then(() => {
        this.filters.campaign.data = this.filtersData.filters.campaigns
        this.filters.dre.data = this.filtersData.filters.dres
        this.filters.agency.data = this.filtersData.filters.agencies
        this.filters.dre_controllers.data = this.filtersData.filters.dre_controllers
      })
    },
    show (item) {
      this.$router.push({ name: 'mission', params: { missionId: item.id } })
    },
    edit (item) {
      this.$router.push({ name: 'missions-edit', params: { missionId: item.id } })
    },
    destroy (item) {
      this.$swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          this.$api.delete('missions/' + item.id).then(response => {
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
    }
  }
}
</script>
