<template>
  <ContentBody v-can="'control_agency'" v-if="!isCompleted">
    <Notification type="is-danger" v-if="form.errors.any()">
      Il y a {{ formErrorsCount }}
      {{ formErrorsCount > 1 ? 'problèmes avec vos entrées' : 'problème avec une entrée'}}.
    </Notification>
    <form @submit.prevent="create" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
      <div class="grid my-2 form-row" v-for="(detail, row) in details" :key="'detail-' + row">
        <div class="col-10">
          <h2 class="text-medium">{{ detail?.control_point.name }}</h2>
        </div>
        <div class="col-2">
          <NLSwitch v-model="form.rows[row].major_fact" :name="'rows.' + row + '.major_fact'" :form="form"
            label="Fait majeur" />
        </div>
        <div class="col-12">
          <NLSelect :name="'rows.' + row + '.score'" label="Notation" :form="form" v-model="form.rows[row].score"
            :options="setupScores(detail.control_point.scores)" labelRequired />
        </div>

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
                        <NLInput :form="form" :label="input.label" :placeholder="input.placeholder" :type="input.type"
                          :labelRequired="input.required"
                          :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                          v-model="form.rows[row].metadata[dataRow][index][input.name]"
                          :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                          v-if="isInput(input.type)" />

                        <NLTextarea :form="form" :label="input.label" :placeholder="input.placeholder"
                          :type="input.type" :labelRequired="input.required"
                          :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                          v-model="form.rows[row].metadata[dataRow][index][input.name]"
                          :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                          v-if="input.type == 'textarea'" :length="input.length" />

                        <NLWyswyg :form="form" :label="input.label" :placeholder="input.placeholder" :type="input.type"
                          :labelRequired="input.required"
                          :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                          v-model="form.rows[row].metadata[dataRow][index][input.name]"
                          :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                          v-if="input.type == 'wyswyg'" :length="input.length" />

                        <NLSelect :form="form" :label="input.label" :type="input.type" :labelRequired="input.required"
                          :name="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                          v-model="form.rows[row].metadata[dataRow][index][input.name]"
                          :id="'rows.' + row + '.metadata.' + dataRow + '.' + index + '.' + input.name"
                          :options="input.options" :placeholder="input.placeholder || 'Choisissez une option...'"
                          :multiple="input.multiple" v-if="input.type == 'select'" />
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
        <div class="col-12">
          <NLTextarea :name="'rows.' + row + '.report'" label="Constat" :form="form" v-model="form.rows[row].report"
            :placeholder="form.rows[row].score == 1 || form.rows[row].score == null ? '' : 'Ajouter votre constat'"
            :labelRequired="form.rows[row].score > 1"
            :disabled="form.rows[row].score == 1 || form.rows[row].score == null && !form.rows[row].major_fact" />
        </div>
        <div class="col-12">
          <NLTextarea :name="'rows.' + row + '.recovery_plan'" label="Plan de redressement" :form="form"
            v-model="form.rows[row].recovery_plan"
            :placeholder="form.rows[row].score == 1 || form.rows[row].score == null ? '' : 'Ajouter votre plan de redressement'"
            :labelRequired="form.rows[row].score > 1"
            :disabled="form.rows[row].score == 1 || form.rows[row].score == null && !form.rows[row].major_fact" />
        </div>
        <div class="col-12">
          <NLFile :name="'rows.' + row + '.media'" label="Pièces jointes" attachableType="App\Models\MissionDetail"
            :attachableId="form.rows[row].detail" v-model="form.rows[row].media" :form="form" multiple />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="d-flex justify-end align-center">
        <NLButton :loading="form.busy" label="Save" class="is-radius" />
      </div>
    </form>
  </ContentBody>
  <div v-can="'view_mission_detail'" v-else>
    <ContentHeader>
      <template #actions>
        <button v-can="'edit_mission,control_agency'" class="btn btn-warning my-6" @click="switchToExeMode()">
          <i class="las la-pen"></i>
        </button>
      </template>
    </ContentHeader>
    <ContentBody>
      <div class="grid">
        <div class="col-12" v-for="detail in details" :key="detail.id">
          <div class="box">
            <div class="grid gap-4">
              <div class="col-12">
                <div class="tags">
                  <span class="tag is-info">{{ detail.familly.name }}</span>
                  <span class="tag">{{ detail.domain.name }}</span>
                  <span class="tag is-warning">{{ detail.process.name }}</span>
                </div>
              </div>

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
                <button class="btn btn-info has-icon" @click="show(detail)">
                  <i class="las la-eye icon"></i>
                  Voir plus
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <NLModal :show="rowSelected" @close="close">
        <template v-slot:title>
          <small class="tag is-info text-small">
            {{ rowSelected?.familly.name }}
          </small>
          <small class="tag is-primary-dark text-small mx-1">
            {{ rowSelected?.domain.name }}
          </small>
          <small class="tag is-warning text-small">
            {{ rowSelected?.process.name }}
          </small>
        </template>
        <template v-slot>
          <p class="text-bold mb-6">
            {{ rowSelected?.control_point.name }}
          </p>
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
                        <td class="text-left" v-for="(items, index) in data"
                          :key="'metadata-row-' + row + '-item-' + index">
                          <span v-for="(item, key) in items"
                            :key="'metadata-row-' + row + '-item-' + index + '-content'"
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
          </div>
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
      details: [],
      process: null,
      mission: null,
      form: new Form({
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
     * Affiche les détails du point de contrôle
     */
    show(item) {
      this.rowSelected = item
      this.currentMetadata.keys = Object.keys(item.parsed_metadata)
    },
    /**
     * Ferme la boite modal des détails du point de contrôle
     */
    close() {
      this.rowSelected = null
    },
    /**
     * Bascule vers le mode d'exécution
     */
    switchToExeMode() {
      this.isCompleted = false
      this.initData(false)
      this.initForm()
    },
    /**
     * Initialise les données
     */
    initData(isCompleted = true) {
      this.$store.dispatch('details/fetchConfig', { missionId: this.$route.params.missionId, processId: this.$route.params.processId }).then(() => {
        this.details = this.config.config.details
        this.mission = this.config.config.mission
        this.process = this.config.config.process
        if (this.details[ 0 ].executed_at !== null) {
          this.isCompleted = isCompleted
        } else {
          this.initForm()
        }
      })
    },
    /**
     * Initialise le formulaire
     */
    initForm() {
      this.details.forEach(detail => {
        this.form.rows.push({
          media: detail.media.length ? detail.media.map(file => file.id) : [],
          detail: detail.id,
          report: detail.report,
          recovery_plan: detail.recovery_plan,
          score: detail.score,
          major_fact: detail.major_fact ? true : false,
          metadata: detail.metadata || [],
        })
      })
    },
    /**
     * Initialise les champs supplémentaire pour chaque point de contrôle
     *
     * @param {Array} fields
     */
    setupFields(fields) {
      return fields.map(field => {
        return {
          type: field[ 0 ].type,
          label: field[ 1 ].label,
          name: field[ 2 ].name,
          length: field[ 3 ].length,
          style: field[ 4 ].style,
          id: field[ 5 ].id,
          placeholder: field[ 6 ].placeholder,
          help_text: field[ 7 ].help_text,
          rules: field[ 8 ].rules,
        }
      })
    },
    /**
     * Initialise les notations pour chaque point de contrôle
     *
     * @param {Array|null} scores
     */
    setupScores(scores) {
      if (typeof scores == 'object') {
        return scores.map(score => {
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
