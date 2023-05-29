<template>
    <div v-if="can('view_agency')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can(['create_agency'])" :to="{ name: 'agencies-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des agences" urlPrefix="agencies" @edit="edit"
                @delete="destroy" />
        </ContentBody>
    </div>
</template>

<script>
import NLDatatable from '../../../components/Datatable/NLDatatable'
export default {
    components: { NLDatatable },
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
    metaInfo() {
        return { title: 'Agences' }
    },
    data() {
        return {
            reloadData: false,
            columns: [
                {
                    label: 'Code',
                    field: 'code',
                    sortable: true
                },
                {
                    label: 'Nom',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Categorie',
                    field: 'category'
                },
                {
                    label: 'Dre',
                    field: 'dre_full_name'
                }
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_agency')
                },
                delete: (item) => {
                    return this.can('delete_agency')
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
            this.$router.push({ name: 'agencies-edit', params: { agency: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('agencies/' + item.id).then(response => {
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
            })
        },

        /**
         * Initialise les données
         */
        initData() {
            this.reloadData = false
        }
    }
}
</script>
