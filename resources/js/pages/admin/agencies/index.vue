<template>
    <ContentBody v-if="can('view_agency')">
        <NLDatatable :columns="columns" :filters="filters" :actions="actions" urlPrefix="agencies" @edit="edit"
            @delete="destroy" @dataLoaded="handleDataLoaded" :refresh="refresh">
            <template #table-actions>
                <router-link v-if="can(['create_agency'])" :to="{ name: 'agencies-create' }" class="btn has-icon">
                    <NLIcon name="add" />
                    Ajouter
                </router-link>
                <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true">
                    <NLIcon name="table" />
                    Exporter
                </button>
            </template>
        </NLDatatable>
        <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
            @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" />
    </ContentBody>
</template>

<script>
import NLDatatable from '../../../components/Datatable/NLDatatable'
import ExcelExportModal from '../../../Modals/ExcelExportModal';
export default {
    components: { NLDatatable, ExcelExportModal },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    metaInfo() {
        return { title: 'Agences' }
    },
    data() {
        return {
            currentUrl: null,
            excelExportIsOpen: false,
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
                    field: 'category',
                    sortable: true
                },
                {
                    label: 'Dre',
                    field: 'dre_full_name'
                }
            ],
            filters: {
                dres: {
                    label: 'DRE',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null,
                },
                categories: {
                    label: 'Catégories',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null,
                },
            },
            actions: {
                edit: {
                    show: (item) => {
                        return this.can('edit_agency')
                    },
                    apply: this.edit
                },
                delete: {
                    show: (item) => {
                        return this.can('delete_agency')
                    },
                    apply: this.destroy
                },
            }
        }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    methods: {
        handleDataLoaded(response) {
            this.currentUrl = response.url
            this.$store.dispatch('settings/updatePageLoading', false)
        },
        /**
         * Redirige vers la page d'edition
         * @param {Object} e
         */
        edit(e) {
            // this.$router.push({ name: 'agencies-edit', params: { agency: e.item.id } })
            window.open(this.$router.resolve({ name: 'agencies-edit', params: { agency: e.item.id } }).href, '_blank')
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
