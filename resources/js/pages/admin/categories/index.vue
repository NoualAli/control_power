<template>
    <div v-if="can('view_category')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_category')" :to="{ name: 'categories-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des catégories" urlPrefix="categories"
                @edit="edit" @delete="destroy" />
        </ContentBody>
    </div>
</template>

<script>
import NLDatatable from '../../../components/Datatable/NLDatatable'
import api from '~/plugins/api'
export default {
    components: { NLDatatable },
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
    metaInfo() {
        return { title: 'Catégories' }
    },
    data() {
        return {
            reloadData: false,
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
                    api.delete('categories/' + item.id).then(response => {
                        if (response.data.status) {
                            this.initData()
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

        /**
         * Initialise les données
         */
        initData() {
            this.reloadData = true
        }
    }
}
</script>
