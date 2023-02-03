import api from '../../plugins/api'
export const state = {
  title: null,
  validationRules: null,
}

// getters
export const getters = {
  title: state => state.title,
  validationRules: state => state.validationRules
}

export const mutations = {
  SET_TITLE(state, title) {
    state.title = title
  },
  SET_VALIDATION_RULES(state, validationRules) {
    state.validationRules = validationRules
  }
}


export const actions = {
  setTitle({ commit }, title) {
    commit('SET_TITLE', title)
  },
  async fetchValidationRules({ commit }) {
    const { data } = await api.get('settings/laravel/rules')
    commit('SET_VALIDATION_RULES', { validationRules: data })
  }
}
