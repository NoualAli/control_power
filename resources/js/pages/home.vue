<template>
  <!-- <div class="container no-data my-6 d-flex is-column align-center justify-between">
    <h1>En cours de développement...</h1>
    <InProgress />
  </div> -->
  <ContentBody>
    <div class="grid gap-2">
      <div class="col-12 col-lg-4">
        <Bar :chartData="anomalies.charts.missions" v-if="anomalies.charts.missions" />
      </div>
      <div class="col-12 col-lg-4">
        <Bar :chartData="anomalies.charts.campaigns" v-if="anomalies.charts.campaigns" />
      </div>
      <div class="col-12 col-lg-4">
        <Bar :chartData="anomalies.charts.famillies" v-if="anomalies.charts.famillies" />
      </div>
      <div class="col-12 col-lg-4">
        <Bar :chartData="majorFacts.charts.missions" v-if="majorFacts.charts.missions" />
      </div>
      <div class="col-12 col-lg-4">
        <Bar :chartData="majorFacts.charts.campaigns" v-if="majorFacts.charts.campaigns" />
      </div>
      <div class="col-12 col-lg-4">
        <Bar :chartData="majorFacts.charts.famillies" v-if="majorFacts.charts.famillies" />
      </div>
    </div>
  </ContentBody>
</template>

<script>
import ContentBody from '../components/ContentBody'
import { mapGetters } from 'vuex'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { Bar } from 'vue-chartjs'

import InProgress from '../components/InProgress'
export default {
  middleware: [ 'auth' ],
  layout: 'backend',
  components: {
    ContentBody,
    Bar,
    // Doughnut,
    // Pie,
    InProgress,
  },
  computed: {
    ...mapGetters({
      statistics: 'statistics/data'
    })
  },
  metaInfo() {
    return { title: 'Tableau de bord' }
  },

  created() {
    this.initData()
  },
  data() {
    return {
      anomalies: {
        charts: {
          missions: null,
          campaigns: null,
          famillies: null,
        },
        tables: {

        }
      },
      majorFacts: {
        charts: {
          missions: null,
          campaigns: null,
          famillies: null,
        },
        tables: {

        }
      }
    }
  },
  methods: {
    initData() {
      this.$store.dispatch('statistics/fetchData').then(() => {
        this.anomalies.charts.missions = this.statistics.data.missionsAnomalies
        this.anomalies.charts.campaigns = this.statistics.data.campaignssAnomalies
        this.anomalies.charts.famillies = this.statistics.data.familliesAnomalies
        this.majorFacts.charts.missions = this.statistics.data.missionsMajorFacts
        this.majorFacts.charts.campaigns = this.statistics.data.campaignsMajorFacts
        this.majorFacts.charts.famillies = this.statistics.data.familliesMajorFacts
      })
    }
  }
}
</script>
