<template>
    <!-- KPI sections -->
    <NLFlex alignItems="center" lgJustifyContent="start" gap="2" extraClass="my-4" wrap>
        <button class="btn" :class="{ 'is-active': currentSection == 'accomplishRate' }"
            :disabled="currentSection == 'accomplishRate'" @click="setCurrentSection('accomplishRate')">
            <NLIcon name="stars" />
            Taux d’accomplissement
        </button>
        <button class="btn" :class="{ 'is-active': currentSection == 'timeLag' }" :disabled="currentSection == 'timeLag'"
            @click="setCurrentSection('timeLag')">
            <NLIcon name="star_half" />
            Taux d'accomplissement (retard)
        </button>
        <button class="btn" :class="{ 'is-active': currentSection == 'missionsFall' }"
            :disabled="currentSection == 'missionsFall'" @click="setCurrentSection('missionsFall')">
            <NLIcon name="star" />
            Taux d'inaccomplissement
        </button>
    </NLFlex>

    <!-- Tables -->
    <NLGrid gap="4">
        <!-- Taux d'Accomplissement des Missions par les contrôleurs  -->
        <NLColumn v-if="currentSection == 'accomplishRate'" class="box">
            <NLFlex alignItems="center">
                <h2>Taux d'accomplissement des missions par les contrôleurs</h2>
                <div v-if="tables.accomplishRate.length">
                    <NLButton class="btn btn-office-excel" label="Exporter" @click="exportExcel('accomplishRate')">
                        <NLIcon name="table" />
                    </NLButton>
                </div>
            </NLFlex>
            <div class="table-container" v-if="tables.accomplishRate.length">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Contrôleur</th>
                            <th class="text-center">Missions assignées</th>
                            <th class="text-center">
                                Missions <br> (Agence AP)
                            </th>
                            <th class="text-center">
                                Missions <br> (Agence A)
                            </th>
                            <th class="text-center">
                                Missions <br> (Agence B)
                            </th>
                            <th class="text-center">
                                Missions <br> (Agence C)
                            </th>
                            <th class="text-center">Missions validées</th>
                            <th class="text-center">Taux %</th>
                            <th class="text-center">État</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, index) in tables.accomplishRate" :key="index">
                            <td class="text-center">{{ index + 1 }}</td>
                            <td class="text-left">{{ row['controller_full_name'] }}</td>
                            <td class="text-center">{{ row['total_missions_assigned'] }}</td>
                            <td class="text-center">
                                {{ row['total_missions_validated_ag_ap'] }} / {{ row['total_missions_assigned_ag_ap'] }}
                            </td>
                            <td class="text-center">
                                {{ row['total_missions_validated_ag_a'] }} / {{ row['total_missions_assigned_ag_a'] }}
                            </td>
                            <td class="text-center">
                                {{ row['total_missions_validated_ag_b'] }} / {{ row['total_missions_assigned_ag_b'] }}
                            </td>
                            <td class="text-center">
                                {{ row['total_missions_validated_ag_c'] }} / {{ row['total_missions_assigned_ag_c'] }}
                            </td>
                            <td class="text-center">{{ row['total_missions_validated'] }}</td>
                            <td class="text-center">{{ row['accomplish_rate'] }}%</td>
                            <td class="text-center">
                                <div class="tag is-centered"
                                    :class="[{ 'is-success': row['accomplish_rate'] > 75 }, { 'is-info': row['accomplish_rate'] == 75 }, { 'is-warning': row['accomplish_rate'] > 50 && row['accomplish_rate'] < 75 }, { 'is-danger': row['accomplish_rate'] < 50 }]">
                                    <span v-if="row['accomplish_rate'] > 75">Top</span>
                                    <span v-else-if="row['accomplish_rate'] == 75">Atteint</span>
                                    <span
                                        v-else-if="row['accomplish_rate'] > 50 && row['accomplish_rate'] < 75">Proche</span>
                                    <span v-else-if="row['accomplish_rate'] < 50">Redynamiser</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-10 text-center text-bold" v-else>
                Pas assez de données
            </div>
        </NLColumn>

        <!-- Taux d'Accomplissement des Missions Hors Délais par les contrôleurs  -->
        <NLColumn v-if="currentSection == 'timeLag'" class="box">
            <NLFlex alignItems="center">
                <h2>Taux d'accomplissement des missions hors délais par les contrôleurs</h2>
                <div v-if="tables.timeLag.length">
                    <NLButton class="btn btn-office-excel" label="Exporter" @click="exportExcel('timeLag')">
                        <NLIcon name="table" />
                    </NLButton>
                </div>
            </NLFlex>
            <div class="table-container" v-if="tables.timeLag.length">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Contrôleur</th>
                            <th class="text-center">Missions assignées</th>
                            <th class="text-center">
                                Missions <br> (Agence AP)
                            </th>
                            <th class="text-center">
                                Missions <br> (Agence A)
                            </th>
                            <th class="text-center">
                                Missions <br> (Agence B)
                            </th>
                            <th class="text-center">
                                Missions <br> (Agence C)
                            </th>
                            <th class="text-center">Missions validées</th>
                            <th class="text-center">Taux %</th>
                            <th class="text-center">État</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, index) in tables.timeLag" :key="index">
                            <td class="text-center">{{ index + 1 }}</td>
                            <td class="text-left">{{ row['controller_full_name'] }}</td>
                            <td class="text-center">{{ row['total_missions_assigned'] }}</td>
                            <td class="text-center">
                                {{ row['total_missions_validated_ag_ap'] }} / {{ row['total_missions_assigned_ag_ap'] }}
                            </td>
                            <td class="text-center">
                                {{ row['total_missions_validated_ag_a'] }} / {{ row['total_missions_assigned_ag_a'] }}
                            </td>
                            <td class="text-center">
                                {{ row['total_missions_validated_ag_b'] }} / {{ row['total_missions_assigned_ag_b'] }}
                            </td>
                            <td class="text-center">
                                {{ row['total_missions_validated_ag_c'] }} / {{ row['total_missions_assigned_ag_c'] }}
                            </td>
                            <td class="text-center">{{ row['total_missions_validated'] }}</td>
                            <td class="text-center">{{ row['time_lag'] }}%</td>
                            <td class="text-center">
                                <div class="tag is-centered"
                                    :class="[{ 'is-success': row['time_lag'] < 25 }, { 'is-info': row['time_lag'] == 25 }, { 'is-warning': row['time_lag'] > 25 && row['time_lag'] <= 50 }, { 'is-danger': row['time_lag'] > 50 }]">
                                    <span v-if="row['time_lag'] < 25">Optimal</span>
                                    <span v-else-if="row['time_lag'] == 25">Acceptable</span>
                                    <span v-else-if="row['time_lag'] > 25 && row['time_lag'] <= 50">À surveiller</span>
                                    <span v-else-if="row['time_lag'] > 50">Critique</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-10 text-center text-bold" v-else>
                Pas assez de données
            </div>
        </NLColumn>

        <!-- Taux d'inaccomplissement des Missions par les Contrôleurs  -->
        <NLColumn v-if="currentSection == 'missionsFall'" class="box">
            <NLFlex alignItems="center">
                <h2>Taux d'inaccomplissement des missions par les contrôleurs</h2>
                <div v-if="tables.timeLag.length">
                    <NLButton class="btn btn-office-excel" label="Exporter" @click="exportExcel('missionsFall')">
                        <NLIcon name="table" />
                    </NLButton>
                </div>
            </NLFlex>
            <div class="table-container" v-if="tables.missionsFall.length">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Contrôleur</th>
                            <th class="text-center">Missions assignées</th>
                            <th class="text-center">
                                Missions <br> (Agence AP)
                            </th>
                            <th class="text-center">
                                Missions <br> (Agence A)
                            </th>
                            <th class="text-center">
                                Missions <br> (Agence B)
                            </th>
                            <th class="text-center">
                                Missions <br> (Agence C)
                            </th>
                            <th class="text-center">Missions inachevées</th>
                            <th class="text-center">Taux %</th>
                            <th class="text-center">État</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, index) in tables.missionsFall" :key="index">
                            <td class="text-center">{{ index + 1 }}</td>
                            <td class="text-left">{{ row['controller_full_name'] }}</td>
                            <td class="text-center">{{ row['total_missions_assigned'] }}</td>
                            <td class="text-center">
                                {{ row['total_missions_not_validated_ag_ap'] }} / {{
                                    row['total_missions_assigned_ag_ap'] }}
                            </td>
                            <td class="text-center">
                                {{ row['total_missions_not_validated_ag_a'] }} / {{ row['total_missions_assigned_ag_a']
                                }}
                            </td>
                            <td class="text-center">
                                {{ row['total_missions_not_validated_ag_b'] }} / {{ row['total_missions_assigned_ag_b']
                                }}
                            </td>
                            <td class="text-center">
                                {{ row['total_missions_not_validated_ag_c'] }} / {{ row['total_missions_assigned_ag_c']
                                }}
                            </td>
                            <td class="text-center">{{ row['total_missions_not_validated'] }}</td>
                            <td class="text-center">{{ row['missions_fall'] }}%</td>
                            <td class="text-center">
                                <div class="tag is-centered"
                                    :class="[{ 'is-success': row['missions_fall'] < 25 }, { 'is-info': row['missions_fall'] == 25 }, { 'is-warning': row['missions_fall'] > 25 && row['missions_fall'] <= 50 }, { 'is-danger': row['missions_fall'] > 50 }]">
                                    <span v-if="row['missions_fall'] < 25">
                                        {{ Number(row['gender']) == 1 ? 'Engagé' : 'Engagée' }}
                                    </span>
                                    <span v-else-if="row['missions_fall'] == 25">Tolérable</span>
                                    <span v-else-if="row['missions_fall'] > 25 && row['missions_fall'] <= 50">
                                        En risque
                                    </span>
                                    <span v-else-if="row['missions_fall'] > 50">Défaillant</span>
                                </div>
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
import { Bar, Doughnut } from 'vue-chartjs'
export default {
    name: "Anomalies",
    components: {
        Bar,
        Doughnut,
    },
    computed: {
        ...mapGetters({
            kpi: 'statistics/KPI',
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
            tables: {
                accomplishRate: null,
                timeLag: null,
                missionsFall: null,
            },
            currentSection: 'accomplishRate',
        }
    },
    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('statistics/fetchKPI', { onlyCurrentCampaign: this?.onlyCurrentCampaign, currentCampaign: this?.currentCampaign }).then(() => {
                this.tables.accomplishRate = this.kpi.data.accomplishRate
                this.tables.timeLag = this.kpi.data.timeLag
                this.tables.missionsFall = this.kpi.data.missionsFall
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        },
        savePNG(element) {
            this.$emit('savePNG', element)
        },
        exportExcel(type) {
            window.open('api/v1/statistics/kpi/export/excel/' + type)
        },
        setCurrentSection(section) {
            this.currentSection = section
        }
    }
}
</script>
