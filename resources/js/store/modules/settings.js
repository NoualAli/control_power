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
    // const { data } = await api.get('settings/laravel/rules')
    const data = [
      { id: 'nullable', label: 'Facultatif' },
      { id: 'required', label: 'Obligatoire' },
      { id: 'distinct', label: 'Distinct' },
      { id: 'email', label: 'Adresse e-mail' },
      { id: 'integer', label: 'Nombre entier' },
      { id: 'float', label: 'Nombre flottant' },
      { id: 'boolean', label: 'Booléen' },
    ]
    commit('SET_VALIDATION_RULES', { validationRules: data })
  }
}
