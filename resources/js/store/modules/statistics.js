import api from "../../plugins/api"

export const state = {
  missions_state: null,
  missions_percentage: null,

  // ANOMALIES
  dres_anomalies: null,
  agencies_anomalies: null,
  famillies_anomalies: null,
  domains_anomalies: null,
  processes_anomalies: null,
  missions_anomalies: null,
  campaigns_anomalies: null,
  score_anomalies: null,

  // MAJOR FACTS
  dres_major_facts: null,
  agencies_major_facts: null,
  famillies_major_facts: null,
  domains_major_facts: null,
  processes_major_facts: null,
  missions_major_facts: null,
  campaigns_major_facts: null,
}

export const mutations = {
  FETCH_MISSIONS_STATE(state, data) {
    state.missions_state = data
  },
  FETCH_MISSIONS_PERCENTAGE(state, data) {
    state.missions_percentage = data
  },

  // ANOMALIES
  FETCH_DRES_ANOMALIES(state, data) {
    state.dres_anomalies = data
  },
  FETCH_AGENCIES_ANOMALIES(state, data) {
    state.agencies_anomalies = data
  },
  FETCH_FAMILLIES_ANOMALIES(state, data) {
    state.famillies_anomalies = data
  },
  FETCH_DOMAINS_ANOMALIES(state, data) {
    state.domains_anomalies = data
  },
  FETCH_PROCESSES_ANOMALIES(state, data) {
    state.processes_anomalies = data
  },
  FETCH_MISSIONS_ANOMALIES(state, data) {
    state.missions_anomalies = data
  },
  FETCH_CAMPAIGNS_ANOMALIES(state, data) {
    state.campaigns_anomalies = data
  },
  FETCH_SCORE_ANOMALIES(state, data) {
    state.score_anomalies = data
  },

  // MAJOR FACTS
  FETCH_DRES_MAJOR_FACTS(state, data) {
    state.dres_major_facts = data
  },
  FETCH_AGENCIES_MAJOR_FACTS(state, data) {
    state.agencies_major_facts = data
  },
  FETCH_FAMILLIES_MAJOR_FACTS(state, data) {
    state.famillies_major_facts = data
  },
  FETCH_DOMAINS_MAJOR_FACTS(state, data) {
    state.domains_major_facts = data
  },
  FETCH_PROCESSES_MAJOR_FACTS(state, data) {
    state.processes_major_facts = data
  },
  FETCH_MISSIONS_MAJOR_FACTS(state, data) {
    state.missions_major_facts = data
  },
  FETCH_CAMPAIGNS_MAJOR_FACTS(state, data) {
    state.campaigns_major_facts = data
  },
}

export const actions = {
  async fetchMissionsState({ commit }) {
    const { data } = await api.get('/api/statistics/missions_state')
    commit('FETCH_MISSIONS_STATE', { missions_state: data })
  },
  async fetchMissionsPercentage({ commit }) {
    const { data } = await api.get('/api/statistics/missions_percentage')
    commit('FETCH_MISSIONS_PERCENTAGE', { missions_percentage: data })
  },

  // ANOMALIES
  async fetchDresAnomalies({ commit }) {
    const { data } = await api.get('/api/statistics/anomalies/dres')
    commit('FETCH_DRES_ANOMALIES', { dres_anomalies: data })
  },
  async fetchAgenciesAnomalies({ commit }) {
    const { data } = await api.get('/api/statistics/anomalies/agencies')
    commit('FETCH_AGENCIES_ANOMALIES', { agencies_anomalies: data })
  },
  async fetchFamilliesAnomalies({ commit }) {
    const { data } = await api.get('/api/statistics/anomalies/famillies')
    commit('FETCH_FAMILLIES_ANOMALIES', { famillies_anomalies: data })
  },
  async fetchDomainsAnomalies({ commit }) {
    const { data } = await api.get('/api/statistics/anomalies/domains')
    commit('FETCH_DOMAINS_ANOMALIES', { domains_anomalies: data })
  },
  async fetchProcessesAnomalies({ commit }) {
    const { data } = await api.get('/api/statistics/anomalies/processes')
    commit('FETCH_PROCESSES_ANOMALIES', { processes_anomalies: data })
  },
  async fetchMissionsAnomalies({ commit }) {
    const { data } = await api.get('/api/statistics/anomalies/missions')
    commit('FETCH_MISSIONS_ANOMALIES', { missions_anomalies: data })
  },
  async fetchCampaignsAnomalies({ commit }) {
    const { data } = await api.get('/api/statistics/anomalies/campaigns')
    commit('FETCH_CAMPAIGNS_ANOMALIES', { campaigns_anomalies: data })
  },
  async fetchScoreAnomalies({ commit }) {
    const { data } = await api.get('/api/statistics/anomalies/score')
    commit('FETCH_SCORE_ANOMALIES', { score_anomalies: data })
  },

  // Major Facts
  async fetchDresMajorFacts({ commit }) {
    const { data } = await api.get('/api/statistics/major-facts/dres')
    commit('FETCH_DRES_MAJOR_FACTS', { dres_major_facts: data })
  },
  async fetchAgenciesMajorFacts({ commit }) {
    const { data } = await api.get('/api/statistics/major-facts/agencies')
    commit('FETCH_AGENCIES_MAJOR_FACTS', { agencies_major_facts: data })
  },
  async fetchFamilliesMajorFacts({ commit }) {
    const { data } = await api.get('/api/statistics/major-facts/famillies')
    commit('FETCH_FAMILLIES_MAJOR_FACTS', { famillies_major_facts: data })
  },
  async fetchDomainsMajorFacts({ commit }) {
    const { data } = await api.get('/api/statistics/major-facts/domains')
    commit('FETCH_DOMAINS_MAJOR_FACTS', { domains_major_facts: data })
  },
  async fetchProcessesMajorFacts({ commit }) {
    const { data } = await api.get('/api/statistics/major-facts/processes')
    commit('FETCH_PROCESSES_MAJOR_FACTS', { processes_major_facts: data })
  },
  async fetchMissionsMajorFacts({ commit }) {
    const { data } = await api.get('/api/statistics/major-facts/missions')
    commit('FETCH_MISSIONS_MAJOR_FACTS', { missions_major_facts: data })
  },
  async fetchCampaignsMajorFacts({ commit }) {
    const { data } = await api.get('/api/statistics/major-facts/campaigns')
    commit('FETCH_CAMPAIGNS_MAJOR_FACTS', { campaigns_major_facts: data })
  },
}

export const getters = {
  missions_state: state => state.missions_state,
  missions_percentage: state => state.missions_percentage,
  dres_anomalies: state => state.dres_anomalies,
  agencies_anomalies: state => state.agencies_anomalies,
  famillies_anomalies: state => state.famillies_anomalies,
  domains_anomalies: state => state.domains_anomalies,
  processes_anomalies: state => state.processes_anomalies,
  missions_anomalies: state => state.missions_anomalies,
  campaigns_anomalies: state => state.campaigns_anomalies,
  score_anomalies: state => state.score_anomalies,

  dres_major_facts: state => state.dres_major_facts,
  agencies_major_facts: state => state.agencies_major_facts,
  famillies_major_facts: state => state.famillies_major_facts,
  domains_major_facts: state => state.domains_major_facts,
  processes_major_facts: state => state.processes_major_facts,
  missions_major_facts: state => state.missions_major_facts,
  campaigns_major_facts: state => state.campaigns_major_facts,
}
