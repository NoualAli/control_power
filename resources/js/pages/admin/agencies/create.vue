<template>
  <div v-can="'create_agency'">
    <ContentHeader title="Ajouter une nouvelle agence" />
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
          <!-- Dre -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="dre_id" v-model="form.dre_id" label="Dre" :options="dresList" labelRequired
              :multiple="false" />
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
      dre: 'dre/all'
    }),
  },
  data() {
    return {
      dresList: [],
      form: new Form({
        name: null,
        code: null,
        dre_id: null,
      }),
    }
  },
  created() {
    this.$store.dispatch('dre/fetchAll').then(() => {
      this.dre.all.forEach(dre => {
        dre = {
          'id': dre.id,
          'label': dre.full_name
        }
        this.dresList.push(dre);
      });
    })
  },
  methods: {
    create() {
      this.form.post('/api/agencies').then(response => {
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
