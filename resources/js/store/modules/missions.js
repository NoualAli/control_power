import api from '../../plugins/api'

export const state = {
  all: null,
  paginated: null,
  current: null,
  config: null,
  filters: null,
  processes: null
  // plannings: null,
  // samples: null,
  // details: null,
}

export const mutations = {
  // FETCH_PLANNINGS(state, data) {
  //   state.plannings = data
  // },
  // FETCH_SAMPLES(state, data) {
  //   state.samples = data
  // },
  // FETCH_DETAILS(state, data) {
  //   state.details = data
  // },
  FETCH_PAGINATED (state, data) {
    state.paginated = data
  },
  FETCH_ALL (state, data) {
    state.all = data
  },
  FETCH_FILTERS (state, data) {
    state.filters = data
  },
  FETCH (state, data) {
    state.current = data
  },
  FETCH_PROCESSES (state, data) {
    state.processes = data
  },
  FETCH_CONFIG (state, data) {
    state.config = data
  }
}

export const actions = {

  async fetchAll ({ commit }) {
    const { data } = await api.get('missions?fetchAll')
    commit('FETCH_ALL', { all: data })
  },
  async fetchFilters ({ commit }) {
    const { data } = await api.get('missions?onlyFilters')
    commit('FETCH_FILTERS', { filters: data })
  },
  async fetchPaginated ({ commit }, campaignId = null) {
    const url = campaignId ? 'missions?campaign_id=' + campaignId : 'missions'
    const { data } = await api.get(url)
    commit('FETCH_PAGINATED', { paginated: data })
  },
  async fetch ({ commit }, { missionId, onlyProcesses = false, edit = false }) {
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
  async fetchConfig ({ commit }, campaignId = null) {
    try {
      const url = campaignId !== null && campaignId !== undefined && campaignId !== '' ? 'missions/concerns/config?campaign_id=' + campaignId : 'missions/concerns/config'
      const { data } = await api.get(url)
      commit('FETCH_CONFIG', { config: data })
    } catch (error) {

    }
  }
  // async fetchPlannings({ commit }, state = null) {
  //   let url = '/api/missions?asPlannings'
  //   if (state !== null && state !== '') {
  //     url += `&state=${state}`
  //   }
  //   const { data } = await api.get(url)
  //   commit('FETCH_PLANNINGS', { plannings: data })
  // },
  // async fetchMissionsState({ commit }, state = null) {
  //   let url = '/api/missions/missions_state'
  //   if (state !== null && state !== '') {
  //     url += `&state=${state}`
  //   }
  //   const { data } = await api.get(url)
  //   commit('FETCH_PLANNINGS', { plannings: data })
  // },
  // async fetchMissions({ commit }, state = null) {
  //   let url = '/api/missions'
  //   if (state !== null && state !== '') {
  //     url += `?state=${state}`
  //   }
  //   const { data } = await api.get(url)
  //   commit('FETCH_MISSIONS', { missions: data })
  // },

  // async fetchValidated({ commit }) {
  //   const { data } = await api.get('/api/missions/validated')
  //   commit('FETCH_MISSIONS', { missions: data })
  // },
  // async fetchNotValidated({ commit }) {
  //   const { data } = await api.get('/api/missions/not-validated')
  //   commit('FETCH_MISSIONS', { missions: data })
  // },

  // async fetchCampaignPlannings({ commit }, campaignId) {
  //   const { data } = await api.get('/api/missions/campaign/' + campaignId + '?asPlanning')
  //   commit('FETCH_PLANNINGS', { plannings: data })
  // },
  // async fetchCampaignMissions({ commit }, campaignId) {
  //   const { data } = await api.get('/api/missions/campaign/' + campaignId)
  //   commit('FETCH_MISSIONS', { missions: data })
  // },

  // async fetchAllCampaignPlannings({ commit }, campaignId) {
  //   const { data } = await api.get('/api/missions/campaign/' + campaignId + '?asPlanning&fetchAll')
  //   commit('FETCH_PLANNINGS', { plannings: data })
  // },
  // async fetchAllCampaignMissions({ commit }, campaignId) {
  //   const { data } = await api.get('/api/missions/campaign/' + campaignId + '?fetchAll')
  //   commit('FETCH_MISSIONS', { missions: data })
  // },

  // async fetchSamples({ commit }, missionId) {
  //   const { data } = await api.get('/api/missions/' + missionId + '/samples')
  //   commit('FETCH_SAMPLES', { samples: data })
  // },

  // async fetchMissionDetails({ commit }, missionId) {
  //   const { data } = await api.get('/api/missions/' + missionId + '?details')
  //   commit('FETCH_DETAILS', { details: data })
  // },

  // async fetchSampleDetails({ commit }, { missionId, sampleId }) {
  //   const { data } = await api.get('/api/missions/' + missionId + '/sample/' + sampleId)
  //   commit('FETCH_DETAILS', { details: data })
  // },

  // async filterSampleDetails({ commit }, { missionId, sampleId, filters, routeName }) {
  //   let url = ''
  //   let queryString = ''
  //   let sign = '?'
  //   if (routeName == 'sample-details') {
  //   } else if (routeName == 'mission-details') {
  //     url = '/api/missions/' + missionId + '/sample/' + sampleId
  //     sign = '?'
  //   } else {
  //   }
  //   let i = 0
  //   for (const key in filters) {
  //     if (Object.hasOwnProperty.call(filters, key)) {
  //       const value = filters[ key ];
  //       if (value !== null && value !== 'null') {
  //         if (routeName == 'sample-details') {
  //           sign = '&'
  //         } else if (routeName == 'mission-details') {
  //           sign = '?'
  //         } else {
  //           sign = i > 0 ? '&' : '?'
  //         }
  //         queryString += sign + 'filter[' + key + ']=' + value
  //         i += 1
  //       }
  //     }
  //   }
  //   url += queryString
  //   const { data } = await api.get(url)
  //   commit('FETCH_DETAILS', { details: data })
  // },
}

export const getters = {
  // plannings: state => state.plannings,
  // samples: state => state.samples,
  // details: state => state.details,
  all: state => state.all,
  paginated: state => state.paginated,
  current: state => state.current,
  config: state => state.config,
  processes: state => state.processes,
  filters: state => state.filters
}
