<template>
  <div v-can="'create_control_point'">
    <ContentHeader title="Ajouter une nouveau point de contrôle" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Familliies -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="familly_id" v-model="form.familly_id" label="Famille" :options="familliesList"
              labelRequired :multiple="false" />
          </div>
          <!-- Domains -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="domain_id" v-model="form.domain_id" label="Domaine" :options="domainsList"
              labelRequired :multiple="false" />
          </div>
          <!-- Processes -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="process_id" v-model="form.process_id" label="Processus" :options="processesList"
              labelRequired :multiple="false" />
          </div>
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput :form="form" name="name" label="Name" v-model="form.name" labelRequired />
          </div>
          <!-- Major fact -->
          <div class="col-12">
            <NLSwitch v-model="form.has_major_fact" name="has_major_fact" :form="form" label="Fait majeur" />
          </div>
          <!-- Major fact types -->
          <div class="col-12" v-if="form.has_major_fact">
            <NLRepeater name="major_fact_types" :rowSchema="majorFactTypesSchema" :form="form"
              title="Types des faits majeur" addButtonLabel="Ajouter un type">
            </NLRepeater>
          </div>
          <!-- Scores -->
          <div class="col-12">
            <NLRepeater name="scores" :rowSchema="scoresSchema" :form="form" title="Notation"
              addButtonLabel="Ajouter une notation">
            </NLRepeater>
          </div>
          <!-- Fields -->
          <div class="col-12">
            <NLRepeater name="fields" :rowSchema="fieldsSchema" :form="form" title="Metadata"
              addButtonLabel="Ajouter un champs">
            </NLRepeater>
          </div>
        </div>
        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="form.busy" label="Add" class="is-radius" />
        </div>
      </form>
    </ContentBody>
  </div>
</template>

