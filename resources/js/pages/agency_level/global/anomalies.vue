<template>
    <ContentBody>
        <NLDatatable :columns="columns" :actions="actions" :filters="filters" @show="show" title="Plans de redressement"
            :urlPrefix="urlPrefix" @dataLoaded="initData()" :refresh="refresh" v-if="urlPrefix">
            <template #table-actions>
                <NLButton class="has-icon" @click="refresh += 1">
                    <NLIcon name="sync" />
                </NLButton>
            </template>
        </NLDatatable>

        <!-- View control point informations -->
        <MissionDetailModal :rowSelected="rowSelected" :show="modals.show" @showForm="showForm" @success="success"
            @close="close" />

        <!-- Traitement du point de contrôle -->
        <MissionDetailForm :data="rowSelected" :show="modals.edit" @success="success" @close="close" />

        <!-- Régularization du point de contrôle -->
        <MissionRegularizationForm :detail="rowSelected" :show="modals.regularize" @success="success" @close="close" />
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
            campaign_id: null,
            mission_id: null,
            urlPrefix: null,
            columns: [
                {
                    label: 'Campagne',
                    field: 'campaign',
                    sortable: true
                },
                {
                    label: 'Mission',
                    field: 'mission',
                    sortable: true
                },
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
                    label: 'Notation',
                    field: 'score',
                    align: 'center',
                    hide: hasRole([ 'cdc', 'ci', 'da' ]),
                    sortable: true,
                    isHtml: true,
                    methods: {
                        showField(item) {
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

                            return '<span class="tag is-centered ' + style + '">' + score + '</span>';
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
                    value: null,
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
                mission: {
                    label: 'Mission',
                    cols: 3,
                    multiple: true,
                    data: null,
                    value: null,
                    hide: hasRole([ 'da' ])
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
                    data: null
                },
                score: {
                    label: 'Notation',
                    multiple: true,
                    data: null,
                    value: null,
                    hide: hasRole([ 'ci', 'cdc', 'da' ]),
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
            modals: {
                show: false,
                edit: false,
                regularize: false,
            },
        }
    },
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        if (this.$route?.query?.id) this.filters.id.value = this.$route?.query?.id
        if (this.$route?.query?.campaign) this.campaign_id = this.$route?.query?.campaign
        if (this.$route?.query?.mission) this.mission_id = this.$route?.query?.mission
        this.urlPrefix = `agency_level/anomalies`
        if (this.campaign_id && this.mission_id) {
            this.columns.find(column => column.label == 'Mission').hide = true
            this.columns.find(column => column.label == 'Campagne').hide = true

            this.filters.campaign.hide = true
            this.filters.mission.hide = true
            this.filters.dre.hide = true
            this.filters.agency.hide = true

            this.urlPrefix = `agency_level/anomalies/${this.campaign_id}/${this.mission_id}`
        }
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', false)
        },
        /**
         * Handle success result
         *
         * @param {*} e
         */
        success(e) {
            this.refresh += 1
            const row = this.rowSelected
            this.modals.edit = false
            this.modals.regularize = false
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
            this.modals.edit = true
            this.modals.show = false
            this.modals.regularize = false
        },

        /**
         * Affiche le modal pour régulariser le point de contrôle
         *
         */
        regularization(row) {
            this.rowSelected = row
            this.modals.regularize = true
            this.modals.show = false
            this.modals.edit = false
        },

        /**
         * Handle close event
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
