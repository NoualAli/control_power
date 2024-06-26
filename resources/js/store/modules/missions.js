import api from '../../plugins/api'

export const state = {
    all: null,
    paginated: null,
    current: null,
    config: null,
    filters: null,
    processes: null,
    detailsConfig: null,
}

export const mutations = {
    FETCH_PAGINATED(state, data) {
        state.paginated = data
    },
    FETCH_ALL(state, data) {
        state.all = data
    },
    FETCH_FILTERS(state, data) {
        state.filters = data
    },
    FETCH(state, data) {
        state.current = data
    },
    FETCH_DETAILS(state, data) {
        state.detailsConfig = data
    },
    FETCH_PROCESSES(state, data) {
        state.processes = data
    },
    FETCH_CONFIG(state, data) {
        state.config = data
    }
}

export const actions = {

    async fetchAll({ commit }) {
        const { data } = await api.get('missions?fetchAll')
        commit('FETCH_ALL', { all: data })
    },
    async fetchPaginated({ commit }, campaignId = null) {
        const url = campaignId ? 'missions?campaign_id=' + campaignId : 'missions'
        const { data } = await api.get(url)
        commit('FETCH_PAGINATED', { paginated: data })
    },
    async fetch({ commit }, { missionId, onlyProcesses = false, edit = false }) {
        try {
            let url = onlyProcesses ? 'missions/' + missionId + '?onlyProcesses' : 'missions/' + missionId
            url += edit ? '?edit' : ''
            const { data } = await api.get(url)
            if (onlyProcesses) {
                console.log(data)
                commit('FETCH_PROCESSES', { processes: data })
            } else {
                commit('FETCH', { current: data })
            }
        } catch (error) {

        }
    },
    async fetchConfig({ commit }, campaignId = null) {
        try {
            const url = campaignId !== null && campaignId !== undefined && campaignId !== '' ? 'missions/concerns/config?campaign_id=' + campaignId : 'missions/concerns/config'
            const { data } = await api.get(url)
            commit('FETCH_CONFIG', { config: data })
        } catch (error) {

        }
    },
    async fetchDetails({ commit }, { missionId, processId }) {
        const url = 'missions/' + missionId + '/details/' + processId
        try {
            const { data } = await api.get(url)
            commit('FETCH_DETAILS', { detailsConfig: data })
        } catch (error) {
            console.error(error);
        }
    }
}

export const getters = {
    all: state => state.all,
    paginated: state => state.paginated,
    current: state => state.current,
    config: state => state.config,
    processes: state => state.processes,
    filters: state => state.filters,
    detailsConfig: state => state.detailsConfig,
}
