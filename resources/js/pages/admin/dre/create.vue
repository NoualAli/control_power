<template>
  <div v-if="can('create_dre')">
    <ContentHeader title="Ajouter une nouvelle DRE" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Code -->
          <div class="col-12 col-md-6">
            <NLInput type="number" :form="form" name="code" label="Code" v-model="form.code" labelRequired />
          </div>
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput :form="form" name="name" label="Name" v-model="form.name" labelRequired />
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
import { Form } from 'vform';
export default {
  middleware: [ 'auth', 'admin' ],
  layout: 'backend',
  data() {
    return {
      form: new Form({
        name: '',
        code: '',
      }),
    }
  },
  methods: {
    create() {
      this.form.post('/api/dre').then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.form.reset()
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
