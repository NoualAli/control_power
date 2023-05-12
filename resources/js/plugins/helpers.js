import store from '~/store'
export function user() {
    return store.getters[ 'auth/user' ]
}

export const helpersMixin = {
    computed: {
        currentYear() {
            return new Date().getFullYear()
        },
    }
}
