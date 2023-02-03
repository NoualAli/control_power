import axios from "axios"
import Swal from "sweetalert2"

export const state = {
  pcf: null,
}

export const mutations = {
  FETCH_PCF(state, data) {
    state.pcf = data
  },
  SUCCESS(state, message) {
    Swal.fire({
      icon: 'success',
      title: 'Succès',
      confirmButtonColor: '#0C9AAC',
      text: message.message,
    })
  },
  ERROR(state, message) {
    Swal.fire({
      icon: 'error',
      title: 'Erreur',
      text: message.message,
    })
  }
}

export const actions = {
  async fetchPCF({ commit }) {
    const { data } = await axios.get('/api/references/pcf')
    commit('FETCH_PCF', { pcf: data })
  },
  async filterPCF({ commit }, { famillyId, domainId, process }) {
    let queryString = ''
    if (famillyId) {
      queryString = '?filter[familly_id]=' + famillyId
      if (domainId) {
        queryString += '&filter[domain_id]=' + domainId
        if (process) {
          queryString += '&filter[process_id]=' + process
        }
      }
    }
    const { data } = await axios.get('/api/references/pcf' + queryString)
    commit('FETCH_PCF', { pcf: data })
  },
}

export const getters = {
  pcf: state => state.pcf,
}

