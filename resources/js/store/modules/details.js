import api from "../../plugins/api"

export const state = {
  all: null,
  paginated: null,
  current: null,
  config: null,
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
  FETCH_CONFIG(state, data) {
    state.config = data
  },
}

export const actions = {
  async fetchAll({ commit }) {
    const { data } = await api.get('missions?fetchAll')
    commit('FETCH_ALL', { all: data })
  },
  async fetchPaginated({ commit }, missionId = null) {
    const url = missionId ? 'missions?campaign_id=' + missionId : 'missions'
    const { data } = await api.get(url)
    commit('FETCH_PAGINATED', { paginated: data })
  },
  async fetch({ commit }, { missionId, onlyProcesses = false, edit = false }) {
    try {
      let url = onlyProcesses ? 'missions/' + missionId + '?onlyProcesses' : 'missions/' + missionId
      url += edit ? '?edit' : ''
      const { data } = await api.get(url)
      if (onlyProcesses) {
        commit('FETCH_PROCESSES', { processes: data })
      } else {
        commit('FETCH', { current: data })
      }
    } catch (error) {

    }
  },
  async fetchConfig({ commit }, { missionId = null, processId = null }) {
    try {
      const url = 'missions/details/concerns/config?mission_id=' + missionId + '&process_id=' + processId
      const { data } = await api.get(url)
      commit('FETCH_CONFIG', { config: data })
    } catch (error) {

    }
  },
}

export const getters = {
  all: state => state.all,
  paginated: state => state.paginated,
  current: state => state.current,
  config: state => state.config,
}
