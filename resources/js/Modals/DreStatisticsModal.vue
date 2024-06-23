<template>
    <NLModal :show="show" @close="close" :isLoading="isLoading">
        <template #title>
            Statistiques {{ dre }}
        </template>

        <template #default>
            <table class="box">
                <thead>
                    <tr>
                        <th class="text-left">Mission</th>
                        <th class="text-left">Agence</th>
                        <th class="text-center">Nombres d'anomalies</th>
                        <th class="text-center">Nombre de régularisations</th>
                        <th class="text-center">Taux de régularisation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="mission in missionsStates" :key="mission.m_id">
                        <td class="text-left">
                            <a target="_blank" :href="'agency-level/missions/' + mission.m_id">
                                {{ mission.reference }}
                            </a>
                        </td>
                        <td class="text-left">{{ mission.agency }}</td>
                        <td class="text-center">{{ mission.total_anomalies }}</td>
                        <td class="text-center">{{ mission.total_regularized }}</td>
                        <td class="text-center">{{ parseInt(mission.regularization_rate) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-bold">
                            Total
                        </td>
                        <td class="text-center text-bold">{{ totalAnomalies }}</td>
                        <td class="text-center text-bold">{{ totalRegularized }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </template>
    </NLModal>
</template>

<script>
export default {
    name: 'DreStatisticsModal',
    emits: [ 'close' ],
    props: {
        dre: { type: [ String, null ], required: true },
        campaign: { type: [ String, null ], required: true },
        show: { type: Boolean, required: true },
    },
    watch: {
        show(newValue, oldValue) {
            if (newValue && newValue !== oldValue) {
                this.initData()
            } else {
                this.currentDre = null
                this.currentCampaign = null,
                    this.isLoading = false
            }
        }
    },
    data() {
        return {
            isLoading: false,
            missionsStates: null,
            totalAnomalies: 0,
            totalRegularized: 0,
        }
    },
    methods: {
        /**
         *  Initialize data
         */
        initData() {
            this.isLoading = true
            if (this.campaign && this.dre && this.isLoading) {
                this.$alapi.get(`statistics/${this.campaign}/dre-statistics/${this.dre}`).then((response) => {
                    this.missionsStates = response.data.missionsStates
                    this.totalAnomalies = this.missionsStates.reduce((total, current) => {
                        return total + parseInt(current.total_anomalies);
                    }, 0)
                    this.totalRegularized = this.missionsStates.reduce((total, current) => {
                        return total + parseInt(current.total_regularized);
                    }, 0)
                    this.isLoading = false
                }).catch(error => {
                    this.isLoading = false
                    this.$swal.catchError(error)
                })
            }
        },

        /**
         * Close actual modal
         */
        close(forceReload = false) {
            this.currentCampaign = null
            this.currentDre = null
            this.isLoading = false
            this.$emit('close', forceReload)
        },
    }
}
</script>
