import store from '~/store'
export function user() {
    return store.getters[ 'auth/user' ]
}

export const helpersMixin = {
    computed: {
        currentYear() {
            return new Date().getFullYear()
        },
    },
    methods: {
        /**
         * Ask user to confirm page leaving
         *
         * @param {Closure} next
         * @param {Object} config
         */
        askBeforeLeave(next, config = { icon: 'question', title: '', message: 'Vous n\'avez pas enregistré vos changements, êtes-vous sûr de vouloir quitter la page ?', showConfirmButton: true, showCancelButton: true }) {

            this.$swal.routeLeaveConfirm(config).then(action => {
                if (action.isConfirmed) {
                    return next();
                } else {
                    return next(false);
                }
            })
        }
    }
}
