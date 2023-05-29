<template>
    <div v-if="can('view_process')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_process')" :to="{ name: 'processes-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des processus" urlPrefix="processes"
                @edit="edit" @delete="destroy" />
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
        return { title: 'Processus' }
    },
    data() {
        return {
            reloadData: false,
            columns: [
                {
                    label: 'Famille',
                    field: 'familly_name'
                },
                {
                    label: 'Domaine',
                    field: 'domain_name'
                },
                {
                    label: 'Nom',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Nombres de points de contrôle',
                    field: 'control_points_count'
                }
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_process')
                },
                delete: (item) => {
                    return this.can('delete_process')
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
            this.$router.push({ name: 'processes-edit', params: { process: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    this.$api.delete('processes/' + item.id).then(response => {
                        if (response.data.status) {
                            this.initData()
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                console.log(error)
                this.$swal.alert_error()
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
