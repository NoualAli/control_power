<template>
    <ContentBody v-if="can('view_category')">
        <NLDatatable :columns="columns" :actions="actions" title="Liste des catégories"
            urlPrefix="structures/agency-categories" @edit="edit" @delete="destroy" :refresh="refresh"
            @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">

            <template #table-actions>
                <router-link v-if="can('create_category')" :to="{ name: 'categories-create' }" class="btn has-icon">
                    <NLIcon name="add" />
                    Ajouter
                </router-link>
            </template>
        </NLDatatable>
    </ContentBody>
</template>

<script>
import api from '~/plugins/api'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    metaInfo() {
        return { title: 'Catégories' }
    },
    data() {
        return {
            refresh: 0,
            columns: [
                {
                    label: 'Nom',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Total processus',
                    field: 'processes_count',
                    sortable: true
                }
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_category')
                },
                delete: (item) => {
                    return this.can('delete_category')
                }
            }
        }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    methods: {
        /**
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            this.$router.push({ name: 'categories-edit', params: { category: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('structures/agency-categories/' + item.id).then(response => {
                        if (response.data.status) {
                            this.refresh += 1
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                this.$swal.alert_error()
                console.error(error)
            })
        },
    }
}
</script>
