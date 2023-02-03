import api from "../../plugins/api"

export const state = {
  total_unread_major_facts: 0
}

export const getters = {
  total_unread_major_facts: state => state.total_unread_major_facts
}

export const mutations = {
  SET_TOTAL_UNREAD_MAJOR_FACTS(state, total_unread_major_facts) {
    state.total_unread_major_facts = total_unread_major_facts
  }
}

export const actions = {
  async fetchTotalUnreadMajorFacts({ commit }) {
    const { data } = await api.get('notifications/total-unread-major-facts')
    commit('SET_TOTAL_UNREAD_MAJOR_FACTS', { total_unread_major_facts: data })
  },
  async readMajorFacts({ commit }) {
    const { data } = await api.post('notifications/read-major-facts')
    commit('SET_TOTAL_UNREAD_MAJOR_FACTS', { total_unread_major_facts: 0 })
  }
}
