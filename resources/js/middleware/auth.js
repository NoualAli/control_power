import store from '~/store'
import Cookies from 'js-cookie'

export default async (to, from, next) => {
  if (!store.getters['auth/check'] && to.path !== '/login') {
    Cookies.set('intended_url', to)
    next({ name: 'login' })
  } else {
    // await store.dispatch('notifications/fetchTotalUnreadMajorFacts')
    // await store.dispatch('notifications/fetchUnreadNotifications')
    next()
  }
}
