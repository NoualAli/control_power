<template>
    <div v-if="can('view_permission')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_permission')" :to="{ name: 'permissions-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des permissions" urlPrefix="permissions"
                @edit="edit" @delete="destroy" :key="forceReload"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)" />
        </ContentBody>
    </div>
</template>

<script>
import api from '~/plugins/api'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
    metaInfo() {
        return { title: 'Permissions' }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    data() {
        return {
            forceReload: 1,
            columns: [
                {
                    label: 'Nom',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Rôles',
                    field: 'roles'
                }
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_permission')
                },
                delete: (item) => {
                    return this.can('delete_permission')
                }
            }
        }
    },
    methods: {
        /**
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            this.$router.push({ name: 'permissions-edit', params: { permission: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('permissions/' + item.id).then(response => {
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
