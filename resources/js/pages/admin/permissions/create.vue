<template>
  <div v-if="can('create_permission')">
    <ContentHeader title="Ajouter une nouvelle permission" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput v-model="form.name" :form="form" name="name" label="Name" label-required />
          </div>

          <!-- Rôles -->
          <div class="col-12 col-md-6">
            <NLSelect
              v-model="form.roles" :form="form" name="roles" label="Rôles" :options="rolesList" :multiple="true"
              label-required
            />
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
import { Form } from 'vform'
import { mapGetters } from 'vuex'
import * as swal from '~/plugins/swal'

export default {
  layout: 'backend',
  middleware: ['auth', 'admin'],
  data () {
    return {
      rolesList: [],
      form: new Form({
        name: '',
        roles: []
      })
    }
  },
  computed: {
    ...mapGetters({
      roles: 'roles/all'
    })
  },
  created () {
    this.$store.dispatch('roles/fetchAll').then(() => {
      this.rolesList = this.roles.all
    })
  },

  methods: {
    create () {
      this.form.post('/api/permissions').then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.form.reset()
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>
