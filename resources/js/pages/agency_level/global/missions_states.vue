<template>
    <ContentBody>
        <NLDatatable :columns="columns" :actions="actions" :filters="filters" @show="show" title="Etat des missions"
            @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)"
            urlPrefix="agency_level/missions/anomalies/states" :refresh="refresh">
            <template #table-actions>
                <NLButton class="has-icon" @click="refresh += 1">
                    <NLIcon name="sync" />
                </NLButton>
            </template>
        </NLDatatable>
    </ContentBody>
</template>

<script>
import { hasRole } from '~/plugins/user'
import Alert from '~/components/Alert'
import MissionDetailModal from '~/Modals/MissionDetailModal'
import MissionDetailForm from '~/forms/MissionDetailForm'
import MissionRegularizationForm from '~/forms/MissionRegularizationForm'
export default {
    components: { Alert, MissionDetailForm, MissionDetailModal, MissionRegularizationForm },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data: () => {
        return {
            rowSelected: null,
            refresh: 0,
            columns: [
                {
                    label: 'Campagne de contrôle',
                    field: 'cc_reference',
                    sortable: true,
                },
                {
                    label: 'Mission',
                    field: 'm_reference',
                    sortable: true,
                },
                {
                    label: 'Total anomalies',
                    field: 'total_anomalies',
                    sortable: true,
                },
                {
                    label: 'Total régularisées',
                    field: 'total_regularized',
                    sortable: true,
                },
                {
                    label: 'Taux de régularization',
                    field: 'regularization_rate',
                    sortable: true,
                },
            ],
            actions: {
                show: true
            },
            filters: {
                campaign: {
                    label: 'Campagne de contrôle',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null
                },
                dre: {
                    label: 'DRE',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null,
                    hide: hasRole([ 'cdc', 'ci', 'da', 'dre' ])
                },
                agency: {
                    label: 'Agence',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null,
                    hide: hasRole([ 'da' ])
                },
            },
        }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    methods: {
        /**
        * Affiche le modal des informations du point de contrôle
        * @param {Object} item
        */
        show(item) {
            window.open(this.$router.resolve({ name: 'anomalies' }).href + `?campaign=${item.cc_id}&mission=${item.m_id}`, '_blank')
        },
    }
}
</script>
