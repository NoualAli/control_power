<template>
    <ContentBody v-if="can('view_process')">
        <NLDatatable :filters="filters" :columns="columns" :actions="actions" title="Liste des processus"
            urlPrefix="processes" @edit="edit" @delete="destroy" :refresh="refresh" @dataLoaded="handleDataLoaded">
            <!-- <template #actions-before="{ item }">
                <a class="btn btn-office-excel" :href="'/excel-export?export=processes&id=' + item.id" target="_blank">
                    <NLIcon name="table" />
                </a>
            </template> -->
            <template #table-actions>
                <router-link v-if="can('create_process')" :to="{ name: 'processes-create' }" class="btn has-icon">
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
        return { title: 'Processus' }
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
                    field: 'family',
                    sortable: true
                },
                {
                    label: 'Domaine',
                    field: 'domain',
                    sortable: true
                },
                {
                    label: 'Processus',
                    field: 'process',
                    sortable: true
                },
                {
                    label: 'Nombres de points de contrôle',
                    field: 'control_points_count',
                    sortable: true
                }
            ],
            filters: {
                family: {
                    label: 'Famille',
                    name: 'family',
                    multiple: true,
                    data: null,
                    value: null
                },
                domain: {
                    label: 'Domaine',
                    name: 'domain',
                    multiple: true,
                    data: null,
                    value: null,
                    dependsOn: 'family'
                }
            },
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
        handleDataLoaded(response) {
            this.currentUrl = response.url
            this.$store.dispatch('settings/updatePageLoading', false)
        },
        /**
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            window.open(this.$router.resolve({ name: 'processes-edit', params: { process: item.id } }).href, '_blank')
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
                            this.refresh += 1
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                this.$swal.catchError(error)
            })
        },
    }
}
</script>
