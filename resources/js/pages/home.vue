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
        <Missions v-if="currentSection == 'realisationStates'" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" />


        <!-- Scores -->
        <Scores v-if="currentSection == 'scores'" :userRole="userRole" :circularChartOptions="circularChartOptions"
            @savePNG="savePNG" :horizontalBarOptions="horizontalBarOptions" />

        <!-- Anomalies -->
        <Anomalies v-if="currentSection == 'anomalies'" :userRole="userRole" :circularChartOptions="circularChartOptions"
            @savePNG="savePNG" />

        <!-- Major facts -->
        <MajorFacts v-if="currentSection == 'majorFacts'" :userRole="userRole" :circularChartOptions="circularChartOptions"
            @savePNG="savePNG" :horizontalBarOptions="horizontalBarOptions" />

        <!-- <NLGrid gap="6" v-if="currentSection == 'regularizations'" /> -->
    </ContentBody>
</template>

<script>
import Anomalies from './dashboard/second_level/Anomalies.vue'
import MajorFacts from './dashboard/second_level/MajorFacts.vue'
import Scores from './dashboard/second_level/Scores.vue'
import Missions from './dashboard/second_level/Missions.vue'
import { user } from '../plugins/user'
export default {
    components: {
        Anomalies,
        MajorFacts,
        Scores,
        Missions,
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            currentSection: null,
            userRole: null,
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
        this.setCurrentSection('realisationStates')
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
            this.$store.dispatch('settings/updatePageLoading', false)
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
