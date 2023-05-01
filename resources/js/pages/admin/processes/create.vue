<template>
  <div v-if="can('create_process')">
    <ContentHeader title="Ajouter un nouveau processus" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Familliies -->
          <div class="col-12 col-md-6">
            <NLSelect
              v-model="form.familly_id" :form="form" name="familly_id" label="Famille" :options="familliesList"
              label-required :multiple="false"
            />
          </div>
          <!-- Domains -->
          <div class="col-12 col-md-6">
            <NLSelect
              v-model="form.domain_id" :form="form" name="domain_id" label="Domaine" :options="domainsList"
              label-required :multiple="false"
            />
          </div>
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput v-model="form.name" :form="form" name="name" label="Name" label-required />
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
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
  layout: 'backend',
  middleware: ['auth', 'admin'],
  data () {
    return {
      familliesList: [],
      domainsList: [],
      form: new Form({
        name: null,
        familly_id: null,
        domain_id: null
      })
    }
  },
  computed: {
    ...mapGetters({
      famillies: 'famillies/all',
      familly: 'famillies/domains'
    })
  },
  watch: {
    'form.familly_id': function (newVal, oldVal) {
      if (newVal !== oldVal) { this.loadDomains(newVal) }
    }
  },

  created () {
    this.initData()
  },
  methods: {
    initData () {
      this.$store.dispatch('famillies/fetchAll', false).then(() => {
        this.familliesList = this.famillies.all
      })
    },
    loadDomains (value) {
      if (value) {
        this.$store.dispatch('famillies/fetch', { id: value, onlyDomains: true }).then(() => {
          this.domainsList = this.familly.domains
        })
      } else {
        this.domainsList = []
      }
    },
    create () {
      this.form.post('/api/processes').then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          // this.form.reset()
          this.form.name = null
        } else {
          this.$swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>
