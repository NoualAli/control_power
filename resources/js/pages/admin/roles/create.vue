<template>
  <div v-if="can('create_role')">
    <ContentHeader title="Ajouter un nouveau rôle" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Name -->
          <div class="col-12 col-md-6">
            <NLInput :form="form" name="name" label="Name" v-model="form.name" labelRequired />
          </div>
          <!-- Code -->
          <div class="col-12 col-md-6">
            <NLInput :form="form" name="code" label="Code" v-model="form.code" labelRequired />
          </div>

          <!-- Permissions -->
          <div class="col-12 col-md-6">
            <NLSelect :form="form" name="permissions" v-model="form.permissions" label="Permissions"
              :options="permissionsList" :multiple="true" labelRequired />
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
      permissions: 'permissions/all'
    }),
  },
  created() {
    this.$store.dispatch('permissions/fetchAll').then(() => {
      this.permissions.all.forEach(permission => {
        permission = {
          'id': permission.id,
          'label': permission.name
        }
        this.permissionsList.push(permission);
      });
    })
  },
  data() {
    return {
      permissionsList: [],
      form: new Form({
        name: '',
        code: '',
        permissions: [],
      }),
    }
  },
  methods: {
    create() {
      this.form.post('/api/roles').then(response => {
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
