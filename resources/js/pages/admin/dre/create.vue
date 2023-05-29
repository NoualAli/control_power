<template>
  <div v-if="can('create_dre')">
    <ContentHeader title="Ajouter une nouvelle DRE" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Code -->
          <div class="col-12 col-md-6">
            <NLInput v-model="form.code" type="number" :form="form" name="code" label="Code" label-required />
          </div>
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput v-model="form.name" :form="form" name="name" label="Name" label-required />
          </div>
        </div>
        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="form.busy" label="Ajouter" class="is-radius" />
        </div>
      </form>
    </ContentBody>
  </div>
</template>

<script>
import { Form } from 'vform'
export default {
  layout: 'MainLayout',
  middleware: [ 'auth', 'admin' ],
  data() {
    return {
      form: new Form({
        name: '',
        code: ''
      })
    }
  },
  methods: {
    create() {
      this.form.post('/api/dre').then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.form.reset()
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
