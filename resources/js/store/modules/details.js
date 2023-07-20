import api from "../../plugins/api"

export const state = {
    all: null,
    paginated: null,
    detail: null,
    config: null,
    global: null,
    majorFacts: null,
    flters: null,
}

export const mutations = {
    FETCH_PAGINATED(state, data) {
        state.paginated = data
    },
    FETCH_ALL(state, data) {
        state.all = data
    },
    FETCH(state, data) {
        state.detail = data
    },
    FETCH_CONFIG(state, data) {
        state.config = data
    },
    FETCH_GLOBAL(state, data) {
        state.global = data
    },
    FETCH_MAJOR_FACTS(state, data) {
        state.majorFacts = data
    },
    FETCH_FILTERS(state, data) {
        state.filters = data
    }
}

export const actions = {
    async fetch({ commit }, detailId) {
        try {
            const { data } = await api.get('missions/details/' + detailId)
            commit('FETCH', { detail: data })
        } catch (error) {
            console.error(error);
        }
    },
    async fetchConfig({ commit }, { missionId = null, processId = null, detailId = null }) {
        try {
            let url = 'missions/details/concerns/config?mission_id=' + missionId + '&process_id=' + processId
            if (detailId) {
                url += '&detail_id=' + detailId
            }
            const { data } = await api.get(url)
            commit('FETCH_CONFIG', { config: data })
        } catch (error) {
            console.error(error);
        }
    },
    async fetchFilters({ commit }) {
        try {
            let url = 'details/concerns/filters'
            const { data } = await api.get(url)
            commit('FETCH_FILTERS', { filters: data })
        } catch (error) {
            console.error(error);
        }
    },
    async fetchGlobal({ commit }) {
        try {
            const { data } = await api.get('details')
            commit('FETCH_GLOBAL', { global: data })
        } catch (error) {
            console.error(error);
        }
    },
    async fetchMajorFacts({ commit }) {
        try {
            const { data } = await api.get('details/major-facts')
            commit('FETCH_MAJOR_FACTS', { majorFacts: data })
        } catch (error) {
            console.error(error);
        }
    }
}

export const getters = {
    all: state => state.all,
    paginated: state => state.paginated,
    detail: state => state.detail,
    config: state => state.config,
    global: state => state.global,
    majorFacts: state => state.majorFacts,
    filters: state => state.filters,
}
