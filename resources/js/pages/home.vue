<template>
    <ContentBody v-if="!isLoading">
        <NLFlex>
            <h2>
                <router-link :to="{ name: 'campaign', params: { campaignId: currentCampaign?.id } }" class="text-dark">
                    Campagne {{ currentCampaign?.reference }}
                </router-link>
            </h2>
            <h2>Du {{ currentCampaign?.start_date }} Au {{ currentCampaign?.end_date }}</h2>
        </NLFlex>
        <NLFlex alignItems="center" lgJustifyContent="start" gap="2" extraClass="mt-8 mb-12" wrap>
            <button class="btn" :class="{ 'is-active': currentSection == 'missionsStates' }"
                :disabled="currentSection == 'missionsStates'" @click="setCurrentSection('missionsStates')"
                v-if="!is('da')">
                <NLIcon name="checklist" />
                Suivi des missions
            </button>
            <button class="btn" :class="{ 'is-active': currentSection == 'scores' }"
                :disabled="currentSection == 'scores'" @click="setCurrentSection('scores')">
                <NLIcon name="format_list_numbered" />
                Notations
            </button>
            <button class="btn" :class="{ 'is-active': currentSection == 'anomalies' }"
                :disabled="currentSection == 'anomalies'" @click="setCurrentSection('anomalies')">
                <NLIcon name="breaking_news" />
                Anomalies
            </button>
            <button class="btn" :class="{ 'is-active': currentSection == 'majorFacts' }"
                :disabled="currentSection == 'majorFacts'" @click="setCurrentSection('majorFacts')" v-if="!is('da')">
                <NLIcon name="brightness_alert" />
                Faits majeurs
            </button>
            <button class="btn" :class="{ 'is-active': currentSection == 'KPI' }" :disabled="currentSection == 'KPI'"
                @click="setCurrentSection('KPI')" v-if="is(['dcp', 'cdcr', 'root', 'admin'])">
                <NLIcon name="trophy" />
                KPI
            </button>
        </NLFlex>

        <!-- Suivi de la réalisation des missions -->
        <Missions v-if="currentSection == 'missionsStates'" :userRole="userRole"
            :circularChartOptions="circularChartOptions" :currentCampaign="currentCampaign.id" @savePNG="savePNG" />

        <!-- Scores -->
        <Scores v-if="currentSection == 'scores'" :userRole="userRole" :circularChartOptions="circularChartOptions"
            @savePNG="savePNG" :horizontalBarOptions="horizontalBarOptions" :currentCampaign="currentCampaign.id" />

        <!-- Anomalies -->
        <Anomalies v-if="currentSection == 'anomalies'" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" :currentCampaign="currentCampaign.id" />

        <!-- Major facts -->
        <MajorFacts v-if="currentSection == 'majorFacts' && !is('da')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" :horizontalBarOptions="horizontalBarOptions"
            :currentCampaign="currentCampaign.id" />

        <!-- KPI -->
        <KPI v-if="currentSection == 'KPI' && !is('da')" :userRole="userRole" @savePNG="savePNG"
            :currentCampaign="currentCampaign.id" />
    </ContentBody>
</template>

<script>
import Anomalies from './dashboard/agencies/Anomalies'
import MajorFacts from './dashboard/agencies/MajorFacts'
import Scores from './dashboard/agencies/Scores'
import Missions from './dashboard/agencies/Missions'
import KPI from './dashboard/agencies/KPI'
import { user, hasRole } from '../plugins/user'
export default {
    components: {
        Anomalies,
        MajorFacts,
        Scores,
        Missions,
        KPI
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            currentCampaign: null,
            currentSection: null,
            userRole: null,
            isLoading: true,
        }
    },
    computed: {
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
        this.initData()
    },
    methods: {
        /**
         * Initialize data
         */
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$alapi.get('statistics/current-campaign').then(response => {
                this.currentCampaign = response.data
                if (hasRole('da')) {
                    this.setCurrentSection('scores')
                } else {
                    this.setCurrentSection('missionsStates')
                }
                this.userRole = user()?.role?.code
            }).catch(error => {
                this.$swal.catchError(error)
            })
        },
        /**
         * Set the current section name and fetch data from laravel api
         *
         * @param {string} section
         *
         * @return {void}
         */
        setCurrentSection(section) {
            this.currentSection = section
            this.isLoading = false
        },

        /**
         * Save charts as PNG
         *
         * @param {String} elementId
         */
        savePNG(elementId) {
            const canvas = document.querySelector(`#${elementId}`)
            const title = canvas.dataset.title
            const dataURL = canvas.toDataURL('image/png')
            const link = document.createElement('a')
            link.download = title ? `${title}.png` : 'canvas.png'
            link.href = dataURL
            link.click()
        }
    }

}
</script>
