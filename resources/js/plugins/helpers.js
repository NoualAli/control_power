import store from '~/store'
export function user() {
  return store.getters[ 'auth/user' ]
}
