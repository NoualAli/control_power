/* eslint-disable camelcase */
import Swal from 'sweetalert2'
import axios from 'axios'
import store from '~/store'
import * as swal from './swal.js'
const api = axios.create({
  headers: {

    'Content-Type': 'application/json',
    Accept: 'application/json'

  },
  baseURL: '/api/'
})
api.interceptors.response.use(response => response, error => {
  const status = error?.response?.status
  const message = error?.response?.data?.message
  const title = status + ' ' + error?.response?.statusText
  if (status === 401 && store.getters['auth/check']) {
    swal.alert_error(message, title)
      .then(() => {
        store.commit('auth/LOGOUT')
        location.reload()
      })
  }
  if (status === 404) {
    window.location.href = '/404'
  }
  if (status === 403 && store.getters['auth/check']) {
    swal.alert_error(message, title)
      .then(() => {
        store.commit('auth/LOGOUT')
        location.reload()
      })
  }

  if (status >= 500) {
    serverError(error.response)
  }
  return Promise.reject(error)
})

let serverErrorModalShown = false
async function serverError (response) {
  if (serverErrorModalShown) {
    return
  }

  if ((response.headers['content-type'] || '').includes('text/html')) {
    const iframe = document.createElement('iframe')

    if (response.data instanceof Blob) {
      iframe.srcdoc = await response.data.text()
    } else {
      iframe.srcdoc = response.data
    }

    Swal.fire({
      html: iframe.outerHTML,
      showConfirmButton: false,
      customClass: { container: 'server-error-modal' },
      didDestroy: () => { serverErrorModalShown = false },
      grow: 'fullscreen',
      padding: 0
    })

    serverErrorModalShown = true
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Quelque chose s\'est mal passé ! Veuillez réessayer.',
      reverseButtons: true,
      confirmButtonText: 'ok',
      cancelButtonText: 'Annuler'
    })
  }
}

api.interceptors.request.use(request => {
  const token = store.getters['auth/token']
  if (token) {
    // eslint-disable-next-line dot-notation
    request.headers['Authorization'] = `Bearer ${token}`
  }

  const locale = store.getters['lang/locale']
  if (locale) {
    request.headers['Accept-Language'] = locale
  }

  // request.headers['X-Socket-Id'] = Echo.socketId()

  return request
})

export default api
