<!-- eslint-disable vue/multi-word-component-names -->
<!-- eslint-disable vue/no-v-html -->
<template>
    <div v-if="can('view_control_point')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_control_point')" :to="{ name: 'control-points-create' }"
                    class="btn btn-info">
                    Ajouter
                </router-link>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :filters="filters" :details="details" :actions="actions"
                title="Liste des points de contrôle" urlPrefix="control-points" @edit="edit" @delete="destroy" />
        </ContentBody>
    </div>
</template>

<script>
import NLDatatable from '../../../components/Datatable/NLDatatable'
export default {
    components: { NLDatatable },
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
    metaInfo() {
        return { title: 'Points de contrôle' }
    },
    data() {
        return {
            reloadData: false,
            columns: [
                {
                    label: 'Famille',
                    field: 'familly_name'
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
                    field: 'familly.name'
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
                    dependsOn: 'familly'
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
    methods: {
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
                            this.initData()
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
        /**
         * Initialise les données
         */
        initData() {
            this.reloadData = true
        },
    }
}
</script>
