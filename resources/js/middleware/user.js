import store from '~/store'

export default (to, from, next) => {
  let role = store.getters['auth/user'].role_name
  if (role !== 'user') {
    next({ name: 'home' })
  } else {
    next()
  }
}
