<template>
  <div v-can="'edit_agency'">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
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
      agency: 'agencies/current',
      dre: 'dre/all'
    }),
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
    this.$store.dispatch('agencies/fetch', this.$route.params.agency).then(() => {
      const data = this.agency.current
      this.form.fill(data)
    })
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
  methods: {
    update() {
      this.form.put('/api/agencies/' + this.$route.params.agency).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.$router.push({ name: 'agencies-index' })
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
