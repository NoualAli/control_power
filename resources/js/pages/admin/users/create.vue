<template>
  <div v-can="'create_user'">
    <ContentHeader title="Ajouter un utilisateur" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Firstname -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="firstname" label="firstname" v-model="form.first_name" />
          </div>

          <!-- Lastname -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="last_name" label="lastname" v-model="form.last_name" />
          </div>

          <!-- Username -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="username" label="username" v-model="form.username" labelRequired />
          </div>

          <!-- Email -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="email" label="email" v-model="form.email" labelRequired type="email" />
          </div>

          <!-- Phone -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="phone" label="phone" v-model="form.phone" type="phone" />
          </div>

          <!-- Dres -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLSelect :form="form" name="dres" label="Dre" :options="dresList" v-model="form.dres" :multiple="true" />
          </div>

          <!-- Role -->
          <div class="col-12">
            <NLSelect :form="form" name="roles" label="Rôles" :options="rolesList" v-model="form.roles"
              :multiple="true" />
          </div>

          <!-- Password -->
          <div class="col-12 col-lg-4">
            <NLInput :form="form" v-model="form.password" label="Password" name="password" type="password"
              labelRequired />
          </div>
          <!-- Password Confirmation -->
          <div class="col-12 col-lg-4">
            <NLInput :form="form" v-model="form.password_confirmation" label="confirm_password"
              name="password_confirmation" type="password" labelRequired />
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
import { mapGetters } from 'vuex';
export default {
  middleware: [ 'auth', 'admin' ],
  layout: 'backend',
  data() {
    return {
      form: new Form({
        username: null,
        email: null,
        first_name: null,
        last_name: null,
        gender: null,
        password: null,
        password_confirmation: null,
        roles: [],
        dres: [],
      }),
      dresList: [],
      rolesList: [],
    }
  },
  computed: mapGetters({
    roles: 'roles/all',
    dres: 'dre/all'
  }),
  created() {
    this.$store.dispatch('roles/fetchAll').then(() => {
      this.roles.all.forEach(role => {
        role = {
          'id': role.id,
          'label': role.name
        }
        this.rolesList.push(role);
      });
    })
    this.$store.dispatch('dre/fetchAll').then(() => {
      this.dres.all.forEach(dre => {
        dre = {
          'id': dre.id,
          'label': dre.name
        }
        this.dresList.push(dre);
      });
    })
  },
  methods: {
    create() {
      this.form.post('/api/users').then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.form.reset()
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })
    },
    getPlaceholder(id) {
      if (id) {
        let placeholder = null
        placeholder = this.dres?.all.filter((dre) => dre.id == id);
        return placeholder[ 0 ] !== undefined ? placeholder[ 0 ]?.name : null;
      }
    },
  }
}
</script>

<style lang="scss" scoped>

</style>
