<template>
    <div v-if="can('view_dre')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_dre')" :to="{ name: 'dre-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des DRE" urlPrefix="dre" @edit="edit"
                @delete="destroy" :key="forceReload"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)" />
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
        return { title: 'Dre' }
    },
    data() {
        return {
            forceReload: 1,
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
                    label: 'Nombre d\'agences',
                    field: 'agencies_count'
                }
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_dre')
                },
                delete: (item) => {
                    return this.can('delete_dre')
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
            this.$router.push({ name: 'dre-edit', params: { dre: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('dre/' + item.id).then(response => {
                        if (response.data.status) {
                            this.forceReload += 1
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
    }
}
</script>