<script>
import NLRepeater from '../../../components/Inputs/NLRepeater'
import { Form } from 'vform';
import { mapGetters } from 'vuex'
export default {
  middleware: [ 'auth', 'admin' ],
  layout: 'backend',
  components: {
    NLRepeater
  },
  computed: {
    ...mapGetters({
      famillies: 'famillies/all',
      familly: 'famillies/domains',
      domain: 'domains/processes',
      validationRules: 'settings/validationRules'
    }),
  },
  watch: {
    "form.familly_id": function (newVal, oldVal) {
      if (newVal !== oldVal) { this.loadDomains(newVal) }
    },
    "form.domain_id": function (newVal, oldVal) {
      if (newVal !== oldVal) { this.loadProcesses(newVal) }
    },
  },
  data() {
    return {
      familliesList: [],
      domainsList: [],
      processesList: [],
      validationRulesList: [],
      majorFactTypesSchema: [
        {
          type: 'text',
          label: 'Type',
          name: 'type',
          placeholder: 'Veuillez saisir le type',
          required: true,
          style: 'col-12'
        },
      ],
      scoresSchema: [
        {
          type: 'number',
          label: 'Note',
          name: 'score',
          placeholder: 'Veuillez saisir la note',
          required: true,
          style: 'col-12 col-lg-6'
        },
        {
          type: 'text',
          label: 'Label',
          name: 'label',
          placeholder: 'Veuillez saisir le label à afficher',
          required: true,
          style: 'col-12 col-lg-6'
        },
      ],
      fieldsSchema: [
        {
          type: 'select',
          label: 'Type',
          name: 'type',
          required: true,
          style: 'col-12 col-lg-3',
          placeholder: "Veuillez choisir un type",
          options: [
            {
              id: 'text',
              label: 'Text'
            },
            {
              id: 'textarea',
              label: 'Textarea'
            },
            {
              id: 'number',
              label: 'Number'
            },
            {
              id: 'select',
              label: 'Select'
            },
            {
              id: 'date',
              label: 'Date'
            },
            {
              id: 'datetime',
              label: 'DateTime'
            },
            {
              id: 'month',
              label: 'Month'
            },
            {
              id: 'week',
              label: 'Week'
            },
            {
              id: 'time',
              label: 'Time'
            },
            {
              id: 'email',
              label: 'Email'
            },
            {
              id: 'tel',
              label: 'Tel'
            },
          ]
        },
        {
          type: 'text',
          label: 'Label',
          name: 'label',
          placeholder: 'Veuillez saisir le label du champs',
          required: true,
          style: 'col-12 col-lg-3'
        },
        {
          type: 'text',
          label: 'Nom',
          name: 'name',
          placeholder: 'Veuillez saisir le nom du champs dans la base de données',
          required: true,
          style: 'col-12 col-lg-3'
        },
        {
          type: 'number',
          label: 'Taille',
          name: 'length',
          placeholder: 'Veuillez saisir la taille du champs dans la base de données',
          required: true,
          default: 255,
          style: 'col-12 col-lg-3'
        },
        {
          type: 'select',
          label: 'Nombre de colonnes',
          name: 'style',
          required: true,
          style: 'col-12 col-lg-3',
          placeholder: "Veuillez choisir le nombre de colonne",
          options: [
            {
              id: 'col-12 col-lg-1',
              label: '1'
            },
            {
              id: 'col-12 col-lg-2',
              label: '2'
            },
            {
              id: 'col-12 col-lg-3',
              label: '3'
            },
            {
              id: 'col-12 col-lg-4',
              label: '4'
            },
            {
              id: 'col-12 col-lg-5',
              label: '5'
            },
            {
              id: 'col-12 col-lg-6',
              label: '6'
            },
            {
              id: 'col-12 col-lg-7',
              label: '7'
            },
            {
              id: 'col-12 col-lg-8',
              label: '8'
            },
            {
              id: 'col-12 col-lg-9',
              label: '9'
            },
            {
              id: 'col-12 col-lg-10',
              label: '10'
            },
            {
              id: 'col-12 col-lg-11',
              label: '11'
            },
            {
              id: 'col-12 col-lg-12',
              label: '12'
            },
          ]
        },
        {
          type: 'text',
          label: 'Identifiant',
          name: 'id',
          placeholder: 'Veuillez saisir l\'identifiant du champs',
          style: 'col-12 col-lg-3'
        },
        {
          type: 'text',
          label: 'Placeholder',
          name: 'placeholder',
          placeholder: 'Veuillez saisir le placeholder du champs',
          style: 'col-12 col-lg-3'
        },
        {
          type: 'text',
          label: 'Texte d\'aide',
          name: 'help_text',
          placeholder: 'Veuillez saisir le texte d\'aide du champs',
          style: 'col-12 col-lg-3'
        },
        {
          type: 'select',
          label: 'Règles de validation',
          name: 'rules',
          required: true,
          style: 'col-12',
          multiple: true,
          placeholder: "Veuillez choisir une ou plusieurs règles de validation",
        },
      ],
      form: new Form({
        name: null,
        familly_id: null,
        domain_id: null,
        process_id: null,
        scores: [],
        fields: [],
        major_fact_types: [],
        has_major_fact: false,
      }),
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
      this.domainsList = []
      this.processesList = []
      this.loadFamillies()
      this.loadValidationRules()
    },
    /**
     * Récupère la liste des familles
     */
    loadFamillies() {
      this.$store.dispatch('famillies/fetchAll', { withChildren: false }).then(() => {
        this.familliesList = this.famillies.all
      })
    },
    /**
     * Récupère la liste des domains
     * @param {*} value
     */
    loadDomains(value) {
      if (value) {
        this.$store.dispatch('famillies/fetch', { id: value, onlyDomains: true }).then(() => {
          this.domainsList = this.familly.domains
        })
      } else {
        this.domainsList = []
      }
    },
    /**
     * Récupère la liste des processus
     * @param {*} value
     */
    loadProcesses(value) {
      if (value) {
        this.$store.dispatch('domains/fetch', { id: value, onlyProcesses: true }).then(() => {
          this.processesList = this.domain.processes
        })
      } else {
        this.processesList = []
      }
    },
    /**
     * Récupère la liste des règles de validation
     */
    loadValidationRules() {
      this.$store.dispatch('settings/fetchValidationRules').then(() => {
        this.validationRulesList = this.validationRules.validationRules
        this.fieldsSchema[ this.fieldsSchema.length - 1 ].options = this.validationRulesList
      })
    },
    /**
     * Ajout un nouveau point de contrôle
     */
    create() {
      this.form.post('/api/control-points').then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.form.reset()
          this.initData()
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })
    }
  }
}
</script>
