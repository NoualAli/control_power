<template>
  <div v-if="can('edit_dre')">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
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
      dre: 'dre/current'
    })
  },
  created () {
    this.$store.dispatch('dre/fetch', this.$route.params.dre).then(() => {
      const data = this.dre.current
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
      this.form.put('/api/dre/' + this.$route.params.dre).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.$router.push({ name: 'dre-index' })
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
