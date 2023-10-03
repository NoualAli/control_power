<template>
    <!-- Suivi de la réalisation des missions -->
    <NLGrid gap="4">
        <NLColumn>
            <NLGrid gap="4">
                <NLColumn>
                    <h2>Suivi de la réalisation des missions</h2>
                </NLColumn>
                <NLColumn lg="3" extraClass="box is-danger d-flex align-center gap-4">
                    <span class="text-bold text-white">
                        En retard
                    </span>
                    <span class="text-extra-large text-bold text-white">{{ cards.missionsState['delay'] || 0 }}</span>
                </NLColumn>
                <NLColumn lg="3" extraClass="box is-warning d-flex align-center gap-4">
                    <div class="text-bold">
                        En cours
                    </div>
                    <div class="text-extra-large text-bold">
                        {{ cards.missionsState['active'] || 0 }}
                    </div>
                </NLColumn>
                <NLColumn lg="3" extraClass="box is-info d-flex align-center gap-4">
                    <div class="text-bold">
                        À réalisées
                    </div>
                    <div class="text-extra-large text-bold">
                        {{ cards.missionsState['todo'] || 0 }}
                    </div>
                </NLColumn>
                <NLColumn lg="3" extraClass="box is-success d-flex align-center gap-4">
                    <div class="text-bold">
                        Réalisées et validées
                    </div>
                    <div class="text-extra-large text-bold">
                        {{ cards.missionsState['done'] || 0 }}
                    </div>
                </NLColumn>
            </NLGrid>
        </NLColumn>

        <!-- Situation des rapports -->
        <NLColumn lg="4">
            <div class="box">
                <div class="d-flex align-center justify-between">
                    <h2>Situation des rapports</h2>
                    <button class="btn btn-info has-icon" @click.prevent="savePNG('missionsPercentage')"
                        v-if="charts.missionsPercentage.datasets[0].data.some(value => value > 0)">
                        <i class="las la-save icon" />
                    </button>
                </div>
                <NLContainer extraClass="d-flex full-center" isFluid>
                    <NLFlex isFullCentered extraClass="w-100 h-100"
                        v-if="charts.missionsPercentage.datasets[0].data.some(value => value > 0)">
                        <Pie id="missionsPercentage" :data="charts.missionsPercentage" :options="circularChartOptions"
                            data-title="situation_des_rapports" />
                    </NLFlex>
                    <div class="my-10 text-center text-bold" v-else>
                        Pas assez de données
                    </div>
                </NLContainer>
            </div>
        </NLColumn>

        <!-- Classement des DRE par taux de réalisation des missions -->
        <NLColumn lg="8" extraClass="box">
            <h2>Classement des DRE par taux de réalisation des missions</h2>
            <div class="table-container" v-if="tables.dresClassificationByAchievementRate.length">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DRE</th>
                            <th>Missions programmées</th>
                            <th>Missions réalisées</th>
                            <th>Taux de réalisation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, index) in tables.dresClassificationByAchievementRate" :key="index">
                            <td class="text-center">{{ index + 1 }}</td>
                            <td>{{ row['dre'] }}</td>
                            <td class="text-center">{{ row['total'] }}</td>
                            <td class="text-center">{{ row['totalAchieved'] }}</td>
                            <td class="text-center">{{ row['rate'] }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-10 text-center text-bold" v-else>
                Pas assez de données
            </div>
        </NLColumn>
    </NLGrid>
</template>

<script>
import { mapGetters } from 'vuex'
import { Bar, Pie, Doughnut } from 'vue-chartjs'
export default {
    name: "Missions",
    components: {
        Bar,
        Doughnut,
        Pie
    },
    computed: {
        ...mapGetters({
            realisationStates: 'statistics/realisationStates'
        }),
    },
    props: {
        circularChartOptions: { type: Object, required: false },
        chartOptions: { type: Object, required: false },
        horizontalBarOptions: { type: Object, required: false },
        onlyCurrentCampaign: { type: Boolean, required: false, default: true }
    },
    data() {
        return {
            charts: {
                missionsPercentage: null,
            },
            tables: {
                dresClassificationByAchievementRate: null,
            },
            cards: {
                missionsState: null
            }
        }
    },
    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('statistics/fetchRealisationStates', this.onlyCurrentCampaign).then(() => {
                this.charts.missionsPercentage = this.realisationStates.data.missionsPercentage
                this.cards.missionsState = this.realisationStates.data.missionsState
                this.tables.dresClassificationByAchievementRate = this.realisationStates.data.dresClassificationByAchievementRate
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        savePNG(element) {
            this.$emit('savePNG', element)
        }
    }
}
</script>
