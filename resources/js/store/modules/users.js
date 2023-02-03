import api from "../../plugins/api"

export const state = {
  all: null,
  paginated: null,
  current: null,
  message: null
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
}

export const actions = {
  async fetchAll({ commit }) {
    const { data } = await api.get('users?fetchAll')
    commit('FETCH_ALL', { all: data })
  },
  async fetchByDre({ commit }, dreId) {
    const { data } = await api.get('users?dre_id=' + dreId)
    commit('FETCH_ALL', { all: data })
  },
  async fetchPaginated({ commit }) {
    const { data } = await api.get('users')
    commit('FETCH_PAGINATED', { paginated: data })
  },
  async fetch({ commit }, id) {
    try {
      const { data } = await api.get('users/' + id)
      commit('FETCH', { current: data })
    } catch (error) {

    }
  },
}

export const getters = {
  all: state => state.all,
  paginated: state => state.paginated,
  current: state => state.current
}

