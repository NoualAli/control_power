<template>
    <div v-if="can('view_field')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_field')" :to="{ name: 'fields-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
                <button class="btn btn-office-excel has-icon" @click="this.excelExportIsOpen = true">
                    <i class="las la-file-excel icon" />
                    Exporter
                </button>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :details="details" :actions="actions" title="Liste des champs"
                urlPrefix="fields" @edit="edit" @delete="destroy" :refresh="refresh" @dataLoaded="handleDataLoaded" />
            <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
                @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" />
        </ContentBody>
    </div>
</template>

<script>
import ExcelExportModal from '../../../Modals/ExcelExportModal.vue';
export default {
    components: { ExcelExportModal },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    metaInfo() {
        return { title: 'Champs' }
    },
    data() {
        return {
            currentUrl: null,
            excelExportIsOpen: false,
            refresh: 1,
            columns: [
                {
                    label: 'Label',
                    field: 'label'
                },
                {
                    label: 'Type',
                    field: 'type'
                },
                {
                    label: 'Nom',
                    field: 'name'
                },
                {
                    label: 'Obligatoire',
                    field: 'required',
                },
            ],
            details: [
                {
                    label: 'Label',
                    field: 'label',
                    cols: {
                        lg: 3
                    }
                },
                {
                    label: 'Type',
                    field: 'type',
                    cols: {
                        lg: 2
                    }
                },
                {
                    label: 'Nom',
                    field: 'name',
                    cols: {
                        lg: 2
                    }
                },
                {
                    label: 'Obligatoire',
                    field: 'required_str',
                    cols: {
                        lg: 2
                    }
                },
                {
                    label: 'Distinct',
                    field: 'distinct_str',
                    cols: {
                        lg: 2
                    }
                },
                {
                    label: 'Placeholder',
                    field: 'placeholder',
                },
                {
                    label: 'Text d\'aide',
                    field: 'help_text',
                },
                {
                    label: 'Colonnes',
                    field: 'columns',
                    cols: {
                        lg: 4
                    }
                },
                {
                    label: 'Longueure (minimum)',
                    field: 'min_length',
                    cols: {
                        lg: 4
                    }
                },
                {
                    label: 'Longueure (maximum)',
                    field: 'max_length',
                    cols: {
                        lg: 4
                    }
                },
                {
                    label: 'Options',
                    field: 'options',
                },
                {
                    label: 'Règles de validations',
                    field: 'additional_rules',
                },
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_fields')
                },
                delete: (item) => {
                    return this.can('delete_fields')
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
            this.$router.push({ name: 'fields-edit', params: { field: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    this.$api.delete('fields/' + item.id).then(response => {
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
