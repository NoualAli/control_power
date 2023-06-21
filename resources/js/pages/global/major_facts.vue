<template>
    <ContentBody>
        <NLDatatable :columns="columns" :actions="actions" :filters="filters" title="Faits majeurs"
            urlPrefix="details/major-facts" @show="show" />

        <!-- View control point informations -->
        <MissionDetailModal :rowSelected="rowSelected" :show="modals.show" @showForm="showForm" @close="close" />

        <!-- Traitement du point de contrôle -->
        <MissionDetailForm :data="rowSelected" @success="success" :containerExpanded="detailFormExpanded"
            :names="forms?.detail" v-if="modals.edit" :show="modals.edit" />

        <!-- Régularization du point de contrôle -->
        <NLModal v-if="modals.regularize" :show="modals.regularize" :defaultMode="true" @close="close('regularize')">
            <template #title>
                <small>
                    {{ rowSelected?.control_point?.name }}
                </small>
            </template>
            <template #default>
                <Alert v-if="forms.regularization.errors.any()" type="is-danger">
                    Il y a {{ formErrorsCount }}
                    {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
                </Alert>
                <form enctype="multipart/form-data" class="grid gap-6" @submit.prevent="save('regularize')"
                    @keydown="forms.detail.onKeydown($event)">
                    <div class="col-12">
                        <NLSwitch v-model="forms.regularization.regularized" type="is-success" :name="'regularized'"
                            :form="forms.regularized" label="Levée" />
                    </div>
                    <div class="col-12">
                        <NLSelect v-if="!forms.regularization.regularized" v-model="forms.regularization.type" name="type"
                            :options="regularizationTypes" :form="forms.regularization" label="Choisissez un type"
                            label-required />
                    </div>
                    <!-- Recovery plan -->
                    <div v-if="forms.regularization.regularized" class="col-12">
                        <NLTextarea v-model="forms.regularization.committed_action" :name="'committed_action'"
                            label="Action engagée" :form="forms.regularization" length="3000" label-required />
                    </div>
                    <div v-if="!forms.regularization.regularized && forms.regularization.type === 'Cause'" class="col-12">
                        <NLTextarea v-model="forms.regularization.reason" :name="'reason'" label="Cause"
                            :form="forms.regularization" length="1000" label-required />
                    </div>
                    <div v-if="!forms.regularization.regularized && forms.regularization.type == 'Action à engagée'"
                        class="col-12">
                        <NLTextarea v-model="forms.regularization.action_to_be_taken" :name="'action_to_be_taken'"
                            label="Action à engagée" :form="forms.regularization" length="3000" label-required />
                    </div>
                    <div class="col-12 d-flex justify-end align-center">
                        <NLButton v-if="!forms.regularization.id" :loading="forms.regularization.busy" label="Enregistrer"
                            class="is-radius" />
                        <NLButton v-else :loading="forms.regularization.busy" label="Valider" class="is-radius" />
                    </div>
                </form>
            </template>
        </NLModal>
    </ContentBody>
</template>
<script>
import { Form } from 'vform'
import { hasRole } from '../../plugins/user'
import MissionDetailModal from '../../Modals/MissionDetailModal'
import Alert from '../../components/Alert'
import NLDatatable from '../../components/Datatable/NLDatatable'
import MissionDetailForm from '../../forms/MissionDetailForm'
export default {
    components: { Alert, NLDatatable, MissionDetailForm, MissionDetailModal },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data: () => {
        return {
            rowSelected: null,
            detailFormExpanded: true,
            regularizationTypes: [
                {
                    id: 'Cause',
                    label: 'Cause'
                },
                {
                    id: 'Action à engagée',
                    label: 'Action à engagée'
                }
            ],
            columns: [
                {
                    label: 'CDC-ID',
                    field: 'cdc_reference'
                },
                {
                    label: 'RAP-ID',
                    field: 'mission_reference'
                },
                {
                    label: 'DRE',
                    field: 'dre_full_name',
                    hide: hasRole([ 'cdc', 'ci', 'da', 'dre' ])
                },
                {
                    label: 'Agence',
                    field: 'agency_full_name'
                },
                {
                    label: 'Famille',
                    field: 'familly_name'
                },
                {
                    label: 'Domaine',
                    field: 'domain_name'
                },
                {
                    label: 'Processus',
                    field: 'process_name'
                },
                {
                    label: 'Point de contrôle',
                    field: 'control_point_name',
                    length: 50
                },
                {
                    label: 'Etat',
                    field: 'is_regularized',
                    hide: hasRole([ 'cdc', 'ci' ])
                },
                {
                    label: 'Transmis le',
                    field: 'is_dispatched',
                    hide: hasRole([ 'cdc', 'ci' ])
                }
            ],
            actions: {
                show: true
            },
            forms: {
                regularization: new Form({
                    regularization_id: null,
                    detail_id: null,
                    regularized: false,
                    reason: null,
                    committed_action: null,
                    action_to_be_taken: null,
                    type: null
                }),
                detail: {
                    process_mode: false,
                    mission: null,
                    process: null,
                    media: [],
                    detail: null,
                    report: null,
                    recovery_plan: null,
                    score: null,
                    major_fact: null,
                    metadata: []
                },
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
                mission: {
                    label: 'Mission',
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
                    hide: !hasRole([ 'dcp', 'cdcr', 'cc' ])
                }
            },
        }
    },
    methods: {
        handleDetailForm(e) {
            this.detailFormExpanded = e
        },
        /**
         * Affiche le formulaire de régularisation
         */
        regularize(item) {
            this.modals.edit = false
            this.modals.show = false
            this.modals.regularize = true
            this.initRegularizationForm()
        },
        /**
         * Handle success result
         *
         * @param {*} e
         */
        success(e) {
            this.close('edit')
            this.close('show')
            this.close('regularize')
        },
        /**
        * Affiche le modal des informations du point de contrôle
        * @param {Object} item
        */
        show(item) {
            this.rowSelected = item
            this.modals.show = true
            this.modals.edit = false
        },
        /**
         * Affiche le modal pour modifer informations du point de contrôle
         *
         */
        edit(row) {
            this.rowSelected = row
            this.modals.edit = true
            this.modals.show = false
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
        initRegularizationForm() {
            this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId, detailId: this.rowSelected?.id }).then(() => {
                const config = this.config.config
                this.rowSelected = config.detail
                this.forms.regularization.detail_id = this.rowSelected.id
                this.forms.regularization.id = config.detail.regularization?.id
                this.forms.regularization.regularized = !!config.detail.regularization?.regularized_at
                this.forms.regularization.reason = config.detail.regularization?.reason
                this.forms.regularization.committed_action = config.detail.regularization?.committed_action
                this.forms.regularization.action_to_be_taken = config.detail.regularization?.action_to_be_taken
                if (config.detail.regularization?.reason) {
                    this.forms.regularization.type = 'Cause'
                } else if (config.detail.regularization?.action_to_be_taken) {
                    this.forms.regularization.type = 'Action à engagé'
                }
            })
        },
        showForm({ row, type }) {
            if (type == 'processing') {
                this.edit(row)
            } else if (type == 'regularization') {
                this.initRegularizationForm(row)
            }
        }
    }
}
</script>
