<template>
    <ContentBody v-if="can('view_control_campaign')">
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
        <Missions :onlyCurrentCampaign="false" :currentCampaign="currentCampaign"
            v-if="currentSection == 'realisationStates' && can('view_control_campaign')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" />


        <!-- Scores -->
        <Scores :onlyCurrentCampaign="false" :currentCampaign="currentCampaign"
            v-if="currentSection == 'scores' && can('view_control_campaign')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" :horizontalBarOptions="horizontalBarOptions" />

        <!-- Anomalies -->
        <Anomalies :onlyCurrentCampaign="false" :currentCampaign="currentCampaign"
            v-if="currentSection == 'anomalies' && can('view_control_campaign')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" />

        <!-- Major facts -->
        <MajorFacts :onlyCurrentCampaign="false" :currentCampaign="currentCampaign"
            v-if="currentSection == 'majorFacts' && can('view_control_campaign')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" :horizontalBarOptions="horizontalBarOptions" />

        <!-- <NLGrid gap="6" v-if="currentSection == 'regularizations'" /> -->
    </ContentBody>
</template>

<script>
import Anomalies from '../dashboard/second_level/Anomalies'
import MajorFacts from '../dashboard/second_level/MajorFacts'
import Scores from '../dashboard/second_level/Scores'
import Missions from '../dashboard/second_level/Missions'
import { user } from '../../plugins/user'
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
            currentCampaign: null,
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
        this.currentCampaign = this.$route?.params?.campaignId
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
            var bgColor = '#FCFCFC';
            // Get the existant chart canvas
            const canvas = document.querySelector(`#${element}`)
            const title = canvas.dataset.title

            // Create a new canvas with a custom background color
            var newCanvas = document.createElement('canvas');
            var newCtx = newCanvas.getContext('2d');
            newCanvas.width = canvas.width;
            newCanvas.height = canvas.height;
            newCtx.fillStyle = bgColor;
            newCtx.fillRect(0, 0, newCanvas.width, newCanvas.height);

            // Draw the original chart on the new canvas
            newCtx.drawImage(canvas, 0, 0);
            // Convert the new canvas to a data URL
            var dataURL = newCanvas.toDataURL('image/jpeg');

            // Create a link and trigger a download
            var link = document.createElement('a');
            link.href = dataURL;
            link.download = title ? `${title}.png` : 'canvas.png'
            link.click();
        }
    }

}
</script>
