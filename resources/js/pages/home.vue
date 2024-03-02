<template>
    <ContentBody v-if="!isLoading">
        <NLFlex alignItems="center" lgJustifyContent="start" gap="2" extraClass="my-4" wrap>
            <button class="btn" :class="{ 'is-active': currentSection == 'missionsStates' }"
                :disabled="currentSection == 'missionsStates'" @click="setCurrentSection('missionsStates')"
                v-if="!is('da')">
                <NLIcon name="checklist" />
                Suivi de la réalisation des missions
            </button>
            <button class="btn" :class="{ 'is-active': currentSection == 'scores' }" :disabled="currentSection == 'scores'"
                @click="setCurrentSection('scores')">
                <NLIcon name="format_list_numbered" />
                Statistiques des notations
            </button>
            <button class="btn" :class="{ 'is-active': currentSection == 'anomalies' }"
                :disabled="currentSection == 'anomalies'" @click="setCurrentSection('anomalies')">
                <NLIcon name="breaking_news" />
                Statistiques des anomalies
            </button>
            <button class="btn" :class="{ 'is-active': currentSection == 'majorFacts' }"
                :disabled="currentSection == 'majorFacts'" @click="setCurrentSection('majorFacts')" v-if="!is('da')">
                <NLIcon name="brightness_alert" />
                Statistiques des faits majeurs
            </button>
            <button class="btn" :class="{ 'is-active': currentSection == 'KPI' }" :disabled="currentSection == 'KPI'"
                @click="setCurrentSection('KPI')" v-if="is(['dcp', 'cdcr', 'root', 'admin'])">
                <NLIcon name="trophy" />
                KPI
            </button>
        </NLFlex>

        <!-- Suivi de la réalisation des missions -->
        <Missions v-if="currentSection == 'missionsStates'" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" />


        <!-- Scores -->
        <Scores v-if="currentSection == 'scores'" :userRole="userRole" :circularChartOptions="circularChartOptions"
            @savePNG="savePNG" :horizontalBarOptions="horizontalBarOptions" />

        <!-- Anomalies -->
        <Anomalies v-if="currentSection == 'anomalies'" :userRole="userRole" :circularChartOptions="circularChartOptions"
            @savePNG="savePNG" />

        <!-- Major facts -->
        <MajorFacts v-if="currentSection == 'majorFacts' && !is('da')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" :horizontalBarOptions="horizontalBarOptions" />

        <!-- KPI -->
        <KPI v-if="currentSection == 'KPI' && !is('da')" :userRole="userRole" @savePNG="savePNG" />
    </ContentBody>
</template>

<script>
import Anomalies from './dashboard/second_level/Anomalies'
import MajorFacts from './dashboard/second_level/MajorFacts'
import Scores from './dashboard/second_level/Scores'
import Missions from './dashboard/second_level/Missions'
import KPI from './dashboard/second_level/KPI'
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
        if (hasRole('da')) {
            this.setCurrentSection('scores')
        } else {
            this.setCurrentSection('missionsStates')
        }
        this.userRole = user()?.role?.code
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
            this.currentSection = section
            this.isLoading = false
            // this.$store.dispatch('settings/updatePageLoading', false)
        },
        savePNG(element) {
            const canvas = document.querySelector(`#${element}`)
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
