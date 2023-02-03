<template>
  <div class="grid gap-6" v-if="permissions.show.inProgress">
    <div class="col-12">
      <div class="box" v-if="user?.username == 'dg'">
        Monsieur le Directeur Général <span class="text-bold">{{ user.full_name }}</span> 👋
      </div>
    </div>
    <!-- <div class="col-12" id="missions_state" v-if="permissions.show.inProgress">
      <h2 class="my-6">État des missions</h2>
      <div class="grid">
        <div class="col-3">
          <div class="grid">
            <router-link :to="{ name: 'missions', query: { state: key } }" class="col-12 box"
              v-if="permissions.show.boxes.missions_state" :class="('is-' + key)"
              v-for="(state, key) in missions_state?.missions_state" :key="(state + '-' + key)">
              <div class="text-bold mt-2">
                {{ $t(key) }}
              </div>
              <div class="text-extra-large text-bold mb-2">{{ state }}</div>
            </router-link>
          </div>
        </div>
        <div class="box col-12 col-lg-4" v-if="this.permissions.show.charts.missions_percentage">
          <h2 class="mb-6 text-mediuml">Situation des rapports</h2>
          <Doughnut chart-id="missions_percentage-chart" :chartData="missionsPercentageChart"
            :chartOptions="missionsPercentageChartOptions" :width="250" :height="250" />
        </div>
        <div class="box col-12 col-lg-5" v-if="this.permissions.show.charts.score_anomalies">
          <h2 class="mb-6 text-mediuml">Nombre des points de contrôle / Notation</h2>
          <Bar :plugins="barPlugins" chart-id="score_anomalies-chart" :chartData="scoreAnomaliesChart"
            :chartOptions="scoreChartOptions" :width="250" :height="250" />
        </div>
      </div>
    </div> -->

    <!-- Anomalies -->
    <!-- <div class="col-12" id="anomalies_block" v-if="permissions.show.inProgress">
      <h2 class="my-6">Statistiques anomalies</h2>
      <div class="grid">
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.campaigns_anomalies && campaigns_anomalies?.campaigns_anomalies">
          <h2 class="mb-6 text-mediuml">Nombre des anomalies par campagne de contrôle</h2>
          <Bar :plugins="barPlugins" chart-id="campaigns_anomalies-chart" :chartData="campaignsAnomaliesChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="(this.permissions.show.charts.dres_anomalies && dres_anomalies?.dres_anomalies)">
          <h2 class="mb-6 text-medium">Pourcentage des anomalies par DRE</h2>
          <Doughnut chart-id="dres_anomalies-chart" :plugins="chartPlugins" :chartData="dresAnomaliseChart"
            :chartOptions="dresChartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.agencies_anomalies && agencies_anomalies?.agencies_anomalies">
          <h2 class="mb-6 text-mediuml">Nombre des anomalies par agence</h2>
          <Bar :plugins="barPlugins" chart-id="agencies_anomalies-chart" :chartData="agenciesAnomaliesChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.missions_anomalies && missions_anomalies?.missions_anomalies">
          <h2 class="mb-6 text-mediuml">Nombre des anomalies par mission</h2>
          <Bar :plugins="barPlugins" chart-id="missions_anomalies-chart" :chartData="missionsAnomaliesChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.famillies_anomalies && famillies_anomalies?.famillies_anomalies">
          <h2 class="mb-6 text-mediuml">Nombre des anomalies par famille</h2>
          <Bar :plugins="barPlugins" chart-id="famillies_anomalies-chart" :chartData="familliesAnomaliesChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.domains_anomalies && domains_anomalies?.domains_anomalies">
          <h2 class="mb-6 text-mediuml">Nombre des anomalies par domaine</h2>
          <Bar :plugins="barPlugins" chart-id="domains_anomalies-chart" :chartData="domainsAnomaliesChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>

        <div class="col-12"
          v-if="this.permissions.show.tables.processes_anomalies && processes_anomalies?.processes_anomalies">
          <h2 class="mb-6 text-mediuml">Nombre des anomalies par processus</h2>
          <table>
            <thead>
              <tr>
                <th>
                  Processus
                </th>
                <th>
                  Nombres d'anomalies
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(total, process) in processes_anomalies.processes_anomalies" :key="process">
                <td>
                  {{ process }}
                </td>
                <td>
                  {{ total }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div> -->

    <!-- Major facts -->
    <!-- <div class="col-12" id="major_facts_block" v-if="permissions.show.inProgress">
      <h2 class="my-6">Statistiques faits majeurs</h2>
      <div class="grid">
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.campaigns_major_facts && campaigns_major_facts?.campaigns_major_facts">
          <h2 class="mb-6 text-mediuml">Nombre des faits majeurs par campagne de contrôle</h2>
          <Bar :plugins="barPlugins" chart-id="campaigns_major_facts-chart" :chartData="campaignsMajorFactsChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.dres_major_facts && dres_major_facts?.dres_major_facts">
          <h2 class="mb-6 text-mediuml">Nombre des faits majeurs par DRE</h2>
          <Bar :plugins="barPlugins" chart-id="dres_major_facts-chart" :chartData="dresMajorFactsChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.agencies_major_facts && agencies_major_facts?.agencies_major_facts">
          <h2 class="mb-6 text-mediuml">Nombre des faits majeurs par agence</h2>
          <Bar :plugins="barPlugins" chart-id="agencies_major_facts-chart" :chartData="agenciesMajorFactsChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.missions_major_facts && missions_major_facts?.missions_major_facts">
          <h2 class="mb-6 text-mediuml">Nombre des faits majeurs par mission</h2>
          <Bar :plugins="barPlugins" chart-id="missions_major_facts-chart" :chartData="missionsMajorFactsChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.famillies_major_facts && famillies_major_facts?.famillies_major_facts">
          <h2 class="mb-6 text-mediuml">Nombre des faits majeurs par famille</h2>
          <Bar :plugins="barPlugins" chart-id="famillies_major_facts-chart" :chartData="familliesMajorFactsChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>
        <div class="box col-12 col-lg-6"
          v-if="this.permissions.show.charts.domains_major_facts && domains_major_facts?.domains_major_facts">
          <h2 class="mb-6 text-mediuml">Nombre des faits majeurs par domaine</h2>
          <Bar :plugins="barPlugins" chart-id="domains_major_facts-chart" :chartData="domainsMajorFactsChart"
            :chartOptions="chartOptions" :width="300" :height="300" />
        </div>

        <div class="col-12"
          v-if="this.permissions.show.tables.processes_major_facts && processes_major_facts?.processes_major_facts">
          <h2 class="mb-6 text-mediuml">Nombre des faits majeurs par processus</h2>
          <table>
            <thead>
              <tr>
                <th>
                  Processus
                </th>
                <th>
                  Nombres d'anomalies
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(total, process) in processes_major_facts.processes_major_facts" :key="process">
                <td>
                  {{ process }}
                </td>
                <td>
                  {{ total }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div> -->
  </div>
  <div class="container no-data my-6 d-flex is-column align-center justify-between" v-else>
    <h1>En cours de développement...</h1>
    <InProgress />
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Bar, Doughnut, Pie } from 'vue-chartjs/legacy'
import { setTitle } from '../plugins/settings'
import { isDcp, isDG } from '../plugins/user'
import InProgress from '../components/InProgress'
export default {
  middleware: [ 'auth' ],
  layout: 'backend',
  components: {
    Bar,
    Doughnut,
    Pie,
    InProgress,
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
      missions_state: 'statistics/missions_state',
      missions_percentage: 'statistics/missions_percentage',
      missions_anomalies: 'statistics/missions_anomalies',
      campaigns_anomalies: 'statistics/campaigns_anomalies',
      dres_anomalies: 'statistics/dres_anomalies',
      agencies_anomalies: 'statistics/agencies_anomalies',
      famillies_anomalies: 'statistics/famillies_anomalies',
      domains_anomalies: 'statistics/domains_anomalies',
      processes_anomalies: 'statistics/processes_anomalies',
      score_anomalies: 'statistics/score_anomalies',
      missions_major_facts: 'statistics/missions_major_facts',
      campaigns_major_facts: 'statistics/campaigns_major_facts',
      dres_major_facts: 'statistics/dres_major_facts',
      agencies_major_facts: 'statistics/agencies_major_facts',
      famillies_major_facts: 'statistics/famillies_major_facts',
      domains_major_facts: 'statistics/domains_major_facts',
      processes_major_facts: 'statistics/processes_major_facts',
    })
  },
  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch('auth/logout')
      await this.
        // Redirect to login.
        this.$router.push({ name: 'login' })
    },
  },
  metaInfo() {
    return { title: this.$t('dashboard') }
  },

  created() {
    setTitle('Tableau de bord')
    this.$store.dispatch('auth/fetchUser')
    this.$store.dispatch('statistics/fetchMissionsState')
    this.setMissionsPercentage()
    this.initPermissions()
    this.initAnomalies()
    this.initMajorFacts()
  },
  data() {
    return {
      currentTab: null,
      permissions: {
        show: {
          inProgress: true,
          charts: {
            missions_percentage: false,

            dres_anomalies: false,
            agencies_anomalies: false,
            famillies_anomalies: false,
            domains_anomalies: false,
            processes_anomalies: false,
            missions_anomalies: false,
            score_anomalies: false,

            dres_major_facts: false,
            agencies_major_facts: false,
            domains_major_facts: false,
            processes_major_facts: false,
            processes_major_facts: false,
            missions_major_facts: false,
          },
          boxes: {
            dre_anomalies: false,
            dre_major_facts: false,
            missions_state: false,
          },
          tables: {
            processes_anomalies: false,
            processes_major_facts: false,
          }
        }
      },
      missionsPercentageChart: {
        labels: [],
        datasets: [ { data: [], backgroundColor: [] } ]
      },

      dresAnomaliseChart: {
        labels: [],
        datasets: [ { data: [], backgroundColor: [] } ]
      },
      agenciesAnomaliesChart: {
        labels: [],
        datasets: [ { data: [], backgroundColor: [] } ]
      },
      familliesAnomaliesChart: {
        labels: [],
        datasets: [ { data: [], backgroundColor: [] } ]
      },
      domainsAnomaliesChart: {
        labels: [],
        datasets: [ { data: [], backgroundColor: [] } ],
      },
      processesAnomaliesChart: {
        labels: [],
        datasets: [ { label: "Total anomalies par processes", data: [], backgroundColor: [] } ]
      },
      missionsAnomaliesChart: {
        labels: [],
        datasets: [ { label: "Total anomalies par mission", data: [], backgroundColor: [] } ]
      },
      campaignsAnomaliesChart: {
        labels: [],
        datasets: [ { label: "Total anomalies par campagne de contrôle", data: [], backgroundColor: [] } ]
      },
      scoreAnomaliesChart: {
        labels: [],
        datasets: [ { label: "", data: [], backgroundColor: [], axis: 'y', fill: false } ]
      },

      dresMajorFactsChart: {
        labels: [],
        datasets: [ { label: "Total faits majeurs par DRE", data: [], backgroundColor: [] } ]
      },
      agenciesMajorFactsChart: {
        labels: [],
        datasets: [ { label: "Total faits majeurs par agence", data: [], backgroundColor: [] } ]
      },
      familliesMajorFactsChart: {
        labels: [],
        datasets: [ { label: "Total faits majeurs par famille", data: [], backgroundColor: [] } ]
      },
      domainsMajorFactsChart: {
        labels: [],
        datasets: [ { label: "Total faits majeurs par processe", data: [], backgroundColor: [] } ],
      },
      processesMajorFactsChart: {
        labels: [],
        datasets: [ { label: "Total faits majeurs par processes", data: [], backgroundColor: [] } ]
      },
      missionsMajorFactsChart: {
        labels: [],
        datasets: [ { label: "Total faits majeurs par mission", data: [], backgroundColor: [] } ]
      },
      campaignsMajorFactsChart: {
        labels: [],
        datasets: [ { label: "Total faits majeurs par campagne de contrôle", data: [], backgroundColor: [] } ]
      },
      chartOptions: {
        rresponsive: true,
        maintainAspectRatio: false,
        barPercentage: 0.1,
        animations: {
          tension: {
            duration: 0,
          },
        },
        categoryPercentage: 3,
        borderRadius: 15,
        borderWidth: 2,
        plugins: {
          legend: {
            display: false
          }
        }
      },
      barPlugins: [ {
        legend: {
          title: false
        }
      } ],
      scoreChartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        barPercentage: 0.1,
        indexAxis: 'y',
        animations: {
          tension: {
            duration: 0,
          },
        },
        categoryPercentage: 5,
        borderRadius: 15,
        borderWidth: 2,
        plugins: {
          legend: {
            display: false
          }
        }
      },
      dresChartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        barPercentage: 0.1,
        borderWidth: 0,
        plugins: {
          legend: {
            position: 'right',
          }
        },
        borderWidth: 2,
      },
      missionsPercentageChartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        barPercentage: 0.1,
        borderWidth: 2,
      },
      borderColors: [ 'rgba(244, 67, 54,1.0)', 'rgba(33, 150, 243,1.0)', 'rgba(0, 150, 136,1.0)', 'rgba(255, 235, 59,1.0)', 'rgba(103, 58, 183,1.0)', 'rgba(96, 125, 139,1.0)' ],
      colors: [ 'rgba(244, 67, 54,.6)', 'rgba(33, 150, 243,.6)', 'rgba(0, 150, 136,.6)', 'rgba(255, 235, 59,.6)', 'rgba(103, 58, 183,.6)', 'rgba(96, 125, 139,.6)' ],
      chartPlugins: [ {
        legend: {
          position: 'left',
        }
      } ]

    }
  },
  methods: {
    setCurrentTab(current) {
      this.currentTab = current
    },
    initAnomalies() {
      this.setCampaignsAnomalies()
      this.setDresAnomalies()
      this.setAgenciesAnomalies()
      this.setFamilliesAnomalies()
      this.setDomainsAnomalies()
      this.setProcessesAnomalies()
      this.setMissionsAnomalies()
      this.setScoreAnomalies()
    },
    initMajorFacts() {
      this.setCampaignsMajorFacts()
      this.setDresMajorFacts()
      this.setAgenciesMajorFacts()
      this.setFamilliesMajorFacts()
      this.setDomainsMajorFacts()
      this.setProcessesMajorFacts()
      this.setMissionsMajorFacts()
    },

    initPermissions() {
      this.permissions.show.inProgress = isDcp() || isDG()

      this.permissions.show.charts.missions_percentage = isDcp() || isDG()
      this.permissions.show.boxes.missions_state = isDcp() || isDG()

      // Anomalies
      this.permissions.show.charts.dres_anomalies = isDcp() || isDG()
      this.permissions.show.charts.agencies_anomalies = false
      this.permissions.show.charts.missions_anomalies = false
      this.permissions.show.charts.campaigns_anomalies = isDcp() || isDG()
      this.permissions.show.charts.famillies_anomalies = isDcp() || isDG()
      this.permissions.show.charts.domains_anomalies = isDcp() || isDG()
      this.permissions.show.charts.score_anomalies = isDcp() || isDG()
      this.permissions.show.tables.processes_anomalies = isDcp() || isDG()
      this.permissions.show.boxes.dre_anomalies = false

      // Major facts
      this.permissions.show.charts.dres_major_facts = isDcp() || isDG()
      this.permissions.show.charts.agencies_major_facts = false
      this.permissions.show.charts.missions_major_facts = false
      this.permissions.show.charts.campaigns_major_facts = isDcp() || isDG()
      this.permissions.show.charts.famillies_major_facts = isDcp() || isDG()
      this.permissions.show.charts.domains_major_facts = isDcp() || isDG()
      this.permissions.show.tables.processes_major_facts = isDcp() || isDG()
      this.permissions.show.boxes.dre_major_facts = false
    },

    async setMissionsPercentage() {
      await this.$store.dispatch('statistics/fetchMissionsPercentage').then(() => {
        this.missionsPercentageChart.labels = Object.keys(this.missions_percentage.missions_percentage).map(key => this.$t(key))
        this.missionsPercentageChart.datasets[ 0 ].data = Object.values(this.missions_percentage.missions_percentage)
        this.missionsPercentageChart.datasets[ 0 ].backgroundColor = [ this.colors[ 0 ], this.colors[ 2 ] ]
      })
    },

    async setDresAnomalies() {
      await this.$store.dispatch('statistics/fetchDresAnomalies').then(() => {
        this.dresAnomaliseChart.labels = Object.keys(this.dres_anomalies.dres_anomalies)
        this.dresAnomaliseChart.datasets[ 0 ].data = Object.values(this.dres_anomalies.dres_anomalies)
        this.dresAnomaliseChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setAgenciesAnomalies() {
      await this.$store.dispatch('statistics/fetchAgenciesAnomalies').then(() => {
        this.agenciesAnomaliesChart.labels = Object.keys(this.agencies_anomalies.agencies_anomalies)
        this.agenciesAnomaliesChart.datasets[ 0 ].data = Object.values(this.agencies_anomalies.agencies_anomalies)
        this.agenciesAnomaliesChart.datasets[ 0 ].backgroundColor = this.colors
      })
    },
    async setCampaignsAnomalies() {
      await this.$store.dispatch('statistics/fetchCampaignsAnomalies').then(() => {
        this.campaignsAnomaliesChart.labels = Object.keys(this.campaigns_anomalies.campaigns_anomalies)
        this.campaignsAnomaliesChart.datasets[ 0 ].data = Object.values(this.campaigns_anomalies.campaigns_anomalies)
        this.campaignsAnomaliesChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setMissionsAnomalies() {
      await this.$store.dispatch('statistics/fetchMissionsAnomalies').then(() => {
        this.missionsAnomaliesChart.labels = Object.keys(this.missions_anomalies.missions_anomalies)
        this.missionsAnomaliesChart.datasets[ 0 ].data = Object.values(this.missions_anomalies.missions_anomalies)
        this.missionsAnomaliesChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setFamilliesAnomalies() {
      await this.$store.dispatch('statistics/fetchFamilliesAnomalies').then(() => {
        this.familliesAnomaliesChart.labels = Object.keys(this.famillies_anomalies.famillies_anomalies)
        this.familliesAnomaliesChart.datasets[ 0 ].data = Object.values(this.famillies_anomalies.famillies_anomalies)
        this.familliesAnomaliesChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setDomainsAnomalies() {
      await this.$store.dispatch('statistics/fetchDomainsAnomalies').then(() => {
        this.domainsAnomaliesChart.labels = Object.keys(this.domains_anomalies.domains_anomalies)
        this.domainsAnomaliesChart.datasets[ 0 ].data = Object.values(this.domains_anomalies.domains_anomalies)
        this.domainsAnomaliesChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setProcessesAnomalies() {
      await this.$store.dispatch('statistics/fetchProcessesAnomalies')
    },
    async setScoreAnomalies() {
      await this.$store.dispatch('statistics/fetchScoreAnomalies').then(() => {
        this.scoreAnomaliesChart.labels = Object.keys(this.score_anomalies.score_anomalies)
        this.scoreAnomaliesChart.datasets[ 0 ].data = Object.values(this.score_anomalies.score_anomalies)
        this.scoreAnomaliesChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },

    async setDresMajorFacts() {
      await this.$store.dispatch('statistics/fetchDresMajorFacts').then(() => {
        this.dresMajorFactsChart.labels = Object.keys(this.dres_major_facts.dres_major_facts)
        this.dresMajorFactsChart.datasets[ 0 ].data = Object.values(this.dres_major_facts.dres_major_facts)
        this.dresMajorFactsChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setAgenciesMajorFacts() {
      await this.$store.dispatch('statistics/fetchAgenciesMajorFacts').then(() => {
        this.agenciesMajorFactsChart.labels = Object.keys(this.agencies_major_facts.agencies_major_facts)
        this.agenciesMajorFactsChart.datasets[ 0 ].data = Object.values(this.agencies_major_facts.agencies_major_facts)
        this.agenciesMajorFactsChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setCampaignsMajorFacts() {
      await this.$store.dispatch('statistics/fetchCampaignsMajorFacts').then(() => {
        this.campaignsMajorFactsChart.labels = Object.keys(this.campaigns_major_facts.campaigns_major_facts)
        this.campaignsMajorFactsChart.datasets[ 0 ].data = Object.values(this.campaigns_major_facts.campaigns_major_facts)
        this.campaignsMajorFactsChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setMissionsMajorFacts() {
      await this.$store.dispatch('statistics/fetchMissionsMajorFacts').then(() => {
        this.missionsMajorFactsChart.labels = Object.keys(this.missions_major_facts.missions_major_facts)
        this.missionsMajorFactsChart.datasets[ 0 ].data = Object.values(this.missions_major_facts.missions_major_facts)
        this.missionsMajorFactsChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setFamilliesMajorFacts() {
      await this.$store.dispatch('statistics/fetchFamilliesMajorFacts').then(() => {
        this.familliesMajorFactsChart.labels = Object.keys(this.famillies_major_facts.famillies_major_facts)
        this.familliesMajorFactsChart.datasets[ 0 ].data = Object.values(this.famillies_major_facts.famillies_major_facts)
        this.familliesMajorFactsChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setDomainsMajorFacts() {
      await this.$store.dispatch('statistics/fetchDomainsMajorFacts').then(() => {
        this.domainsMajorFactsChart.labels = Object.keys(this.domains_major_facts.domains_major_facts)
        this.domainsMajorFactsChart.datasets[ 0 ].data = Object.values(this.domains_major_facts.domains_major_facts)
        this.domainsMajorFactsChart.datasets[ 0 ].backgroundColor = this.colors
        this.scoreAnomaliesChart.datasets[ 0 ].borderColor = this.borderColors
      })
    },
    async setProcessesMajorFacts() {
      await this.$store.dispatch('statistics/fetchProcessesMajorFacts')
    },
  },
}
</script>
