<template>
    <div v-if="can('view_control_point')">
        <ContentBody>
            <NLDatatable :columns="columns" :filters="filters" :details="details" :actions="actions"
                title="Liste des points de contrôle" urlPrefix="control-points" @edit="edit" @delete="destroy"
                :refresh="refresh" @dataLoaded="handleDataLoaded">

                <template #actions-after="{ item }">
                    <button :class="['btn', { 'btn-success': !item.is_active, 'btn-danger': item.is_active }]"
                        @click="toggleState(item)" v-if="item.process_is_active">
                        <NLIcon :name="item.is_active ? 'lock_open' : 'lock'" />
                    </button>
                </template>

                <template #table-actions>
                    <router-link v-if="can('create_control_point')" :to="{ name: 'control-points-create' }"
                        class="btn has-icon">
                        <NLIcon name="add" />
                        Ajouter
                    </router-link>
                    <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true">
                        <NLIcon name="table" />
                        Exporter
                    </button>
                    <NLButton class="has-icon" @click="refresh += 1">
                        <NLIcon name="sync" />
                    </NLButton>
                </template>
            </NLDatatable>
            <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
                @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" />
        </ContentBody>
    </div>
</template>

<script>
import ExcelExportModal from '../../../Modals/ExcelExportModal';
export default {
    components: { ExcelExportModal },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    metaInfo() {
        return { title: 'Points de contrôle' }
    },
    data() {
        return {
            currentUrl: null,
            excelExportIsOpen: false,
            refresh: 0,
            columns: [
                {
                    label: 'Ordre d\'affichage',
                    field: 'display_priority',
                    sortable: true,
                    align: 'center',
                },
                {
                    label: 'Famille',
                    field: 'family_name'
                },
                {
                    label: 'Domaine',
                    field: 'domain_name'
                },
                {
                    label: 'Processus',
                    field: 'process_name'
                },
                {
                    label: 'Nom',
                    field: 'name',
                    length: 75,
                    sortable: true,
                },
                {
                    label: 'Fait majeur',
                    field: 'has_major_fact',
                    align: 'center',
                    isHtml: true,
                    methods: {
                        showField(item) {
                            let icon = item.has_major_fact == 1 ? 'check-circle' : 'times-circle'
                            let color = item.has_major_fact == 1 ? 'text-success' : 'text-danger'
                            let title = item.has_major_fact == 1 ? 'Oui' : 'Non'

                            return `<i class="las la-${icon} ${color} icon" title="${title}"></i>`
                        }
                    }
                },
                {
                    label: 'Échantillonnage',
                    name: 'field_count',
                    align: 'center',
                    isHtml: true,
                    methods: {
                        showField(item) {
                            let icon = Boolean(item.field_count) ? 'check-circle' : 'times-circle'
                            let color = Boolean(item.field_count) ? 'text-success' : 'text-danger'
                            let title = Boolean(item.field_count) ? 'Oui' : 'Non'

                            return `<i class="las la-${icon} ${color} icon" title="${title}"></i>`
                        }
                    }
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
                    label: 'Notations',
                    field: 'scores_str',
                    isHtml: true
                },
                {
                    label: 'Échantillonnage',
                    field: 'fields.label',
                    hasMany: true
                },
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_control_point')
                },
                delete: (item) => {
                    return this.can('delete_control_point')
                }
            },
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
                process: {
                    label: 'Processus',
                    name: 'process',
                    multiple: true,
                    data: null,
                    value: null,
                    dependsOn: 'domain'
                },
                major_fact: {
                    label: 'Fait majeur',
                    name: 'major_fact',
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
                },
                with_metadata: {
                    label: 'Avec échantillonage',
                    multiple: false,
                    value: null,
                    data: [
                        {
                            id: 'Non',
                            label: 'Non'
                        },
                        {
                            id: 'Oui',
                            label: 'Oui'
                        }
                    ]
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
            let message = item.is_active ? 'Êtes-vous sûr de vouloir désactiver le point de contrôle <b>' + item.name + '</b>' : 'Êtes-vous sûr de vouloir activer le point de contrôle <b>' + item.name + '</b>'
            this.$swal.confirm({ message }).then(action => {
                this.rowSelected = item
                if (action.isConfirmed) {
                    this.$api.patch('control-points/' + item.id).then(response => {
                        if (response.data.status) {
                            this.refresh += 1
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
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            // this.$router.push({ name: 'control-points-edit', params: { controlPoint: item.id } })
            window.open(this.$router.resolve({ name: 'control-points-edit', params: { controlPoint: item.id } }).href, '_blank')
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    this.$api.delete('control-points/' + item.id).then(response => {
                        if (response.data.status) {
                            this.refresh += 1
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.toast_error(response.data.message)
                        }
                    })
                }
            }).catch(error => {
                this.$swal.alert_error(error.message)
            })
        },
    }
}
</script>
