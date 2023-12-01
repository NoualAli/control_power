<template>
    <div v-if="is('root')">
        <ContentHeader>
            <template #actions>
                <NLButton :loading="isBackup" v-if="is('root')" class="btn btn-info" label="Sauvegarder"
                    @click.stop="backup" />
            </template>
        </ContentHeader>
        <ContentBody>
            <NLDatatable :columns="columns" :actions="actions" title="Liste des sauvegarde de la base de données"
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
        return { title: 'Backup base de donnée' }
    },
    data() {
        return {
            refresh: 1,
            isBackup: false,
            form: new Form({}),
            columns: [
                {
                    label: 'Nom',
                    field: 'name',
                },
                {
                    label: 'Taille',
                    field: 'size',
                },
                {
                    label: 'Extension',
                    field: 'extension',
                },
                {
                    label: 'Date',
                    field: 'created_at',
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
        backup() {
            this.isBackup = !this.isBackup
            this.form.post('backup-db').then(response => {
                this.isBackup = !this.isBackup
                if (response.data.status) {
                    this.refresh += 1
                    this.$swal.toast_success(response.data.message)
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                this.isBackup = !this.isBackup
                console.log(error)
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
