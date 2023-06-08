<template>
    <ContentBody>
        <NLDatatable :columns="columns" :actions="actions" :filters="filters" @show="show"
            title="Anomalie • Notation • Plan de redressement" urlPrefix="details" />
        <!-- Détails du point de contrôle -->
        <NLModal :show="modals.show" @close="close('show')">
            <template #title>
                <small>
                    {{ rowSelected?.control_point.name }}
                </small>
            </template>
            <template #default>
                <div class="grid list">
                    <div class="col-12 list-item">
                        <!-- Family -->
                        <div class="list-item-content no-bg grid">
                            <div class="col-4">
                                <b>Famille:</b>
                            </div>
                            <div class="col-8">
                                {{ rowSelected?.familly?.name }}
                            </div>
                        </div>
                    </div>
                    <!-- Domain -->
                    <div class="col-12 list-item">
                        <div class="list-item-content no-bg grid">
                            <div class="col-4">
                                <b>Domaine:</b>
                            </div>
                            <div class="col-8">
                                {{ rowSelected?.domain?.name }}
                            </div>
                        </div>
                    </div>
                    <!-- Process -->
                    <div class="col-12 list-item">
                        <div class="list-item-content no-bg grid">
                            <div class="col-4">
                                <b>Processus:</b>
                            </div>
                            <div class="col-8">
                                {{ rowSelected?.process?.name }}
                            </div>
                        </div>
                    </div>
                    <!-- Major fact -->
                    <div class="col-12 list-item">
                        <div class="list-item-content no-bg grid">
                            <div class="col-4">
                                <b>Fait majeur:</b>
                            </div>
                            <div class="col-8">
                                <span v-if="!rowSelected?.major_fact">
                                    <i class="las la-check-circle icon text-success" />
                                    Non
                                </span>
                                <span v-else>
                                    <i class="las la-times-circle icon text-danger" />
                                    Oui
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Score -->
                    <div class="col-12 list-item">
                        <div class="list-item-content no-bg grid">
                            <div class="col-4">
                                <b>Appréciation:</b>
                            </div>
                            <div class="col-8">
                                {{ rowSelected?.appreciation }}
                            </div>
                        </div>
                    </div>
                    <!-- Report -->
                    <div class="col-12 list-item">
                        <div class="list-item-content no-bg grid">
                            <div class="col-4">
                                <b>Constat:</b>
                            </div>
                            <div class="col-8">
                                {{ rowSelected?.report || '-' }}
                            </div>
                        </div>
                    </div>
                    <!-- Recovery plan -->
                    <div class="col-12 list-item">
                        <div class="list-item-content no-bg grid">
                            <div class="col-4">
                                <b>Plan de redressement:</b>
                            </div>
                            <div class="col-8">
                                {{ rowSelected?.recovery_plan || '-' }}
                            </div>
                        </div>
                    </div>
                    <!-- Metadata -->
                    <div v-if="rowSelected?.metadata?.length" class="col-12 list-item">
                        <div class="list-item-content no-bg grid">
                            <div class="col-12" :class="{ 'col-lg-4': !rowSelected?.metadata }">
                                <b>Informations supplémentaires:</b>
                            </div>
                            <div class="col-12" :class="{ 'col-lg-8': !rowSelected?.metadata }">
                                <div class="table-container" v-if="rowSelected?.metadata">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th v-for="( heading, indexHeading ) in  currentMetadata.keys "
                                                    :key="indexHeading" class="text-left">
                                                    {{ heading }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="( data, row ) in  rowSelected?.metadata "
                                                :key="'metadata-row-' + row">
                                                <td v-for="( items, index ) in  data "
                                                    :key="'metadata-row-' + row + '-item-' + index" class="text-left">
                                                    <template v-for="( item, key ) in  items ">
                                                        <span v-if="key !== 'label' && key !== 'rules'"
                                                            :key="'metadata-row-' + row + '-item-' + index + key + '-content'">
                                                            {{ item || '-' }}
                                                        </span>
                                                    </template>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <span v-else>-</span>
                            </div>
                        </div>
                    </div>
                    <!-- Media -->
                    <div v-if="rowSelected?.media?.length" class="col-12 list-item">
                        <div v-for="( file, indexFile ) in  rowSelected?.media " :key="indexFile" class="list-item-content"
                            @click.stop=" ">
                            <div class="files-list list is-visible grid gap-4 text-medium">
                                <div class="col-11 d-flex justify-between align-center">
                                    <a :href="file.link" target="_blank" class="text-dark text-small">
                                        {{ file.original_name }}
                                    </a>
                                    <span class="text-small">{{ file.size }}</span>
                                </div>
                                <div class="col-1 d-flex justify-end align-center gap-4">
                                    <a :href="file.link" :download="file.original_name">
                                        <i class="las la-download text-info icon" />
                                    </a>
                                    <i v-if="!mission?.dre_report_is_validated"
                                        class="las la-trash text-danger icon is-clickable"
                                        @click.stop="deleteItem(file, index)" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Regularization -->
                    <div v-if="rowSelected?.score > 1 && rowSelected?.regularization?.regularized"
                        class="col-12 list-item box border-top border-1 border-solid border-primary-dark">
                        <div class="list-item-content no-bg grid">
                            <div class="col-12">
                                <h2>Régularisation</h2>
                            </div>
                            <div class="col-4">
                                <b>Etat:</b>
                            </div>
                            <div class="col-8">
                                {{ rowSelected?.regularization?.regularized }}
                            </div>

                            <div v-if="rowSelected?.regularization?.reason" class="col-4">
                                <b>Cause:</b>
                            </div>
                            <div v-if="rowSelected?.regularization?.reason" class="col-8">
                                {{ rowSelected?.regularization?.reason }}
                            </div>

                            <div v-if="rowSelected?.regularization?.action_to_be_taken" class="col-4">
                                <b>Actions à engagé:</b>
                            </div>
                            <div v-if="rowSelected?.regularization?.action_to_be_taken" class="col-8">
                                {{ rowSelected?.regularization?.action_to_be_taken }}
                            </div>

                            <div v-if="rowSelected?.regularization?.committed_action" class="col-4">
                                <b>Actions engagé:</b>
                            </div>
                            <div v-if="rowSelected?.regularization?.committed_action" class="col-8">
                                {{ rowSelected?.regularization?.committed_action }}
                            </div>

                            <div v-if="rowSelected?.regularization?.regularized_at" class="col-4">
                                <b>Date Régularisation:</b>
                            </div>
                            <div v-if="rowSelected?.regularization?.regularized_at" class="col-8">
                                {{ rowSelected?.regularization?.regularized_at }}
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template #footer>
                <div class="col-12 d-flex justify-end align-center">
                    <div class="d-flex align-center gap-2">
                        <!-- CI -->
                        <button
                            v-if="!rowSelected?.mission?.controller_opinion_is_validated && !rowSelected?.major_fact && can('create_opinion')"
                            class="btn btn-warning has-icon" @click="edit(rowSelected)">
                            <i class="las la-pen icon" />
                            Modifier
                        </button>

                        <!-- CDC -->
                        <button
                            v-if="!rowSelected?.mission?.dre_report_is_validated && !rowSelected?.major_fact && can('create_dre_report,validate_dre_report')"
                            class="btn btn-warning has-icon" @click="edit(rowSelected)">
                            <i class="las la-pen icon" />
                            Modifier
                        </button>

                        <!-- CDCR -->
                        <button
                            v-if="!rowSelected?.mission?.cdcr_validation_at && !rowSelected?.major_fact_dispatched_at && can('make_first_validation,process_mission')"
                            class="btn btn-warning has-icon" @click="edit(rowSelected)">
                            <i class="las la-pen icon" />
                            Traiter
                        </button>

                        <!-- DCP -->
                        <button
                            v-if="!rowSelected?.mission?.dcp_validation_at && rowSelected?.mission?.cdcr_validation_at && !rowSelected?.major_fact_dispatched_at && can('make_second_validation')"
                            class="btn btn-warning has-icon" @click="edit(rowSelected)">
                            <i class="las la-pen icon" />
                            Traiter
                        </button>
                        <button
                            v-if="!rowSelected?.major_fact_dispatched_at && rowSelected?.major_fact && can('dispatch_major_fact')"
                            class="btn btn-info has-icon" @click.prevent="notify(rowSelected)">
                            <i class="las la-bell icon" />
                            Notifier
                        </button>
                        <!-- Agency director -->
                        <button
                            v-if="rowSelected?.mission?.dcp_validation_at && !rowSelected?.regularization?.regularized_at && !rowSelected?.major_fact && rowSelected?.score !== 1 && can('regularize_mission_detail')"
                            class="btn btn-warning has-icon" @click="regularize(rowSelected)">
                            <i class="las la-pen icon" />
                            Régulariser
                        </button>
                    </div>
                </div>
            </template>
        </NLModal>
        <!-- Traitement du point de contrôle -->
        <NLModal v-if="modals.edit" :show="modals.edit" :default-mode="true" @close="close('edit')">
            <template #title>
                <small>
                    {{ rowSelected?.control_point.name }}
                </small>
            </template>
            <template #default>
                <Notification v-if="forms.detail.errors.any()" type="is-danger">
                    Il y a {{ formErrorsCount }}
                    {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
                </Notification>
                <form enctype="multipart/form-data" class="grid gap-2" @submit.prevent="save('edit')"
                    @keydown="forms.detail.onKeydown($event)">
                    <!-- Major fact -->
                    <div v-if="rowSelected?.control_point?.has_major_fact" class="col-12">
                        <NLSwitch type="is-danger" v-model="forms.detail.major_fact" :name="'major_fact'"
                            :form="forms.detail" label="Fait majeur" />
                    </div>
                    <!-- score -->
                    <div class="col-12">
                        <NLSelect v-model="forms.detail.score" :name="'score'" label="Notation" :form="forms.detail"
                            :options="setupScores(rowSelected?.control_point.scores)" label-required />
                    </div>

                    <!-- Metadata -->
                    <div v-if="rowSelected?.control_point.fields && forms.detail.score > 1 && !forms.detail.process_mode"
                        class="col-12">
                        <div class="repeater">
                            <h2 class="mb-6">
                                Informations supplémentaires
                            </h2>
                            <!-- Repeater row -->
                            <div v-for="( item, dataRow ) in  forms.detail.metadata " :key="'metadata-' + dataRow"
                                class="grid my-6 repeater-row">
                                <div class="col-12">
                                    <div class="grid gap-2">
                                        <div class="col-11">
                                            <div class="grid">
                                                <div v-for="( input, index ) in  setupFields(rowSelected?.control_point.fields) "
                                                    :key="'metadata-input-' + input.name + '-' + dataRow + '-id'"
                                                    :class="input.style">
                                                    <!-- Defining different inputs -->
                                                    <NLInput v-if="isInput(input.type)"
                                                        :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                        v-model="forms.detail.metadata[dataRow][index][input.name]"
                                                        :form="forms.detail" :label="input.label"
                                                        :placeholder="input.placeholder" :type="input.type"
                                                        :label-required="input.required"
                                                        :name="'metadata.' + dataRow + '.' + index + '.' + input.name" />

                                                    <NLTextarea v-if="input.type === 'textarea'"
                                                        :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                        v-model="forms.detail.metadata[dataRow][index][input.name]"
                                                        :form="forms.detail" :label="input.label"
                                                        :placeholder="input.placeholder" :type="input.type"
                                                        :label-required="input.required"
                                                        :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                        :length="input.length" />

                                                    <NLWyswyg v-if="input.type === 'wyswyg'"
                                                        :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                        v-model="forms.detail.metadata[dataRow][index][input.name]"
                                                        :form="forms.detail" :label="input.label"
                                                        :placeholder="input.placeholder" :type="input.type"
                                                        :label-required="input.required"
                                                        :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                        :length="input.length" />

                                                    <NLSelect v-if="input.type === 'select'"
                                                        :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                        v-model="forms.detail.metadata[dataRow][index][input.name]"
                                                        :form="forms.detail" :label="input.label" :type="input.type"
                                                        :label-required="input.required"
                                                        :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                                                        :options="input.options"
                                                        :placeholder="input.placeholder || 'Choisissez une option...'"
                                                        :multiple="input.multiple" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Remove current row -->
                                        <div v-if="dataRow >= 0" class="col-1 p-0 d-flex justify-start align-center">
                                            <div class="btn btn-danger" @click="removeRow(dataRow)">
                                                Supprimer
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add new row -->
                            <div class="d-flex justify-start align-center">
                                <span class="btn" @click="addRow(rowSelected?.control_point.fields)">
                                    <i class="las la-plus" />
                                </span>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="forms.detail.process_mode && rowSelected?.metadata" class="col-12 list-item">
                        <div class="list-item-content no-bg grid">
                            <div class="col-12" :class="{ 'col-lg-4': !rowSelected?.metadata }">
                                <b>Informations supplémentaires:</b>
                            </div>
                            <div class="col-12" :class="{ 'col-lg-8': !rowSelected?.metadata }">
                                <div class="table-container" v-if="rowSelected?.metadata">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th v-for="( heading, indexHeading ) in  currentMetadata.keys "
                                                    :key="indexHeading" class="text-left">
                                                    {{ heading }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="( data, row ) in  rowSelected?.metadata "
                                                :key="'metadata-row-' + row">
                                                <td v-for="( items, index ) in  data "
                                                    :key="'metadata-row-' + row + '-item-' + index" class="text-left">
                                                    <template v-for="( item, key ) in  items ">
                                                        <span v-if="key !== 'label' && key !== 'rules'"
                                                            :key="'metadata-row-' + row + '-item-' + index + key + '-content'">
                                                            {{ item || '-' }}
                                                        </span>
                                                    </template>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <span v-else>-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Report -->
                    <div class="col-12">
                        <NLTextarea v-if="!forms.detail.process_mode" v-model="forms.detail.report" :name="'report'"
                            label="Constat" :form="forms.detail"
                            :placeholder="[null, undefined, ''].includes(forms.detail.score) || ['object', 'array'].includes(typeof forms.detail.score) && !forms.detail.major_fact ? '' : 'Ajouter votre constat'"
                            :label-required="![null, undefined, ''].includes(forms.detail.score) && !['object', 'array'].includes(typeof forms.detail.score) || forms.detail.major_fact"
                            :disabled="[null, undefined, ''].includes(forms.detail.score) || ['object', 'array'].includes(typeof forms.detail.score) && !forms.detail.major_fact" />
                        <NLTextarea v-else v-model="forms.detail.report" label="Constat" :form="forms.detail"
                            placeholder="Constat" name="report" readonly />
                    </div>

                    <!-- Media (attachements) -->
                    <div v-if="!forms.detail.process_mode" class="col-12">
                        <NLFile v-model="forms.detail.media" :name="'media'" label="Pièces jointes"
                            attachable-type="App\Models\MissionDetail" :attachable-id="forms.detail.detail"
                            :form="forms.detail" multiple :can-delete="!rowSelected?.controller_opinion_is_validated"
                            :readonly="forms.detail.process_mode" />
                    </div>

                    <!-- Recovery plan -->
                    <div class="col-12">
                        <NLTextarea v-model="forms.detail.recovery_plan" :name="'recovery_plan'"
                            label="Plan de redressement" :form="forms.detail"
                            :placeholder="[1, null, undefined, ''].includes(parseInt(forms.detail.score)) || ['object', 'array'].includes(typeof forms.detail.score) && !forms.detail.major_fact ? '' : 'Ajouter votre plan de redressement'"
                            :label-required="![1, null, undefined, ''].includes(parseInt(forms.detail.score)) && !['object', 'array'].includes(typeof forms.detail.score) || forms.detail.major_fact"
                            :disabled="[1, null, undefined, ''].includes(parseInt(forms.detail.score)) || ['object', 'array'].includes(typeof forms.detail.score) && !forms.detail.major_fact" />
                    </div>
                    <!-- Submit Button -->
                    <div class="col-12 d-flex justify-end align-center">
                        <NLButton v-if="!forms.detail.process_mode" :loading="forms.detail.busy" label="Enregistrer"
                            class="is-radius" />
                        <NLButton v-else :loading="forms.detail.busy" label="Valider" class="is-radius" />
                    </div>
                </form>
            </template>
        </NLModal>

        <!-- Régularization du point de contrôle -->
        <NLModal v-if="modals.regularize" :show="modals.regularize" :default-mode="true" @close="close('regularize')">
            <template #title>
                <small>
                    {{ rowSelected?.control_point?.name }}
                </small>
            </template>
            <template #default>
                <Notification v-if="forms.regularization.errors.any()" type="is-danger">
                    Il y a {{ formErrorsCount }}
                    {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
                </Notification>
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
import { mapGetters } from 'vuex'
import { Form } from 'vform'
import { hasRole } from '../../plugins/user'
import Notification from '../../components/Notification'
import NLDatatable from '../../components/Datatable/NLDatatable'
export default {
    components: { Notification, NLDatatable },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data: () => {
        return {
            rowSelected: null,
            mission: null,
            process: null,
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
                    label: 'Notation',
                    field: 'score',
                    hide: !hasRole([ 'dcp', 'cdcr', 'cc' ]),
                    isHtml: true,
                    methods: {
                        style() {
                            return 'text-center'
                        },
                        showField(item) {
                            const score = Number(item.score)
                            let style = 'text-dark text-bold'
                            if (score === 1) {
                                style = 'bg-success text-white text-bold'
                            } else if (score === 2) {
                                style = 'bg-info text-white text-bold'
                            } else if (score === 3) {
                                style = 'bg-warning text-bold'
                            } else if (score === 4) {
                                style = 'bg-danger text-white text-bold'
                            } else {
                                style = 'bg-grey text-dark text-bold'
                            }
                            return `<div class="container">
                  <div class="has-border-radius py-1 text-center ${style}">${score}</div>
                </div>`
                        }
                    }
                },
                {
                    label: 'Etat',
                    field: 'is_regularized',
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
                detail: new Form({
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
                    // process_mode: null
                })
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
            currentMetadata: {}
        }
    },
    computed: {
        ...mapGetters({
            config: 'details/config',
        }),
        formErrorsCount() {
            if (this.modals.edit) {
                return Object.entries(this.forms.detail.errors.all()).length
            } else if (this.modals.regularize) {
                return Object.entries(this.forms.regularization.errors.all()).length
            }
            return 0
        },
        files() {
            return this.rowSelected.media.map(file => file.id)
        }
    },
    methods: {
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
        * Affiche le modal des informations du point de contrôle
        * @param {Object} item
        */
        show(item) {
            this.$store.dispatch('details/fetchConfig', { missionId: item.mission_id, processId: item.process_id, detailId: item.id }).then(() => {
                const config = this.config.config
                this.rowSelected = config.detail
                this.mission = config.mission
                this.process = config.process
                this.modals.show = true
                this.modals.edit = false
                this.currentMetadata.keys = Object.keys(this.rowSelected.parsed_metadata)
            })
            // this.rowSelected = item
        },
        /**
         * Affiche le modal pour modifer informations du point de contrôle
         *
         */
        edit() {
            this.modals.edit = true
            this.modals.show = false
            this.initDetailForm()
        },
        /**
         * Ferme la boite modal des détails du point de contrôle
         */
        close(modal) {
            if (Object.prototype.hasOwnProperty.call(this.modals, modal)) {
                this.modals[ modal ] = false
            }
            this.forms.detail.reset()
            this.forms.regularization.reset()
            if (modal !== 'show') {
                this.initData()
            }
            this.currentMetadata = {}
            this.rowSelected = null
        },
        /**
         * Initialise le formulaire
         */
        initDetailForm() {
            this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId, detailId: this.rowSelected?.id }).then(() => {
                const config = this.config.config
                this.rowSelected = config.detail
                this.forms.detail.process_mode = hasRole([ 'cc', 'cdcr', 'dcp' ])
                this.forms.detail.mission = config.mission.id
                this.forms.detail.process = config.process.id
                this.forms.detail.detail = config.detail.id
                this.forms.detail.media = config.detail.media.length ? config.detail.media.map(file => file.id) : []
                this.forms.detail.detail = config.detail.id
                this.forms.detail.report = config.detail.report
                this.forms.detail.recovery_plan = config.detail.recovery_plan
                this.forms.detail.score = parseInt(config.detail.score)
                this.forms.detail.major_fact = !!config.detail.major_fact
                this.forms.detail.metadata = config.detail.metadata || []
            })
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
        /**
         * Initialise les champs supplémentaire pour chaque point de contrôle
         *
         * @param {Array} fields
         */
        setupFields(fields) {
            return fields?.map(field => {
                const type = Object.prototype.hasOwnProperty.call(field, 0) ? field[ 0 ].type : ''
                const label = Object.prototype.hasOwnProperty.call(field, 1) ? field[ 1 ].label : ''
                const name = Object.prototype.hasOwnProperty.call(field, 2) ? field[ 2 ].name : ''
                const length = Object.prototype.hasOwnProperty.call(field, 3) ? field[ 3 ].length : null
                const style = Object.prototype.hasOwnProperty.call(field, 4) ? field[ 4 ].style : ''
                const id = Object.prototype.hasOwnProperty.call(field, 5) ? field[ 5 ].id : ''
                const placeholder = Object.prototype.hasOwnProperty.call(field, 6) ? field[ 6 ].placeholder : ''
                const help_text = Object.prototype.hasOwnProperty.call(field, 7) ? field[ 7 ].help_text : ''
                const rules = Object.prototype.hasOwnProperty.call(field, 8) ? field[ 8 ].rules : []
                return { type, label, name, length, style, id, placeholder, help_text, rules }
            })
        },
        /**
         * Initialise les notations pour chaque point de contrôle
         *
         * @param {Array|null} scores
         */
        setupScores(scores) {
            if (typeof scores === 'object') {
                return scores?.map(score => {
                    return {
                        id: score[ 0 ].score,
                        label: score[ 1 ].label
                    }
                })
            }
            return []
        },
        /**
         * Création de la mission
         */
        save(action) {
            let form, url
            if (action === 'edit') {
                form = this.forms.detail
                url = '/api/missions/details/' + this.forms.detail.mission
            } else if (action === 'regularize') {
                form = this.forms.regularization
                url = '/api/regularize/' + this.forms.regularization.detail_id
            }
            form.post(url).then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.initData()
                    form.reset()
                    this.close('edit')
                    this.close('show')
                    this.close('regularize')
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                let message = error.message
                if (error.response.status === 422) {
                    message = 'Les données fournies sont invalides.'
                }
                this.$swal.toast_error(message)
            })
        },
        /**
         * Ajouter une ligne dans le répéteur
         *
         * @param {Number} fields Index du champs
         */
        addRow(fields) {
            fields = this.setupFields(fields)
            const schema = []
            for (let index = 0; index < fields.length; index++) {
                const element = fields[ index ]
                const name = element.name
                let defaultValue = element.default !== undefined ? element.default : ''
                defaultValue = element.multiple ? [] : ''
                schema.push({ [ name ]: defaultValue, label: element.label, rules: element.rules })
            }
            if (this.forms.detail.metadata) this.forms.detail.metadata.push(schema)
        },
        /**
         * Supprimer une ligne du répéteur
         *
         * @param {Number} row
         * @param {Number} field
         */
        removeRow(row, field) {
            this.forms.detail.metadata.splice(field, 1)
        },
        /**
         * Vérifie que la valeur est un input valide
         *
         * @param {String} value
         */
        isInput(value) {
            return [ 'text', 'date', 'datetime', 'time', 'week', 'number', 'tel', 'email', 'month', 'url' ].includes(value)
        },
        notify() {
            this.$swal.confirm({ title: 'Dispatch notification', message: 'Voulez-vous notifier les autorités concernées?' }).then(action => {
                if (action.isConfirmed) {
                    this.$api.post('notifications/major-fact/' + this.rowSelected.id).then(response => {
                        this.$swal.toast_success(response.data.message)
                        this.rowSelected = null
                    }).catch(error => {
                        this.$swal.alert_error(error)
                    })
                }
            })
        }
    }
}
</script>
