<template>
    <ContentBody v-if="can('view_user')">
        <NLDatatable :columns="columns" :actions="actions" :details="details" :filters="filters"
            title="Liste des utilisateurs" urlPrefix="users" @edit="edit" @delete="destroy" :refresh="refresh"
            @dataLoaded="handleDataLoaded">
            <template #actions-before="{ item }">
                <a class="btn btn-office-excel" v-if="!item.must_change_password && is(['root', 'admin'])"
                    :href="'/excel-export?export=users&id=' + item.id" target="_blank">
                    <NLIcon name="table" />
                </a>
                <NLButton class="btn btn-danger"
                    v-if="!isCurrent(item) && !item.must_change_password && is(['root', 'admin'])"
                    @click.prevent="reset(item)">
                    <NLIcon name="backspace" />
                </NLButton>
            </template>
            <template #table-actions>
                <router-link v-if="can('create_user')" :to="{ name: 'users-create' }" class="btn has-icon">
                    <NLIcon name="add" />
                    Ajouter
                </router-link>
                <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true">
                    <NLIcon name="table" />
                    Exporter
                </button>
            </template>
        </NLDatatable>
        <ExcelExportModal :show="excelExportIsOpen" :route="this.currentUrl" @close="this.excelExportIsOpen = false"
            @success="this.excelExportIsOpen = false" />
    </ContentBody>
</template>

<script>
import { hasRole, user } from '../../../plugins/user'
import ExcelExportModal from '../../../Modals/ExcelExportModal';
import api from '../../../plugins/api'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    components: {
        ExcelExportModal
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    data() {
        return {
            excelExportIsOpen: false,
            currentUrl: null,
            refresh: 1,
            columns: [
                {
                    label: "Nom d'utilisateur",
                    field: 'username',
                    sortable: true
                },
                {
                    label: 'Nom complet',
                    field: 'full_name',
                    sortable: true,
                },
                {
                    label: 'Adresse email',
                    field: 'email',
                    sortable: true,
                },
                {
                    label: 'N° de téléphone',
                    field: 'phone',
                },
                {
                    label: 'DRE',
                    field: 'dres'
                },
                {
                    label: 'Rôle',
                    field: 'role',
                    sortable: true,
                },
                {
                    label: 'Etat',
                    field: 'is_active',
                    isHtml: true,
                    methods: {
                        showField(item) {
                            if (item.is_active) {
                                return '<span class="tag is-success">Actif</span>'
                            }
                            return '<span class="tag is-warning">Inactif</span>'
                        }
                    }
                },
                {
                    label: 'Dernière connexion',
                    field: 'last_login',
                    // sortable: true,
                    hide: !hasRole([ 'root', 'admin' ])
                },
                {
                    label: 'Date de création',
                    field: 'created_at',
                    sortable: true,
                    hide: !hasRole([ 'root', 'admin' ])
                },
            ],
            details: [
                {
                    label: 'Matricule',
                    field: 'registration_number',
                    cols: {
                        lg: 2
                    }
                },
                {
                    label: 'Genre',
                    field: 'gender_str',
                    cols: {
                        lg: 2
                    }
                },
                {
                    label: 'Agences',
                    field: 'agencies_str',
                },
            ],
            actions: {
                edit: {
                    show: (item) => {
                        let condition = !this.isCurrent(item) && this.can('edit_user') && item?.role_code !== 'root'
                        if (hasRole('cdcr')) {
                            return condition && ![ 'admin', 'root', 'dg', 'ig', 'sg', 'dcp', 'cdrcp', 'der', 'cder', 'deac', 'dga' ].includes(item.role_code)
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
            },
            filters: {
                roles: {
                    label: 'Rôle',
                    data: null,
                    value: null,
                    multiple: true,
                    cols: 4
                },
                // is_active: {
                //     label: 'Etat',
                //     data: [
                //         {
                //             id: 1,
                //             label: 'Actif',
                //         },
                //         {
                //             id: 2,
                //             label: 'Inactif',
                //         },
                //     ],
                //     multiple: false,
                //     value: null,
                // }
            }
        }
    },
    methods: {
        handleDataLoaded(response) {
            this.currentUrl = response.url
            this.$store.dispatch('settings/updatePageLoading', false)
        },
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
            window.open(this.$router.resolve({ name: 'users-edit', params: { user: e.item.id } }).href, '_blank')
            // return this.$router.push({ name: 'users-edit', params: { user: e.item.id } })
        },

        /**
         * Reset basic user informations
         *
         * @param {Object} user
         */
        reset(user) {
            return this.$swal.confirm_destroy("Êtes-vous sûr de vouloir réinitialiser les informations de l'utilisateur <b>" + user?.username + "</b>").then((action) => {
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
