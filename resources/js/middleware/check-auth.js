// import store from '~/store'

// export default async (to, from, next) => {
//   if (!store.getters['auth/check'] && store.getters['auth/token']) {
//     try {
//       await store.dispatch('auth/fetchUser')
//     } catch (e) {
//       return next({ name: 'login' })
//     }
//   } else if (!store.getters['auth/token'] && !store.getters['auth/check']) {
//     if (to.path !== '/login') {
//       return next({ name: 'login' })
//     }
//   }

//   next()
// }

import store from '~/store'

export default async (to, from, next) => {
  if (!store.getters['auth/check'] && store.getters['auth/token']) {
    try {
      // alert('alert check fetch user')
      await store.dispatch('auth/fetchUser')
    } catch (e) {
      console.error(e)
    }
  }
  if (!store.getters['auth/token'] && !store.getters['auth/check']) {
    if (to.path !== '/login') {
      return next({ name: 'login' })
    }
  }
  next()
}
