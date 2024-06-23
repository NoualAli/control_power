import api from '../../plugins/api'

export const state = {
    all: null,
    paginated: null,
    current: null,
    domains: null
}

export const mutations = {
    FETCH_ALL(state, data) {
        state.all = data
    },
    FETCH_PAGINATED(state, data) {
        state.paginated = data
    },
    FETCH(state, data) {
        state.current = data
    },
    FETCH_DOMAINS(state, data) {
        state.domains = data
    }
}

export const actions = {
    async fetchAll({ commit }, { withChildren = true, usableForAgencies = true, usableForDres = false }) {
        let url = 'families?fetchAll'
        if (withChildren) {
            url += '&withChildren'
        }
        if (usableForAgencies) {
            url += '&usableForAgencies'
        }
        if (usableForDres) {
            url += '&usableForDres'
        }
        const { data } = await api.get(url)
        commit('FETCH_ALL', { all: data })
    },
    async fetchPaginated({ commit }) {
        const { data } = await api.get('families')
        commit('FETCH_PAGINATED', { paginated: data })
    },
    async fetch({ commit }, { id, onlyDomains = false }) {
        try {
            const url = !onlyDomains ? `families/${id}` : `families/${id}?onlyDomains`
            const { data } = await api.get(url)
            if (onlyDomains) {
                commit('FETCH_DOMAINS', { domains: data })
            } else {
                commit('FETCH', { current: data })
            }
        } catch (error) {

        }
    }
}

export const getters = {
    all: state => state.all,
    paginated: state => state.paginated,
    current: state => state.current,
    domains: state => state.domains
}
