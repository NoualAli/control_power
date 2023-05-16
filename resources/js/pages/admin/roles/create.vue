<template>
  <div v-if="can('create_role')">
    <ContentHeader title="Ajouter un nouveau rôle" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput v-model="form.name" :form="form" name="name" label="Name" label-required />
          </div>
          <!-- Code -->
          <div class="col-12 col-md-6">
            <NLInput v-model="form.code" :form="form" name="code" label="Code" label-required />
          </div>

          <!-- Permissions -->
          <div class="col-12 col-md-6">
            <NLSelect v-model="form.permissions" :form="form" name="permissions" label="Permissions"
              :options="permissionsList" :multiple="true" label-required />
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
export default {
  layout: 'MainLayout',
  middleware: [ 'auth', 'admin' ],
  data() {
    return {
      permissionsList: [],
      form: new Form({
        name: '',
        code: '',
        permissions: []
      })
    }
  },
  computed: {
    ...mapGetters({
      permissions: 'permissions/all'
    })
  },
  created() {
    this.$store.dispatch('permissions/fetchAll').then(() => {
      this.permissions.all.forEach(permission => {
        permission = {
          id: permission.id,
          label: permission.name
        }
        this.permissionsList.push(permission)
      })
    })
  },

  methods: {
    create() {
      this.form.post('/api/roles').then(response => {
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
