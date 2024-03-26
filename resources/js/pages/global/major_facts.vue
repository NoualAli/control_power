<template>
    <ContentBody>
        <NLDatatable :columns="columns" :actions="actions" :filters="filters" title="Faits majeurs"
            urlPrefix="agency_level/major-facts" @show="show" :refresh="refresh"
            @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)">
            <template #table-actions>
                <NLButton class="has-icon" @click="refresh += 1">
                    <NLIcon name="sync" />
                </NLButton>
            </template>
        </NLDatatable>

        <!-- View control point informations -->
        <MissionDetailModal :rowSelected="rowSelected" :show="modals.show" @success="success" @showForm="showForm"
            @close="close" />

        <!-- Traitement du point de contrôle -->
        <MissionDetailForm :data="rowSelected" :show="modals.edit" @success="success" @close="close" />

        <!-- Régularization du point de contrôle -->
        <MissionRegularizationForm :data="rowSelected" :show="modals.regularize" @success="success" @close="close" />
    </ContentBody>
</template>

<script>
import { hasRole } from '../../plugins/user'
import Alert from '../../components/Alert'
import MissionDetailModal from '../../Modals/MissionDetailModal'
import MissionDetailForm from '../../forms/MissionDetailForm'
import MissionRegularizationForm from '../../forms/MissionRegularizationForm'
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
                    label: 'Référence',
                    field: 'reference',
                },
                {
                    label: 'DRE',
                    field: 'dre',
                    hide: hasRole([ 'cdc', 'da', 'ci' ]),
                    sortable: true,
                },
                {
                    label: 'Agence',
                    field: 'agency',
                    hide: hasRole([ 'da' ]),
                    sortable: true,
                },
                {
                    label: 'Famille',
                    field: 'family',
                    // hide: !hasRole([ 'cdcr', 'dcp', 'cc' ]),
                    sortable: true,
                    length: 50,
                },
                {
                    label: 'Domaine',
                    field: 'domain',
                    // hide: !hasRole([ 'cdcr', 'dcp', 'cc' ]),
                    sortable: true,
                    length: 30,
                },
                {
                    label: 'Processus',
                    field: 'process',
                    // hide: !hasRole([ 'cdcr', 'dcp', 'cc' ]),
                    sortable: true,
                    length: 50,
                },
                {
                    label: 'Point de contrôle',
                    field: 'control_point',
                    length: 50,
                    // hide: !hasRole([ 'cdcr', 'dcp', 'cc' ]),
                    sortable: true,
                },
                {
                    label: 'Validé',
                    field: 'major_fact_is_validated',
                    isHtml: true,
                    methods: {
                        showField(item) {
                            let icon = 'exclamation-triangle'
                            let color = 'text-warning'
                            let title = 'En attente de traitement'
                            if (item.major_fact_is_validated == 1) {
                                icon = 'check-circle'
                                color = 'text-success'
                                title = 'Validé'
                            } else if (item.major_fact_is_pending == 1 && item.major_fact_is_rejected == 0) {
                                icon = 'exclamation-triangle'
                                color = 'text-warning'
                                title = 'En attente de traitement'
                            } else if (item.major_fact_is_rejected == 1 && item.major_fact_is_pending == 0) {
                                icon = 'times-circle'
                                color = 'text-danger'
                                title = 'Rejeté'
                            }
                            return `<i class="las la-${icon} ${color} icon" title="${title}"></i>`
                        }
                    }
                },
                {
                    label: 'Etat',
                    field: 'state',
                }
            ],
            actions: {
                show: true
            },
            modals: {
                show: false,
                edit: false,
                regularize: false
            },
            filters: {
                id: {
                    hide: true,
                    data: null,
                    value: null
                },
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
                    value: null
                },
                mission: {
                    label: 'Mission',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null
                },
                family: {
                    label: 'Famille',
                    multiple: true,
                    data: null,
                    value: null
                },
                domain: {
                    label: 'Domaine',
                    multiple: true,
                    data: null,
                    value: null
                },
                process: {
                    label: 'Processus',
                    multiple: true,
                    data: null,
                    value: null
                },
                state: {
                    label: 'Etat',
                    multiple: false,
                    value: null,
                    data: [
                        {
                            id: 'Non levée',
                            label: 'Non levée'
                        },
                        {
                            id: 'En cours d\'assainissement',
                            label: 'En cours d\'assainissement'
                        },
                        {
                            id: 'Levée',
                            label: 'Levée'
                        },
                        {
                            id: 'Rejetée',
                            label: 'Rejetée'
                        }
                    ]
                },
                with_metadata: {
                    label: 'Avec échantillonage',
                    multiple: false,
                    value: null,
                    data: [
                        {
                            id: 'Non',
                            label: 'Non'
                        },
                        {
                            id: 'Oui',
                            label: 'Oui'
                        }
                    ]
                },
            },
        }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        if (this.$route?.query?.id) {
            this.filters.id.value = this.$route?.query?.id
        } else if (this.$route.query[ 'filter[id]' ]) {
            this.filters.id.value = this.$route?.query[ 'filter[id]' ]
        }
    },
    methods: {
        /**
         * Handle success result
         *
         * @param {*} e
         */
        success(e) {
            this.refresh += 1
            this.show(this.rowSelected)
        },
        /**
        * Affiche le modal des informations du point de contrôle
        * @param {Object} item
        */
        show(item) {
            this.rowSelected = item
            this.modals.show = true
            this.modals.edit = false
            this.modals.regularize = false
        },
        /**
         * Affiche le modal pour modifer informations du point de contrôle
         *
         */
        processing(row) {
            this.rowSelected = row
            this.modals.show = false
            this.modals.regularize = false
            this.modals.edit = true
        },

        /**
         * Affiche le modal pour régulariser le point de contrôle
         *
         */
        regularize(row) {
            this.rowSelected = row
            this.modals.show = false
            this.modals.edit = false
            this.modals.regularize = true
        },

        /**
         * Ferme la boite modal des détails du point de contrôle
         */
        close() {
            for (const key in this.modals) {
                if (Object.hasOwnProperty.call(this.modals, key)) {
                    this.modals[ key ] = false
                }
            }
            this.rowSelected = null
        },
        /**
         * @param {Object} Object
         * @param {Object} Object.row
         * @param {String} Object.type
         */
        showForm({ row, type }) {
            const functionName = type.toLowerCase();
            const fn = this[ functionName ];
            if (fn && typeof fn === 'function') {
                fn(row);
            } else {
                console.error('Function not found or not a function:', functionName);
            }
        }
    }
}
</script>
