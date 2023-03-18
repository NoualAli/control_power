<template>
  <ContentBody>
    <div class="grid gap-4 mb-4">
      <div class="col-12 col-lg-3">
        <button class="btn btn-info w-100" :class="{ 'is-active': currentSection == 'realisationStates' }"
          @click="setCurrentSection('realisationStates')">
          Suivi de la réalisation des missions
        </button>
      </div>
      <div class="col-12 col-lg-3">
        <button class="btn btn-warning w-100" :class="{ 'is-active': currentSection == 'scores' }"
          @click="setCurrentSection('scores')">
          Statistiques des notations
        </button>
      </div>
      <div class="col-12 col-lg-3">
        <button class="btn btn-danger-dark w-100" :class="{ 'is-active': currentSection == 'anomalies' }"
          @click="setCurrentSection('anomalies')">
          Statistiques des anomalies
        </button>
      </div>
      <div class="col-12 col-lg-3">
        <button class="btn btn-danger-dark w-100" :class="{ 'is-active': currentSection == 'majorFacts' }"
          @click="setCurrentSection('majorFacts')">
          Statistiques des faits majeur
        </button>
      </div>
      <!-- <div class="col-12 col-lg-3">
        <button class="btn btn-danger-dark w-100" :class="{ 'is-active': currentSection == 'regularizations' }"
          @click="setCurrentSection('regularizations')">
          Suivi la levé / Non levé des anomalie
        </button>
      </div> -->
    </div>

    <div class="grid gap-4" v-if="currentSection == 'realisationStates'">
      <!-- Suivi de la réalisation des missions -->
      <div class="col-12">
        <div class="grid gap-4">
          <div class="col-12">
            <h2>Suivi de la réalisation des missions</h2>
          </div>
          <div class="col-12 col-lg-3 box is-danger d-flex align-center gap-4">
            <span class="text-bold text-white">
              En retard
            </span>
            <span class="text-extra-large text-bold text-white">{{ missionsState['delay'] }}</span>
          </div>
          <div class="col-12 col-lg-3 box is-warning d-flex align-center gap-4">
            <div class="text-bold">
              En cours
            </div>
            <div class="text-extra-large text-bold">{{ missionsState['active'] }}</div>
          </div>
          <div class="col-12 col-lg-3 box is-info d-flex align-center gap-4">
            <div class="text-bold">
              À réalisées
            </div>
            <div class="text-extra-large text-bold">{{ missionsState['todo'] }}</div>
          </div>
          <div class="col-12 col-lg-3 box is-success d-flex align-center gap-4">
            <div class="text-bold">
              Réalisées et validées
            </div>
            <div class="text-extra-large text-bold">{{ missionsState['done'] }}</div>
          </div>
        </div>
      </div>

      <!-- Situation des rapports -->
      <div class="col-12 col-lg-4 box">
        <div class="d-flex align-center justify-between">
          <h2>Situation des rapports</h2>
          <button class="btn btn-info has-icon" @click.prevent="savePNG('missionsPercentage')">
            <i class="las la-save icon"></i>
          </button>
        </div>
        <div class="container d-flex align-center justify-center h-100 w-100">
          <Pie :chartData="charts.missionsPercentage" :chartOptions="circularChartOptions" class="w-100"
            id="missionsPercentage" data-title="situation_des_rapports" />
        </div>
      </div>

      <!-- Classement des DRE par taux de réalisation des missions -->
      <div class="col-12 col-lg-8">
        <h2>Classement des DRE par taux de réalisation des missions</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>DRE</th>
              <th>Missions programmées</th>
              <th>Missions réalisées</th>
              <th>Taux de réalisation</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in tables.dresClassificationByAchievementRate">
              <td>{{ index + 1 }}</td>
              <td>{{ row['dre'] }}</td>
              <td>{{ row['total'] }}</td>
              <td>{{ row['totalAchieved'] }}</td>
              <td>{{ row['rate'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Scores -->
    <div class="grid gap-4" v-if="currentSection == 'scores'">
      <!-- Classement des notations -->
      <div class="col-12 col-lg-6 box">
        <div class="d-flex align-center justify-between">
          <h2>Classement des notations</h2>
          <button class="btn btn-info has-icon" @click.prevent="savePNG('globalScores')">
            <i class="las la-save icon"></i>
          </button>
        </div>
        <Bar :chartData="charts.globalScores" class="w-100" :chartOptions="horizontalBarOptions" id="globalScores"
          data-title="classement_des_notations" />
      </div>

      <!-- Notations moyennes par famille -->
      <div class="col-12 col-lg-6 box">
        <div class="d-flex align-center justify-between">
          <h2>Notations moyennes par famille</h2>
          <button class="btn btn-info has-icon" @click.prevent="savePNG('avgScoreByFamily')">
            <i class="las la-save icon"></i>
          </button>
        </div>
        <div class="container d-flex align-center justify-center h-100 w-100">
          <Doughnut :chartData="charts.avgScoreByFamily" class="w-100" :chartOptions="circularChartOptions"
            id="avgScoreByFamily" data-title="notations_moyennes_par_famille" />
        </div>
      </div>

      <!-- Notations par domaine -->
      <div class="col-12 col-lg-6">
        <h2>Notations moyennes par domaine</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Domaine</th>
              <th>Nombre</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in tables.avgScoreByDomain">
              <td>{{ index + 1 }}</td>
              <td>{{ row['domain'] }}</td>
              <td>{{ row['avg_score'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Notations moyennes par DRE -->
      <div class="col-12 col-lg-6">
        <h2>Notations moyennes par DRE</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>DRE</th>
              <th>Notation moyenne</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in tables.avgScoreByDre">
              <td>{{ index + 1 }}</td>
              <td>{{ row['dre'] }}</td>
              <td>{{ row['avg_score'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Anomalies -->
    <div class="grid gap-4" v-if="currentSection == 'anomalies'">
      <!-- Anomalies par famille -->
      <div class="col-12 col-lg-6 box">
        <div class="d-flex align-center justify-between">
          <h2>Anomalies par famille</h2>
          <button class="btn btn-info has-icon" @click.prevent="savePNG('familiesAnomalies')">
            <i class="las la-save icon"></i>
          </button>
        </div>
        <div class="container d-flex align-center justify-center h-100 w-100">
          <Doughnut :chartData="anomaliesData.charts.families" class="w-100" :chartOptions="circularChartOptions"
            id="familiesAnomalies" data-title="anomalies_par_familles" />
        </div>
      </div>
      <!-- Anomalies par DRE -->
      <div class="col-12 col-lg-6 box">
        <div class="d-flex align-center justify-between">
          <h2>Anomalies par DRE</h2>
          <button class="btn btn-info has-icon" @click.prevent="savePNG('dresAnomalies')">
            <i class="las la-save icon"></i>
          </button>
        </div>
        <Bar :chartData="anomaliesData.charts.dres" class="w-100" :chartOptions="chartOptions" id="dresAnomalies"
          data-title="anomalies_par_dre" />
      </div>
      <!-- Anomalies par domaine -->
      <div class="col-12 col-lg-6">
        <h2>Anomalies par domaine</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Domaine</th>
              <th>Nombre</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in anomaliesData.tables.domains">
              <td>{{ index + 1 }}</td>
              <td>{{ row['domain'] }}</td>
              <td>{{ row['total'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 10 agences contenant un nombre d'anomalies élevé -->
      <div class="col-12 col-lg-6">
        <h2>Les 10 agences contenant un nombre d'anomalies élevé</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Agence</th>
              <th>Nombre d'anomalies</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in anomaliesData.tables.agencies">
              <td>{{ index + 1 }}</td>
              <td>{{ row['agency'] }}</td>
              <td>{{ row['total_anomalies'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 10 missions contenant un nombre des anomalies élevé -->
      <div class="col-12 col-lg-6">
        <h2>Les 10 missions contenant un nombre des anomalies élevé</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Mission</th>
              <th>Nombre d'anomalies</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in anomaliesData.tables.missions">
              <td>{{ index + 1 }}</td>
              <td>{{ row['mission'] }}</td>
              <td>{{ row['total_anomaly'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 10 missions contenant un nombre des anomalies élevé -->
      <div class="col-12 col-lg-6">
        <h2>Les 10 campagnes de contrôle contenant un nombre des anomalies élevé</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Campagne</th>
              <th>Nombre d'anomalies</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in anomaliesData.tables.campaigns">
              <td>{{ index + 1 }}</td>
              <td>{{ row['campaign'] }}</td>
              <td>{{ row['total_anomaly'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Major facts -->
    <div class="grid gap-4" v-if="currentSection == 'majorFacts'">
      <!-- Faits majeur par famille -->
      <div class="col-12 col-lg-6 box">
        <div class="d-flex align-center justify-between">
          <h2>Faits majeur par famille</h2>
          <button class="btn btn-info has-icon" @click.prevent="savePNG('familiesMajorFacts')">
            <i class="las la-save icon"></i>
          </button>
        </div>
        <div class="container d-flex align-center justify-center h-100 w-100">
          <Doughnut :chartData="majorFactsData.charts.families" class="w-100" :chartOptions="circularChartOptions"
            id="familiesMajorFacts" data-title="faits_majeur_par_famille" />
        </div>
      </div>
      <!-- Faits majeur par DRE -->
      <div class="col-12 col-lg-6 box">
        <div class="d-flex align-center justify-between">
          <h2>Faits majeur par DRE</h2>
          <button class="btn btn-info has-icon" @click.prevent="savePNG('dresMajorFacts')">
            <i class="las la-save icon"></i>
          </button>
        </div>
        <Bar :chartData="majorFactsData.charts.dres" class="w-100" :chartOptions="chartOptions" id="dresMajorFacts"
          data-title="faits_majeur_par_dre" />
      </div>
      <!-- Faits majeur par domaine -->
      <div class="col-12 col-lg-6">
        <h2>Faits majeur par domaine</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Domaine</th>
              <th>Nombre Faits majeur</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in majorFactsData.tables.domains">
              <td>{{ index + 1 }}</td>
              <td>{{ row['domain'] }}</td>
              <td>{{ row['total'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 10 agences contenant un nombre des faits majeur élevé -->
      <div class="col-12 col-lg-6">
        <h2>Les 10 agences contenant un nombre des faits majeur élevé</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Agence</th>
              <th>Nombre Faits majeur</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in majorFactsData.tables.agencies">
              <td>{{ index + 1 }}</td>
              <td>{{ row['agency'] }}</td>
              <td>{{ row['total_major_facts'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 10 missions contenant un nombre des faits majeur élevé -->
      <div class="col-12 col-lg-6">
        <h2>Les 10 missions contenant un nombre des faits majeur élevé</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Mission</th>
              <th>Nombre Faits majeur</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in majorFactsData.tables.missions">
              <td>{{ index + 1 }}</td>
              <td>{{ row['mission'] }}</td>
              <td>{{ row['total_major_facts'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- 10 missions contenant un nombre des faits majeur élevé -->
      <div class="col-12 col-lg-6">
        <h2>Les 10 campagnes de contrôle contenant un nombre des faits majeur élevé</h2>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Campagne</th>
              <th>Nombre de Faits majeur</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in majorFactsData.tables.campaigns">
              <td>{{ index + 1 }}</td>
              <td>{{ row['campaign'] }}</td>
              <td>{{ row['total_major_facts'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="grid gap-4" v-if="currentSection == 'regularizations'">

    </div>
  </ContentBody>
</template>

<script>
import ContentHeader from '../components/ContentHeader'
import ContentBody from '../components/ContentBody'
import { mapGetters } from 'vuex'
// import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { Bar, Pie, Doughnut } from 'vue-chartjs'

import InProgress from '../components/InProgress'
export default {
  middleware: [ 'auth' ],
  layout: 'backend',
  components: {
    ContentHeader,
    ContentBody,
    Bar,
    Doughnut,
    Pie,
    InProgress,
  },
  metaInfo() {
    return { title: 'Tableau de bord' }
  },

  created() {
    this.setCurrentSection('realisationStates')
  },
  data() {
    return {
      currentSection: null,
      anomaliesData: {
        charts: {
          families: null,
          dres: null,
        },
        tables: {
          domains: null,
          missions: null,
          campaigns: null,
          agencies: null,
        }
      },
      majorFactsData: {
        charts: {
          families: null,
          dres: null,
        },
        tables: {
          missions: null,
          campaigns: null,
          domains: null,
          agencies: null,
        }
      },
      charts: {
        missionsPercentage: null,
        globalScores: null,
        avgScoreByFamily: null,
      },
      tables: {
        dresClassificationByAchievementRate: null,
        avgScoreByDre: null,
        avgScoreByDomain: null,
      },
      missionsState: null,
    }
  },
  methods: {
    /**
     * Set the current section name and fetch data from laravel api
     *
     * @param {string} section
     *
     * @return {void}
     */
    setCurrentSection(section) {
      let UCFsection = section.charAt(0).toUpperCase() + section.slice(1)
      if (this.currentSection !== section) {
        this.$store.dispatch('statistics/fetch' + UCFsection).then(() => {
          if (section == 'scores' && this.currentSection !== section) {
            this.currentSection = section
            this.charts.globalScores = this.scores.data.globalScores
            this.charts.avgScoreByFamily = this.scores.data.avgScoreByFamily
            this.tables.avgScoreByDre = this.scores.data.avgScoreByDre
            this.tables.avgScoreByDomain = this.scores.data.avgScoreByDomain
          } else if (section == 'majorFacts' && this.currentSection !== section) {
            this.currentSection = section
            this.majorFactsData.tables.domains = this.majorFacts.data.domainsMajorFacts
            this.majorFactsData.tables.missions = this.majorFacts.data.missionsMajorFacts
            this.majorFactsData.tables.campaigns = this.majorFacts.data.campaignsMajorFacts
            this.majorFactsData.tables.agencies = this.majorFacts.data.agenciesMajorFacts

            this.majorFactsData.charts.families = this.majorFacts.data.familiesMajorFacts
            this.majorFactsData.charts.dres = this.majorFacts.data.dresMajorFacts
          } else if (section == 'anomalies' && this.currentSection !== section) {
            this.currentSection = section
            this.anomaliesData.tables.campaigns = this.anomalies.data.campaignsAnomalies
            this.anomaliesData.tables.missions = this.anomalies.data.missionsAnomalies
            this.anomaliesData.tables.domains = this.anomalies.data.domainsAnomalies
            this.anomaliesData.tables.agencies = this.anomalies.data.agenciesAnomalies

            this.anomaliesData.charts.families = this.anomalies.data.familiesAnomalies
            this.anomaliesData.charts.dres = this.anomalies.data.dresAnomalies
          } else if (section == 'regularizations' && this.currentSection !== section) {

          } else {
            if (this.currentSection !== section) {
              this.currentSection = section
              this.charts.missionsPercentage = this.realisationStates.data.missionsPercentage
              this.missionsState = this.realisationStates.data.missionsState
              this.tables.dresClassificationByAchievementRate = this.realisationStates.data.dresClassificationByAchievementRate
            }
          }
        })
      }
    },
    savePNG(element) {
      const container = document.querySelector(`#${element}`)
      const canvas = container.querySelector('canvas')
      const title = container.dataset.title
      const dataURL = canvas.toDataURL('image/jpeg')
      const link = document.createElement("a");
      link.download = title ? `${title}.jpg` : "canvas.jpg";
      link.href = dataURL;
      link.click();
    }
  },
  computed: {
    ...mapGetters({
      anomalies: 'statistics/anomalies',
      majorFacts: 'statistics/majorFacts',
      regularizations: 'statistics/regularizations',
      scores: 'statistics/scores',
      realisationStates: 'statistics/realisationStates',
    }),
    /**
     * Set default chart options
     */
    chartOptions() {
      return {
        responsive: true,
        maintainAspectRatio: true,
        barPercentage: 0.5,
        borderWidth: 2,
      }
    },
    /**
     * Set circular chart options
     */
    circularChartOptions() {
      const options = { ...this.chartOptions }
      options.maintainAspectRatio = false
      return options
    },
    /**
     * Set horizontal bar options
     */
    horizontalBarOptions() {
      const options = {
        indexAxis: 'y',
        ...this.chartOptions
      }
      return options
    }
  }
}
</script>
