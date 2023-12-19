<template>
    <div v-if="can('view_control_point')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_control_point')" :to="{ name: 'control-points-create' }"
                    class="btn btn-info">
                    Ajouter
                </router-link>
                <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true">
                    <i class="las la-file-excel icon" />
                    Exporter
                </button>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :filters="filters" :details="details" :actions="actions"
                title="Liste des points de contrôle" urlPrefix="control-points" @edit="edit" @delete="destroy"
                :refresh="refresh" @dataLoaded="handleDataLoaded" />
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
                    field: 'major_fact',
                },
            ],
            details: [
                {
                    label: 'Famille',
                    field: 'family.name'
                },
                {
                    label: 'Domaine',
                    field: 'domain.name'
                },
                {
                    label: 'Processus',
                    field: 'process.name'
                },
                {
                    label: 'Nom',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Fait majeur',
                    field: 'major_fact_str',
                },
                {
                    label: 'Notations',
                    field: 'scores_str',
                    isHtml: true
                },
                // {
                //     label: 'Métadonnées',
                //     field: 'fields.label',
                //     hasMany: true
                // }
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
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            this.$router.push({ name: 'control-points-edit', params: { controlPoint: item.id } })
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
