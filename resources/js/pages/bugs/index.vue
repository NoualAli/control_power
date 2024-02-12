<template>
    <div>
        <ContentHeader>
            <template #right-actions>
                <router-link :to="{ name: 'bugs-create' }" class="btn btn-info">
                    Signaler un bug
                </router-link>
                <button class="btn btn-office-excel has-icon" @click="openExcelExport">
                    <NLIcon name="table" />
                    Exporter
                </button>
            </template>
        </ContentHeader>

        <ContentBody>
            <NLDatatable :columns="columns" :details="details" urlPrefix="bugs" @dataLoaded="handleDataLoaded"
                :refresh="refresh">
                <template #actions-before="{ item }">
                    <button class="btn btn-info" v-if="!item?.state && is(['root', 'admin'])" @click="fix(item)">
                        <i class="las la-check-circle icon"></i>
                    </button>
                </template>
            </NLDatatable>
            <ExcelExportModal v-if="excelExportIsOpen" :show="excelExportIsOpen" :route="this.currentUrl"
                @close="this.excelExportIsOpen = false" @success="this.excelExportIsOpen = false" />
        </ContentBody>
    </div>
</template>

<script>
import { hasRole } from '../../plugins/user'
import ExcelExportModal from '../../Modals/ExcelExportModal';
export default {
    middleware: [ 'auth' ],
    layout: 'MainLayout',
    components: {
        ExcelExportModal
    },
    data() {
        return {
            refresh: 0,
            excelExportIsOpen: false,
            currentUrl: null,
            columns: [
                {
                    field: 'reference',
                    label: 'Référence',
                },
                {
                    field: 'type',
                    label: 'Type',
                },
                {
                    field: 'creator.full_name',
                    label: 'Initiateur',
                    hide: !hasRole([ 'root', 'admin' ])
                },
                {
                    field: 'priority_html',
                    label: 'Priorité',
                    isHtml: true,
                    align: 'center',
                },
                {
                    field: 'created_at',
                    label: 'Signaler le',
                },
                {
                    field: 'state_html',
                    label: 'Etat',
                    isHtml: true,
                },
            ],
            details: [
                {
                    field: 'description',
                    label: 'Description',
                    isHtml: true,
                    cols: {
                        lg: 12
                    }
                },
                {
                    field: 'type',
                    label: 'Type',
                },
                {
                    field: 'creator.full_name',
                    label: 'Initiateur',
                },
                {
                    field: 'priority_html',
                    label: 'Priorité',
                    isHtml: true,
                    align: 'center',
                },
                {
                    field: 'created_at',
                    label: 'Signaler le',
                },
                {
                    field: 'state_html',
                    label: 'Etat',
                    isHtml: true,
                },
                {
                    field: 'media_links_list',
                    label: 'Pièces jointes',
                    isMedia: true,
                    cols: {
                        lg: 12
                    }
                },
            ],
        }
    },
    methods: {
        handleDataLoaded(response) {
            this.currentUrl = response.url
            this.$store.dispatch('settings/updatePageLoading', false)
        },
        openExcelExport() {
            this.excelExportIsOpen = true
        },
        fix(item) {
            this.$swal.confirm_update('Voulez-vous marquer ce bug comme résolut ?').then(action => {
                if (action.isConfirmed) {
                    this.$api.put('bugs/' + item.id).then(response => {
                        if (response?.data?.status) {
                            this.refresh += 1
                            this.$swal.toast_success(response?.data?.message)
                        } else {
                            this.$swal.toast_error(response?.data?.message)
                        }
                    })
                }
            }).catch(error => {
                this.$swal.catchError(error)
            })
        }
    }

}
</script>
