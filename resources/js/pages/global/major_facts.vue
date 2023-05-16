<template>
  <ContentBody>
    <NLDatatable :filters="filters" namespace="details" state-key="global" :config="tableConfig" @show="show" />

    <!-- View control point informations -->
    <NLModal :show="modals.show" :default-mode="true" @close="close('show')">
      <template #title>
        <div class="tags">
          <small class="tag is-primary-dark text-small">
            {{ mission?.campaign?.reference }}
          </small>
          <small class="tag is-primary-extra-light text-small mx-1">
            {{ mission?.reference }}
          </small>
        </div>
      </template>
      <template #default>
        <div class="grid gap-6">
          <div class="col-12">
            <span class="label">Fait majeur: </span>
            <span v-html="rowSelected?.major_fact_str" />
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
          <div v-if="rowSelected?.metadata" class="col-12" :class="{ 'col-lg-4': !rowSelected?.metadata }">
            <span class="label">
              Informations supplémentaires:
            </span>
          </div>
          <div v-if="rowSelected?.metadata" class="col-12" :class="{ 'col-lg-8': !rowSelected?.parsed_metadata }">
            <table v-if="rowSelected?.parsed_metadata">
              <thead>
                <tr>
                  <th v-for="(heading, index) in Object.keys(rowSelected?.parsed_metadata)" :key="index" class="text-left">
                    {{ heading }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(data, row) in rowSelected?.metadata" :key="'metadata-row-' + row">
                  <td v-for="(items, index) in data" :key="'metadata-row-' + row + '-item-' + index" class="text-left">
                    <template v-for="(item, key) in items">
                      <span v-if="key !== 'label' && key !== 'rules'"
                        :key="'metadata-row-' + row + '-item-' + index + key + '-content'">
                        {{ item }}
                      </span>
                    </template>
                  </td>
                </tr>
              </tbody>
            </table>
            <span v-else>-</span>
          </div>
          <div class="col-12">
            <span class="label">Constat: </span>
            <span>{{ rowSelected?.report || '-' }}</span>
          </div>
          <div class="col-12">
            <span class="label">Plan de redressement: </span>
            <span>{{ rowSelected?.recovery_plan || '-' }}</span>
          </div>
          <div v-if="rowSelected?.media.length" class="col-12 list-item">
            <NLFile v-model="files" label="Pièces jointes" name="media" :can-delete="false" readonly />
          </div>
          <div class="col-12 d-flex justify-end align-center">
            <div class="d-flex align-center gap-2">
              <!-- CI -->
              <button
                v-if="!mission?.controller_opinion_is_validated && !rowSelected?.major_fact && can('create_opinion')"
                class="btn btn-warning has-icon" @click="edit(rowSelected)">
                <i class="las la-pen icon" />
                Modifier
              </button>

              <!-- CDC -->
              <button
                v-if="!mission?.dre_report_is_validated && !rowSelected?.major_fact && can('create_dre_report,validate_dre_report')"
                class="btn btn-warning has-icon" @click="edit(rowSelected)">
                <i class="las la-pen icon" />
                Modifier
              </button>

              <!-- CDCR -->
              <button v-if="!rowSelected?.major_fact_dispatched_at && can('make_first_validation,make_second_validation')"
                class="btn btn-warning has-icon" @click="edit(rowSelected)">
                <i class="las la-pen icon" />
                Traiter
              </button>

              <!-- DCP -->
              <!-- <button class="btn btn-warning has-icon" @click="edit(rowSelected)"
                v-if="!mission?.dcp_validation_at && rowSelected?.mission?.cdcr_validation_at && !rowSelected?.major_fact_dispatched_at && can('make_second_validation')">
                <i class="las la-pen icon"></i>
                Traiter
              </button> -->
              <button
                v-if="!rowSelected?.major_fact_dispatched_at && rowSelected?.major_fact && can('dispatch_major_fact')"
                class="btn btn-info has-icon" @click.prevent="notify(rowSelected)">
                <i class="las la-bell icon" />
                Notifier
              </button>
              <!-- Agency director -->
              <button
                v-if="mission?.dcp_validation_at && !rowSelected?.regularization?.regularized_at && rowSelected?.score !== 1 && can('regularize_mission_detail')"
                class="btn btn-warning has-icon" @click="edit(rowSelected)">
                <i class="las la-pen icon" />
                Régulariser
              </button>
            </div>
          </div>
        </div>
      </template>
    </NLModal>
    <!-- Traitement du point de contrôle -->
    <NLModal v-if="modals.edit" :show="modals.edit" :default-mode="true" @close="close('edit')">
      <template #title>
        <small>
          {{ rowSelected?.control_point?.name }}
        </small>
      </template>
      <template #default>
        <Notification v-if="forms.detail.errors.any()" type="is-danger">
          Il y a {{ formErrorsCount }}
          {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
        </Notification>
        <form enctype="multipart/form-data" class="grid gap-6" @submit.prevent="save('edit')"
          @keydown="forms.detail.onKeydown($event)">
          <!-- Major Fact -->
          <div class="col-12">
            <NLSwitch v-model="forms.detail.major_fact" :name="'major_fact'" :form="forms.detail" label="Fait majeur" />
          </div>

          <!-- Score -->
          <div class="col-12">
            <NLSelect v-model="forms.detail.score" :name="'score'" label="Notation" :form="forms.detail"
              :options="setupScores(rowSelected?.control_point?.scores)" label-required />
          </div>

          <!-- Metadata -->
          <div v-if="rowSelected?.control_point?.fields && forms.detail.score > 1 && !forms.detail.process_mode"
            class="col-12">
            <div class="repeater">
              <h2 class="mb-6">
                Informations supplémentaires
              </h2>
              <!-- Repeater row -->
              <div v-for="(item, dataRow) in forms.detail.metadata" :key="'metadata-' + dataRow"
                class="grid my-6 repeater-row">
                <div class="col-12">
                  <div class="grid gap-2">
                    <div class="col-11">
                      <div class="grid">
                        <div v-for="(input, index) in setupFields(rowSelected?.control_point?.fields)"
                          :key="'metadata-input-' + input.name + '-' + dataRow + '-id'" :class="input.style">
                          <!-- Defining different inputs -->
                          <NLInput v-if="isInput(input.type)" :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="forms.detail.metadata[dataRow][index][input.name]" :form="forms.detail"
                            :label="input.label" :placeholder="input.placeholder" :type="input.type"
                            :label-required="input.required"
                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name" />

                          <NLTextarea v-if="input.type === 'textarea'"
                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="forms.detail.metadata[dataRow][index][input.name]" :form="forms.detail"
                            :label="input.label" :placeholder="input.placeholder" :type="input.type"
                            :label-required="input.required"
                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name" :length="input.length" />

                          <NLWyswyg v-if="input.type === 'wyswyg'"
                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="forms.detail.metadata[dataRow][index][input.name]" :form="forms.detail"
                            :label="input.label" :placeholder="input.placeholder" :type="input.type"
                            :label-required="input.required"
                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name" :length="input.length" />

                          <NLSelect v-if="input.type === 'select'"
                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="forms.detail.metadata[dataRow][index][input.name]" :form="forms.detail"
                            :label="input.label" :type="input.type" :label-required="input.required"
                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name" :options="input.options"
                            :placeholder="input.placeholder || 'Choisissez une option...'" :multiple="input.multiple" />
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
                <span class="btn" @click="addRow(rowSelected?.control_point?.fields)">
                  <i class="las la-plus" />
                </span>
              </div>
            </div>
          </div>
          <!-- Metadata -->
          <div v-else-if="!rowSelected?.control_point?.fields && forms.detail.process_mode" class="col-12"
            :class="{ 'col-lg-8': !rowSelected?.parsed_metadata }">
            <div class=" label">
              Informations supplémentaires
            </div>
            <table v-if="rowSelected?.parsed_metadata">
              <thead>
                <tr>
                  <th v-for="(heading, index) in Object.keys(rowSelected?.parsed_metadata)" :key="index" class="text-left">
                    {{ heading }}
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(data, row) in rowSelected?.metadata" :key="'metadata-row-' + row">
                  <td v-for="(items, index) in data" :key="'metadata-row-' + row + '-item-' + index" class="text-left">
                    <template v-for="(item, key) in items">
                      <span v-if="key !== 'label' && key !== 'rules'"
                        :key="'metadata-row-' + row + '-item-' + index + key + '-content'">
                        {{ item }}
                      </span>
                    </template>
                  </td>
                </tr>
              </tbody>
            </table>
            <span v-else>-</span>
          </div>

          <!-- Report -->
          <div v-if="!forms.detail.process_mode" class="col-12">
            <NLTextarea v-model="forms.detail.report" :name="'report'" label="Constat" :form="forms.detail"
              :placeholder="forms.detail.score === 1 || forms.detail.score === null && !forms.detail.major_fact ? '' : 'Ajouter votre constat'"
              :label-required="forms.detail.score > 1 || forms.detail.major_fact"
              :readonly="forms.detail.score === 1 || forms.detail.score === null && !forms.detail.major_fact" />
          </div>
          <div v-else class="col-12">
            <span class="label">Constat: </span>
            <span>{{ rowSelected?.report || '-' }}</span>
          </div>
          <!-- Media (attachements) -->
          <div class="col-12">
            <NLFile v-model="forms.detail.media" :name="'media'" label="Pièces jointes"
              attachable-type="App\Models\MissionDetail" :attachable-id="forms.detail.detail" :form="forms.detail"
              multiple :can-delete="!rowSelected?.major_fact && !forms.detail.process_mode"
              :readonly="forms.detail.process_mode" />
          </div>
          <!-- Recovery plan -->
          <div class="col-12">
            <NLTextarea v-model="forms.detail.recovery_plan" :name="'recovery_plan'" label="Plan de redressement"
              :form="forms.detail"
              :placeholder="forms.detail.score === 1 || forms.detail.score === null && !forms.detail.major_fact ? '' : 'Ajouter votre plan de redressement'"
              :label-required="forms.detail.score > 1 || forms.detail.major_fact"
              :readonly="forms.detail.score === 1 || forms.detail.score === null && !forms.detail.major_fact" />
          </div>

          <!-- Submit Button -->
          <div class="col-12 d-flex justify-end align-center">
            <NLButton v-if="!forms.detail.process_mode" :loading="forms.detail.busy" label="Save" class="is-radius" />
            <NLButton v-else :loading="forms.detail.busy" label="Validate" class="is-radius" />
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
export default {
  components: { Notification },
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
      tableConfig: {
        data: null,
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
            hide: hasRole([ 'cdc', 'ci' ])
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
            field: 'control_point_name'
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
                const score = item.score
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
          }
        ],
        actions: {
          show: false
        }
      },
      forms: {
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
          multiple: true,
          data: null,
          value: null
        },
        mission_id: {
          label: 'Mission',
          multiple: true,
          data: null,
          value: null
        },
        agency: {
          label: 'Agence',
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
          value: null
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
            }
          ],
          value: null
        }
      },
      currentMetadata: {}
    }
  },
  computed: {
    ...mapGetters({
      details: 'details/majorFacts',
      config: 'details/config',
      filtersData: 'details/filters'
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
  created() {
    this.initData()
    this.initFilters()
  },
  methods: {
    /**
     * Initialise les filtres
     */
    initFilters() {
      this.$store.dispatch('details/fetchFilters').then(() => {
        this.filters.campaign.data = this.filtersData.filters.campaigns
        this.filters.mission_id.data = this.filtersData.filters.missions
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
      this.$store.dispatch('details/fetchMajorFacts').then(() => { this.tableConfig.data = this.details.majorFacts })
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
      if (Object.prototype.hasOwnProperty.call(this.modals, modal)) {
        this.modals[ modal ] = false
      }
      this.forms.detail.reset()
      // this.forms.regularization.reset()
      this.initData()
      this.currentMetadata = {}
      this.rowSelected = null
      // if (modal === 'show') {
      // } else {
      // }
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
        this.forms.detail.major_fact = !!config.detail.major_fact
        this.forms.detail.metadata = config.detail.metadata || []
      })
    },
    initRegularizationForm() {
      // this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId, detailId: this.rowSelected?.id }).then(() => {
      //   const config = this.config.config
      //   this.rowSelected = config.detail
      //   this.forms.regularization.detail_id = this.rowSelected.id
      //   this.forms.regularization.id = config.detail.regularization?.id
      //   this.forms.regularization.regularized = config.detail.regularization?.regularized_at ? true : false
      //   this.forms.regularization.reason = config.detail.regularization?.reason
      //   this.forms.regularization.committed_action = config.detail.regularization?.committed_action
      //   this.forms.regularization.action_to_be_taken = config.detail.regularization?.action_to_be_taken
      //   if (config.detail.regularization?.reason) {
      //     this.forms.regularization.type = 'Cause'
      //   } else if (config.detail.regularization?.action_to_be_taken) {
      //     this.forms.regularization.type = 'Action à engagé'
      //   }
      // })
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
     * Vérifie que la valeur est un input valide
     *
     * @param {String} value
     */
    isInput(value) {
      return [ 'text', 'date', 'datetime', 'time', 'week', 'number', 'tel', 'email', 'month', 'url' ].includes(value)
    },
    /**
     * Notifier les authoritées concernées
     */
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
