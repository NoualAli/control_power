import api from '../../plugins/api'
import Cookies from 'js-cookie'

// state
export const state = {
  user: null,
  logins: null,
  token: Cookies.get('token')
}

// getters
export const getters = {
  user: state => state.user,
  token: state => state.token,
  check: state => state.user !== null,
  logins: state => state.logins
}

// mutations
export const mutations = {
  SAVE_TOKEN (state, { token, remember }) {
    state.token = token
    Cookies.set('token', token, { expires: remember ? 365 : null })
  },

  FETCH_USER_SUCCESS (state, { user }) {
    state.user = user
  },

  FETCH_USER_FAILURE (state) {
    state.token = null
    Cookies.remove('token')
  },

  LOGOUT (state) {
    state.user = null
    state.token = null

    Cookies.remove('token')
  },

  UPDATE_USER (state, { user }) {
    state.user = user
  },

  FETCH_LOGINS (state, { logins }) {
    state.logins = logins
  }
}

// actions
export const actions = {
  saveToken ({ commit, dispatch }, payload) {
    commit('SAVE_TOKEN', payload)
  },

  async fetchUser ({ commit }) {
    try {
      const { data } = await api.get('user')
      const user = { ...data }
      delete user.roles
      delete user.roles_str
      delete user.dres
      delete user.dres_str
      localStorage.setItem('user', JSON.stringify(user))
      localStorage.setItem('roles', JSON.stringify(data.roles.map(role => role.code)))
      localStorage.setItem('permissions', JSON.stringify(data.roles.map(role => role.permissions.map(permission => permission.name))[0]))
      localStorage.setItem('dres', JSON.stringify(data.dres.map(dre => dre.full_name)))
      localStorage.setItem('agencies', JSON.stringify(data.dres?.map(dre => dre.agencies?.map(agency => agency.full_name))[0]))
      commit('FETCH_USER_SUCCESS', { user: data })
    } catch (e) {
      console.error(e)
      commit('FETCH_USER_FAILURE')
    }
  },

  async fetchCurrentUserLogins ({ commit }) {
    try {
      const { data } = await api.get('users/logins/history')
      commit('FETCH_LOGINS', { logins: data })
    } catch (e) {
      console.error(e)

      this.$swal.alert_error()
    }
  },

  updateUser ({ commit }, payload) {
    commit('UPDATE_USER', payload)
  },

  async logout ({ commit }) {
    try {
      await api.post('logout').then(() => {
        localStorage.removeItem('permissions')
        localStorage.removeItem('roles')
      })
    } catch (e) { }

    commit('LOGOUT')
  }
}
