/* eslint-disable eqeqeq */
export function user() {
    return JSON.parse(localStorage.getItem('user')) || []
}

export function getRoles() {
    return JSON.parse(localStorage.getItem('roles')) || []
}

export function getRole() {
    return localStorage.getItem('role') || null
}

export function getPermissions() {
    return JSON.parse(localStorage.getItem('permissions')) || []
}

export function getDres() {
    return JSON.parse(localStorage.getItem('dres')) || []
}

export function getAgencies() {
    return JSON.parse(localStorage.getItem('agencies')) || []
}

export function isAbleTo($abilities = String | Array) {
    const can = []
    const userPermissions = getPermissions()
    if (typeof $abilities == 'string') {
        $abilities = ($abilities || '').split(/\s*,\s*/)
        $abilities.forEach(ability => {
            can.push(userPermissions.includes(ability.trim()))
        })
        return can.some(value => value === true)
    } else if (Array.isArray($abilities)) {
        $abilities.forEach($ability => {
            can.push(userPermissions.includes($ability.trim()))
        })
        return can.includes(true)
    } else if (typeof $abilities === 'object') {
        for (const key in $abilities) {
            if (Object.hasOwnProperty.call($abilities, key)) {
                const $ability = $abilities[ key ].trim()
                can.push(userPermissions.includes($ability))
            }
        }
        console.log(`can :${can}`)
        return can.includes(true)
    }
}

export function hasRole(roles = String | Array, status) {
    const userRole = status || getRole()
    if (typeof roles === 'string') {
        roles = (roles || '').split(/\s*,\s*/)
        return roles.includes(userRole)
    } else if (typeof roles === 'array') {
        return roles.includes(userRole)
    } else if (typeof roles === 'object') {
        return roles.includes(userRole)
    }
}
