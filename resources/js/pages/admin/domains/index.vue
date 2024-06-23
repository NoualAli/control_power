<template>
    <ContentBody v-if="can('view_domain')">
        <NLDatatable :filters="filters" :columns="columns" :details="details" :actions="actions"
            title="Liste des domaines" urlPrefix="domains" @show="show" @edit="edit" @delete="destroy"
            :refresh="refresh" @dataLoaded="handleDataLoaded">
            <template #actions-before="{ item }">
                <a class="btn btn-office-excel" :href="'/excel-export?export=domains&id=' + item.id" target="_blank">
                    <NLIcon name="table" />
                </a>
            </template>
            <template #actions-after="{ item }">
                <button :class="['btn', { 'btn-success': !item.is_active, 'btn-danger': item.is_active }]"
                    @click="toggleState(item)" v-if="item.family_is_active">
                    <NLIcon :name="item.is_active ? 'lock_open' : 'lock'" />
                </button>
            </template>

            <template #table-actions>
                <router-link v-if="can('create_domain')" :to="{ name: 'domains-create' }" class="btn has-icon">
                    <NLIcon name="add" />
                    Ajouter
                </router-link>
                <NLButton class="has-icon" @click="refresh += 1">
                    <NLIcon name="sync" />
                </NLButton>
                <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true">
                    <NLIcon name="table" />
                    Exporter
                </button>
            </template>
        </NLDatatable>
        <DomainModal :rowSelected="rowSelected" :refresh="refresh" :show="showModal" @toggleState="toggleState"
            @destroy="destroy" @close="close" />
        <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
            @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" />
    </ContentBody>
</template>

<script>
import ExcelExportModal from '~/Modals/ExcelExportModal';
import DomainModal from '~/Modals/DomainModal.vue'

export default {
    components: { ExcelExportModal, DomainModal },
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
            showModal: false,
            rowSelected: null,
            columns: [
                {
                    label: 'Ordre d\'affichage',
                    field: 'display_priority',
                    align: 'center',
                    sortable: true,
                },
                {
                    label: 'Famille',
                    field: 'family_name',
                    sortable: true
                },
                {
                    label: 'Domaine',
                    field: 'name',
                    sortable: true
                },
                // {
                //     label: 'Utilisable pour agence',
                //     field: 'usable_for_agency',
                //     align: 'center',
                //     isHtml: true,
                //     methods: {
                //         showField(item) {
                //             let icon = item.usable_for_agency == 1 ? 'check-circle' : 'times-circle'
                //             let color = item.usable_for_agency == 1 ? 'text-success' : 'text-danger'
                //             let title = item.usable_for_agency == 1 ? 'Oui' : 'Non'

                //             return `<i class="las la-${icon} ${color} icon" title="${title}"></i>`
                //         }
                //     }
                // },
                // {
                //     label: 'Utilisable pour DRE',
                //     field: 'usable_for_dre',
                //     align: 'center',
                //     isHtml: true,
                //     methods: {
                //         showField(item) {
                //             let icon = item.usable_for_dre == 1 ? 'check-circle' : 'times-circle'
                //             let color = item.usable_for_dre == 1 ? 'text-success' : 'text-danger'
                //             let title = item.usable_for_dre == 1 ? 'Oui' : 'Non'

                //             return `<i class="las la-${icon} ${color} icon" title="${title}"></i>`
                //         }
                //     }
                // },
                {
                    label: 'Nombre de processus',
                    field: 'processes_count',
                    align: 'center',
                    sortable: true,
                },
                {
                    label: 'Actif',
                    field: 'is_active',
                    align: 'center',
                    isHtml: true,
                    methods: {
                        showField(item) {
                            let icon = item.is_active == 1 ? 'check-circle' : 'times-circle'
                            let color = item.is_active == 1 ? 'text-success' : 'text-danger'
                            let title = item.is_active == 1 ? 'Oui' : 'Non'

                            return `<i class="las la-${icon} ${color} icon" title="${title}"></i>`
                        }
                    }
                },
            ],
            details: [
                {
                    label: 'Processus',
                    field: 'processes.name',
                    hasMany: true,
                    cols: {
                        lg: 12,
                        md: 12,
                        sm: 12,
                    }
                },
            ],
            filters: {
                family: {
                    label: 'Famille',
                    name: 'family',
                    multiple: true,
                    data: null,
                    value: null
                },
                // usable_for_agency: {
                //     label: 'Utilisabe pour agence',
                //     name: 'usable_for_agency',
                //     data: [
                //         {
                //             id: "0",
                //             label: 'Non',
                //         },
                //         {
                //             id: "1",
                //             label: 'Oui',
                //         },
                //     ],
                //     value: null,
                // },
                // usable_for_dre: {
                //     label: 'Utilisabe pour DRE',
                //     name: 'usable_for_dre',
                //     data: [
                //         {
                //             id: "0",
                //             label: 'Non',
                //         },
                //         {
                //             id: "1",
                //             label: 'Oui',
                //         },
                //     ],
                //     value: null,
                // },
                is_active: {
                    label: 'Actif',
                    name: 'is_active',
                    data: [
                        {
                            id: "0",
                            label: 'Non',
                        },
                        {
                            id: "1",
                            label: 'Oui',
                        },
                    ],
                    value: null,
                }
            },
            actions: {
                show: true,
                edit: (item) => {
                    return this.can('edit_domain')
                },
                delete: {
                    show: (item) => {
                        return this.can('delete_domain') && item.is_deletable
                    }
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
         * Toggle item state
         *
         * @param {Object} item
         */
        toggleState(item) {
            let message = item.is_active ? 'Êtes-vous sûr de vouloir désactiver le domaine <b>' + item.name + '</b>' : 'Êtes-vous sûr de vouloir activer le domaine <b>' + item.name + '</b>'
            this.$swal.confirm({ message }).then(action => {
                if (action.isConfirmed) {
                    this.showModal = false
                    this.$api.patch('domains/' + item.id).then(response => {
                        if (response.data.status) {
                            this.refresh += 1
                            this.showModal = !!this.rowSelected
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                    }).catch(error => {
                        this.$swal.catchError(error)
                    })
                }
            })
        },

        /**
         * @param {Object} Object
         * @param {Object} Object.row
         * @param {String} Object.type
         */
        showForm({ row, type }) {
            const functionName = type.toLowerCase();
            const fn = this[ functionName ];
            if (fn && typeof fn === 'function') {
                fn(row);
            } else {
                console.error('Function not found or not a function:', functionName);
            }
        },

        /**
        * Affiche le modal des informations du point de contrôle
        * @param {Object} item
        */
        show(item) {
            this.rowSelected = item
            this.showModal = true
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
                            this.close()
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

        /**
         * Handle close event
         */
        close() {
            this.showModal = false
            this.rowSelected = null
        },
    }
}
</script>
