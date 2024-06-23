<template>
    <ContentBody>
        <NLDatatable :columns="columns" :details="details" :filters="filters" :actions="actions" title="Références PCF"
            urlPrefix="references/pcf" @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)" />

        <ProcessModal :rowSelected="currentProcess" :show="!!currentProcess" @close="close" />
    </ContentBody>
</template>
<script>
import ProcessModal from '~/Modals/ProcessModal.vue'
import NLColumn from '~/components/Grid/NLColumn'
import NLGrid from '~/components/Grid/NLGrid'
import NLListItem from '~/components/List/NLListItem'
import NLList from '~/components/List/NLList'
import NLModal from '~/components/NLModal'
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
            columns: [
                {
                    label: 'Famille',
                    field: 'family',
                    sortable: true
                },
                {
                    label: 'Domaine',
                    field: 'domain',
                    sortable: true
                },
                {
                    label: 'Processus',
                    field: 'process',
                    sortable: true
                },
            ],
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
                }
            },
            details: [
                {
                    label: 'Points de contrôle',
                    field: 'control_points.name',
                    hasMany: true,
                    cols: {
                        lg: 12
                    }
                }
            ],
            actions: {
                show: {
                    show: true,
                    apply: this.show
                },
            }
        }
    },
    methods: {
        show(item) {
            this.currentProcess = item.item
        },
        close() {
            this.currentProcess = null
        }
    }
}
</script>
