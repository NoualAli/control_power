import { hasRole } from '../plugins/user'

export default (to, from, next, status) => {
  if (hasRole(['root', 'admin'])) {
    alert('alert admin  redirect to next ')

    next()
  } else {
    alert('alert admin  redirect to home ')

    next({ name: 'home' })
  }
}
