export function user () {
  return JSON.parse(localStorage.getItem('user')) || []
}

export function getRoles () {
  return JSON.parse(localStorage.getItem('roles')) || []
}

export function getPermissions () {
  return JSON.parse(localStorage.getItem('permissions')) || []
}

export function getDres () {
  return JSON.parse(localStorage.getItem('dres')) || []
}

export function getAgencies () {
  return JSON.parse(localStorage.getItem('agencies')) || []
}

export function isAbleTo ($abilities = String | Array) {
  const can = []
  const userPermissions = getPermissions()
  if (typeof $abilities === 'string') {
    $abilities = ($abilities || '').split(/\s*,\s*/)
    $abilities.some(ability => {
      can.push(userPermissions.includes(ability.trim()))
    })
    return can.some(value => value === true)
  } else if (typeof $abilities === 'array') {
    $abilities.foreEach($ability => {
      can.push(userPermissions.includes($ability.trim()))
    })
    return can.includes(true)
  } else if (typeof $abilities === 'object') {
    for (const key in $abilities) {
      if (Object.hasOwnProperty.call($abilities, key)) {
        const $ability = $abilities[key].trim()
        can.push(userPermissions.includes($ability))
      }
    }
    return can.includes(true)
  }
}

export function hasRole (roles = String | Array, status) {
  const userRoles = status || getRoles()
  const hasRoles = []
  if (typeof roles === 'string') {
    roles = (roles || '').split(/\s*,\s*/)
    roles.some(role => {
      hasRoles.push(userRoles.includes(role))
    })
    return hasRoles.some(value => value === true)
  } else if (typeof roles === 'array') {
    roles.foreEach(role => {
      hasRoles.push(userRoles.includes(role))
    })
    return hasRoles.includes(true)
  } else if (typeof roles === 'object') {
    for (const key in roles) {
      if (Object.hasOwnProperty.call(roles, key)) {
        const role = roles[key]
        hasRoles.push(userRoles.includes(role))
      }
    }
    return hasRoles.includes(true)
  }
}
