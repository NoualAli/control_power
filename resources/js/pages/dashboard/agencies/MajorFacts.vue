<template>
    <!-- Major facts -->
    <NLGrid gap="4">
        <!-- Faits majeurs par famille -->
        <NLColumn lg="6" class="box">
            <div class="d-flex align-center justify-between">
                <h2>Faits majeurs par famille</h2>
                <button class="btn btn-info has-icon" @click.prevent="savePNG('familiesMajorFacts')"
                    v-if="charts.families.datasets[0].data.length">
                    <span class="material-icons material-symbols-rounded icon">
                        save
                    </span>
                </button>
            </div>
            <NLContainer extraClass="d-flex full-center" isFluid>
                <NLFlex isFullCentered extraClass="w-100 h-100" v-if="charts.families.datasets[0].data.length">
                    <Doughnut id="familiesMajorFacts" :data="charts.families" :options="circularChartOptions"
                        data-title="faits_majeur_par_famille" />
                </NLFlex>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLContainer>
        </NLColumn>
        <!-- Faits majeurs par DRE -->
        <NLColumn lg="6" class="box">
            <div class="d-flex align-center justify-between">
                <h2>Faits majeurs par DRE</h2>
                <button class="btn btn-info has-icon" @click.prevent="savePNG('dresMajorFacts')"
                    v-if="charts.dres.datasets[0].data.length">
                    <span class="material-icons material-symbols-rounded icon">
                        save
                    </span>
                </button>
            </div>
            <NLContainer extraClass="d-flex full-center" isFluid>
                <NLFlex isFullCentered class="w-100 h-100" v-if="charts.dres.datasets[0].data.length">
                    <Bar id="dresMajorFacts" :data="charts.dres" :options="chartOptions"
                        data-title="faits_majeur_par_dre" />
                </NLFlex>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </NLContainer>
        </NLColumn>
        <!-- 10 domaines contenant un nombre des faits majeurs élevé -->
        <NLColumn lg="6">
            <div class="box">
                <h2>Les 10 Domaines contenant un nombre des faits majeurs élevés</h2>
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
                                <td class="text-center">{{ row['total_major_facts'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </div>
        </NLColumn>
        <!-- 10 agences contenant un nombre des faits majeurs élevé -->
        <NLColumn lg="6">
            <div class="box">
                <h2>Les 10 Agences contenant un nombre des faits majeurs élevés</h2>
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
                                <td class="text-center">{{ row['total_major_facts'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </div>
        </NLColumn>
        <!-- 10 missions contenant un nombre des faits majeurs élevé -->
        <NLColumn lg="6">
            <div class="box">
                <h2>Les 10 Missions contenant un nombre des faits majeurs élevés</h2>
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
                                <td class="text-center">{{ row['total_major_facts'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </div>
        </NLColumn>
        <!-- 10 campagnes de contrôle contenant un nombre des faits majeurs élevé -->
        <NLColumn lg="6">
            <div class="box">
                <h2>Les 10 Campagnes de contrôle contenant un nombre des faits majeurs élevés</h2>
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
                                <td class="text-center">{{ row['total_major_facts'] }}</td>
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
    name: "MajorFacts",
    emits: [ 'savePNG' ],
    components: {
        Bar,
        Doughnut,
    },
    computed: {
        ...mapGetters({
            majorFacts: 'agencyLevelStatistics/majorFacts',
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
            this.$store.dispatch('agencyLevelStatistics/fetchMajorFacts', { onlyCurrentCampaign: false, currentCampaign: this?.currentCampaign }).then(() => {
                this.tables.domains = this.majorFacts.data.domainsMajorFacts
                this.tables.missions = this.majorFacts.data.missionsMajorFacts
                this.tables.campaigns = this.majorFacts.data.campaignsMajorFacts
                this.tables.agencies = this.majorFacts.data.agenciesMajorFacts

                this.charts.families = this.majorFacts.data.familiesMajorFacts
                this.charts.dres = this.majorFacts.data.dresMajorFacts
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        savePNG(element) {
            this.$emit('savePNG', element)
        }
    }
}
</script>
