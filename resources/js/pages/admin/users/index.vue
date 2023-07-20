<template>
    <div v-if="can('view_user')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_user')" :to="{ name: 'users-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" :details="details" title="Liste des utilisateurs"
                urlPrefix="users" @edit="edit" @delete="destroy" :key="forceReload"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)" />
        </ContentBody>
    </div>
</template>

<script>
import Avatar from '../../../components/Avatar.vue'
import { user } from '../../../plugins/user'
import api from '../../../plugins/api'
export default {
    components: { Avatar },
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    data() {
        return {
            forceReload: 1,
            columns: [
                {
                    label: "Nom d'utilisateur",
                    field: 'username',
                    sortable: true
                },
                {
                    label: 'Nom complet',
                    field: 'full_name'
                },
                {
                    label: 'Adresse email',
                    field: 'email',
                    sortable: true
                },
                {
                    label: 'DRE',
                    field: 'dres'
                },
                {
                    label: 'Rôles',
                    field: 'roles',
                }
            ],
            details: [
                {
                    label: "Nom d'utilisateur",
                    field: 'username',
                },
                {
                    label: 'Nom complet',
                    field: 'full_name'
                },
                {
                    label: 'Adresse email',
                    field: 'email',
                },
                {
                    label: 'N° de téléphone',
                    field: 'phone',
                },
                {
                    label: 'DRE',
                    field: 'dres_str'
                },
                {
                    label: 'Rôles',
                    field: 'roles_str'
                }
            ],
            actions: {
                edit: (item) => {
                    return !this.isCurrent(item) && this.can('edit_user') && !item.roles.includes('root')
                },
                delete: (item) => {
                    return !this.isCurrent(item) && this.can('delete_user') && !item.roles.includes('root')
                }
            }
        }
    },
    methods: {
        /**
         * Vérifie si la ligne correspond à l'utilisateur actuel
         * @param {Object} item
         */
        isCurrent(item) {
            return item?.id === user()?.id
        },
        /**
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            this.$router.push({ name: 'users-edit', params: { user: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('users/' + item.id).then(response => {
                        if (response.data.status) {
                            this.forceReload += 1
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                console.error(error)
                this.$swal.alert_error()
            })
        },
    }
}
</script>
