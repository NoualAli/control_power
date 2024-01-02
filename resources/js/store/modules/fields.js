import api from '../../plugins/api'

export const state = {
    all: null,
    paginated: null,
    current: null,
}

export const mutations = {
    FETCH_PAGINATED(state, data) {
        state.paginated = data
    },
    FETCH_ALL(state, data) {
        state.all = data
    },
    FETCH(state, data) {
        state.current = data
    },
}

export const actions = {

    async fetchAll({ commit }) {
        const { data } = await api.get('fields?fetchAll')
        commit('FETCH_ALL', { all: data })
    },
    async fetchPaginated({ commit }, campaignId = null) {
        const url = campaignId ? 'fields?campaign_id=' + campaignId : 'fields'
        const { data } = await api.get(url)
        commit('FETCH_PAGINATED', { paginated: data })
    },
    async fetch({ commit }, fieldId) {
        try {
            let url = 'fields/' + fieldId
            // url += edit ? '?edit' : ''
            const { data } = await api.get(url)
            commit('FETCH', { current: data })
        } catch (error) {

        }
    },
}

export const getters = {
    all: state => state.all,
    paginated: state => state.paginated,
    current: state => state.current,
}
