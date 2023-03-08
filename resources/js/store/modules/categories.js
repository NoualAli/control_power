import api from "../../plugins/api"

export const state = {
  all: null,
  paginated: null,
  current: null,
  config: null,
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
  FETCH_CONFIG(state, data) {
    state.config = data
  },
}

export const actions = {
  async fetchAll({ commit }) {
    const { data } = await api.get('categories?fetchAll')
    commit('FETCH_ALL', { all: data })
  },
  async fetchPaginated({ commit }) {
    const { data } = await api.get('categories')
    commit('FETCH_PAGINATED', { paginated: data })
  },
  async fetch({ commit }, id) {
    try {
      const { data } = await api.get('categories/' + id)
      commit('FETCH', { current: data })
    } catch (error) {

    }
  },
  async fetchConfig({ commit }, id = null) {
    try {
      const url = id ? 'categories/concerns/config?category_id=' + id : 'categories/concerns/config'
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
  config: state => state.config
}
