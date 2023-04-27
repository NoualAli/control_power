<template>
  <div v-if="can('edit_domain')">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Familliies -->
          <div class="col-12 col-md-6">
            <NLSelect
              v-model="form.familly_id" :form="form" name="familly_id" label="Famille" :options="familliesList"
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
          <NLButton :loading="form.busy" label="Update" class="is-radius" />
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
      form: new Form({
        name: null,
        familly_id: null
      })
    }
  },
  computed: {
    ...mapGetters({
      domain: 'domains/current',
      famillies: 'famillies/all'
    })
  },
  created () {
    this.$store.dispatch('famillies/fetchAll').then(() => {
      this.familliesList = this.famillies.all
    })
    this.$store.dispatch('domains/fetch', { id: this.$route.params.domain }).then(() => {
      const data = this.domain.current
      console.log(data)
      this.form.fill(data)
    })
  },
  methods: {
    update () {
      this.form.put('/api/domains/' + this.$route.params.domain).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.$router.push({ name: 'domains-index' })
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
