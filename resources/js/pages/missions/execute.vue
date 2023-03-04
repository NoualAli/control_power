<template>
  <ContentBody v-can="'control_agency,create_dre_report,validate_dre_report'">
    <div class="container">
      <div class="grid">
        <div class="col-1"></div>
        <div class="col-11">
          <h2>
            {{ process?.familly?.name }} / {{ process?.domain?.name }} / {{ process?.name }}
          </h2>
        </div>
        <div class="col-1">
        </div>
        <div class="col-11">
          <Notification type="is-danger" v-if="form.errors.any()">
            Il y a {{ formErrorsCount }}
            {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée' }}.
          </Notification>
        </div>
      </div>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
        <div class="form-row" v-for="(detail, row) in details" :key="'detail-' + row">
          <div class="grid my-2">
            <div class="col-1"></div>
            <div class="col-11">
              <div class="control-point">
                {{ detail?.control_point.name }}
              </div>
            </div>
            <div class="col-1"></div>
            <div class="col-12 col-lg-8 grid">
              <!-- Major fact -->
              <div class="col-12" v-if="detail?.control_point.has_major_fact">
                <NLSwitch v-model="form.rows[row].major_fact" :name="'rows.' + row + '.major_fact'" :form="form"
                  label="Fait majeur" />
              </div>
              <div class="col-12">
                <NLSelect :name="'rows.' + row + '.score'" label="Notation" :form="form" v-model="form.rows[row].score"
                  :options="setupScores(detail.control_point.scores)" labelRequired />
              </div>

              <!-- Metadata -->
              <div class="col-12" v-if="detail.control_point.fields && form.rows[row].score > 1">
                <div class="repeater">
                  <h2 class="mb-6">Informations supplémentaires</h2>
                  <!-- Repeater row -->
                  <div class="grid my-6 repeater-row" v-for="(item, dataRow) in form.rows[row].metadata"
                    :key="'metadata-' + dataRow + 'row-' + row">
                    <div class="col-12">
                      <div class="grid gap-2">
                        <div class="col-11">
                          <div class="grid">
                            <div :key="'metadata-input-' + input.name + '-' + dataRow + '-id'" :class="input.style"
                              v-for="(input, index) in setupFields(detail.control_point.fields)">
                              <!-- Defining different inputs -->
                              <NLInput :form="form" :label="input.label" :placeholder="input.placeholder"
                                :type="input.type" :labelRequired="input.required"
                                :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                v-model="form.rows[row].metadata[dataRow][index][input.name]"
                                :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                v-if="isInput(input.type)" :helpText="input.help_text" />

                              <NLTextarea :form="form" :label="input.label" :placeholder="input.placeholder"
                                :type="input.type" :labelRequired="input.required"
                                :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                v-model="form.rows[row].metadata[dataRow][index][input.name]"
                                :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                v-if="input.type == 'textarea'" :length="input.length" :helpText="input.help_text" />

                              <NLWyswyg :form="form" :label="input.label" :placeholder="input.placeholder"
                                :type="input.type" :labelRequired="input.required"
                                :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                v-model="form.rows[row].metadata[dataRow][index][input.name]"
                                :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                v-if="input.type == 'wyswyg'" :length="input.length" :helpText="input.help_text" />

                              <NLSelect :form="form" :label="input.label" :type="input.type"
                                :labelRequired="input.required"
                                :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                v-model="form.rows[row].metadata[dataRow][index][input.name]"
                                :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                                :options="input.options" :placeholder="input.placeholder || 'Choisissez une option...'"
                                :multiple="input.multiple" v-if="input.type == 'select'" :helpText="input.help_text" />
                            </div>
                          </div>
                        </div>
                        <!-- Remove current row -->
                        <div class="col-1 p-0 d-flex justify-start align-center" v-if="row >= 0">
                          <div class="btn btn-danger" @click="removeRow(row, dataRow)">
                            Supprimer
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Add new row -->
                  <div class="d-flex justify-start align-center">
                    <span class="btn" @click="addRow(row, detail.control_point.fields)">
                      <i class="las la-plus"></i>
                    </span>
                  </div>
                </div>
              </div>
              <!-- Report -->
              <div class="col-12">
                <NLTextarea :name="'rows.' + row + '.report'" label="Constat" :form="form" v-model="form.rows[row].report"
                  :placeholder="form.rows[row].score == 1 || form.rows[row].score == null && !form.rows[row].major_fact ? '' : 'Ajouter votre constat'"
                  :labelRequired="form.rows[row].score > 1 || form.rows[row].major_fact"
                  :disabled="form.rows[row].score == 1 || form.rows[row].score == null && !form.rows[row].major_fact" />
              </div>
              <!-- Recovery plan -->
              <div class="col-12">
                <NLTextarea :name="'rows.' + row + '.recovery_plan'" label="Plan de redressement" :form="form"
                  v-model="form.rows[row].recovery_plan"
                  :placeholder="form.rows[row].score == 1 || form.rows[row].score == null && !form.rows[row].major_fact ? '' : 'Ajouter votre plan de redressement'"
                  :labelRequired="form.rows[row].score > 1 || form.rows[row].major_fact"
                  :disabled="form.rows[row].score == 1 || form.rows[row].score == null && !form.rows[row].major_fact" />
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <!-- Media (attachements) -->
              <NLFile :name="'rows.' + row + '.media'" label="Pièces jointes" attachableType="App\Models\MissionDetail"
                :attachableId="form.rows[row].detail" v-model="form.rows[row].media" :form="form" multiple />
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="form.busy" label="Save" class="is-radius" v-if="!this.form.process_mode" />
          <NLButton :loading="form.busy" label="Validate" class="is-radius" v-else />
        </div>
      </form>
    </div>
  </ContentBody>
</template>

<script>
import ContentHeader from '../../components/ContentHeader'
import ContentBody from '../../components/ContentBody'
import { mapGetters } from 'vuex'
import Form from 'vform'
import Notification from '../../components/Notification'
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
      details: [],
      process: null,
      form: new Form({
        process_mode: false,
        mission: null,
        process: null,
        rows: []
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
     * Initialise les données
     */
    initData() {
      this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId }).then(() => {
        this.details = this.config.config.details
        this.process = this.config.config.process
        this.initForm()
      })
    },
    /**
     * Initialise le formulaire
     */
    initForm() {
      this.form.mission = this.$route.params.processId
      this.form.process = this.$route.params.processId
      this.details.forEach(detail => {
        this.form.rows.push({
          media: detail.media.length ? detail.media.map(file => file.id) : [],
          detail: detail.id,
          report: detail.report,
          recovery_plan: detail.recovery_plan,
          score: detail.score,
          major_fact: detail.major_fact ? true : false,
          major_fact_type: detail.major_fact_type ? detail.major_fact_type : [],
          metadata: detail.metadata || [],
          process_mode: this.form.process_mode
        })
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
 * Initialise les notations pour chaque point de contrôle
 *
 * @param {Array|null} majorFactTypes
 */
    setupMajorFactTypes(majorFactTypes) {
      if (typeof majorFactTypes == 'object') {
        return majorFactTypes?.map(type => {
          return {
            id: type[ 0 ].type,
            label: type[ 0 ].type,
          }
        })
      }
      return []

    },
    /**
     * Création de la mission
     */
    create() {
      this.form.post('/api/missions/details/' + this.$route.params.missionId).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.$router.push({ name: 'mission', params: { missionId: this.$route.params.missionId } })
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
     * @param {Number} row Index de la ligne
     * @param {Number} fields Index du champs
     */
    addRow(row, fields) {
      fields = this.setupFields(fields)
      const schema = []
      for (let index = 0; index < fields.length; index++) {
        const element = fields[ index ];
        const name = element.name
        let defaultValue = element.default !== undefined ? element.default : ''
        defaultValue = element.multiple ? [] : ''
        schema.push({ [ name ]: defaultValue, label: element.label, rules: element.rules })
      }
      if (this.form.rows[ row ][ 'metadata' ]) this.form.rows[ row ].metadata.push(schema)
    },
    /**
     * Supprimer une ligne du répéteur
     *
     * @param {Number} row
     * @param {Number} field
     */
    removeRow(row, field) {
      this.form[ 'rows' ][ row ][ 'metadata' ].splice(field, 1)
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
