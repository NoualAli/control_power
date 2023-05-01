<template>
  <div v-if="can('edit_familly')">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
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
  computed: {
    ...mapGetters({
      familly: 'famillies/current'
    })
  },
  created () {
    this.$store.dispatch('famillies/fetch', { id: this.$route.params.familly }).then(() => {
      const data = this.familly.current
      this.form.fill(data)
    })
  },
  data () {
    return {
      form: new Form({
        name: '',
        code: ''
      })
    }
  },
  methods: {
    update () {
      this.form.put('/api/famillies/' + this.$route.params.familly).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.$router.push({ name: 'famillies-index' })
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
