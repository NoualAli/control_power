import store from '~/store'

export default (to, from, next) => {
  alert("alert guest")

  if (store.getters['auth/check']) {
    next({ name: 'home' })
  } else {
    next()
  }
}
