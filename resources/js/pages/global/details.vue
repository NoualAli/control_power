<template>
  <ContentBody>
    <NLDatatable :filters="filters" namespace="details" stateKey="global" :config="tableConfig" @show="show" />

    <!-- View control point informations -->
    <NLModal :show="modals.show" @close="close('show')" :defaultMode="true">
      <template v-slot:title>
        <div class="tags">
          <small class="tag is-primary-dark text-small">
            {{ mission?.campaign?.reference }}
          </small>
          <small class="tag is-primary-extra-light text-small mx-1">
            {{ mission?.reference }}
          </small>
        </div>
      </template>
      <template v-slot>
        <div class="grid gap-6">
          <div class="col-12">
            <span class="label">Fait majeur: </span>
            <span v-html="rowSelected?.major_fact_str"></span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Dre: </span>
            <span>{{ mission?.dre?.full_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Agence: </span>
            <span>{{ mission?.agency?.full_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Famille: </span>
            <span>{{ process?.familly?.name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Domaine: </span>
            <span>{{ rowSelected?.domain?.name }}</span>
          </div>
          <div class="col-12">
            <span class="label">Processus: </span>
            <span>{{ process?.name }}</span>
          </div>
          <div class="col-12">
            <span class="label">Point de contrôle: </span>
            <span>{{ rowSelected?.control_point?.name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Appréciation: </span>
            <span>{{ rowSelected?.appreciation }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Notation: </span>
            <span>{{ rowSelected?.score }}</span>
          </div>
          <div class="col-12" :class="{ 'col-lg-4': !rowSelected?.metadata }" v-if="rowSelected?.metadata?.length">
            <span class="label">
              Informations supplémentaires:
            </span>
          </div>
          <div class="col-12" :class="{ 'col-lg-8': !rowSelected?.parsed_metadata }" v-if="rowSelected?.metadata?.length">
            <table v-if="rowSelected?.parsed_metadata">
              <thead>
                <tr>
                  <th class="text-left" v-for="heading in Object.keys(rowSelected?.parsed_metadata)">
                    {{ heading }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(data, row) in rowSelected?.metadata" :key="'metadata-row-' + row">
                  <td class="text-left" v-for="(items, index) in data" :key="'metadata-row-' + row + '-item-' + index">
                    <span v-for="(item, key) in items" :key="'metadata-row-' + row + '-item-' + index + '-content'"
                      v-if="key !== 'label' && key !== 'rules'">
                      {{ item }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-12">
            <span class="label">Constat: </span>
            <span>{{ rowSelected?.report || '-' }}</span>
          </div>
          <div class="col-12">
            <span class="label">Plan de redressement: </span>
            <span>{{ rowSelected?.recovery_plan || '-' }}</span>
          </div>
          <div class="col-12" v-if="rowSelected?.regularization?.regularized_at">
            <span class="label">Date de régularisation: </span>
            <span>{{ rowSelected?.regularization?.regularized_at || '-' }}</span>
          </div>
          <div class="col-12 list-item" v-if="rowSelected?.media?.length">
            <NLFile label="Pièces jointes" name="media" v-model="files" :canDelete="false" readonly />
          </div>

          <div class="col-12 d-flex justify-end align-center">
            <div class="d-flex align-center gap-2">
              <!-- CI -->
              <button class="btn btn-warning has-icon" @click="edit(rowSelected)"
                v-if="!mission?.controller_opinion_is_validated && !rowSelected?.major_fact && can('create_opinion')">
                <i class="las la-pen icon"></i>
                Modifier
              </button>

              <!-- CDC -->
              <button class="btn btn-warning has-icon" @click="edit(rowSelected)"
                v-if="!mission?.dre_report_is_validated && !rowSelected?.major_fact && can('create_dre_report,validate_dre_report')">
                <i class="las la-pen icon"></i>
                Modifier
              </button>

              <!-- CDCR -->
              <button class="btn btn-warning has-icon" @click="edit(rowSelected)"
                v-if="!mission?.cdcr_validation_at && !rowSelected?.major_fact_dispatched_at && can('make_first_validation,process_mission')">
                <i class="las la-pen icon"></i>
                Traiter
              </button>

              <!-- DCP -->
              <button class="btn btn-warning has-icon" @click="edit(rowSelected)"
                v-if="!mission?.dcp_validation_at && rowSelected?.mission?.cdcr_validation_at && !rowSelected?.major_fact_dispatched_at && can('make_second_validation')">
                <i class="las la-pen icon"></i>
                Traiter
              </button>
              <button class="btn btn-info has-icon" @click.prevent="notify(rowSelected)"
                v-if="!rowSelected?.major_fact_dispatched_at && rowSelected?.major_fact && can('dispatch_major_fact')">
                <i class="las la-bell icon"></i>
                Notifier
              </button>
              <!-- Agency director -->
              <button
                v-if="mission?.dcp_validation_at && !rowSelected?.regularization?.regularized_at && !rowSelected?.major_fact && rowSelected?.score !== 1 && can('regularize_mission_detail')"
                class="btn btn-warning has-icon" @click="regularize(rowSelected)">
                <i class="las la-pen icon"></i>
                Régulariser
              </button>
            </div>
          </div>
        </div>
      </template>
    </NLModal>
    <!-- Traitement du point de contrôle -->
    <NLModal :show="modals.edit" :defaultMode="true" @close="close('edit')" v-if="modals.edit">
      <template v-slot:title>
        <small>
          {{ rowSelected?.control_point?.name }}
        </small>
      </template>
      <template v-slot>
        <Notification type="is-danger" v-if="forms.detail.errors.any()">
          Il y a {{ formErrorsCount }}
          {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
        </Notification>
        <form @submit.prevent="save('edit')" @keydown="forms.detail.onKeydown($event)" enctype="multipart/form-data"
          class="grid gap-6">
          <!-- Major Fact -->
          <div class="col-12">
            <NLSwitch v-model="forms.detail.major_fact" :name="'major_fact'" :form="forms.detail" label="Fait majeur" />
          </div>

          <!-- Score -->
          <div class="col-12">
            <NLSelect :name="'score'" label="Notation" :form="forms.detail" v-model="forms.detail.score"
              :options="setupScores(rowSelected?.control_point?.scores)" labelRequired />
          </div>

          <!-- Metadata -->
          <div class="col-12"
            v-if="rowSelected?.control_point?.fields && forms.detail.score > 1 && !forms.detail.process_mode">
            <div class="repeater">
              <h2 class="mb-6">Informations supplémentaires</h2>
              <!-- Repeater row -->
              <div class="grid my-6 repeater-row" v-for="(item, dataRow) in forms.detail.metadata"
                :key="'metadata-' + dataRow">
                <div class="col-12">
                  <div class="grid gap-2">
                    <div class="col-11">
                      <div class="grid">
                        <div :key="'metadata-input-' + input.name + '-' + dataRow + '-id'" :class="input.style"
                          v-for="(input, index) in setupFields(rowSelected?.control_point?.fields)">
                          <!-- Defining different inputs -->
                          <NLInput :form="forms.detail" :label="input.label" :placeholder="input.placeholder"
                            :type="input.type" :labelRequired="input.required"
                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="forms.detail.metadata[dataRow][index][input.name]"
                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="isInput(input.type)" />

                          <NLTextarea :form="forms.detail" :label="input.label" :placeholder="input.placeholder"
                            :type="input.type" :labelRequired="input.required"
                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="forms.detail.metadata[dataRow][index][input.name]"
                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="input.type == 'textarea'"
                            :length="input.length" />

                          <NLWyswyg :form="forms.detail" :label="input.label" :placeholder="input.placeholder"
                            :type="input.type" :labelRequired="input.required"
                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="forms.detail.metadata[dataRow][index][input.name]"
                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="input.type == 'wyswyg'"
                            :length="input.length" />

                          <NLSelect :form="forms.detail" :label="input.label" :type="input.type"
                            :labelRequired="input.required" :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="forms.detail.metadata[dataRow][index][input.name]"
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
                <span class="btn" @click="addRow(rowSelected?.control_point?.fields)">
                  <i class="las la-plus"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12" :class="{ 'col-lg-8': !rowSelected?.parsed_metadata }"
            v-else-if="forms.detail.process_mode && rowSelected?.parsed_metadata.length && forms.detail.score > 1">
            <div class=" label">
              Informations supplémentaires
            </div>
            <table v-if="rowSelected?.parsed_metadata">
              <thead>
                <tr>
                  <th class="text-left" v-for="heading in Object.keys(rowSelected?.parsed_metadata)">
                    {{ heading }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(data, row) in rowSelected?.metadata" :key="'metadata-row-' + row">
                  <td class="text-left" v-for="(items, index) in data" :key="'metadata-row-' + row + '-item-' + index">
                    <span v-for="(item, key) in items" :key="'metadata-row-' + row + '-item-' + index + '-content'"
                      v-if="key !== 'label' && key !== 'rules'">
                      {{ item }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
            <span v-else>-</span>
          </div>

          <!-- Report -->
          <div class="col-12" v-if="!forms.detail.process_mode">
            <NLTextarea :name="'report'" label="Constat" :form="forms.detail" v-model="forms.detail.report"
              :placeholder="![2, 3, 4].includes(forms.detail.score) && !forms.detail.major_fact ? '' : 'Ajouter votre constat'"
              :labelRequired="forms.detail.score > 1 || forms.detail.major_fact"
              :readonly="![2, 3, 4].includes(forms.detail.score) && !forms.detail.major_fact" />
          </div>
          <div class="col-12" v-else>
            <span class="label">Constat: </span>
            <span>{{ rowSelected?.report || '-' }}</span>
          </div>
          <!-- Media (attachements) -->
          <div class="col-12">
            <NLFile :name="'media'" label="Pièces jointes" attachableType="App\Models\MissionDetail"
              :attachableId="forms.detail.detail" v-model="forms.detail.media" :form="forms.detail" multiple
              :readonly="forms.detail.process_mode" />
            {{ forms.detail.process_mode }}
          </div>

          <!-- Recovery plan -->
          <div class="col-12">
            <NLTextarea :name="'recovery_plan'" label="Plan de redressement" :form="forms.detail"
              v-model="forms.detail.recovery_plan"
              :placeholder="![2, 3, 4].includes(forms.detail.score) && !forms.detail.major_fact ? '' : 'Ajouter votre plan de redressement'"
              :labelRequired="forms.detail.score > 1 || forms.detail.major_fact"
              :readonly="![2, 3, 4].includes(forms.detail.score) && !forms.detail.major_fact" />
          </div>

          <!-- Submit Button -->
          <div class="col-12 d-flex justify-end align-center">
            <NLButton :loading="forms.detail.busy" label="Save" class="is-radius" v-if="!forms.detail.process_mode" />
            <NLButton :loading="forms.detail.busy" label="Validate" class="is-radius" v-else />
          </div>
        </form>
      </template>
    </NLModal>

    <!-- Régularization du point de contrôle -->
    <NLModal :show="modals.regularize" :defaultMode="true" @close="close('regularize')" v-if="modals.regularize">
      <template v-slot:title>
        <small>
          {{ rowSelected?.control_point?.name }}
        </small>
      </template>
      <template v-slot>
        <Notification type="is-danger" v-if="forms.regularization.errors.any()">
          Il y a {{ formErrorsCount }}
          {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
        </Notification>
        <form @submit.prevent="save('regularize')" @keydown="forms.detail.onKeydown($event)" enctype="multipart/form-data"
          class="grid gap-6">
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
            <NLTextarea :name="'reason'" label="Cause" :form="forms.regularization" v-model="forms.regularization.reason"
              length="1000" labelRequired />
          </div>
          <div class="col-12" v-if="!forms.regularization.regularized && forms.regularization.type == 'Action à engagé'">
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
</template>
<script>
import { mapGetters } from 'vuex';
import { Form } from 'vform';
import { hasRole } from '../../plugins/user'
import Notification from '../../components/Notification'
export default {
  layout: 'backend',
  middleware: [ 'auth' ],
  components: { Notification },
  computed: {
    ...mapGetters({
      details: 'details/global',
      config: 'details/config',
      filtersData: 'details/filters'
    }),
    formErrorsCount() {
      if (this.modals.edit) {
        return Object.entries(this.forms.detail.errors.all()).length
      } else if (this.modals.regularize) {
        return Object.entries(this.forms.regularization.errors.all()).length
      }
    },
    files() {
      return this.rowSelected.media.map(file => file.id)
    }
  },
  data: () => {
    return {
      rowSelected: null,
      mission: null,
      process: null,
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
      tableConfig: {
        data: null,
        columns: [
          {
            label: 'CDC-ID',
            field: 'cdc_reference',
          },
          {
            label: 'RAP-ID',
            field: 'mission_reference',
          },
          {
            label: 'DRE',
            field: 'dre_full_name',
          },
          {
            label: 'Agence',
            field: 'agency_full_name',
          },
          {
            label: 'Famille',
            field: 'familly_name',
          },
          {
            label: 'Domaine',
            field: 'domain_name',
          },
          {
            label: 'Processus',
            field: 'process_name',
          },
          {
            label: 'Point de contrôle',
            field: 'control_point_name',
          },
          {
            label: 'Fait majeur',
            field: 'major_fact_str',
            isHtml: true,
            methods: {
              showField(item) {
                return `
                <div class="text-center">
                  ${item.major_fact_str}
                </div>
                `
              }
            }
          },
          {
            label: 'Notation',
            field: 'score',
            hide: !hasRole([ 'dcp', 'cdcr', 'cc' ]),
            methods: {
              style() {
                return 'text-center'
              }
            }
          },
        ],
        actions: {
          show: false,
        }
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
          metadata: [],
          process_mode: null,
        }),
      },
      modals: {
        show: false,
        edit: false,
        regularize: false,
      },
      filters: {
        campaign: {
          label: 'Campagne de contrôle',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        mission_id: {
          label: 'Mission',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        dre: {
          label: 'DRE',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        agency: {
          label: 'Agence',
          cols: 'col-lg-3',
          multiple: true,
          data: null,
          value: null
        },
        familly: {
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
          value: null,
        },
        is_regularized: {
          label: 'Régularisation',
          multiple: false,
          value: null,
          hide: !hasRole([ 'dcp', 'cdcr' ]),
          data: [
            {
              id: 0,
              label: 'Non levé'
            },
            {
              id: 1,
              label: 'Levé'
            },
          ],
        },
        score: {
          label: 'Notation',
          multiple: true,
          data: [
            {
              id: 1,
              label: 1
            },
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
            },
          ],
          value: null,
          hide: !hasRole([ 'dcp', 'cdcr', 'cc' ]),
        },
        major_fact: {
          label: 'Fait majeur',
          data: [
            {
              id: 0,
              label: 'Non'
            },
            {
              id: 1,
              label: 'Oui'
            },
          ],
          value: null
        },
      },
      currentMetadata: {},
    }
  },
  created() {
    this.initFilters()
    this.initData()
  },
  methods: {
    /**
     * Initialise les filtres
     */
    initFilters() {
      this.$store.dispatch('details/fetchFilters').then(() => {
        this.filters.campaign.data = this.filtersData.filters.campaigns
        this.filters.mission_id.data = this.filtersData.filters.missions
        this.filters.dre.data = this.filtersData.filters.dres
        this.filters.agency.data = this.filtersData.filters.agencies
        this.filters.familly.data = this.filtersData.filters.famillies
        this.filters.domain.data = this.filtersData.filters.domains
        this.filters.process.data = this.filtersData.filters.processes
      })
    },
    /**
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('details/fetchGlobal').then(() => this.tableConfig.data = this.details.global)
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
      if (this.modals.hasOwnProperty(modal)) {
        this.modals[ modal ] = false
      }
      this.forms.detail.reset()
      this.forms.regularization.reset()
      this.initData()
      this.currentMetadata = {}
      this.rowSelected = null
      if (modal == 'show') {
      } else {
      }
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
        this.forms.detail.score = config.detail.score
        this.forms.detail.major_fact = config.detail.major_fact ? true : false
        this.forms.detail.metadata = config.detail.metadata || []
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
     * Création de la mission
     */
    save(action) {
      let form, url
      if (action == 'edit') {
        form = this.forms.detail
        url = '/api/missions/details/' + this.forms.detail.mission
      } else if (action == 'regularize') {
        form = this.forms.regularization
        url = '/api/regularize/' + this.forms.regularization.detail_id
      }
      form.post(url).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.initData()
          form.reset()
          this.close('edit')
          this.close('show')
          this.close('regularize')
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
      swal.confirm({ title: 'Dispatch notification', message: 'Voulez-vous notifier les autorités concernées?' }).then(action => {
        if (action.isConfirmed) {
          api.post('notifications/major-fact/' + this.rowSelected.id).then(response => {
            swal.toast_success(response.data.message)
            this.rowSelected = null
          }).catch(error => {
            swal.alert_error(error)
          })
        }
      })
    }
  }
}
</script>

