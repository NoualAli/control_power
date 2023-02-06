import api from "../../plugins/api"

export const state = {
  total_unread_major_facts: 0,
  all: null,
  paginated: null,
}

export const mutations = {
  SET_TOTAL_UNREAD_MAJOR_FACTS(state, total_unread_major_facts) {
    state.total_unread_major_facts = total_unread_major_facts
  },
  FETCH_ALL(state, data) {
    state.all = data
  },
  FETCH_PAGINATED(state, data) {
    state.paginated = data
  },
}

export const actions = {
  async fetchAll({ commit }) {
    const { data } = await api.get('notifications?fetchAll')
    commit('FETCH_ALL', { all: data })
  },
  async fetchPaginated({ commit }) {
    const { data } = await api.get('notifications')
    commit('FETCH_PAGINATED', { paginated: data })
  },
  async fetchTotalUnreadMajorFacts({ commit }) {
    const { data } = await api.get('notifications/total-unread-major-facts')
    commit('SET_TOTAL_UNREAD_MAJOR_FACTS', { total_unread_major_facts: data })
  },
  async readMajorFacts({ commit }) {
    const { data } = await api.post('notifications/read-major-facts')
    commit('SET_TOTAL_UNREAD_MAJOR_FACTS', { total_unread_major_facts: 0 })
  }
}

export const getters = {
  total_unread_major_facts: state => state.total_unread_major_facts,
  all: state => state.all,
  paginated: state => state.paginated,
  current: state => state.current
}
