<template>
  <div v-if="can('edit_role')">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
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
            <NLSelect
              v-model="form.permissions" :form="form" name="permissions" label="Permissions"
              :options="permissionsList" :multiple="true" label-required
            />
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
      permissions: 'permissions/all',
      role: 'roles/current'
    })
  },
  created () {
    this.$store.dispatch('permissions/fetchAll').then(() => {
      this.permissions.all.forEach(permission => {
        permission = {
          id: permission.id,
          label: permission.name
        }
        this.permissionsList.push(permission)
      })
    })
    this.$store.dispatch('roles/fetch', this.$route.params.role).then(() => {
      const data = this.role.current
      this.form.fill(data)
      this.form.permissions = this.role.current.permissions.map(item => item.id)
    })
  },
  data () {
    return {
      permissionsList: [],
      form: new Form({
        name: '',
        code: '',
        permissions: []
      })
    }
  },
  methods: {
    update () {
      this.form.put('/api/roles/' + this.$route.params.role).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.$router.push({ name: 'roles-index' })
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
