<template>
  <div v-if="can('view_mission_detail')">
    <ContentHeader>
      <template #title>
        <div class="tags w-90">
          <span class="tag is-info">{{ process?.familly?.name }}</span>
          <span class="tag">{{ process?.domain?.name }}</span>
          <span class="tag is-warning">{{ process?.name }}</span>
        </div>
      </template>
    </ContentHeader>
    <ContentBody>
      <div class="grid">
        <div class="col-12" v-for="detail in details" :key="detail?.id">
          <div class="box">
            <div class="grid gap-4">

              <div class="col-12">
                <h3>{{ detail?.control_point?.name }}</h3>
              </div>

              <div class="col-4"><b>Fait majeur:</b></div>
              <div class="col-8">
                <span v-if="!detail?.major_fact">
                  <i class="las la-check-circle icon text-success"></i>
                  Non
                </span>
                <span v-else>
                  <i class="las la-times-circle icon text-danger"></i>
                  Oui
                </span>
              </div>

              <div class="col-4"><b>Appréciation:</b></div>
              <div class="col-8">{{ detail?.appreciation }}</div>

              <div class="col-4"><b>Constat:</b></div>
              <div class="col-8">{{ detail?.report || '-' }}</div>

              <div class="col-4"><b>Plan de redressement:</b></div>
              <div class="col-8">{{ detail?.recovery_plan || '-' }}</div>

              <div class="col-12" v-if="detail?.regularization?.regularized">
                <div class="grid gap-4">
                  <div class="col-4"><b>Régularisation:</b></div>
                  <div class="col-8">{{ detail?.regularization?.regularized || '-' }}</div>
                </div>
              </div>

              <div class="col-12 d-flex justify-end align-center">
                <div class="d-flex gap-2 align-center">
                  <button class="btn btn-info has-icon" @click="show(detail)">
                    <i class="las la-eye icon"></i>
                    Voir plus
                  </button>

                  <!-- CI -->
                  <button class="btn btn-warning has-icon" @click="edit(detail)"
                    v-if="!mission?.controller_opinion_is_validated && !detail?.major_fact && can('create_opinion')">
                    <i class="las la-pen icon"></i>
                    Modifier
                  </button>

                  <!-- CDC -->
                  <button class="btn btn-warning has-icon" @click="edit(detail)"
                    v-if="!mission?.dre_report_is_validated && !detail?.major_fact && can('create_dre_report,validate_dre_report')">
                    <i class="las la-pen icon"></i>
                    Modifier
                  </button>

                  <!-- CDCR -->
                  <button class="btn btn-warning has-icon" @click="edit(detail)"
                    v-if="!mission?.cdcr_validation_at && !detail?.major_fact_dispatched_at && can('make_first_validation,process_mission') && [2, 3, 4].includes(detail?.score)">
                    <i class="las la-pen icon"></i>
                    Traiter
                  </button>

                  <!-- DCP -->
                  <button class="btn btn-warning has-icon" @click="edit(detail)"
                    v-if="!mission?.dcp_validation_at && mission.cdcr_validation_at && !detail?.major_fact_dispatched_at && can('make_second_validation') && [2, 3, 4].includes(detail?.score)">
                    <i class="las la-pen icon"></i>
                    Traiter
                  </button>
                  <button class="btn btn-info has-icon" @click.prevent="notify(detail)"
                    v-if="!detail?.major_fact_dispatched_at && detail?.major_fact && can('dispatch_major_fact')">
                    <i class="las la-bell icon"></i>
                    Notifier
                  </button>

                  <!-- Agency director -->
                  <button
                    v-if="mission?.dcp_validation_at && !detail?.regularization?.regularized_at && !detail?.major_fact && detail?.score !== 1 && can('regularize_mission_detail')"
                    class="btn btn-warning has-icon" @click="edit(detail)">
                    <i class="las la-pen icon"></i>
                    Régulariser
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Détails du point de contrôle -->
      <NLModal :show="modals.show" @close="close('show')">
        <template v-slot:title>
          <small>
            {{ rowSelected?.control_point.name }}
          </small>
        </template>
        <template v-slot>
          <div class="grid list">
            <!-- Major fact -->
            <div class="col-12 list-item">
              <div class="list-item-content no-bg grid">
                <div class="col-4"><b>Fait majeur:</b></div>
                <div class="col-8">
                  <span v-if="!rowSelected?.major_fact">
                    <i class="las la-check-circle icon text-success"></i>
                    Non
                  </span>
                  <span v-else>
                    <i class="las la-times-circle icon text-danger"></i>
                    Oui
                  </span>
                </div>
              </div>
            </div>
            <!-- Score -->
            <div class="col-12 list-item">
              <div class="list-item-content no-bg grid">
                <div class="col-4"><b>Appréciation:</b></div>
                <div class="col-8">{{ rowSelected?.appreciation }}</div>
              </div>
            </div>
            <!-- Report -->
            <div class="col-12 list-item">
              <div class="list-item-content no-bg grid">
                <div class="col-4"><b>Constat:</b></div>
                <div class="col-8">{{ rowSelected?.report || '-' }}</div>
              </div>
            </div>
            <!-- Recovery plan -->
            <div class="col-12 list-item">
              <div class="list-item-content no-bg grid">
                <div class="col-4"><b>Plan de redressement:</b></div>
                <div class="col-8">{{ rowSelected?.recovery_plan || '-' }}</div>
              </div>
            </div>
            <!-- Metadata -->
            <div class="col-12 list-item" v-if="rowSelected?.metadata?.length">
              <div class="list-item-content no-bg grid">
                <div class="col-12" :class="{ 'col-lg-4': !rowSelected?.metadata }"><b>Informations supplémentaires:</b>
                </div>
                <div class="col-12" :class="{ 'col-lg-8': !rowSelected?.metadata }">
                  <table v-if="rowSelected?.metadata">
                    <thead>
                      <tr>
                        <th class="text-left" v-for="heading in currentMetadata.keys">
                          {{ heading }}
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(data, row) in rowSelected?.metadata" :key="'metadata-row-' + row">
                        <td class="text-left" v-for="(items, index) in data" :key="'metadata-item-' + index">
                          <span v-for="(item, key) in items" :key="'metadata-item-' + index + '-content'"
                            v-if="key !== 'label' && key !== 'rules'">
                            {{ item || '-' }}
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <span v-else>-</span>
                </div>
              </div>
            </div>
            <!-- Media -->
            <div class="col-12 list-item" v-if="rowSelected?.media?.length">
              <div class="list-item-content" @click.stop="" v-for="file in rowSelected?.media">
                <div class="files-list list is-visible grid gap-4 text-medium">
                  <div class="col-11 d-flex justify-between align-center">
                    <a :href="file.link" target="_blank" class="text-dark text-small">
                      {{ file.original_name }}
                    </a>
                    <span class="text-small">{{ file.size }}</span>
                  </div>
                  <div class="col-1 d-flex justify-end align-center gap-4">
                    <a :href="file.link" :download="file.original_name">
                      <i class="las la-download text-info icon"></i>
                    </a>
                    <i class="las la-trash text-danger icon is-clickable" @click.stop="deleteItem(file, index)"
                      v-if="!mission?.dre_report_is_validated"></i>
                  </div>
                </div>
              </div>
            </div>
            <!-- Regularization -->
            <div class="col-12 list-item box border-top border-1 border-solid border-primary-dark"
              v-if="rowSelected?.score > 1 && rowSelected?.regularization?.regularized">
              <div class="list-item-content no-bg grid">
                <div class="col-12">
                  <h2>Régularisation</h2>
                </div>
                <div class="col-4"><b>Etat:</b></div>
                <div class="col-8">{{ rowSelected?.regularization?.regularized }}</div>

                <div class="col-4" v-if="rowSelected?.regularization?.reason"><b>Cause:</b></div>
                <div class="col-8" v-if="rowSelected?.regularization?.reason">
                  {{ rowSelected?.regularization?.reason }}
                </div>

                <div class="col-4" v-if="rowSelected?.regularization?.action_to_be_taken"><b>Actions à engagé:</b></div>
                <div class="col-8" v-if="rowSelected?.regularization?.action_to_be_taken">
                  {{ rowSelected?.regularization?.action_to_be_taken }}
                </div>

                <div class="col-4" v-if="rowSelected?.regularization?.committed_action"><b>Actions engagé:</b></div>
                <div class="col-8" v-if="rowSelected?.regularization?.committed_action">
                  {{ rowSelected?.regularization?.committed_action }}
                </div>

                <div class="col-4" v-if="rowSelected?.regularization?.regularized_at"><b>Date Régularisation:</b></div>
                <div class="col-8" v-if="rowSelected?.regularization?.regularized_at">
                  {{ rowSelected?.regularization?.regularized_at }}
                </div>
              </div>
            </div>
          </div>
        </template>
      </NLModal>

      <!-- Edition du point de contrôle -->
      <NLModal :show="modals.edit" :defaultMode="true" @close="close('edit')" v-if="modals.edit">
        <template v-slot:title>
          <small>
            {{ rowSelected?.control_point.name }}
          </small>
        </template>
        <template v-slot>
          <Notification type="is-danger" v-if="forms.generic.errors.any()">
            Il y a {{ formErrorsCount }}
            {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
          </Notification>
          <form @submit.prevent="save" @keydown="forms.generic.onKeydown($event)" enctype="multipart/form-data"
            class="grid gap-2" v-if="!regularization_mode">
            <!-- Major fact -->
            <div class="col-12" v-if="rowSelected?.control_point?.has_major_fact">
              <NLSwitch v-model="forms.generic.major_fact" :name="'major_fact'" :form="forms.generic"
                label="Fait majeur" />
            </div>
            <!-- score -->
            <div class="col-12">
              <NLSelect :name="'score'" label="Notation" :form="forms.generic" v-model="forms.generic.score"
                :options="setupScores(rowSelected?.control_point.scores)" labelRequired />
            </div>

            <!-- Metadata -->
            <div class="col-12"
              v-if="rowSelected?.control_point.fields && forms.generic.score > 1 && !forms.generic.process_mode">
              <div class="repeater">
                <h2 class="mb-6">Informations supplémentaires</h2>
                <!-- Repeater row -->
                <div class="grid my-6 repeater-row" v-for="(item, dataRow) in forms.generic.metadata"
                  :key="'metadata-' + dataRow">
                  <div class="col-12">
                    <div class="grid gap-2">
                      <div class="col-11">
                        <div class="grid">
                          <div :key="'metadata-input-' + input.name + '-' + dataRow + '-id'" :class="input.style"
                            v-for="(input, index) in setupFields(rowSelected?.control_point.fields)">
                            <!-- Defining different inputs -->
                            <NLInput :form="forms.generic" :label="input.label" :placeholder="input.placeholder"
                              :type="input.type" :labelRequired="input.required"
                              :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                              v-model="forms.generic.metadata[dataRow][index][input.name]"
                              :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="isInput(input.type)" />

                            <NLTextarea :form="forms.generic" :label="input.label" :placeholder="input.placeholder"
                              :type="input.type" :labelRequired="input.required"
                              :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                              v-model="forms.generic.metadata[dataRow][index][input.name]"
                              :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="input.type == 'textarea'"
                              :length="input.length" />

                            <NLWyswyg :form="forms.generic" :label="input.label" :placeholder="input.placeholder"
                              :type="input.type" :labelRequired="input.required"
                              :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                              v-model="forms.generic.metadata[dataRow][index][input.name]"
                              :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="input.type == 'wyswyg'"
                              :length="input.length" />

                            <NLSelect :form="forms.generic" :label="input.label" :type="input.type"
                              :labelRequired="input.required"
                              :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                              v-model="forms.generic.metadata[dataRow][index][input.name]"
                              :id="'metadata.' + dataRow + '.' + index + '.' + input.name" :options="input.options"
                              :placeholder="input.placeholder || 'Choisissez une option...'" :multiple="input.multiple"
                              v-if="input.type == 'select'" />
                          </div>
                        </div>
                      </div>
                      <!-- Remove current row -->
                      <div class="col-1 p-0 d-flex justify-start align-center" v-if="dataRow >= 0">
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
                    <i class="las la-plus"></i>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-12 list-item" v-else-if="forms.generic.process_mode && rowSelected?.metadata">
              <div class="list-item-content no-bg grid">
                <div class="col-12" :class="{ 'col-lg-4': !rowSelected?.metadata }"><b>Informations supplémentaires:</b>
                </div>
                <div class="col-12" :class="{ 'col-lg-8': !rowSelected?.metadata }">
                  <table v-if="rowSelected?.metadata">
                    <thead>
                      <tr>
                        <th class="text-left" v-for="heading in currentMetadata.keys">
                          {{ heading }}
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(data, row) in rowSelected?.metadata" :key="'metadata-row-' + row">
                        <td class="text-left" v-for="(items, index) in data" :key="'metadata-item-' + index">
                          <span v-for="(item, key) in items" :key="'metadata-item-' + index + '-content'"
                            v-if="key !== 'label' && key !== 'rules'">
                            {{ item || '-' }}
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <span v-else>-</span>
                </div>
              </div>
            </div>

            <!-- Report -->
            <div class="col-12">
              <NLTextarea :name="'report'" label="Constat" :form="forms.generic" v-model="forms.generic.report"
                :placeholder="![2, 3, 4].includes(forms.generic.score) && !forms.generic.major_fact ? '' : 'Ajouter votre constat'"
                :labelRequired="forms.generic.score > 1 || forms.generic.major_fact"
                :disabled="(![2, 3, 4].includes(forms.generic.score) && !forms.generic.major_fact)"
                v-if="!forms.generic.process_mode" />
              <NLTextarea label="Constat" :form="forms.generic" v-model="forms.generic.report" placeholder="Constat"
                name="report" readonly v-else />
            </div>

            <!-- Media (attachements) -->
            <div class="col-12" v-if="!forms.generic.process_mode">
              <NLFile :name="'media'" label="Pièces jointes" attachableType="App\Models\MissionDetail"
                :attachableId="forms.generic.detail" v-model="forms.generic.media" :form="forms.generic" multiple
                :canDelete="!rowSelected?.controller_opinion_is_validated" :readonly="forms.generic.process_mode" />
            </div>

            <!-- Recovery plan -->
            <div class="col-12">
              <NLTextarea :name="'recovery_plan'" label="Plan de redressement" :form="forms.generic"
                v-model="forms.generic.recovery_plan"
                :placeholder="![2, 3, 4].includes(forms.generic.score) && !forms.generic.major_fact ? '' : 'Ajouter votre plan de redressement'"
                :labelRequired="forms.generic.score > 1 || forms.generic.major_fact"
                :disabled="(![2, 3, 4].includes(forms.generic.score) && !forms.generic.major_fact)" />
            </div>

            <!-- Submit Button -->
            <div class="col-12 d-flex justify-end align-center">
              <NLButton :loading="forms.generic.busy" label="Save" class="is-radius" v-if="!forms.generic.process_mode" />
              <NLButton :loading="forms.generic.busy" label="Validate" class="is-radius" v-else />
            </div>
          </form>
          <form @submit.prevent="regularize" @keydown="forms.detail.onKeydown($event)" enctype="multipart/form-data"
            class="grid gap-6" v-else>
            <div class="col-12">
              <NLSwitch v-model="forms.regularization.regularized" type="is-success" :name="'regularized'"
                :form="forms.regularized" label="Levé" />
            </div>
            <div class="col-12">
              <NLSelect name="type" :options="regularizationTypes" :form="forms.regularization"
                v-model="forms.regularization.type" label="Choisissez un type" labelRequired
                v-if="!forms.regularization.regularized" />
            </div>
            <!-- Recovery plan -->
            <div class="col-12" v-if="forms.regularization.regularized">
              <NLTextarea :name="'committed_action'" label="Action engagé" :form="forms.regularization"
                v-model="forms.regularization.committed_action" length="3000" labelRequired />
            </div>
            <div class="col-12" v-if="!forms.regularization.regularized && forms.regularization.type == 'Cause'">
              <NLTextarea :name="'reason'" label="Cause" :form="forms.regularization"
                v-model="forms.regularization.reason" length="1000" labelRequired />
            </div>
            <div class="col-12"
              v-if="!forms.regularization.regularized && forms.regularization.type == 'Action à engagé'">
              <NLTextarea :name="'action_to_be_taken'" label="Action à engagé" :form="forms.regularization"
                v-model="forms.regularization.action_to_be_taken" length="3000" labelRequired />
            </div>
            <div class="col-12 d-flex justify-end align-center">
              <NLButton :loading="forms.regularization.busy" label="Save" class="is-radius"
                v-if="!forms.regularization.id" />
              <NLButton :loading="forms.regularization.busy" label="Validate" class="is-radius" v-else />
            </div>
          </form>
        </template>
      </NLModal>
    </ContentBody>
  </div>
</template>

<script>
import ContentHeader from '../../components/ContentHeader'
import ContentBody from '../../components/ContentBody'
import { mapGetters } from 'vuex'
import Form from 'vform'
import Notification from '../../components/Notification'
import { hasRole } from '../../plugins/user'
export default {
  layout: 'backend',
  middleware: [ 'auth' ],
  components: {
    ContentHeader,
    ContentBody, Notification
  },
  metaInfo() {
    return { title: this.mission?.reference + ' - ' + this.process?.name }
  },
  data() {
    return {
      rowSelected: null,
      currentMetadata: {},
      process: null,
      mission: null,
      details: [],
      modals: {
        show: false,
        edit: false,
      },
      regularizationTypes: [
        {
          id: 'Cause',
          label: 'Cause',
        },
        {
          id: 'Action à engagé',
          label: 'Action à engagé',
        },
      ],
      regularization_mode: false,
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
        generic: new Form({
          process_mode: false,
          mission: null,
          process: null,
          media: [],
          detail: null,
          report: null,
          recovery_plan: null,
          score: null,
          major_fact: false,
          metadata: [],
        }),
      }
    }
  },
  computed: {
    formErrorsCount() {
      return Object.entries(this.forms.generic.errors.all()).length
    },
    ...mapGetters({
      config: 'details/config',
    }),
  },
  breadcrumb() {
    return {
      label: this.process?.name
    }
  },
  created() {
    this.initData()
  },
  methods: {
    /**
     * Affiche le modal des informations du point de contrôle
     */
    show(item) {
      this.rowSelected = item
      this.modals.show = true
      this.currentMetadata.keys = Object.keys(item.parsed_metadata)
    },
    /**
     * Affiche le modal pour modifer informations du point de contrôle
     *
     * @param {Object} item
     */
    edit(item) {
      this.rowSelected = item
      this.modals.edit = true
      this.currentMetadata.keys = Object.keys(item.parsed_metadata)
      this.initForm()
    },
    /**
     * Ferme la boite modal des détails du point de contrôle
     */
    close(modal) {
      this.rowSelected = null
      if (this.modals.hasOwnProperty(modal)) {
        this.modals[ modal ] = false
      }
      this.forms.generic.reset()
      this.currentMetadata = {}
    },
    /**
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId }).then(() => {
        this.details = this.config.config.details
        this.mission = this.config.config.mission
        this.process = this.config.config.process
        this.modals.show = false
        this.modals.edit = false
      })
    },
    /**
     * Initialise le formulaire
     */
    initForm() {
      this.regularization_mode = hasRole('da')
      this.regularization_mode ? this.initRegularizationForm() : this.initGenericForm()
    },
    initGenericForm() {
      this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId, detailId: this.rowSelected?.id }).then(() => {
        const config = this.config.config
        this.rowSelected = config.detail
        this.forms.generic.process_mode = config.mission.dre_report_is_validated
        this.forms.generic.mission = this.$route.params.missionId
        this.forms.generic.process = this.$route.params.processId
        this.forms.generic.detail = config.detail.id
        this.forms.generic.media = config.detail.media.length ? config.detail.media.map(file => file.id) : []
        this.forms.generic.detail = config.detail.id
        this.forms.generic.report = config.detail.report
        this.forms.generic.recovery_plan = config.detail.recovery_plan
        this.forms.generic.score = config.detail.score
        this.forms.generic.metadata = config.detail.metadata || []
        this.forms.generic.major_fact = config.detail.major_fact ? true : false
        this.forms.generic.process_mode = this.is([ 'dcp', 'cdcr', 'cc' ])
      })
    },
    initRegularizationForm() {
      this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId, detailId: this.rowSelected?.id }).then(() => {
        const config = this.config.config
        this.rowSelected = config.detail
        this.forms.regularization.detail_id = this.rowSelected.id
        this.forms.regularization.id = config.detail.regularization?.id
        this.forms.regularization.regularized = config.detail.regularization?.regularized_at ? true : false
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
        const type = field.hasOwnProperty(0) ? field[ 0 ].type : ''
        const label = field.hasOwnProperty(1) ? field[ 1 ].label : ''
        const name = field.hasOwnProperty(2) ? field[ 2 ].name : ''
        const length = field.hasOwnProperty(3) ? field[ 3 ].length : null
        const style = field.hasOwnProperty(4) ? field[ 4 ].style : ''
        const id = field.hasOwnProperty(5) ? field[ 5 ].id : ''
        const placeholder = field.hasOwnProperty(6) ? field[ 6 ].placeholder : ''
        const help_text = field.hasOwnProperty(7) ? field[ 7 ].help_text : ''
        const rules = field.hasOwnProperty(8) ? field[ 8 ].rules : []
        return { type, label, name, length, style, id, placeholder, help_text, rules }
      })
    },
    /**
     * Initialise les notations pour chaque point de contrôle
     *
     * @param {Array|null} scores
     */
    setupScores(scores) {
      if (typeof scores == 'object') {
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
     * Enregistrement du détail de la mission
     */
    save() {
      swal.confirm_update().then(action => {
        if (action.isConfirmed) {
          this.forms.generic.post('/api/missions/details/' + this.mission.id).then(response => {
            if (response.data.status) {
              swal.toast_success(response.data.message)
              this.initData()
            } else {
              swal.alert_error(response.data.message)
            }
          }).catch(error => {
            let message = error.message
            if (error.response.status == 422) {
              message = 'Les données fournies sont invalides.'
            }
            swal.toast_error(message)
          })
        }
      })
    },
    /**
     * Régularisation du détail de la mission
     */
    regularize() {

      this.forms.regularization.post('/api/regularize/' + this.forms.regularization.detail_id).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.forms.regularization.reset()
          this.initData()
          this.close('edit')
          this.close('show')
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        let message = error.message
        if (error.response.status == 422) {
          message = 'Les données fournies sont invalides.'
        }
        swal.toast_error(message)
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
        const element = fields[ index ];
        const name = element.name
        let defaultValue = element.default !== undefined ? element.default : ''
        defaultValue = element.multiple ? [] : ''
        schema.push({ [ name ]: defaultValue, label: element.label, rules: element.rules })
      }
      if (this.forms.generic.metadata) this.forms.generic.metadata.push(schema)
    },
    /**
     * Supprimer une ligne du répéteur
     *
     * @param {Number} row
     * @param {Number} field
     */
    removeRow(row, field) {
      this.forms.generic.metadata.splice(field, 1)
    },
    /**
     * Vérifie que la valeur est un input valide
     *
     * @param {String} value
     */
    isInput(value) {
      return [ 'text', 'date', 'datetime', 'time', 'week', 'number', 'tel', 'email', 'month', 'url' ].includes(value)
    },

    /**
     * Notifier les authorités concernées
     */
    notify(detail) {
      swal.confirm_update('Voulez-vous notifier les autorités concernées?').then(action => {
        if (action.isConfirmed) {
          api.post('notifications/major-fact/' + detail?.id).then(response => {
            swal.toast_success(response.data.message)
            this.initData()
            this.close('edit')
            this.close('show')
          }).catch(error => {
            swal.alert_error(error)
          })
        }
      })
    }
  },
}
</script>
