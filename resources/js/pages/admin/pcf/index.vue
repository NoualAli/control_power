<template>
    <ContentBody>
        <NLDatatable :refresh="refresh" :columns="columns" :actions="actions" :details="details" :filters="filters"
            title="Textes réglementaires" urlPrefix="pcf"
            @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
            <template #table-actions>
                <router-link v-if="is(['root', 'admin', 'cdcr'])" :to="{ name: 'pcf-management-create' }" class="btn">
                    <NLIcon name="add" />
                    Ajouter
                </router-link>
            </template>
        </NLDatatable>

        <ProcessModal :rowSelected="currentProcess" :show="!!currentProcess" @close="close" />
    </ContentBody>
</template>
<script>
import ProcessModal from '~/Modals/ProcessModal'
import NLColumn from '~/components/Grid/NLColumn'
import NLGrid from '~/components/Grid/NLGrid'
import NLListItem from '~/components/List/NLListItem'
import NLList from '~/components/List/NLList'
import NLModal from '~/components/NLModal'
import { hasRole } from '~/plugins/user'
export default {
    components: {
        ProcessModal,
        NLColumn,
        NLGrid,
        NLListItem,
        NLList, NLModal
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    data() {
        return {
            currentProcess: null,
            refresh: 0,
            columns: [
                {
                    label: 'Catégorie',
                    field: 'category',
                    sortable: true
                },
                {
                    label: 'Nom',
                    field: 'original_name',
                    sortable: true,
                    isHtml: true,
                    methods: {
                        showField(item) {
                            return '<a href="' + item.path + '" target="_blank" download="' + item.original_name + '">' + item.original_name + '</a>'
                        }
                    }
                },
                {
                    label: 'Taille',
                    field: 'size',
                    sortable: true
                },
                {
                    label: 'Total attaché',
                    field: 'relationship_count',
                    sortable: true
                },
            ],
            filters: {
                category: {
                    label: 'Catégories',
                    name: 'category',
                    multiple: true,
                    data: [
                        {
                            id: 'Notes',
                            label: 'Notes',
                        },
                        {
                            id: 'Circulaires',
                            label: 'Circulaires',
                        },
                        {
                            id: 'Lettres-circulaire',
                            label: 'Lettres-circulaire',
                        },
                        {
                            id: 'Guides 1er niveau',
                            label: 'Guides 1er niveau',
                        },
                    ],
                    value: null
                },
            },
            details: [
                {
                    label: 'Objet',
                    field: 'object',
                    cols: {
                        lg: 6
                    }
                },
                {
                    label: 'Date',
                    field: 'date',
                    cols: {
                        lg: 3
                    }
                },
                {
                    label: 'N°',
                    field: 'number',
                    cols: {
                        lg: 3
                    }
                }
            ],
            actions: {
                delete: {
                    show: hasRole([ 'root', 'admin', 'cdcr' ]),
                    apply: this.destroy
                },
                edit: {
                    show: hasRole([ 'root', 'admin', 'cdcr' ]),
                    apply: this.edit
                },
            }
        }
    },
    methods: {
        show(item) {
            this.currentProcess = item.item
        },
        destroy(e) {
            this.$swal.confirm_destroy("Êtes-vous sûr de vouloir supprimer l'élément: <b>" + e.item.category + "</b> <br/> nommé: <b>" + e.item.original_name + "</b>").then(action => {
                if (action.isConfirmed) {
                    this.$api.delete('pcf/' + e.item.id).then(response => {
                        if (response.data.status) {
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                        this.refresh += 1
                    }).catch(error => {
                        this.$swal.catchError(error)
                    })
                }
            })
        },
        edit(e) {
            window.open(this.$router.resolve({ name: 'pcf-management-edit', params: { pcf: e.item.id } }).href, '_blank')
        },
        close() {
            this.currentProcess = null
        }
    }
}
</script>
