import api from '../../plugins/api'

export const state = {
    anomalies: null,
    majorFacts: null,
    regularizations: null,
    scores: null,
    missionsStates: null,
    KPI: null,
}

export const mutations = {
    FETCH_ANOMALIES(state, data) {
        state.anomalies = data
    },
    FETCH_MAJOR_FACTS(state, data) {
        state.majorFacts = data
    },
    FETCH_REGULARIZATIONS(state, data) {
        state.regularizations = data
    },
    FETCH_SCORES(state, data) {
        state.scores = data
    },
    FETCH_KPI(state, data) {
        state.KPI = data
    },
    FETCH_MISSIONS_STATES(state, data) {
        state.missionsStates = data
    }
}

export const actions = {
    async fetchAnomalies({ commit }, { onlyCurrentCampaign = false, currentCampaign = null }) {
        let url = '/statistics/anomalies'
        if (onlyCurrentCampaign && !currentCampaign) {
            url += '?onlyCurrentCampaign'
        }

        if (currentCampaign && !onlyCurrentCampaign) {
            url += '?campaign=' + currentCampaign
        }
        const { data } = await api.get(url)
        commit('FETCH_ANOMALIES', { data })
    },
    async fetchKPI({ commit }, { onlyCurrentCampaign = false, currentCampaign = null }) {
        let url = '/statistics/kpi/v1'
        if (onlyCurrentCampaign && !currentCampaign) {
            url += '?onlyCurrentCampaign'
        }

        if (currentCampaign && !onlyCurrentCampaign) {
            url += '?campaign=' + currentCampaign
        }
        const { data } = await api.get(url)
        commit('FETCH_KPI', { data })
    },
    async fetchMajorFacts({ commit }, { onlyCurrentCampaign = false, currentCampaign = null }) {
        let url = '/statistics/major-facts'
        if (onlyCurrentCampaign && !currentCampaign) {
            url += '?onlyCurrentCampaign'
        }

        if (currentCampaign && !onlyCurrentCampaign) {
            url += '?campaign=' + currentCampaign
        }
        const { data } = await api.get(url)
        commit('FETCH_MAJOR_FACTS', { data })
    },
    async fetchRegularizations({ commit }, { onlyCurrentCampaign = false, currentCampaign = null }) {
        let url = '/statistics/regularizations'
        if (onlyCurrentCampaign && !currentCampaign) {
            url += '?onlyCurrentCampaign'
        }

        if (currentCampaign && !onlyCurrentCampaign) {
            url += '?campaign=' + currentCampaign
        }
        const { data } = await api.get(url)
        commit('FETCH_REGULARIZATIONS', { data })
    },
    async fetchScores({ commit }, { onlyCurrentCampaign = false, currentCampaign = null }) {
        let url = '/statistics/scores'
        if (onlyCurrentCampaign && !currentCampaign) {
            url += '?onlyCurrentCampaign'
        }

        if (currentCampaign && !onlyCurrentCampaign) {
            url += '?campaign=' + currentCampaign
        }

        const { data } = await api.get(url)
        commit('FETCH_SCORES', { data })
    },
    async fetchMissionsStates({ commit }, { onlyCurrentCampaign = false, currentCampaign = null }) {
        let url = '/statistics/missions-states'
        if (onlyCurrentCampaign && !currentCampaign) {
            url += '?onlyCurrentCampaign'
        }

        if (currentCampaign && !onlyCurrentCampaign) {
            url += '?campaign=' + currentCampaign
        }
        const { data } = await api.get(url)
        commit('FETCH_MISSIONS_STATES', { data })
    }
}

export const getters = {
    anomalies: state => state.anomalies,
    majorFacts: state => state.majorFacts,
    regularizations: state => state.regularizations,
    scores: state => state.scores,
    missionsStates: state => state.missionsStates,
    KPI: state => state.KPI
}
