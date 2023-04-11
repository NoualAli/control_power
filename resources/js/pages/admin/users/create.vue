<template>
  <div v-if="can('create_user')">
    <ContentHeader title="Ajouter un utilisateur" />
    <ContentBody>
      <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="grid gap-10 my-4">
          <!-- Firstname -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="firstname" label="Prénom" v-model="form.first_name" />
          </div>

          <!-- Lastname -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="last_name" label="Nom de famille" v-model="form.last_name" />
          </div>

          <!-- Username -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="username" label="Nom d'utilisateur" v-model="form.username" labelRequired />
          </div>

          <!-- Email -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="email" label="Adresse e-mail" v-model="form.email" labelRequired type="email" />
          </div>

          <!-- Phone -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="form" name="phone" label="N° de téléphone" v-model="form.phone" type="phone" />
          </div>

          <!-- Dres -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLSelect :form="form" name="dres" label="Dre" :options="dresList" v-model="form.dres" :multiple="true" />
          </div>

          <!-- Roles -->
          <div class="col-12">
            <NLSelect :form="form" name="roles" label="Rôles" :options="rolesList" v-model="form.roles" :multiple="true"
              labelRequired />
          </div>

          <!-- Password -->
          <div class="col-12 col-lg-4">
            <NLInput :form="form" v-model="form.password" label="Mot de passe" name="password" type="password"
              helpText="Si aucune valeur n'est spécifié le mot de passe par défaut est: Azerty123" />
          </div>
          <!-- Password Confirmation -->
          <div class="col-12 col-lg-4">
            <NLInput :form="form" v-model="form.password_confirmation" label="Confirmation mot de passe"
              name="password_confirmation" type="password" />
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
      this.rolesList = this.roles.all;
    })
    this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
      this.dresList = this.dres.all;
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
