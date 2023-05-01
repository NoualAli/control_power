<template>
  <div v-if="can('edit_process')">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
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
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput :form="form" name="name" label="Name" v-model="form.name" labelRequired />
          </div>
        </div>
        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="form.busy" label="Update" class="is-radius" />
        </div>
      </form>
    </ContentBody>
  </div>
</template>

<script>
import { Form } from 'vform';
import { mapGetters } from 'vuex'
export default {
  middleware: [ 'auth', 'admin' ],
  layout: 'backend',
  computed: {
    ...mapGetters({
      process: 'processes/current',
      familly: 'famillies/domains',
      famillies: 'famillies/all',
    }),
  },
  watch: {
    "form.familly_id": function (newVal, oldVal) {
      if (newVal !== oldVal) { this.loadDomains(newVal) }
    },
  },
  created() {
    this.initData()
  },
  data() {
    return {
      familliesList: [],
      domainsList: [],
      form: new Form({
        name: null,
        familly_id: null,
        domain_id: null,
      }),
    }
  },
  methods: {
    initData() {
      this.$store.dispatch('processes/fetch', { id: this.$route.params.process }).then(() => {
        this.$store.dispatch('famillies/fetchAll', false).then(() => {
          this.familliesList = this.famillies.all
          this.loadDomains(this.form.familly_id)
        })
        this.form.name = this.process.current.name
        this.form.familly_id = this.process.current.familly.id
        this.form.domain_id = this.process.current.domain_id
      })
    },
    loadDomains(value) {
      if (value) {
        this.$store.dispatch('famillies/fetch', { id: value, onlyDomains: true }).then(() => {
          this.domainsList = this.familly.domains
        })
      } else {
        this.domainsList = []
      }
    },
    update() {
      this.form.put('/api/processes/' + this.$route.params.process).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.$router.push({ name: 'processes-index' })
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
