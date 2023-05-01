<template>
  <div v-if="can('edit_domain')">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
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
      domain: 'domains/current',
      famillies: 'famillies/all'
    }),
  },
  created() {
    this.$store.dispatch('famillies/fetchAll', false).then(() => {
      this.familliesList = this.famillies.all
    })
    this.$store.dispatch('domains/fetch', { id: this.$route.params.domain }).then(() => {
      const data = this.domain.current
      this.form.fill(data)
    })
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
  methods: {
    update() {
      this.form.put('/api/domains/' + this.$route.params.domain).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.$router.push({ name: 'domains-index' })
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
