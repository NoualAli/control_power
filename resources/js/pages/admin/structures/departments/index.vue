<template>
    <ContentBody v-if="can('view_dre')">
        <NLDatatable :columns="columns" :actions="actions" title="Liste des DRE" urlPrefix="structures/dre" @edit="edit"
            @delete="destroy" :refresh="refresh" @dataLoaded="handleDataLoaded">

            <template #actions-before="{ item }">
                <a class="btn btn-office-excel" :href="'/excel-export?export=dres&id=' + item.id" target="_blank">
                    <NLIcon name="table" />
                </a>
            </template>

            <template #table-actions>
                <router-link v-if="can('create_dre')" :to="{ name: 'dre-create' }" class="btn has-icon">
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
import ExcelExportModal from '../../../../Modals/ExcelExportModal'

export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    components: { ExcelExportModal },
    metaInfo() {
        return { title: 'Dre' }
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
                    label: 'Inspection régionale',
                    field: 'regional_inspection',
                },
                {
                    label: 'Nombre d\'agences',
                    field: 'agencies_count'
                }
            ],
            actions: {
                edit: {
                    show: (item) => {
                        return this.can('edit_dre')
                    },
                    apply: this.edit
                },
                delete: {
                    show: (item) => {
                        return this.can('delete_dre')
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
         * @param {Object} event
         */
        edit(event) {
            this.$router.push({ name: 'dre-edit', params: { dre: event.item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} event
         */
        destroy(event) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('structures/dre/' + event.item.id).then(response => {
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
