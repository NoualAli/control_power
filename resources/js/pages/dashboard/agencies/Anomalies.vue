<template>
    <!-- Anomalies -->
    <NLGrid gap="4">
        <!-- Anomalies par famille -->
        <NLColumn lg="6" class="box">
            <div class="d-flex align-center justify-between">
                <h2>Anomalies par famille</h2>
                <button class="btn btn-info has-icon" @click.prevent="savePNG('familiesAnomalies')"
                    v-if="charts.families.datasets[0].data.length">
                    <span class="material-icons material-symbols-rounded icon">
                        save
                    </span>
                </button>
            </div>
            <NLContainer extraClass="d-flex full-center" isFluid>
                <NLFlex isFullCentered extraClass="w-100 h-100" v-if="charts.families.datasets[0].data.length">
                    <Doughnut id="familiesAnomalies" :data="charts.families" :options="circularChartOptions"
                        data-title="anomalies_par_familles" />
                </NLFlex>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLContainer>
        </NLColumn>

        <!-- Anomalies par DRE -->
        <NLColumn lg="6" class="box" v-if="!is('da')">
            <div class="d-flex align-center justify-between">
                <h2>Anomalies par DRE</h2>
                <button class="btn btn-info has-icon" @click.prevent="savePNG('dresAnomalies')"
                    v-if="charts.dres.datasets[0].data.length">
                    <span class="material-icons material-symbols-rounded icon">
                        save
                    </span>
                </button>
            </div>
            <NLContainer extraClass="d-flex full-center" isFluid>
                <NLFlex isFullCentered extraClass="w-100 h-100" v-if="charts.dres.datasets[0].data.length">
                    <Bar id="dresAnomalies" :data="charts.dres" :options="chartOptions"
                        data-title="anomalies_par_dre" />
                </NLFlex>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLContainer>
        </NLColumn>

        <!-- 10 domaines contenant un nombre d'anomalies élevé -->
        <NLColumn lg="6">
            <div class="box">
                <h2>Les 10 Domaines contenant un nombre d'anomalies élevées</h2>
                <div class="table-container" v-if="tables.domains.length">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Domaine</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in tables.domains" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td class="text-left">{{ row['domain'] }}</td>
                                <td class="text-center">{{ row['total_anomalies'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </div>
        </NLColumn>
        <!-- 10 agences contenant un nombre d'anomalies élevé -->
        <NLColumn lg="6" v-if="!is('da')">
            <div class="box">
                <h2>Les 10 Agences contenant un nombre d'anomalies élevées</h2>
                <div class="table-container" v-if="tables.agencies.length">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Agence</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in tables.agencies" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td class="text-left">{{ row['agency'] }}</td>
                                <td class="text-center">{{ row['total_anomalies'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </div>
        </NLColumn>
        <!-- 10 missions contenant un nombre d'anomalies élevé -->
        <NLColumn lg="6">
            <div class="box">
                <h2>Les 10 Missions contenant un nombre d'anomalies élevées</h2>
                <div class="table-container" v-if="tables.missions.length">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Mission</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in tables.missions" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td class="text-left">{{ row['mission'] }}</td>
                                <td class="text-center">{{ row['total_anomalies'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </div>
        </NLColumn>
        <!-- 10 missions contenant un nombre d'anomalies élevé -->
        <NLColumn lg="6">
            <div class="box">
                <h2>Les 10 Campagnes de contrôle contenant un nombre d'anomalies élevées</h2>
                <div class="table-container" v-if="tables.campaigns.length">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Campagne</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in tables.campaigns" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td class="text-left">{{ row['campaign'] }}</td>
                                <td class="text-center">{{ row['total_anomalies'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </div>
        </NLColumn>
    </NLGrid>
</template>

<script>
import { mapGetters } from 'vuex'
import { Bar, Doughnut } from 'vue-chartjs'
export default {
    name: "Anomalies",
    emits: [ 'savePNG' ],
    components: {
        Bar,
        Doughnut,
    },
    computed: {
        ...mapGetters({
            anomalies: 'agencyLevelStatistics/anomalies',
        }),
    },
    props: {
        circularChartOptions: { type: Object, required: false },
        chartOptions: { type: Object, required: false },
        horizontalBarOptions: { type: Object, required: false },
        onlyCurrentCampaign: { type: Boolean, required: false, default: true },
        userRole: { type: String, required: false, default: null },
        currentCampaign: { type: String, required: false, default: null }
    },
    data() {
        return {
            charts: {
                families: null,
                dres: null
            },
            tables: {
                missions: null,
                campaigns: null,
                domains: null,
                agencies: null
            }
        }
    },
    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('agencyLevelStatistics/fetchAnomalies', { onlyCurrentCampaign: false, currentCampaign: this?.currentCampaign }).then(() => {
                this.tables.domains = this.anomalies.data.domainsAnomalies
                this.tables.missions = this.anomalies.data.missionsAnomalies
                this.tables.campaigns = this.anomalies.data.campaignsAnomalies
                this.tables.agencies = this.anomalies.data.agenciesAnomalies

                this.charts.families = this.anomalies.data.familiesAnomalies
                this.charts.dres = this.anomalies.data.dresAnomalies
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        savePNG(element) {
            this.$emit('savePNG', element)
        }
    }
}
</script>
