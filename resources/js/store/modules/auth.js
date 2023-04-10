import api from '../../plugins/api'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = {
  user: null,
  token: Cookies.get('token')
}

// getters
export const getters = {
  user: state => state.user,
  token: state => state.token,
  check: state => state.user !== null
}

// mutations
export const mutations = {
  [types.SAVE_TOKEN] (state, { token, remember }) {
    state.token = token
    console.log('mutation')
    console.log(state.token)
    Cookies.set('token', token, { expires: remember ? 365 : null })
  },

  [types.FETCH_USER_SUCCESS] (state, { user }) {
    state.user = user
  },

  [types.FETCH_USER_FAILURE] (state) {
    state.token = null
    Cookies.remove('token')
  },

  [types.LOGOUT] (state) {
    state.user = null
    state.token = null

    Cookies.remove('token')
  },

  [types.UPDATE_USER] (state, { user }) {
    state.user = user
  }
}

// actions
export const actions = {
  saveToken ({ commit, dispatch }, payload) {
    console.log('action')
    console.log(payload)
    commit(types.SAVE_TOKEN, payload)
  },

  async fetchUser ({ commit }) {
    try {
      const { data } = await api.get('user')
      // console.log(data)
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
      commit(types.FETCH_USER_SUCCESS, { user: data })
    } catch (e) {
      console.error(e)
      commit(types.FETCH_USER_FAILURE)
    }
  },

  updateUser ({ commit }, payload) {
    commit(types.UPDATE_USER, payload)
  },

  async logout ({ commit }) {
    try {
      await api.post('logout').then(() => {
        localStorage.removeItem('permissions')
        localStorage.removeItem('roles')
      })
    } catch (e) { }

    commit(types.LOGOUT)
  }
}
