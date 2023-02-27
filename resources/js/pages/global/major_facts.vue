<template>
  <ContentBody>
    <NLDatatable :filters="filters" namespace="details" stateKey="majorFacts" :config="tableConfig" @show="show" />
    <NLModal :show="modals.show" @close="close('show')" :defaultMode="true">
      <template v-slot:title>
        <div class="tags">
          <small class="tag is-primary-dark text-small">
            {{ rowSelected?.cdc_reference }}
          </small>
          <small class="tag is-primary-extra-light text-small mx-1">
            {{ rowSelected?.mission_reference }}
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
            <span>{{ rowSelected?.dre_full_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Agence: </span>
            <span>{{ rowSelected?.agency_full_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Famille: </span>
            <span>{{ rowSelected?.familly_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Domaine: </span>
            <span>{{ rowSelected?.domain_name }}</span>
          </div>
          <div class="col-12">
            <span class="label">Processus: </span>
            <span>{{ rowSelected?.process_name }}</span>
          </div>
          <div class="col-12">
            <span class="label">Point de contrôle: </span>
            <span>{{ rowSelected?.control_point_name }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Appréciation: </span>
            <span>{{ rowSelected?.appreciation }}</span>
          </div>
          <div class="col-12 col-lg-6">
            <span class="label">Notation: </span>
            <span>{{ rowSelected?.score }}</span>
          </div>
          <div class="col-12" :class="{ 'col-lg-4': !rowSelected?.metadata }">
            <span class="label">
              Informations supplémentaires:
            </span>
          </div>
          <div class="col-12" :class="{ 'col-lg-8': !rowSelected?.parsed_metadata }" v-if="rowSelected?.metadata">
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
          <div class="col-8" v-else>
            -
          </div>
          <div class="col-12">
            <span class="label">Constat: </span>
            <span>{{ rowSelected?.report || '-' }}</span>
          </div>
          <div class="col-12">
            <span class="label">Plan de redressement: </span>
            <span>{{ rowSelected?.recovery_plan || '-' }}</span>
          </div>
          <div class="col-12 list-item" v-if="rowSelected?.media">
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
                  <i class="las la-trash text-danger icon is-clickable" @click.stop="deleteItem(file, index)"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 d-flex justify-end align-center" v-can="'dispatch_major_fact'">
            <div class="d-flex align-center gap-2">
              <button class="btn btn-warning has-icon" @click.prevent="edit" v-can="'process_mission,dispatch_major_fact'"
                v-if="rowSelected?.mission_dcp_validation_at">
                <i class="las la-check icon"></i>
                Traiter
              </button>
              <button class="btn btn-warning has-icon" @click.prevent="edit" v-can="'control_agency'"
                v-if="!rowSelected?.mission_dcp_validation_at">
                <i class="las la-pen icon"></i>
                Modifier
              </button>

              <button class="btn btn-info has-icon" @click.prevent="notify" v-if="rowSelected?.mission_dcp_validation_at">
                <i class="las la-bell icon"></i>
                Notifier
              </button>
            </div>
          </div>
        </div>
      </template>
    </NLModal>
    <!-- Edition du point de contrôle -->
    <NLModal :show="modals.edit" :defaultMode="true" @close="close('edit')" v-if="modals.edit">
      <template v-slot:title>
        <small>
          {{ rowSelected?.control_point?.name }}
        </small>
      </template>
      <template v-slot>
        <Notification type="is-danger" v-if="form.errors.any()">
          Il y a {{ formErrorsCount }}
          {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
        </Notification>
        <form @submit.prevent="save" @keydown="form.onKeydown($event)" enctype="multipart/form-data" class="grid gap-6">
          <div class="col-12">
            <NLSwitch v-model="form.major_fact" :name="'major_fact'" :form="form" label="Fait majeur" />
          </div>
          <div class="col-12">
            <NLSelect :name="'score'" label="Notation" :form="form" v-model="form.score"
              :options="setupScores(rowSelected?.control_point?.scores)" labelRequired />
          </div>

          <!-- Metadata -->
          <div class="col-12" v-if="rowSelected?.control_point?.fields && form.score > 1 && !form.process_mode">
            <div class="repeater">
              <h2 class="mb-6">Informations supplémentaires</h2>
              <!-- Repeater row -->
              <div class="grid my-6 repeater-row" v-for="(item, dataRow) in form.metadata" :key="'metadata-' + dataRow">
                <div class="col-12">
                  <div class="grid gap-2">
                    <div class="col-11">
                      <div class="grid">
                        <div :key="'metadata-input-' + input.name + '-' + dataRow + '-id'" :class="input.style"
                          v-for="(input, index) in setupFields(rowSelected?.control_point?.fields)">
                          <!-- Defining different inputs -->
                          <NLInput :form="form" :label="input.label" :placeholder="input.placeholder" :type="input.type"
                            :labelRequired="input.required" :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="form.metadata[dataRow][index][input.name]"
                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="isInput(input.type)" />

                          <NLTextarea :form="form" :label="input.label" :placeholder="input.placeholder"
                            :type="input.type" :labelRequired="input.required"
                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="form.metadata[dataRow][index][input.name]"
                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="input.type == 'textarea'"
                            :length="input.length" />

                          <NLWyswyg :form="form" :label="input.label" :placeholder="input.placeholder" :type="input.type"
                            :labelRequired="input.required" :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="form.metadata[dataRow][index][input.name]"
                            :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="input.type == 'wyswyg'"
                            :length="input.length" />

                          <NLSelect :form="form" :label="input.label" :type="input.type" :labelRequired="input.required"
                            :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                            v-model="form.metadata[dataRow][index][input.name]"
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
          <div class="col-12" :class="{ 'col-lg-8': !rowSelected?.parsed_metadata }" v-else>
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
          <div class="col-12" v-if="!form.process_mode">
            <NLTextarea :name="'report'" label="Constat" :form="form" v-model="form.report"
              :placeholder="form.score == 1 || form.score == null && !form.major_fact ? '' : 'Ajouter votre constat'"
              :labelRequired="form.score > 1 || form.major_fact"
              :disabled="form.score == 1 || form.score == null && !form.major_fact" />
          </div>
          <div class="col-12" v-else>
            <span class="label">Constat: </span>
            <span>{{ rowSelected?.report || '-' }}</span>
          </div>
          <!-- Media (attachements) -->
          <div class="col-12" v-if="!form.process_mode">
            <NLFile :name="'media'" label="Pièces jointes" attachableType="App\Models\MissionDetail"
              :attachableId="form.detail" v-model="form.media" :form="form" multiple />
          </div>
          <div class="col-12 list-item" v-else-if="form.process_mode && rowSelected?.media">
            <div class="list-item-label label">
              Pièces jointes
            </div>
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
                  <i class="las la-trash text-danger icon is-clickable" @click.stop="deleteItem(file, index)"></i>
                </div>
              </div>
            </div>
          </div>
          <!-- Recovery plan -->
          <div class="col-12">
            <NLTextarea :name="'recovery_plan'" label="Plan de redressement" :form="form" v-model="form.recovery_plan"
              :placeholder="form.score == 1 || form.score == null && !form.major_fact ? '' : 'Ajouter votre plan de redressement'"
              :labelRequired="form.score > 1 || form.major_fact"
              :disabled="form.score == 1 || form.score == null && !form.major_fact" />
          </div>

          <!-- Submit Button -->
          <div class="col-12 d-flex justify-end align-center">
            <NLButton :loading="form.busy" label="Save" class="is-radius" v-if="!form.process_mode" />
            <NLButton :loading="form.busy" label="Validate" class="is-radius" v-else />
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
  computed: {
    ...mapGetters({
      details: 'details/majorFacts',
      config: 'details/config',
      filtersData: 'details/filters'
    }),
    formErrorsCount() {
      return Object.entries(this.form.errors.all()).length
    },
  },
  data: () => {
    return {
      rowSelected: null,
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
            methods: {
              style() {
                return 'text-center'
              }
            }
          },
        ],
        actions: {
          show: true,
        }
      },
      filters: {
        campaign: {
          label: 'Campagne de contrôle',
          name: 'campaign',
          multiple: false,
          data: null,
          value: null
        },
        mission_id: {
          label: 'Mission',
          name: 'mission_id',
          multiple: false,
          data: null,
          value: null
        },
        agency_id: {
          label: 'Agence',
          name: 'agency_id',
          multiple: false,
          data: null,
          value: null
        },
        familly: {
          label: 'Famille',
          name: 'familly',
          multiple: false,
          data: null,
          value: null
        },
        domain: {
          label: 'Domaine',
          name: 'domain',
          multiple: false,
          data: null,
          value: null
        },
        process: {
          label: 'Processus',
          name: 'process',
          multiple: false,
          data: null,
          value: null
        },
        // {
        //   label: 'Point de contrôle',
        //   name: 'control_point_id',
        //   multiple: false,
        //   cols: 'col-lg-12',
        //   data: {},
        // },
        score: {
          label: 'Notation',
          name: 'score',
          multiple: false,
          data: null,
          value: null
        },
      },
      form: new Form({
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
      modals: {
        show: false,
        edit: false,
      },
      currentMetadata: {},
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
        this.filters.agency_id.data = this.filtersData.filters.agencies
        this.filters.familly.data = this.filtersData.filters.famillies
        this.filters.domain.data = this.filtersData.filters.domains
        this.filters.process.data = this.filtersData.filters.processes
        this.filters.score.data = this.filtersData.filters.scores
        // this.filters.major_fact.data = this.filtersData.filters.major_fact
      })
    },
    /**
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('details/fetchMajorFacts').then(() => this.tableConfig.data = this.details.majorFacts)
    },
    /**
        * Affiche le modal des informations du point de contrôle
        */
    show(item) {
      this.rowSelected = item
      this.modals.show = true
      this.modals.edit = false
      this.currentMetadata.keys = Object.keys(item.parsed_metadata)
    },
    /**
     * Affiche le modal pour modifer informations du point de contrôle
     *
     */
    edit() {
      // this.rowSelected = item
      this.modals.edit = true
      this.modals.show = false
      // this.currentMetadata.keys = Object.keys(this.rowSelected.parsed_metadata)
      this.initForm()
    },
    /**
     * Ferme la boite modal des détails du point de contrôle
     */
    close(modal) {
      if (this.modals.hasOwnProperty(modal)) {
        this.modals[ modal ] = false
      }
      if (modal == 'show') {
        this.currentMetadata = {}
        this.rowSelected = null
      } else {
        this.form.reset()
        this.initData()
      }
    },
    /**
 * Initialise le formulaire
 */
    initForm() {
      this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId, detailId: this.rowSelected?.id }).then(() => {
        const config = this.config.config
        this.rowSelected = config.detail
        this.form.process_mode = !hasRole([ 'cc', 'cdcr' ])
        this.form.mission = config.mission.id
        this.form.process = config.process.id
        this.form.detail = config.detail.id
        this.form.media = config.detail.media.length ? config.detail.media.map(file => file.id) : []
        this.form.detail = config.detail.id
        this.form.report = config.detail.report
        this.form.recovery_plan = config.detail.recovery_plan
        this.form.score = config.detail.score
        this.form.major_fact = config.detail.major_fact ? true : false
        this.form.metadata = config.detail.metadata || []
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
    save() {
      this.form.post('/api/missions/details/' + this.form.mission).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.initData()
          this.form.reset()
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
      if (this.form.metadata) this.form.metadata.push(schema)
    },
    /**
     * Supprimer une ligne du répéteur
     *
     * @param {Number} row
     * @param {Number} field
     */
    removeRow(row, field) {
      this.form.metadata.splice(field, 1)
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
            this.close('edit')
            this.close('show')
          }).catch(error => {
            swal.alert_error(error)
          })
        }
      })
    }
  }
}
</script>

