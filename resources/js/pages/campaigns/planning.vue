<template>
  <div>
    <NLDatatable :config="config" @show="openDetails" />
  </div>
</template>

<script>
import { isDcp, isHeadOfDepartment, isDG, isController } from '../../plugins/user'
import { setTitle } from '../../plugins/settings'
import { mapGetters } from 'vuex'
export default {
  layout: 'backend',
  middleware: [ 'auth', 'admin:dcp,dg,cdc,ci,cdr' ],
  metaInfo() {
    return { title: 'Suivi réalisation des missions' }
  },
  data() {
    return {
      campaignId: null,
      permissions: {
        create: false,
      },
      rowSelected: null,
      config: {
        data: null,
        namespace: 'missions',
        state_key: 'plannings',
        rowKey: 'id',
        columns: [
          {
            label: 'Réference',
            field: 'campaign.reference',
          },
          {
            label: 'Dre',
            field: 'dre.full_name',
          },
          {
            label: 'Agence',
            field: 'agency.full_name',
          },
          {
            label: 'Contrôle sur place par',
            field: 'controller.full_name',
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
            label: 'État',
            field: 'state',
            methods: {
              style: (item) => {
                if (item.state == 'EN COURS') {
                  return 'bg-warning'
                } else if (item.state == 'RÉALISÉ') {
                  return 'bg-success text-white'
                } else if (item.state == 'EN RETARD') {
                  return 'bg-danger text-white'
                } else {
                  return 'bg-info text-white'
                }
              }
            }
          },
        ],
        actions: {
          show: true,
        }
      },
    }
  },
  computed: mapGetters({
    plannings: 'missions/plannings',
  }),
  created() {
    this.getPlannings()
  },
  methods: {
    getPlannings() {
      this.$store.dispatch('missions/fetchCampaignPlannings', this.$route.params.campaignId).then(() => this.config.data = this.plannings.plannings)
      isController() ? setTitle('Suivi réalisation de vos missions') : setTitle('Suivre la réalisation des missions')
    },

    openDetails(row) {
      this.$router.push({ name: 'mission-samples', params: { missionId: row.id } })
    }
  }
}
</script>
