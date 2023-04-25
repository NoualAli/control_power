import api from '../../plugins/api'

export const state = {
  all: null,
  paginated: null,
  current: null,
  processes: [],
  plannings: [],
  samples: [],
  details: [],
  nextReference: null
}

export const mutations = {
  FETCH_ALL (state, data) {
    state.all = data
  },
  FETCH_PAGINATED (state, data) {
    state.paginated = data
  },
  FETCH (state, data) {
    state.current = data
  },
  FETCH_PROCESSES (state, data) {
    state.processes = data
  },
  FETCH_PLANNINGS (state, data) {
    state.plannings = data
  },
  FETCh_SAMPLES (state, data) {
    state.samples = data
  },
  FETCH_SAMPLE_DETAILS (state, data) {
    state.details = data
  },
  FETCH_NEXT_REFERENCE (state, data) {
    state.nextReference = data
  }
}

export const actions = {
  async fetchAll ({ commit }) {
    const { data } = await api.get('campaigns?fetchAll')
    commit('FETCH_ALL', { all: data })
  },
  async fetchPaginated ({ commit }) {
    const { data } = await api.get('campaigns')
    commit('FETCH_PAGINATED', { paginated: data })
  },
  async fetchCurrent ({ commit }) {
    const { data } = await api.get('campaigns/current')
    commit('FETCH_CURRENT', { current: data })
    return Promise.resolve()
  },
  async fetch ({ commit }, { campaignId, edit = false }) {
    try {
      const url = edit ? 'campaigns/' + campaignId + '?edit' : 'campaigns/' + campaignId
      const { data } = await api.get(url)
      commit('FETCH', { current: data })
      return Promise.resolve(data)
    } catch (error) {

    }
  },
  async fetchProcesses ({ commit }, id) {
    try {
      const { data } = await api.get('campaigns/processes/' + id)
      commit('FETCH_PROCESSES', { processes: data })
    } catch (error) {

    }
  },
  async fetchPlannings ({ commit }, campaignId) {
    const { data } = await api.get('campaigns/' + campaignId + '/plannings')
    commit('FETCH_PLANNINGS', { plannings: data })
  },
  async fetchAllPlannings ({ commit }, campaignId) {
    const { data } = await api.get('campaigns/' + campaignId + '/plannings?fetchAll')
    commit('FETCH_PLANNINGS', { plannings: data })
  },
  async fetchSamples ({ commit }, { campaignId, agencyId }) {
    const { data } = await api.get('campaigns/' + campaignId + '/agency/' + agencyId)
    commit('FETCh_SAMPLES', { samples: data })
  },
  async fetchSampleDetails ({ commit }, { sampleId }) {
    const { data } = await api.get('campaigns/sample/' + sampleId + '/details')
    commit('FETCh_SAMPLE_DETAILS', { details: data })
  },
  async fetchNextReference ({ commit }) {
    try {
      const { data } = await api.get('campaigns/next-reference')
      commit('FETCH_NEXT_REFERENCE', { nextReference: data })
    } catch (error) {
    }
  },
  async filter ({ commit }, filters) {
    let url = 'campaigns'
    let queryString = ''
    let sign = '?'

    let i = 0
    for (const key in filters) {
      if (Object.hasOwnProperty.call(filters, key)) {
        const value = filters[key]
        if (value !== null && value !== 'null') {
          sign = i > 0 ? '&' : '?'
          queryString += sign + 'filter[' + key + ']=' + value
          i += 1
        }
      }
    }
    url += queryString
    const { data } = await api.get(url)
    commit('FETCH_PAGINATED', { paginated: data })
  }
}

export const getters = {
  all: state => state.all,
  paginated: state => state.paginated,
  current: state => state.current,
  processes: state => state.processes,
  plannings: state => state.plannings,
  samples: state => state.samples,
  details: state => state.details,
  nextReference: state => state.nextReference
}
