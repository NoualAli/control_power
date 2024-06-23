<template>
    <ContentBody v-if="can('view_process')">
        <NLDatatable :filters="filters" :columns="columns" @show="show" :details="details" :actions="actions"
            title="Liste des processus" urlPrefix="processes" @edit="edit" @delete="destroy" :refresh="refresh"
            @dataLoaded="handleDataLoaded">
            <template #actions-before="{ item }">
                <a class="btn btn-office-excel" :href="'/excel-export?export=processes&id=' + item.id" target="_blank">
                    <NLIcon name="table" />
                </a>
            </template>
            <template #actions-after="{ item }">
                <button :class="['btn', { 'btn-success': !item.is_active, 'btn-danger': item.is_active }]"
                    @click="toggleState(item)" v-if="item.domain_is_active">
                    <NLIcon :name="item.is_active ? 'lock_open' : 'lock'" />
                </button>
            </template>

            <template #table-actions>
                <router-link v-if="can('create_process')" :to="{ name: 'processes-create' }" class="btn has-icon">
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
        <ProcessModal :rowSelected="rowSelected" :refresh="refresh" :show="showModal" @toggleState="toggleState"
            @destroy="destroy" @close="close" />
        <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
            @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" />
    </ContentBody>
</template>

<script>
import ExcelExportModal from '../../../Modals/ExcelExportModal';
import ProcessModal from '~/Modals/ProcessModal.vue'
export default {
    components: { ExcelExportModal, ProcessModal },
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
            showModal: false,
            rowSelected: null,
            columns: [
                {
                    label: 'Ordre d\'affichage',
                    field: 'display_priority',
                    align: 'center',
                    sortable: true
                },
                {
                    label: 'Famille',
                    field: 'family_name',
                    sortable: true
                },
                {
                    label: 'Domaine',
                    field: 'domain_name',
                    sortable: true
                },
                {
                    label: 'Processus',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Nombre de points de contrôle',
                    field: 'control_points_count',
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
                    label: 'Points de contrôle',
                    field: 'control_points.name',
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
                domain: {
                    label: 'Domaine',
                    name: 'domain',
                    multiple: true,
                    data: null,
                    value: null,
                    dependsOn: 'family'
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
                    return this.can('edit_process')
                },
                delete: {
                    show: (item) => {
                        return this.can('delete_process') && item.is_deletable
                    }
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
         * Toggle item state
         *
         * @param {Object} item
         */
        toggleState(item) {
            let message = item.is_active ? 'Êtes-vous sûr de vouloir désactiver le processus <b>' + item.name + '</b>' : 'Êtes-vous sûr de vouloir activer le processus <b>' + item.name + '</b>'
            this.$swal.confirm({ message }).then(action => {
                if (action.isConfirmed) {
                    this.showModal = false
                    this.$api.patch('processes/' + item.id).then(response => {
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
                            this.close()
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
