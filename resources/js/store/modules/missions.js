import api from "../../plugins/api"

export const state = {
  all: null,
  paginated: null,
  current: null,
  config: null,
  filters: null,
  processes: null,
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
  FETCH_PROCESSES(state, data) {
    state.processes = data
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
  async fetchFilters({ commit }, { missionId = null, filters = null } = {}) {
    let url = missionId ? 'missions/' + missionId + '?onlyProcesses&withFilters' : 'missions?onlyProcesses&withFilters'
    if (!missionId) {
      url = 'missions?onlyFilters'
    }
    let family = filters?.family_id?.value ?? ''
    let domain = filters?.domain_id?.value ?? ''
    url += '&filter[family_id]=' + family
    url += '&filter[domain_id]=' + domain
    if (filters?.family_id.value) {
      if (filters?.domain_id.value) {
        // if (filters?.process_id.value) {
        //   url += '&filter[process_id]=' + filters?.process_id.value
        // }
      }
    }
    const { data } = await api.get(url)
    commit('FETCH_FILTERS', { filters: data })
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

  buildFilterUrl(filters, url) {
    if (filters.family_id.value) {
      url += '&filter[family_id]=' + filters.family_id.value
      if (filters.domain_id.value) {
        url += '&filter[domain_id]=' + filters.domain_id.value
        if (filters.process_id.value) {
          url += '&filter[process_id]=' + filters.process_id.value
        }
      }
    }
    return url
  }
}

export const getters = {
  all: state => state.all,
  paginated: state => state.paginated,
  current: state => state.current,
  config: state => state.config,
  processes: state => state.processes,
  filters: state => state.filters
}

