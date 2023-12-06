<template>
    <div v-if="can('view_process')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_process')" :to="{ name: 'processes-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
                <a href="/excel-export?export=processes" target="_blank" class="btn btn-office-excel has-icon">
                    <i class="las la-file-excel icon" />
                    Exporter
                </a>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des processus" urlPrefix="processes"
                @edit="edit" @delete="destroy" :refresh="refresh"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
                <template #actions-before="{ item }">
                    <a class="btn btn-office-excel" :href="'/excel-export?export=processes&id=' + item.id" target="_blank">
                        <i class="las la-file-excel icon" />
                    </a>
                </template>
            </NLDatatable>
        </ContentBody>
    </div>
</template>

<script>
export default {
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
                    label: 'Nom',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Nombres de points de contrôle',
                    field: 'control_points_count'
                }
            ],
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
        /**
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            this.$router.push({ name: 'processes-edit', params: { process: item.id } })
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
                console.log(error)
                this.$swal.alert_error()
            })
        },
    }
}
</script>
