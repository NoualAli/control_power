<template>
    <ContentBody>
        <NLDatatable :columns="columns" :details="details" :filters="filters" :actions="actions" title="Références PCF"
            urlPrefix="references/pcf" @action="handleActions" @show="handleActions"
            @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)" />

        <ProcessInformationsModal :process="currentProcess" :show="!!currentProcess" @close="close" />
    </ContentBody>
</template>
<script>
import ProcessInformationsModal from '../../Modals/ProcessInformationsModal'
import NLColumn from '../../components/Grid/NLColumn'
import NLGrid from '../../components/Grid/NLGrid'
import NLListItem from '../../components/List/NLListItem'
import NLList from '../../components/List/NLList'
import NLModal from '../../components/NLModal'
export default {
    components: {
        ProcessInformationsModal,
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
                    field: 'family_name',
                    filterable: 'family_id',
                },
                {
                    label: 'Domaine',
                    field: 'domain_name',
                    filterable: 'domain_id',
                },
                {
                    label: 'Processus',
                    field: 'process_name',
                    filterable: 'process_id',
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
                    label: 'Famille',
                    field: 'family.name',
                },
                {
                    label: 'Domaine',
                    field: 'domain.name',
                },
                {
                    label: 'Processus',
                    field: 'name',
                },
                {
                    label: 'Points de contrôle',
                    field: 'control_points.name',
                    hasMany: true
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
        handleActions(e) {
            console.log(e);
        },
        show(item) {
            this.currentProcess = item.item
            // this.$api.get('processes/' + item.item.id).then(response => this.currentProcess = response.data)
        },
        close() {
            this.currentProcess = null
        }
    }
}
</script>
