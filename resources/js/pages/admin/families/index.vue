<template>
    <ContentBody v-if="can('view_family')">
        <NLDatatable :columns="columns" :actions="actions" title="Liste des familles" urlPrefix="families" @edit="edit"
            @delete="destroy" :refresh="refresh" @dataLoaded="handleDataLoaded">
            <!-- <template #actions-before="{ item }">
                    <a class="btn btn-office-excel" :href="'/excel-export?export=families&id=' + item.id" target="_blank">
                        <NLIcon name="table" />
                    </a>
                </template> -->
            <template #table-actions>
                <router-link v-if="can('create_family')" :to="{ name: 'families-create' }" class="btn has-icon">
                    <NLIcon name="add" />
                    Ajouter
                </router-link>
                <!-- <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true">
                        <NLIcon name="table" />
                        Exporter
                    </button> -->
            </template>
        </NLDatatable>
        <!-- <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
                @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" /> -->
    </ContentBody>
</template>

<script>
import ExcelExportModal from '../../../Modals/ExcelExportModal';
export default {
    components: { ExcelExportModal },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    metaInfo() {
        return { title: 'Famille' }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    data() {
        return {
            currentUrl: null,
            excelExportIsOpen: false,
            refresh: 0,
            columns: [
                {
                    label: 'Famille',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Nombre de domaines',
                    field: 'domains_count'
                }
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_family')
                },
                delete: (item) => {
                    return this.can('delete_family')
                }
            }
        }
    },
    methods: {
        handleDataLoaded(response) {
            this.currentUrl = response.url
            this.$store.dispatch('settings/updatePageLoading', false)
        },
        /**
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            this.$router.push({ name: 'families-edit', params: { family: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('families/' + item.id).then(response => {
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
