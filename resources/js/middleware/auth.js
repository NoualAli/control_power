import store from '~/store'
import Cookies from 'js-cookie'

export default async (to, from, next) => {
    const isAuthenticated = store.getters[ 'auth/check' ]
    const user = JSON.parse(localStorage.getItem('user'))
    if (!isAuthenticated && to.path !== '/login') {
        Cookies.set('intended_url', to.path)
        Cookies.set('intended_url', to)
        next({ name: 'login' })
    } else {
        if (user?.must_change_password) {
            next({ name: 'password.new' })
        } else {
            next()
        }
    }
}
