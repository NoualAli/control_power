<template>
    <ContentBody>
        <NLDatatable :columns="columns" :actions="actions" :filters="filters" @show="show"
            title="Anomalie • Notation • Plan de redressement" urlPrefix="details" :key="forceReload"
            @dataLoaded="() => this.$store.dispatch('settings/updatePageLoading', false)" />

        <!-- View control point informations -->
        <MissionDetailModal :rowSelected="rowSelected" :show="modals.show" @showForm="showForm" @close="close" />

        <!-- Traitement du point de contrôle -->
        <MissionDetailForm :data="rowSelected" :show="modals.edit" @success="success" @close="close" />

        <!-- Régularization du point de contrôle -->
        <MissionRegularizationForm :detail="rowSelected" :show="modals.regularize" @success="success" @close="close"
            :key="forceReload" />
    </ContentBody>
</template>
<script>
import { hasRole, user } from '../../plugins/user'
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
            forceReload: 1,
            columns: [
                {
                    label: 'CDC-ID',
                    field: 'campaign',
                    sortable: true,
                },
                {
                    label: 'RAP-ID',
                    field: 'mission',
                    sortable: true,
                },
                {
                    label: 'DRE',
                    field: 'dre',
                    hide: hasRole([ 'cdc', 'ci', 'da', 'dre' ]),
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
                    sortable: true,
                    length: 50,
                },
                {
                    label: 'Domaine',
                    field: 'domain',
                    sortable: true,
                    length: 30,
                },
                {
                    label: 'Processus',
                    field: 'process',
                    sortable: true,
                    length: 50,
                },
                {
                    label: 'Point de contrôle',
                    field: 'control_point',
                    length: 50,
                    sortable: true,
                },
                {
                    label: 'Notation',
                    field: 'score',
                    align: 'center',
                    hide: !hasRole([ 'dcp', 'cdcr', 'cc' ]),
                    sortable: true,
                    isHtml: true,
                    methods: {
                        showField(item) {
                            // console.log(item.score);
                            const score = item.score;
                            let style = ''
                            if (score == 1) {
                                style = 'is-success';
                            } else if (score == 2) {
                                style = 'is-info';
                            } else if (score == 3) {
                                style = 'is-warning';
                            } else if (score == 4) {
                                style = 'is-danger';
                            } else {
                                style = 'is-grey';
                            }

                            return '<div class="tag ' + style + '">' + score + '</div>';
                        }
                    }
                },
                {
                    label: 'Etat',
                    field: 'is_regularized_str',
                    hide: hasRole([ 'cdc', 'ci' ])
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
                is_regularized: {
                    label: 'Régularisation',
                    multiple: false,
                    value: null,
                    hide: hasRole([ 'cdc', 'ci' ]),
                    data: [
                        {
                            id: 'Non levée',
                            label: 'Non levée'
                        },
                        {
                            id: 'Levée',
                            label: 'Levée'
                        }
                    ]
                },
                score: {
                    label: 'Notation',
                    multiple: true,
                    data: [
                        {
                            id: 2,
                            label: 2
                        },
                        {
                            id: 3,
                            label: 3
                        },
                        {
                            id: 4,
                            label: 4
                        }
                    ],
                    value: null,
                    hide: !hasRole([ 'dcp', 'cdcr', 'cc' ]),
                }
            },
        }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
    },
    methods: {
        /**
         * Handle success result
         *
         * @param {*} e
         */
        success(e) {
            // this.$store.dispatch('settings/updatePageLoading', true)
            // this.forceReload += 1
            const row = this.rowSelected
            this.modals.edit = false
            this.modals.regularize = false
            this.close(true)
            this.show(row)
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
        edit(row) {
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
         * Handle close event
         */
        close(forceReload = false) {
            this.$store.dispatch('settings/updatePageLoading', true)
            for (const key in this.modals) {
                if (Object.hasOwnProperty.call(this.modals, key)) {
                    this.modals[ key ] = false
                }
            }
            this.rowSelected = null
            if (forceReload) {
                this.forceReload += 1
            }
            this.$store.dispatch('settings/updatePageLoading', false)
        },
        /**
         * @param {Object} Object
         * @param {Object} Object.row
         * @param {String} Object.type
         */
        showForm({ row, type }) {
            if (type == 'processing' || type == 'edit') {
                this.edit(row)
            } else if (type == 'regularization') {
                this.regularize(row)
            }
        }
    }
}
</script>
