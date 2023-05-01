export const state = {
  pcf: null,
  filters: null
}

export const mutations = {
  FETCH_PCF (state, data) {
    state.pcf = data
  },
  FETCH_FILTERS_DATA (state, data) {
    state.filters = data
  }
}

export const actions = {
  async fetchPCF ({ commit }, onlyFiltersData = false) {
    const url = onlyFiltersData ? 'references/pcf?onlyFiltersData' : 'references/pcf'
    const { data } = await this.$api.get(url)
    if (onlyFiltersData) {
      commit('FETCH_FILTERS_DATA', { filters: data })
    } else {
      commit('FETCH_PCF', { pcf: data })
    }
  }
}

export const getters = {
  pcf: state => state.pcf,
  filters: state => state.filters
}
