<template>
    <div v-if="can('view_user')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_user')" :to="{ name: 'users-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
                <a href="/excel-export?export=users" target="_blank" class="btn btn-office-excel has-icon">
                    <i class="las la-file-excel icon" />
                    Exporter
                </a>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" :details="details" title="Liste des utilisateurs"
                urlPrefix="users" @edit="edit" @delete="destroy" :refresh="refresh"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
                <template #actions-before="{ item }">
                    <a class="btn btn-office-excel" v-if="!item.must_change_password"
                        :href="'/excel-export?export=users&id=' + item.id" target="_blank">
                        <i class="las la-file-excel icon" />
                    </a>
                    <NLButton class="btn btn-danger"
                        v-if="!isCurrent(item) && !item.must_change_password && is(['root', 'admin'])"
                        @click.prevent="reset(item)">
                        <i class="las la-backspace icon" />
                    </NLButton>
                </template>
            </NLDatatable>
        </ContentBody>
    </div>
</template>

<script>
import { hasRole, user } from '../../../plugins/user'
import api from '../../../plugins/api'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    data() {
        return {
            refresh: 1,
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
                    label: 'N° de téléphone',
                    field: 'phone',
                    sortable: true
                },
                {
                    label: 'DRE',
                    field: 'dres'
                },
                {
                    label: 'Rôle',
                    field: 'role',
                },
                {
                    label: 'Actif',
                    field: 'is_active',
                    isHtml: true,
                    methods: {
                        showField(item) {
                            if (item.is_active) {
                                return '<i class="las la-check-circle icon text-success"></i>'
                            }
                            return '<i class="las la-times-circle icon text-danger"></i>'
                        }
                    }
                },
                {
                    label: 'Dernière connexion',
                    field: 'last_login',
                    // sortable: true,
                },
                {
                    label: 'Date de création',
                    field: 'created_at',
                    sortable: true,
                },
            ],
            details: [
                {
                    label: "Nom d'utilisateur",
                    field: 'username',
                },
                {
                    label: 'Nom complet',
                    field: 'full_name_with_martial'
                },
                {
                    label: 'Genre',
                    field: 'gender_str'
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
                    label: 'Agences',
                    field: 'agencies_str'
                },
                {
                    label: 'Rôle',
                    field: 'role.name'
                },
                {
                    label: 'Dernière connexion',
                    field: 'last_login.last_activity',
                },
                {
                    label: 'Date de création',
                    field: 'created_at',
                },
            ],
            actions: {
                edit: {
                    show: (item) => {
                        let condition = !this.isCurrent(item) && this.can('edit_user') && item?.role_code !== 'root'
                        if (hasRole('cdcr')) {
                            return condition && ![ 'admin', 'root', 'dg', 'ig', 'sg', 'dcp', 'cdrcp', 'der', 'deac', 'dga' ].includes(item.role_code)
                        }
                        return condition
                    },
                    apply: this.edit
                },
                delete: {
                    show: (item) => {
                        return !this.isCurrent(item) && this.can('delete_user') && item?.role_code !== 'root' && hasRole([ 'root', 'admin' ]) && item.id !== user()?.id
                    },
                    apply: this.destroy
                }
            }
        }
    },
    methods: {
        /**
         * check if user is current
         *
         * @param {Object} item
         */
        isCurrent(item) {
            return item?.id === user()?.id
        },
        /**
         * Redirect to edit form
         *
         * @param {Object} e
         */
        edit(e) {
            return this.$router.push({ name: 'users-edit', params: { user: e.item.id } })
        },

        /**
         * Reset basic user informations
         *
         * @param {Object} user
         */
        reset(user) {
            return this.$swal.confirm_destroy("Voulez-vous vraiment réinitialiser les informations de l'utilisateur <b>" + user?.username + "</b>").then((action) => {
                if (action.isConfirmed) {
                    return this.$api.post('users/reset/' + user?.id).then(response => {
                        if (response.data.status) {
                            this.refresh += 1
                            return this.$swal.toast_success(response.data.message)
                        } else {
                            return this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                console.error(error)
                this.$swal.alert_error()
            })
        },

        /**
         * Destroy user
         *
         * @param {Object} e
         */
        destroy(e) {
            return this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    return api.delete('users/' + e.item.id).then(response => {
                        if (response.data.status) {
                            this.refresh += 1
                            return this.$swal.toast_success(response.data.message)
                        } else {
                            return this.$swal.toast_error(response.data.message)
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
