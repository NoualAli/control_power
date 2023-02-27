<template>
  <div v-can="'edit_permission'">
    <ContentBody>
      <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput :form="form" name="name" label="Name" v-model="form.name" labelRequired />
          </div>

          <!-- Rôles -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="roles" v-model="form.roles" label="Rôles" :options="rolesList" :multiple="true"
              labelRequired />
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
      permission: 'permissions/current',
      roles: 'roles/all'
    }),
  },
  created() {
    this.$store.dispatch('roles/fetchAll').then(() => {
      this.rolesList = this.roles.all;
    })
    this.$store.dispatch('permissions/fetch', this.$route.params.permission).then(() => {
      const data = this.permission.current
      this.form.fill(data)
      this.form.roles = this.permission.current.roles.map(item => item.id)
    })
  },
  data() {
    return {
      rolesList: [],
      form: new Form({
        name: '',
        roles: [],
      }),
    }
  },
  methods: {
    update() {
      this.form.put('/api/permissions/' + this.$route.params.permission).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.$router.push({ name: 'permissions-index' })
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
