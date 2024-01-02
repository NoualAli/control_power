<template>
    <div v-if="can('view_role')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_role')" :to="{ name: 'roles-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
                <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true">
                    <i class="las la-file-excel icon" />
                    Exporter
                </button>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des rôles" urlPrefix="roles" @edit="edit"
                @delete="destroy" :refresh="refresh" @dataLoaded="handleDataLoaded">
                <template #actions-before="{ item }">
                    <a class="btn btn-office-excel" :href="'/excel-export?export=roles&id=' + item.id" target="_blank">
                        <i class="las la-file-excel icon" />
                    </a>
                </template>
            </NLDatatable>
            <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
                @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" />
        </ContentBody>
    </div>
</template>

<script>
import ExcelExportModal from '../../../Modals/ExcelExportModal.vue';
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    components: {
        ExcelExportModal
    },
    metaInfo() {
        return { title: 'Rôles' }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    data() {
        return {
            excelExportIsOpen: false,
            currentUrl: null,
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
                }
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_role')
                },
                delete: (item) => {
                    return this.can('delete_role') && item.code !== 'root'
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
            this.$router.push({ name: 'roles-edit', params: { role: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('roles/' + item.id).then(response => {
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
