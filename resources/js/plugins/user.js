import store from '~/store'

export function hasRole(roles = String | Array, status) {
  let userRoles = status ? status : getRoles()
  if (typeof roles == 'string') {
    let hasRoles = []
    roles = (roles || '').split(/\s*,\s*/);
    roles.some(role => {
      hasRoles.push(userRoles.includes(role))
    });
    // console.log(hasRoles.some(value => value === true));
    return hasRoles.some(value => value === true)

    return userRoles.includes(roles)
  } else if (typeof roles == 'array') {
    let hasRoles = []
    roles.foreEach(role => {
      hasRoles.push(userRoles.includes(role))
    })
    return hasRoles.includes(true)
  } else if (typeof roles == 'object') {
    let hasRoles = []
    for (const key in roles) {
      if (Object.hasOwnProperty.call(roles, key)) {
        const role = roles[ key ];
        hasRoles.push(userRoles.includes(role))
      }
    }
    return hasRoles.includes(true)
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

export function isAbleTo($abilities) {
  let can = []
  $abilities = ($abilities || '').split(/\s*,\s*/);
  $abilities.some(ability => {
    can.push(user()?.permissions_arr?.includes(ability.trim()))
  });
  return can.some(value => value === true)
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
