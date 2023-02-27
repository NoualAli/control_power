<template>
  <div v-can="'view_mission'">
    <ContentHeader v-if="campaignId">
      <template v-slot:actions>
        <router-link :to="{ name: 'missions-create', params: { campaignId } }" class="btn btn-info"
          v-can="'create_mission'">
          Ajouter
        </router-link>
      </template>
    </ContentHeader>
    <ContentBody>
      <NLDatatable namespace="missions" :config="config" @show="show" @delete="destroy" @edit="edit" />
    </ContentBody>
  </div>
</template>

<script>
import ContentHeader from '../../components/ContentHeader'
import ContentBody from '../../components/ContentBody'
import { mapGetters } from 'vuex'
export default {
  components: {
    ContentHeader, ContentBody
  },
  layout: 'backend',
  middleware: [ 'auth' ],
  metaInfo() {
    return { title: 'Suivi des réalisations des missions' }
  },
  data() {
    return {
      rowSelected: null,
      campaignId: null,
      config: {
        data: null,
        columns: [
          {
            label: 'CDC-ID',
            field: 'campaign',
          },
          {
            label: 'Référence',
            field: 'reference',
          },
          {
            label: 'Dre',
            field: 'dre',
          },
          {
            label: 'Agence',
            field: 'agency',
          },
          {
            label: 'Contrôle sur place par',
            field: 'agency_controllers_str',
          },
          {
            label: 'Date début',
            field: 'start',
          },
          {
            label: 'Date fin',
            field: 'end',
          },
          {
            label: 'Moyenne',
            field: 'avg_score',
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
            label: 'État',
            field: 'state',
            isHtml: true,
            methods: {
              showField(item) {
                let state = 'inProgress'
                if (item.state == 'EN COURS') {
                  state = 'inProgress'
                } else if (item.state == 'À RÉALISER') {
                  state = 'todo'
                } else if (item.state == 'RÉALISÉ') {
                  state = 'done'
                } else if (item.state == 'EN RETARD') {
                  state = 'late'
                } else if (item.state == 'Validé et envoyé') {
                  state = 'validated'
                } else if (item.state == 'En attente de validation') {
                  state = 'wating-validation'
                }
                return `<div class="container" title="${item.state}">
                  <div class="mission-state ${state}"></div>
                </div>`
              },
              // style: (item) => {
              //   if (item.state == 'EN COURS') {
              //     return 'mission-state bg-warning text-bold text-small'
              //   } else if (item.state == 'À RÉALISER') {
              //     return 'mission-state bg-info text-white text-bold text-small'
              //   } else if (item.state == 'RÉALISÉ') {
              //     return 'mission-state bg-success text-white text-bold text-small'
              //   } else if (item.state == 'EN RETARD') {
              //     return 'mission-state bg-danger text-white text-bold text-small'
              //   } else if (item.state == 'Validé et envoyé') {
              //     return 'mission-state bg-success text-white text-bold text-small'
              //   } else if (item.state == 'En attente de validation') {
              //     return 'mission-state bg-danger text-white text-bold text-small'
              //   }
              // }
            }
          },
          {
            label: 'Progression',
            field: 'progress_status',
            methods: {
              showField(item) {
                return item.progress_status + '%'
              }
            }
          }
        ],
        actions: {
          show: (item) => {
            return user().authorizations.view_mission
          },
          edit: (item) => {
            return user().authorizations.edit_mission && item.remaining_days_before_start > 5
          },
          delete: (item) => {
            return user().authorizations.delete_mission && item.remaining_days_before_start > 5
          },
        }
      },
    }
  },
  computed: mapGetters({
    missions: 'missions/paginated',
  }),
  created() {
    this.campaignId = this.$route.params.campaignId
    this.initData()
  },
  methods: {
    initData() {
      let missions = null
      if (this.$route.params.campaignId) {
        missions = this.$store.dispatch('missions/fetchPaginated', this.$route.params.campaignId)
      } else {
        missions = this.$store.dispatch('missions/fetchPaginated')
      }
      missions.then(() => this.config.data = this.missions.paginated)
    },
    show(item) {
      this.$router.push({ name: 'mission', params: { missionId: item.id } })
    },
    edit(item) {
      this.$router.push({ name: 'missions-edit', params: { missionId: item.id } })
    },
    destroy(item) {
      swal.confirm_destroy().then((action) => {
        if (action.isConfirmed) {
          api.delete('missions/' + item.id).then(response => {
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
    }
  }
}
</script>
