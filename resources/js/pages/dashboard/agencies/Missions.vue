<template>
    <!-- Suivi de la réalisation des missions -->
    <NLGrid gap="4">
        <NLColumn v-if="!is('da') && !isLoading">
            <NLGrid gap="4">
                <NLColumn>
                    <h2>Suivi de la réalisation des missions</h2>
                </NLColumn>
                <NLColumn lg="3" extraClass="box is-danger">
                    <router-link :to="'missions?filter[is_late]=Oui&filter[campaign]=' + campaign?.id"
                        class="text-white text-bold w-100 d-flex align-center gap-4">
                        <i class="las la-clock text-white text-extra-large"></i>
                        <div class="text-bold text-white">
                            En retard
                        </div>
                        <div class="text-extra-large text-bold text-white">
                            {{ cards.missionsState['delay'] || 0 }} /
                            {{ cards.missionsState['total_missions'] }}
                        </div>
                    </router-link>
                </NLColumn>
                <NLColumn lg="3" extraClass="box is-info d-flex align-center gap-4">
                    <router-link :to="'missions?filter[current_state]=1&filter[campaign]=' + campaign?.id"
                        class="text-white text-bold w-100 d-flex align-center gap-4">
                        <i class="las la-hourglass-start text-white text-extra-large"></i>
                        <div class="text-bold text-white">
                            À réaliser
                        </div>
                        <div class="text-extra-large text-white text-bold">
                            {{ cards.missionsState['todo'] || 0 }} /
                            {{ cards.missionsState['total_missions'] }}
                        </div>
                    </router-link>
                </NLColumn>
                <NLColumn lg="3" extraClass="box is-warning d-flex align-center gap-4">
                    <router-link :to="'missions?filter[current_state]=2,3&filter[campaign]=' + campaign?.id"
                        class="text-white text-bold w-100 d-flex align-center gap-4">
                        <i class="las la-spinner la-spin text-white text-extra-large"></i>
                        <div class="text-bold text-white">
                            En cours
                        </div>
                        <div class="text-extra-large text-bold text-white">
                            {{ cards.missionsState['active'] || 0 }} /
                            {{ cards.missionsState['total_missions'] }}
                        </div>
                    </router-link>
                </NLColumn>
                <NLColumn lg="3" extraClass="box is-success d-flex align-center gap-4">
                    <router-link :to="'missions?filter[current_state]=4,5,6,7,8&filter[campaign]=' + campaign?.id"
                        class="text-white text-bold w-100 d-flex align-center gap-4">
                        <i class="las la-check-circle text-white text-extra-large"></i>
                        <div class="text-bold text-white">
                            Réalisées et validées
                        </div>
                        <div class="text-extra-large text-white text-bold">
                            {{ cards.missionsState['done'] || 0 }} /
                            {{ cards.missionsState['total_missions'] }}
                        </div>
                    </router-link>
                </NLColumn>
            </NLGrid>
        </NLColumn>

        <!-- Situation des rapports -->
        <NLColumn lg="4" v-if="!is(['da', 'ci'])">
            <div class="box">
                <div class="d-flex align-center justify-between">
                    <h2>Situation des rapports</h2>
                    <button class="btn btn-info has-icon" @click.prevent="savePNG('missionsPercentage')"
                        v-if="charts.missionsPercentage.datasets[0].data.some(value => value > 0)">
                        <span class="material-icons material-symbols-rounded icon">
                            save
                        </span>
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
        <NLColumn lg="8" extraClass="box"
            v-if="is(['dg', 'dga', 'sg', 'ig', 'iga', 'deac', 'cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin'])">
            <h2>Classement des DRE par taux de réalisation des missions</h2>
            <div class="table-container" v-if="tables.dresClassificationByAchievementRate.length">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DRE</th>
                            <th>
                                Missions programmées
                            </th>
                            <th>
                                Missions réalisées
                            </th>
                            <th>
                                Taux de réalisation
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="( row, index ) in  tables.dresClassificationByAchievementRate " :key="index">
                            <td class="text-center">{{ index + 1 }}</td>
                            <td>{{ row['dre'] }}</td>
                            <td class="text-center">
                                {{ row['total'] }}
                            </td>
                            <td class="text-center">
                                {{ row['totalAchieved'] }}
                            </td>
                            <td class="text-center">
                                {{ row['rate'] }}%
                            </td>
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
            missionsStates: 'agencyLevelStatistics/missionsStates'
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
            campaign: null,
            charts: {
                missionsPercentage: null,
            },
            tables: {
                dresClassificationByAchievementRate: null,
            },
            cards: {
                missionsState: null
            },
            isLoading: true,
        }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('agencyLevelStatistics/fetchMissionsStates', { onlyCurrentCampaign: this?.onlyCurrentCampaign, currentCampaign: this?.currentCampaign }).then(() => {
                this.charts.missionsPercentage = this.missionsStates.data.missionsPercentage
                this.cards.missionsState = this.missionsStates.data.missionsState
                this.tables.dresClassificationByAchievementRate = this.missionsStates.data.dresClassificationByAchievementRate
                if (this.currentCampaign) {
                    this.campaign = this.currentCampaign
                } else {
                    this.campaign = this.missionsStates.data.currentCampaign
                }
                this.isLoading = false
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        savePNG(element) {
            this.$emit('savePNG', element)
        }
    }
}
</script>

<style lang="css">
.la-hourglass-start:before {
    content: "\f251";
    display: inline-block;
    animation-name: hourglass;
    animation-duration: 3s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    animation-delay: 0.5s;
}

@keyframes hourglass {
    0% {
        content: "\f251";
    }

    33.3% {
        content: "\f252";
    }

    66.6% {
        content: "\f253";
    }
}
</style>
