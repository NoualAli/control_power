<template>
  <div v-can="'view_mission_detail'">
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
        <div class="col-12" v-for="detail in details" :key="detail.id">
          <div class="box">
            <div class="grid gap-4">

              <div class="col-12">
                <h3>{{ detail.control_point.name }}</h3>
              </div>

              <div class="col-4"><b>Fait majeur:</b></div>
              <div class="col-8">
                <span v-if="!detail.major_fact">
                  <i class="las la-check-circle icon text-success"></i>
                  Non
                </span>
                <span v-else>
                  <i class="las la-times-circle icon text-danger"></i>
                  Oui
                </span>
              </div>

              <div class="col-4"><b>Appréciation:</b></div>
              <div class="col-8">{{ detail.appreciation }}</div>

              <div class="col-4"><b>Constat:</b></div>
              <div class="col-8">{{ detail.report || '-' }}</div>

              <div class="col-4"><b>Plan de redressement:</b></div>
              <div class="col-8">{{ detail.recovery_plan || '-' }}</div>

              <div class="col-12 d-flex justify-end align-center">
                <div class="d-flex gap-2 align-center">
                  <button class="btn btn-info has-icon" @click="show(detail)">
                    <i class="las la-eye icon"></i>
                    Voir plus
                  </button>
                  <button v-can="'control_agency'" class="btn btn-warning has-icon" @click="edit(detail)"
                    v-if="!mission?.controller_opinion_validated">
                    <i class="las la-pen icon"></i>
                    Modifier
                  </button>
                  <button v-can="'create_dre_report,validate_dre_report'" class="btn btn-warning has-icon"
                    @click="edit(detail)" v-if="!mission?.dre_report_validated">
                    <i class="las la-pen icon"></i>
                    Modifier
                  </button>
                  <button v-can="'make_first_validation'" class="btn btn-warning has-icon" @click="edit(detail)"
                    v-if="!mission?.cdcr_validation_at">
                    <i class="las la-pen icon"></i>
                    Traiter
                  </button>
                  <button v-can="'make_second_validation'" class="btn btn-warning has-icon" @click="edit(detail)"
                    v-if="!mission?.dcp_validation_at">
                    <i class="las la-pen icon"></i>
                    Traiter
                  </button>
                  <button v-can="'regularize_mission_detail'" class="btn btn-warning has-icon" @click="edit(detail)">
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
            <div class="col-12 list-item">
              <div class="list-item-content no-bg grid">
                <div class="col-4"><b>Appréciation:</b></div>
                <div class="col-8">{{ rowSelected?.appreciation }}</div>
              </div>
            </div>
            <div class="col-12 list-item">
              <div class="list-item-content no-bg grid">
                <div class="col-4"><b>Constat:</b></div>
                <div class="col-8">{{ rowSelected?.report || '-' }}</div>
              </div>
            </div>
            <div class="col-12 list-item">
              <div class="list-item-content no-bg grid">
                <div class="col-4"><b>Plan de redressement:</b></div>
                <div class="col-8">{{ rowSelected?.recovery_plan || '-' }}</div>
              </div>
            </div>
            <div class="col-12 list-item">
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
          <Notification type="is-danger" v-if="form.errors.any()">
            Il y a {{ formErrorsCount }}
            {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
          </Notification>
          <form @submit.prevent="create" @keydown="form.onKeydown($event)" enctype="multipart/form-data"
            class="grid gap-2">
            <!-- Major fact -->
            <div class="col-12" v-if="detail?.control_point.has_major_fact">
              <NLSwitch v-model="form.major_fact" :name="'major_fact'" :form="form" label="Fait majeur" />
            </div>
            <div class="col-12">
              <NLSelect :name="'score'" label="Notation" :form="form" v-model="form.score"
                :options="setupScores(rowSelected?.control_point.scores)" labelRequired />
            </div>

            <!-- Metadata -->
            <div class="col-12" v-if="rowSelected?.control_point.fields && form.score > 1">
              <div class="repeater">
                <h2 class="mb-6">Informations supplémentaires</h2>
                <!-- Repeater row -->
                <div class="grid my-6 repeater-row" v-for="(item, dataRow) in form.metadata" :key="'metadata-' + dataRow">
                  <div class="col-12">
                    <div class="grid gap-2">
                      <div class="col-11">
                        <div class="grid">
                          <div :key="'metadata-input-' + input.name + '-' + dataRow + '-id'" :class="input.style"
                            v-for="(input, index) in setupFields(rowSelected?.control_point.fields)">
                            <!-- Defining different inputs -->
                            <NLInput :form="form" :label="input.label" :placeholder="input.placeholder" :type="input.type"
                              :labelRequired="input.required"
                              :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                              v-model="form.metadata[dataRow][index][input.name]"
                              :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="isInput(input.type)" />

                            <NLTextarea :form="form" :label="input.label" :placeholder="input.placeholder"
                              :type="input.type" :labelRequired="input.required"
                              :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
                              v-model="form.metadata[dataRow][index][input.name]"
                              :id="'metadata.' + dataRow + '.' + index + '.' + input.name" v-if="input.type == 'textarea'"
                              :length="input.length" />

                            <NLWyswyg :form="form" :label="input.label" :placeholder="input.placeholder"
                              :type="input.type" :labelRequired="input.required"
                              :name="'metadata.' + dataRow + '.' + index + '.' + input.name"
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
                  <span class="btn" @click="addRow(rowSelected?.control_point.fields)">
                    <i class="las la-plus"></i>
                  </span>
                </div>
              </div>
            </div>
            <!-- Report -->
            <div class="col-12">
              <NLTextarea :name="'report'" label="Constat" :form="form" v-model="form.report"
                :placeholder="form.score == 1 || form.score == null && !form.major_fact ? '' : 'Ajouter votre constat'"
                :labelRequired="form.score > 1 || form.major_fact"
                :disabled="form.score == 1 || form.score == null && !form.major_fact" />
            </div>
            <!-- Media (attachements) -->
            <div class="col-12">
              <NLFile :name="'media'" label="Pièces jointes" attachableType="App\Models\MissionDetail"
                :attachableId="form.detail" v-model="form.media" :form="form" multiple />
            </div>
            <!-- Recovery plan -->
            <div class="col-12">
              <NLTextarea :name="'recovery_plan'" label="Plan de redressement" :form="form" v-model="form.recovery_plan"
                :placeholder="form.score == 1 || form.score == null && !form.major_fact ? '' : 'Ajouter votre plan de redressement'"
                :labelRequired="form.score > 1 || form.major_fact"
                :disabled="form.score == 1 || form.score == null && !form.major_fact" />
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-end align-center">
              <NLButton :loading="form.busy" label="Save" class="is-radius" v-if="!form.process_mode" />
              <NLButton :loading="form.busy" label="Validate" class="is-radius" v-else />
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
    return { title: 'Éxecution de la mission' }
  },
  data() {
    return {
      rowSelected: null,
      currentMetadata: {},
      isCompleted: false,
      process: null,
      details: [],
      modals: {
        show: false,
        edit: false,
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

    }
  },
  computed: {
    formErrorsCount() {
      return Object.entries(this.form.errors.all()).length
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
      // console.log(Object.keys(item.parsed_metadata));
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
      this.form.reset()
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
        console.log(this.process);
        this.modals.show = false
        this.modals.edit = false
      })
    },
    /**
     * Initialise le formulaire
     */
    initForm() {
      this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId, detailId: this.rowSelected?.id }).then(() => {
        const config = this.config.config
        this.rowSelected = config.detail
        this.form.process_mode = hasRole([ 'cc', 'cdcr' ])
        this.form.mission = this.$route.params.missionId
        this.form.process = this.$route.params.processId
        this.form.detail = config.detail.id
        this.form.media = config.detail.media.length ? config.detail.media.map(file => file.id) : []
        this.form.detail = config.detail.id
        this.form.report = config.detail.report
        this.form.recovery_plan = config.detail.recovery_plan
        this.form.score = config.detail.score
        this.form.major_fact = config.detail.major_fact ? true : false
        this.form.metadata = config.detail.metadata || []
        // this.form.process_mode = config.detail.form.process_mode
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
    create() {
      this.form.post('/api/missions/details/' + this.mission.id).then(response => {
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
  },
}
</script>
