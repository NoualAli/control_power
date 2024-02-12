<template>
    <div v-if="is('root')">
        <!-- <ContentHeader>
            <template #right-actions>
                <NLButton :loading="isBackup" v-if="is('root')" class="btn btn-info" label="Sauvegarder"
                    @click.stop="backup" />
            </template>
        </ContentHeader> -->
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des sauvegardes de la base de données"
                urlPrefix="backup-db" @delete="destroy" :refresh="refresh"
                @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
                <template #actions-after="{ item }">
                    <a @click.stop="download(item)" class="btn btn-info">
                        <i class="las la-download icon" />
                    </a>
                </template>
            </NLDatatable>
        </ContentBody>
    </div>
</template>

<script>
import Form from 'vform'

export default {
    name: 'BackupDB',
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    metaInfo() {
        return { title: 'Backup base de données' }
    },
    data() {
        return {
            refresh: 1,
            isBackup: false,
            columns: [
                {
                    label: 'Nom',
                    field: 'name',
                    sortable: true,
                },
                {
                    label: 'Taille',
                    field: 'size',
                    sortable: true,
                },
                {
                    label: 'Date',
                    field: 'created_at',
                    sortable: true,
                }
            ],
            actions: {
                delete: (item) => {
                    return this.is('root')
                }
            }
        }
    },
    created() {
        this.initData()
    },

    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', false)
        },
        download(item) {
            window.open('/backup-db/' + item.name);
        },
        /**
         * TODO
         */
        backup() {
            this.isBackup = true
            this.form.post('backup-db').then(response => {
                this.isBackup = false
                if (response.data.status) {
                    this.refresh += 1
                    this.$swal.toast_success(response.data.message)
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                this.isBackup = true
                this.$swal.catchError(error)
            })
        },
        destroy(item) {
            this.$swal.confirm_destroy().then((action) => {
                if (action.isConfirmed) {
                    this.$api.delete('backup-db/' + item.name).then(response => {
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
                this.$swal.alert_error(error)
            })
        }
    }
}
</script>

<style lang="scss" scoped></style>
