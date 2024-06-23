<template>
    <ContentBody v-if="can('view_family')">
        <NLDatatable :columns="columns" :actions="actions" :filters="filters" title="Liste des familles"
            urlPrefix="families" @edit="edit" @delete="destroy" @show="show" :refresh="refresh"
            @dataLoaded="handleDataLoaded">
            <template #actions-before="{ item }" v-if="is(['admin', 'root', 'dcp', 'cdcr'])">
                <a class="btn btn-office-excel" :href="'/excel-export?export=families&id=' + item.id" target="_blank">
                    <NLIcon name="table" />
                </a>
            </template>

            <template #actions-after="{ item }">
                <button :class="['btn', { 'btn-success': !item.is_active, 'btn-danger': item.is_active }]"
                    @click="toggleState(item)">
                    <NLIcon :name="item.is_active ? 'lock_open' : 'lock'" />
                </button>
            </template>

            <template #table-actions>
                <router-link v-if="can('create_family')" :to="{ name: 'families-create' }" class="btn has-icon">
                    <NLIcon name="add" />
                    Ajouter
                </router-link>
                <NLButton class="has-icon" @click="refresh += 1">
                    <NLIcon name="sync" />
                </NLButton>
                <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true"
                    v-if="is(['admin', 'root', 'dcp', 'cdcr'])">
                    <NLIcon name="table" />
                    Exporter
                </button>
            </template>
        </NLDatatable>
        <FamilyModal :rowSelected="rowSelected" :show="showModal" @toggleState="toggleState" @destroy="destroy"
            @close="close" :refresh="refresh" />
        <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
            @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" />
    </ContentBody>
</template>

<script>
import ExcelExportModal from '~/Modals/ExcelExportModal';
import FamilyModal from '~/Modals/FamilyModal';

export default {
    components: { ExcelExportModal, FamilyModal },
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
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Nombre de domaines',
                    field: 'domains_count',
                    align: 'center',
                    sortable: true,
                },
                {
                    label: 'Nombre de processus',
                    field: 'processes_count',
                    align: 'center',
                    sortable: true,
                },
                {
                    label: 'Nombre de point de contrôle',
                    field: 'control_points_count',
                    align: 'center',
                    sortable: true,
                },
                {
                    label: 'Nombre de campagnes',
                    field: 'control_campaigns_count',
                    sortable: true,
                    align: 'center',
                },
                {
                    label: 'Nombre de missions',
                    field: 'missions_count',
                    sortable: true,
                    align: 'center',
                },
                {
                    label: 'Nombre de d\'anomalies',
                    field: 'anomalies_count',
                    sortable: true,
                    align: 'center',
                },
                {
                    label: 'Nombre de régularisations',
                    field: 'regularizations_count',
                    sortable: true,
                    align: 'center',
                },
                {
                    label: 'Taux de régularisation',
                    field: 'regularizations_rate',
                    sortable: true,
                    align: 'center',
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
                // {
                //     label: 'Créateur',
                //     name: 'creator_full_name',
                //     sortable: true,
                //     methods: {
                //         showField(item) {
                //             return item.creator_full_name || '-'
                //         }
                //     }
                // },
                // {
                //     label: 'Date création',
                //     name: 'created_at',
                //     sortable: true,
                //     methods: {
                //         showField(item) {
                //             return item.created_at || '-'
                //         }
                //     }
                // },
                // {
                //     label: 'Modfier par',
                //     name: 'updater_full_name',
                //     sortable: true,
                //     methods: {
                //         showField(item) {
                //             return item.creator_full_name || '-'
                //         }
                //     }
                // },
                {
                    label: 'Date de modification',
                    name: 'updated_at',
                    sortable: true,
                    methods: {
                        showField(item) {
                            return item.updated_at || item.created_at
                        }
                    }
                },
            ],
            actions: {
                show: true,
                edit: {
                    show: (item) => {
                        return this.can('edit_family')
                    },
                },
                delete: {
                    show: (item) => {
                        return this.can('delete_family') && item.is_deletable
                    }
                }
            },
            filters: {
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
            let message = item.is_active ? 'Êtes-vous sûr de vouloir désactiver la famille <b>' + item.name + '</b>' : 'Êtes-vous sûr de vouloir activer la famille <b>' + item.name + '</b>'
            this.$swal.confirm({ message }).then(action => {
                if (action.isConfirmed) {
                    this.showModal = false
                    this.$api.patch('families/' + item.id).then(response => {
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
         * Handle close event
         */
        close() {
            this.showModal = false
            this.rowSelected = null
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
                if (action.isConfirmed && !Number(item.control_campaigns_count)) {
                    this.rowSelected = item
                    api.delete('families/' + item.id).then(response => {
                        if (response.data.status) {
                            this.refresh += 1
                            this.close()
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.alert_error(response.data.message)
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
