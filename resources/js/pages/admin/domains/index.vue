<template>
    <div v-if="can('view_domain')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_domain')" :to="{ name: 'domains-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
                <a href="/excel-export?export=domains" target="_blank" class="btn btn-office-excel has-icon">
                    <i class="las la-file-excel icon" />
                    Exporter
                </a>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des domaines" urlPrefix="domains" @edit="edit"
                @delete="destroy" :refresh="refresh"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
                <template #actions-before="{ item }">
                    <a class="btn btn-office-excel" :href="'/excel-export?export=domains&id=' + item.id" target="_blank">
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
        return { title: 'Domaines' }
    },
    data() {
        return {
            refresh: 0,
            columns: [
                {
                    label: 'Famille',
                    field: 'family.name'
                },
                {
                    label: 'Nom',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Nombres de processus',
                    field: 'processes_count'
                }
            ],
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
        /**
         * Redirige vers la page d'edition
         * @param {Object} item
         */
        edit(item) {
            this.$router.push({ name: 'domains-edit', params: { domain: item.id } })
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
