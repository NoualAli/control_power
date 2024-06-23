import api from "../../plugins/api"

export const state = {
  all: null,
  paginated: null,
  current: null,
  processes: []
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
  FETCH_PROCESSES(state, data) {
    state.processes = data
  },
}

export const actions = {
  async fetchAll({ commit }) {
    const { data } = await api.get('domains?fetchAll')
    commit('FETCH_ALL', { all: data })
  },
  async fetchPaginated({ commit }) {
    const { data } = await api.get('domains')
    commit('FETCH_PAGINATED', { paginated: data })
  },
  async fetch({ commit }, { id, onlyProcesses = false }) {
    const url = !onlyProcesses ? `domains/${id}` : `domains/${id}?onlyProcesses`
    const { data } = await api.get(url)
    if (onlyProcesses) {
      commit('FETCH_PROCESSES', { processes: data })
    } else {
      commit('FETCH', { current: data })
    }
  },
}

export const getters = {
  all: state => state.all,
  paginated: state => state.paginated,
  current: state => state.current,
  processes: state => state.processes
}
