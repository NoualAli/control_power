import api from "../../plugins/api"

export const state = {
  data: null,
}

export const mutations = {
  FETCH_DATA(state, data) {
    state.data = data
  },
}

export const actions = {
  async fetchData({ commit }) {
    const { data } = await api.get('/statistics/dashboard')
    commit('FETCH_DATA', { data: data })
  },
}

export const getters = {
  data: state => state.data
}
