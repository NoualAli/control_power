import store from '~/store'
import Cookies from 'js-cookie'

export default async (to, from, next) => {
  const isAuthenticated = store.getters[ 'auth/check' ]
  const user = JSON.parse(localStorage.getItem('user'))
  if (!isAuthenticated) {
    Cookies.set('intended_url', to.path)

    next({ name: 'login' })
  } else {
    // await store.dispatch('notifications/fetchTotalUnreadMajorFacts')
    // await store.dispatch('notifications/fetchUnreadNotifications')
    if (user?.must_change_password) {
      next({ name: 'password.new' })
    } else {
      next()
    }
  }
}
