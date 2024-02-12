<template>
    <ContentBody v-if="can('view_domain')">
        <NLDatatable :filters="filters" :columns="columns" :actions="actions" title="Liste des domaines" urlPrefix="domains"
            @edit="edit" @delete="destroy" :refresh="refresh" @dataLoaded="handleDataLoaded">
            <!-- <template #actions-before="{ item }">
                <a class="btn btn-office-excel" :href="'/excel-export?export=domains&id=' + item.id" target="_blank">
                    <NLIcon name="table" />
                </a>
            </template> -->
            <template #table-actions>
                <router-link v-if="can('create_domain')" :to="{ name: 'domains-create' }" class="btn has-icon">
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
        return { title: 'Domaines' }
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
                    label: 'Nombres de processus',
                    field: 'processes_count',
                    sortable: true,
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
            },
            actions: {
                edit: (item) => {
                    return this.can('edit_domain')
                },
                delete: (item) => {
                    return this.can('delete_domain')
                }
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
         * @param {Object} item
         */
        edit(item) {
            // this.$router.push({ name: 'domains-edit', params: { domain: item.id } })
            window.open(this.$router.resolve({ name: 'domains-edit', params: { domain: item.id } }).href, '_blank')
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    this.$api.delete('domains/' + item.id).then(response => {
                        if (response.data.status) {
                            this.refresh += 1
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                console.error(error)
                this.$swal.alert_error()
            })
        },
    }
}
</script>
