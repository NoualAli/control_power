<template>
    <!-- Scores -->
    <NLGrid gap="4">
        <!-- Classement des notations -->
        <NLColumn lg="6">
            <div class="box">
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
            </div>
        </NLColumn>

        <!-- Notations moyennes par famille -->
        <NLColumn class="box" lg="6">
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
        <NLColumn lg="6">
            <div class="box">
                <h2>Notations moyennes par domaine</h2>
                <div class="table-container" v-if="tables.avgScoreByDomain.length">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Domaine</th>
                                <th class="text-center">Moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in tables.avgScoreByDomain" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td class="text-left">{{ row['domain'] }}</td>
                                <td class="text-center">{{ row['avg_score'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="my-10 text-center text-bold" v-else>
                    Pas assez de données
                </div>
            </div>
        </NLColumn>

        <!-- Notations moyennes par DRE -->
        <NLColumn lg="6">
            <div class="box">
                <h2>Notations moyennes par DRE</h2>
                <div class="table-container" v-if="tables.avgScoreByDre.length">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">DRE</th>
                                <th class="text-center">Moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in tables.avgScoreByDre" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td class="text-left">{{ row['dre'] }}</td>
                                <td class="text-center">{{ row['avg_score'] }}</td>
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
    name: "Scores",
    components: {
        Bar,
        Doughnut,
    },
    computed: {
        ...mapGetters({
            scores: 'statistics/scores',
        }),
    },
    props: {
        circularChartOptions: { type: Object, required: false },
        chartOptions: { type: Object, required: false },
        horizontalBarOptions: { type: Object, required: false },
        onlyCurrentCampaign: { type: Boolean, required: false, default: true },
        userRole: { type: String, required: false, default: null }
    },
    data() {
        return {
            charts: {
                globalScores: null,
                avgScoreByFamily: null
            },
            tables: {
                avgScoreByDre: null,
                avgScoreByDomain: null
            },
        }
    },
    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('statistics/fetchScores', this.onlyCurrentCampaign).then(() => {
                this.charts.globalScores = this.scores.data.globalScores
                this.charts.avgScoreByFamily = this.scores.data.avgScoreByFamily
                this.tables.avgScoreByDre = this.scores.data.avgScoreByDre
                this.tables.avgScoreByDomain = this.scores.data.avgScoreByDomain
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        savePNG(element) {
            this.$emit('savePNG', element)
        }
    }
}
</script>
