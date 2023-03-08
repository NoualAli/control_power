<template>
  <div v-if="can('edit_dre')">
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
      dre: 'dre/current'
    }),
  },
  created() {
    this.$store.dispatch('dre/fetch', this.$route.params.dre).then(() => {
      const data = this.dre.current
      this.form.fill(data)
    })
  },
  data() {
    return {
      form: new Form({
        name: '',
        code: '',
      }),
    }
  },
  methods: {
    update() {
      this.form.put('/api/dre/' + this.$route.params.dre).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.$router.push({ name: 'dre-index' })
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
