<template>
  <div v-can="'create_domain'">
    <ContentHeader title="Ajouter un nouveau domaine" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Familliies -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="familly_id" v-model="form.familly_id" label="Famille" :options="familliesList"
              labelRequired :multiple="false" />
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
import { mapGetters } from 'vuex'
export default {
  middleware: [ 'auth', 'admin' ],
  layout: 'backend',
  computed: {
    ...mapGetters({
      famillies: 'famillies/all'
    }),
  },
  data() {
    return {
      familliesList: [],
      form: new Form({
        name: null,
        familly_id: null,
      }),
    }
  },
  created() {
    this.$store.dispatch('famillies/fetchAll').then(() => {
      this.familliesList = this.famillies.all
    })
  },
  methods: {
    create() {
      this.form.post('/api/domains').then(response => {
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
