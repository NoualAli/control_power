import api from "../../plugins/api"

export const state = {
  all: null,
  paginated: null,
  current: null,
  controlPoints: []
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
  FETCH_CONTROL_POINTS(state, data) {
    state.controlPoints = data
  },
}

export const actions = {
  async fetchAll({ commit }) {
    const { data } = await api.get('processes?fetchAll')
    commit('FETCH_ALL', { all: data })
  },
  async fetchPaginated({ commit }) {
    const { data } = await api.get('processes')
    commit('FETCH_PAGINATED', { paginated: data })
  },

  async fetch({ commit }, { id, onlyControlPoints = false }) {
    const url = !onlyControlPoints ? `processes/${id}` : `processes/${id}?onlyControlPoints`
    const { data } = await api.get(url)
    try {
      if (onlyControlPoints) {
        commit('FETCH_CONTROL_POINTS', { controlPoints: data })
      } else {
        commit('FETCH', { current: data })
      }
    } catch (error) {
    }
  },
}

export const getters = {
  all: state => state.all,
  paginated: state => state.paginated,
  current: state => state.current,
  controlPoints: state => state.controlPoints
}
