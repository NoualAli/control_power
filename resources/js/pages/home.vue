<template>
    <ContentBody>
        <NLGrid gap="4" extraClass=" mb-4">
            <NLColumn lg="3">
                <button class="btn btn-info w-100" :class="{ 'is-active': currentSection == 'realisationStates' }"
                    @click="setCurrentSection('realisationStates')">
                    Suivi de la réalisation des missions
                </button>
            </NLColumn>
            <NLColumn lg="3">
                <button class="btn btn-warning w-100" :class="{ 'is-active': currentSection == 'scores' }"
                    @click="setCurrentSection('scores')">
                    Statistiques des notations
                </button>
            </NLColumn>
            <NLColumn lg="3">
                <button class="btn btn-danger-dark w-100" :class="{ 'is-active': currentSection == 'anomalies' }"
                    @click="setCurrentSection('anomalies')">
                    Statistiques des anomalies
                </button>
            </NLColumn>
            <NLColumn lg="3">
                <button class="btn btn-danger-dark w-100" :class="{ 'is-active': currentSection == 'majorFacts' }"
                    @click="setCurrentSection('majorFacts')">
                    Statistiques des faits majeur
                </button>
            </NLColumn>
        </NLGrid>

        <!-- Suivi de la réalisation des missions -->
        <NLGrid gap="4" v-if="currentSection == 'realisationStates'">
            <NLColumn>
                <NLGrid gap="4">
                    <NLColumn>
                        <h2>Suivi de la réalisation des missions</h2>
                    </NLColumn>
                    <NLColumn lg="3" extraClass="box is-danger d-flex align-center gap-4">
                        <span class="text-bold text-white">
                            En retard
                        </span>
                        <span class="text-extra-large text-bold text-white">{{ missionsState['delay'] }}</span>
                    </NLColumn>
                    <NLColumn lg="3" extraClass="box is-warning d-flex align-center gap-4">
                        <div class="text-bold">
                            En cours
                        </div>
                        <div class="text-extra-large text-bold">
                            {{ missionsState['active'] }}
                        </div>
                    </NLColumn>
                    <NLColumn lg="3" extraClass="box is-info d-flex align-center gap-4">
                        <div class="text-bold">
                            À réalisées
                        </div>
                        <div class="text-extra-large text-bold">
                            {{ missionsState['todo'] }}
                        </div>
                    </NLColumn>
                    <NLColumn lg="3" extraClass="box is-success d-flex align-center gap-4">
                        <div class="text-bold">
                            Réalisées et validées
                        </div>
                        <div class="text-extra-large text-bold">
                            {{ missionsState['done'] }}
                        </div>
                    </NLColumn>
                </NLGrid>
            </NLColumn>

            <!-- Situation des rapports -->
            <NLColumn lg="4" extraClass="box">
                <div class="d-flex align-center justify-between">
                    <h2>Situation des rapports</h2>
                    <button class="btn btn-info has-icon" @click.prevent="savePNG('missionsPercentage')"
                        v-if="charts.missionsPercentage.datasets[0].data.length">
                        <i class="las la-save icon" />
                    </button>
                </div>
                <NLContainer extraClass="d-flex full-center" isFluid>
                    <NLFlex isFullCentered extraClass="w-100 h-100"
                        v-if="charts.missionsPercentage.datasets[0].data.length">
                        <Pie id="missionsPercentage" :data="charts.missionsPercentage" :options="circularChartOptions"
                            data-title="situation_des_rapports" />
                    </NLFlex>
                    <div class="my-10 text-center text-bold" v-else>
                        Pas assez de données
                    </div>
                </NLContainer>
            </NLColumn>

            <!-- Classement des DRE par taux de réalisation des missions -->
            <NLColumn lg="8" extraClass="box">
                <h2>Classement des DRE par taux de réalisation des missions</h2>
                <div class="table-container" v-if="tables.dresClassificationByAchievementRate.length">
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
                            <tr v-for="(row, index) in tables.dresClassificationByAchievementRate" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['dre'] }}</td>
                                <td>{{ row['total'] }}</td>
                                <td>{{ row['totalAchieved'] }}</td>
                                <td>{{ row['rate'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
        </NLGrid>

        <!-- Scores -->
        <NLGrid gap="4" v-if="currentSection == 'scores'">
            <!-- Classement des notations -->
            <NLColumn lg="6" extraClass="box">
                <div class="d-flex align-center justify-between">
                    <h2>Classement des notations</h2>
                    <button class="btn btn-info has-icon" @click.prevent="savePNG('globalScores')"
                        v-if="charts.globalScores.datasets[0].data.length">
                        <i class="las la-save icon" />
                    </button>
                </div>
                <NLContainer extraClass="d-flex full-center" isFluid>
                    <NLFlex isFullCentered extraClass="w-100 h-100" v-if="charts.globalScores.datasets[0].data.length">
                        <Bar id="globalScores" :data="charts.globalScores" :options="horizontalBarOptions"
                            data-title="classement_des_notations" />
                    </NLFlex>
                    <div class="my-10 text-center text-bold" v-else>
                        Pas assez de données
                    </div>
                </NLContainer>
            </NLColumn>

            <!-- Notations moyennes par famille -->
            <NLColumn lg="6" class="box">
                <div class="d-flex align-center justify-between">
                    <h2>Notations moyennes par famille</h2>
                    <button class="btn btn-info has-icon" @click.prevent="savePNG('avgScoreByFamily')"
                        v-if="charts.avgScoreByFamily.datasets[0].data.length">
                        <i class="las la-save icon" />
                    </button>
                </div>
                <NLContainer extraClass="d-flex full-center" isFluid>
                    <NLFlex isFullCentered extraClass="w-100 h-100" v-if="charts.avgScoreByFamily.datasets[0].data.length">
                        <Doughnut id="avgScoreByFamily" :data="charts.avgScoreByFamily" :options="circularChartOptions"
                            data-title="notations_moyennes_par_famille" />
                    </NLFlex>
                    <div class="my-10 text-center text-bold" v-else>
                        Pas assez de données
                    </div>
                </NLContainer>
            </NLColumn>

            <!-- Notations par domaine -->
            <NLColumn lg="6" extraClass="box">
                <h2>Notations moyennes par domaine</h2>
                <div class="table-container" v-if="tables.avgScoreByDomain.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Domaine</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in tables.avgScoreByDomain" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['domain'] }}</td>
                                <td>{{ row['avg_score'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>

            <!-- Notations moyennes par DRE -->
            <NLColumn lg="6" extraClass="box">
                <h2>Notations moyennes par DRE</h2>
                <div class="table-container" v-if="tables.avgScoreByDre.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DRE</th>
                                <th>Notation moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in tables.avgScoreByDre" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['dre'] }}</td>
                                <td>{{ row['avg_score'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
        </NLGrid>

        <!-- Anomalies -->
        <NLGrid gap="4" v-if="currentSection == 'anomalies'">
            <!-- Anomalies par famille -->
            <NLColumn lg="6" class="box">
                <div class="d-flex align-center justify-between">
                    <h2>Anomalies par famille</h2>
                    <button class="btn btn-info has-icon" @click.prevent="savePNG('familiesAnomalies')"
                        v-if="anomaliesData.charts.families.datasets[0].data.length">
                        <i class="las la-save icon" />
                    </button>
                </div>
                <NLContainer extraClass="d-flex full-center" isFluid>
                    <NLFlex isFullCentered extraClass="w-100 h-100"
                        v-if="anomaliesData.charts.families.datasets[0].data.length">
                        <Doughnut id="familiesAnomalies" :data="anomaliesData.charts.families"
                            :options="circularChartOptions" data-title="anomalies_par_familles" />
                    </NLFlex>
                    <div class="my-10 text-center text-bold" v-else>
                        Pas assez de données
                    </div>
                </NLContainer>
            </NLColumn>
            <!-- Anomalies par DRE -->
            <NLColumn lg="6" class="box">
                <div class="d-flex align-center justify-between">
                    <h2>Anomalies par DRE</h2>
                    <button class="btn btn-info has-icon" @click.prevent="savePNG('dresAnomalies')"
                        v-if="anomaliesData.charts.dres.datasets[0].data.length">
                        <i class="las la-save icon" />
                    </button>
                </div>
                <NLContainer extraClass="d-flex full-center" isFluid>
                    <NLFlex isFullCentered extraClass="w-100 h-100"
                        v-if="anomaliesData.charts.dres.datasets[0].data.length">
                        <Bar id="dresAnomalies" :data="anomaliesData.charts.dres" :options="chartOptions"
                            data-title="anomalies_par_dre" />
                    </NLFlex>
                    <div class="my-10 text-center text-bold" v-else>
                        Pas assez de données
                    </div>
                </NLContainer>
            </NLColumn>
            <!-- Anomalies par domaine -->
            <NLColumn lg="6" class="box">
                <h2>Anomalies par domaine</h2>
                <div class="table-container" v-if="anomaliesData.tables.domains.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Domaine</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in anomaliesData.tables.domains" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['domain'] }}</td>
                                <td>{{ row['total'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
            <!-- 10 agences contenant un nombre d'anomalies élevé -->
            <NLColumn lg="6" class="box">
                <h2>Les 10 agences contenant un nombre d'anomalies élevé</h2>
                <div class="table-container" v-if="anomaliesData.tables.agencies.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agence</th>
                                <th>Nombre d'anomalies</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in anomaliesData.tables.agencies" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['agency'] }}</td>
                                <td>{{ row['total_anomalies'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
            <!-- 10 missions contenant un nombre des anomalies élevé -->
            <NLColumn lg="6" class="box">
                <h2>Les 10 missions contenant un nombre des anomalies élevé</h2>
                <div class="table-container" v-if="anomaliesData.tables.missions.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mission</th>
                                <th>Nombre d'anomalies</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in anomaliesData.tables.missions" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['mission'] }}</td>
                                <td>{{ row['total_anomaly'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
            <!-- 10 missions contenant un nombre des anomalies élevé -->
            <NLColumn lg="6" class="box">
                <h2>Les 10 campagnes de contrôle contenant un nombre des anomalies élevé</h2>
                <div class="table-container" v-if="anomaliesData.tables.campaigns.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Campagne</th>
                                <th>Nombre d'anomalies</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in anomaliesData.tables.campaigns" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['campaign'] }}</td>
                                <td>{{ row['total_anomaly'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
        </NLGrid>

        <!-- Major facts -->
        <NLGrid gap="4" v-if="currentSection == 'majorFacts'">
            <!-- Faits majeur par famille -->
            <NLColumn lg="6" class="box">
                <div class="d-flex align-center justify-between">
                    <h2>Faits majeur par famille</h2>
                    <button class="btn btn-info has-icon" @click.prevent="savePNG('familiesMajorFacts')"
                        v-if="majorFactsData.charts.families.datasets[0].data.length">
                        <i class="las la-save icon" />
                    </button>
                </div>
                <NLContainer extraClass="d-flex full-center" isFluid>
                    <NLFlex isFullCentered v-if="majorFactsData.charts.families.datasets[0].data.length">
                        <Doughnut id="familiesMajorFacts" :data="majorFactsData.charts.families"
                            :options="circularChartOptions" data-title="faits_majeur_par_famille" />
                    </NLFlex>
                    <div class="my-10 text-center text-bold" v-else>
                        Pas assez de données
                    </div>
                </NLContainer>
            </NLColumn>
            <!-- Faits majeur par DRE -->
            <NLColumn lg="6" class="box">
                <div class="d-flex align-center justify-between">
                    <h2>Faits majeur par DRE</h2>
                    <button class="btn btn-info has-icon" @click.prevent="savePNG('dresMajorFacts')"
                        v-if="majorFactsData.charts.dres.datasets[0].data.length">
                        <i class="las la-save icon" />
                    </button>
                </div>
                <NLContainer extraClass="d-flex full-center" isFluid>
                    <NLFlex isFullCentered class="w-100 h-100" v-if="majorFactsData.charts.dres.datasets[0].data.length">
                        <Bar id="dresMajorFacts" :data="majorFactsData.charts.dres" :options="chartOptions"
                            data-title="faits_majeur_par_dre" />
                    </NLFlex>
                    <div class="my-10 text-center text-bold" v-else>
                        Pas assez de données
                    </div>
                </NLContainer>
            </NLColumn>
            <!-- Faits majeur par domaine -->
            <NLColumn lg="6" class="box">
                <h2>Faits majeur par domaine</h2>
                <div class="table-container" v-if="majorFactsData.tables.domains.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Domaine</th>
                                <th>Nombre Faits majeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in majorFactsData.tables.domains" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['domain'] }}</td>
                                <td>{{ row['total'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
            <!-- 10 agences contenant un nombre des faits majeur élevé -->
            <NLColumn lg="6" class="box">
                <h2>Les 10 agences contenant un nombre des faits majeur élevé</h2>
                <div class="table-container" v-if="majorFactsData.tables.agencies.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agence</th>
                                <th>Nombre Faits majeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in majorFactsData.tables.agencies" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['agency'] }}</td>
                                <td>{{ row['total_major_facts'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
            <!-- 10 missions contenant un nombre des faits majeur élevé -->
            <NLColumn lg="6" class="box">
                <h2>Les 10 missions contenant unl nombre des faits majeur élevé</h2>
                <div class="table-container" v-if="majorFactsData.tables.missions.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mission</th>
                                <th>Nombre Faits majeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in majorFactsData.tables.missions" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['mission'] }}</td>
                                <td>{{ row['total_major_facts'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
            <!-- 10 missions contenant un nombre des faits majeur élevé -->
            <NLColumn lg="6" class="box">
                <h2>Les 10 campagnes de contrôle contenant un nombre des faits majeur élevé</h2>
                <div class="table-container" v-if="majorFactsData.tables.campaigns.length">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Campagne</th>
                                <th>Nombre de Faits majeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in majorFactsData.tables.campaigns" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ row['campaign'] }}</td>
                                <td>{{ row['total_major_facts'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLColumn>
        </NLGrid>

        <NLGrid gap="6" v-if="currentSection == 'regularizations'" />
    </ContentBody>
</template>

<script>
import { mapGetters } from 'vuex'
import { Bar, Pie, Doughnut } from 'vue-chartjs'
export default {
    components: {
        Bar,
        Doughnut,
        Pie
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            currentSection: null,
            anomaliesData: {
                charts: {
                    families: null,
                    dres: null
                },
                tables: {
                    domains: null,
                    missions: null,
                    campaigns: null,
                    agencies: null
                }
            },
            majorFactsData: {
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
            },
            charts: {
                missionsPercentage: null,
                globalScores: null,
                avgScoreByFamily: null
            },
            tables: {
                dresClassificationByAchievementRate: null,
                avgScoreByDre: null,
                avgScoreByDomain: null
            },
            missionsState: null
        }
    },
    computed: {
        ...mapGetters({
            anomalies: 'statistics/anomalies',
            majorFacts: 'statistics/majorFacts',
            regularizations: 'statistics/regularizations',
            scores: 'statistics/scores',
            realisationStates: 'statistics/realisationStates'
        }),
        /**
         * Set default chart options
         */
        chartOptions() {
            return {
                responsive: true,
                maintainAspectRatio: true,
                barPercentage: 0.5,
                borderWidth: 2
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
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.setCurrentSection('realisationStates')
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
            this.$store.dispatch('settings/updatePageLoading', true)
            const UCFsection = section.charAt(0).toUpperCase() + section.slice(1)
            if (this.currentSection !== section) {
                this.$store.dispatch('statistics/fetch' + UCFsection).then(() => {
                    if (section === 'scores' && this.currentSection !== section) {
                        this.currentSection = section
                        this.charts.globalScores = this.scores.data.globalScores
                        this.charts.avgScoreByFamily = this.scores.data.avgScoreByFamily
                        this.tables.avgScoreByDre = this.scores.data.avgScoreByDre
                        this.tables.avgScoreByDomain = this.scores.data.avgScoreByDomain
                    } else if (section === 'majorFacts' && this.currentSection !== section) {
                        this.currentSection = section
                        this.majorFactsData.tables.domains = this.majorFacts.data.domainsMajorFacts
                        this.majorFactsData.tables.missions = this.majorFacts.data.missionsMajorFacts
                        this.majorFactsData.tables.campaigns = this.majorFacts.data.campaignsMajorFacts
                        this.majorFactsData.tables.agencies = this.majorFacts.data.agenciesMajorFacts

                        this.majorFactsData.charts.families = this.majorFacts.data.familiesMajorFacts
                        this.majorFactsData.charts.dres = this.majorFacts.data.dresMajorFacts
                    } else if (section === 'anomalies' && this.currentSection !== section) {
                        this.currentSection = section
                        this.anomaliesData.tables.campaigns = this.anomalies.data.campaignsAnomalies
                        this.anomaliesData.tables.missions = this.anomalies.data.missionsAnomalies
                        this.anomaliesData.tables.domains = this.anomalies.data.domainsAnomalies
                        this.anomaliesData.tables.agencies = this.anomalies.data.agenciesAnomalies

                        this.anomaliesData.charts.families = this.anomalies.data.familiesAnomalies
                        this.anomaliesData.charts.dres = this.anomalies.data.dresAnomalies
                    } else if (section === 'regularizations' && this.currentSection !== section) {
                    } else {
                        if (this.currentSection !== section) {
                            this.currentSection = section
                            this.charts.missionsPercentage = this.realisationStates.data.missionsPercentage
                            this.missionsState = this.realisationStates.data.missionsState
                            this.tables.dresClassificationByAchievementRate = this.realisationStates.data.dresClassificationByAchievementRate
                        }
                    }
                    this.$store.dispatch('settings/updatePageLoading', false)
                })
            }
        },
        savePNG(element) {
            const canvas = document.querySelector(`#${element}`)
            const title = canvas.dataset.title
            const dataURL = canvas.toDataURL('image/jpeg')
            const link = document.createElement('a')
            link.download = title ? `${title}.jpg` : 'canvas.jpg'
            link.href = dataURL
            link.click()
        }
    }

}
</script>
