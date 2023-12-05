<template>
    <div v-if="can('view_family')">
        <ContentHeader>
            <template #actions>
                <router-link v-if="can('create_family')" :to="{ name: 'families-create' }" class="btn btn-info">
                    Ajouter
                </router-link>
                <a href="/excel-export?export=families" target="_blank" class="btn btn-excel has-icon">
                    <i class="las la-file-excel icon" />
                    Exporter
                </a>
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des familles" urlPrefix="families" @edit="edit"
                @delete="destroy" :key="forceReload"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
                <template #actions-before="{ item }">
                    <a class="btn btn-excel" :href="'/excel-export?export=families&id=' + item.id" target="_blank">
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
        return { title: 'Famille' }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    data() {
        return {
            forceReload: 1,
            columns: [
                {
                    label: 'Nom',
                    field: 'name',
                    sortable: true
                },
                {
                    label: 'Nombre de domaines',
                    field: 'domains_count'
                }
            ],
            actions: {
                edit: (item) => {
                    return this.can('edit_family')
                },
                delete: (item) => {
                    return this.can('delete_family')
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
            this.$router.push({ name: 'families-edit', params: { family: item.id } })
        },

        /**
         * Supprime la ressource
         * @param {Object} item
         */
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    api.delete('families/' + item.id).then(response => {
                        if (response.data.status) {
                            this.forceReload += 1
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
