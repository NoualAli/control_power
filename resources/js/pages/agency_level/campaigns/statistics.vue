<template>
    <ContentBody v-if="can('view_control_campaign')">
        <NLFlex alignItems="center" lgJustifyContent="start" gap="2" extraClass="my-4" wrap>
            <button :disabled="currentSection == 'missionsStates'" class="btn"
                :class="{ 'is-active': currentSection == 'missionsStates' }"
                @click="setCurrentSection('missionsStates')" v-if="!is('da')">
                <NLIcon name="checklist" />
                Suivi de la réalisation des missions
            </button>
            <button :disabled="currentSection == 'scores'" class="btn"
                :class="{ 'is-active': currentSection == 'scores' }" @click="setCurrentSection('scores')">
                <NLIcon name="format_list_numbered" />
                Statistiques des notations
            </button>
            <button :disabled="currentSection == 'anomalies'" class="btn"
                :class="{ 'is-active': currentSection == 'anomalies' }" @click="setCurrentSection('anomalies')">
                <NLIcon name="breaking_news" />
                Statistiques des anomalies
            </button>
            <button :disabled="currentSection == 'majorFacts'" class="btn"
                :class="{ 'is-active': currentSection == 'majorFacts' }" @click="setCurrentSection('majorFacts')"
                v-if="!is('da')">
                <NLIcon name="brightness_alert" />
                Statistiques des faits majeurs
            </button>
            <button :disabled="currentSection == 'KPI'" class="btn" :class="{ 'is-active': currentSection == 'KPI' }"
                @click="setCurrentSection('KPI')" v-if="is(['dcp', 'cdcr'])">
                <NLIcon name="trophy" />
                KPI
            </button>
        </NLFlex>

        <!-- Suivi de la réalisation des missions -->
        <Missions :onlyCurrentCampaign="false" :currentCampaign="currentCampaign"
            v-if="currentSection == 'missionsStates' && can('view_control_campaign')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" />


        <!-- Scores -->
        <Scores :onlyCurrentCampaign="false" :currentCampaign="currentCampaign"
            v-if="currentSection == 'scores' && can('view_control_campaign')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG"
            :horizontalBarOptions="horizontalBarOptions" />

        <!-- Anomalies -->
        <Anomalies :onlyCurrentCampaign="false" :currentCampaign="currentCampaign"
            v-if="currentSection == 'anomalies' && can('view_control_campaign')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG" />

        <!-- Major facts -->
        <MajorFacts :onlyCurrentCampaign="false" :currentCampaign="currentCampaign"
            v-if="currentSection == 'majorFacts' && can('view_control_campaign')" :userRole="userRole"
            :circularChartOptions="circularChartOptions" @savePNG="savePNG"
            :horizontalBarOptions="horizontalBarOptions" />

        <!-- KPI -->
        <KPI v-if="currentSection == 'KPI' && !is('da')" :userRole="userRole" @savePNG="savePNG" />
    </ContentBody>
</template>

<script>
import Anomalies from '~/pages/dashboard/agencies/Anomalies'
import MajorFacts from '~/pages/dashboard/agencies/MajorFacts'
import Scores from '~/pages/dashboard/agencies/Scores'
import Missions from '~/pages/dashboard/agencies/Missions'
import KPI from '~/pages/dashboard/agencies/KPI'
import { user } from '~/plugins/user'
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
        this.setCurrentSection('missionsStates')
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
