<template>
    <div v-if="can('view_agency')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can(['create_agency'])" :to="{ name: 'agencies-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
                <a href="/excel-export?export=agencies" target="_blank" class="btn btn-office-excel has-icon">
                    <i class="las la-file-excel icon" />
                    Exporter
                </a>
            </template>
            <template #title>
                Liste des agences
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" urlPrefix="agencies" @edit="edit" @delete="destroy"
                @dataLoaded="this.$store.dispatch('settings/updatePageLoading', false)" :refresh="refresh" />
        </ContentBody>
    </div>
</template>

<script>
import NLDatatable from '../../../components/Datatable/NLDatatable'
export default {
    components: { NLDatatable },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    metaInfo() {
        return { title: 'Agences' }
    },
    data() {
        return {
            refresh: 0,
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
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
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
                            this.refresh += 1
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
