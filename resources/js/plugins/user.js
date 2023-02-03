import store from '~/store'

export function hasRole(roles = String | Array, status) {
  let userRoles = status ? status : getRoles()
  if (typeof roles == 'string') {
    return userRoles.includes(roles)
  } else if (typeof roles == 'array') {
    let hasRole = []
    roles.foreEach(role => {
      hasRole.push(userRoles.includes(role))
    })
    return hasRole.includes(true)
  } else if (typeof roles == 'object') {
    let hasRole = []
    for (const key in roles) {
      if (Object.hasOwnProperty.call(roles, key)) {
        const role = roles[ key ];
        hasRole.push(userRoles.includes(role))
      }
    }
    return hasRole.includes(true)
  }
  // return true
}

export function user() {
  return store.getters[ 'auth/user' ]
}

export function getRoles() {
  let roles = user()?.roles.map(item => item.code)
  return roles
}

export function isAbleTo($ability) {
  return user().permissions_arr.includes($ability)
}

export function isRoot() {
  return hasRole('root')
}
export function isDG() {
  return hasRole('dg')
}
export function isDcp() {
  return hasRole('dcp')
}
export function isHeadOfDepartment() {
  return hasRole('cdc')
}
export function isController() {
  return hasRole('ci')
}
