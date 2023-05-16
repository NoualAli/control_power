<template>
  <div class="grid">
    <div class="col-12">
      <form @submit.prevent="updateProfile" @keydown="infoForm.onKeydown($event)">
        <h2>Mettez à jour vos informations</h2>

        <div class="grid gap-3 my-4">
          <!-- Username -->
          <div class="col-12 col-lg-4 col-md-6">
            <NLInput v-model="infoForm.username" :form="infoForm" name="username" label="Nom d'utilisateur" readonly />
          </div>

          <!-- Firstname -->
          <div class="col-12 col-lg-4 col-md-6">
            <NLInput v-model="infoForm.first_name" :form="infoForm" name="firstname" label="Prénom" />
          </div>

          <!-- Lastname -->
          <div class="col-12 col-lg-4 col-md-6">
            <NLInput v-model="infoForm.last_name" :form="infoForm" name="last_name" label="Nom de famille" />
          </div>

          <!-- Phone -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput v-model="infoForm.phone" :form="infoForm" name="phone" label="N° de téléphone" type="phone" />
          </div>

          <!-- Email -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput v-model="infoForm.email" :form="infoForm" name="email" label="Adresse e-mail" label-required
              type="email" />
          </div>
        </div>
        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="infoForm.busy" label="Update" class="is-radius" />
        </div>
      </form>
    </div>

    <div class="col-12">
      <form @submit.prevent="updatePassword" @keydown="passwordForm.onKeydown($event)">
        <h2>Changez votre mot de passe</h2>
        <div class="grid gap-3 my-4">
          <!-- Current password -->
          <div class="col-12 col-lg-4">
            <NLInput v-model="passwordForm.current_password" :form="passwordForm" label="Mot de passe actuel"
              name="current_password" type="password" label-required />
          </div>

          <!-- Password -->
          <div class="col-12 col-lg-4">
            <NLInput v-model="passwordForm.password" :form="passwordForm" label="Mot de passe" name="password"
              type="password" label-required />
          </div>
          <!-- Password Confirmation -->
          <div class="col-12 col-lg-4">
            <NLInput v-model="passwordForm.password_confirmation" :form="passwordForm" label="Confirmation mot de passe"
              name="password_confirmation" type="password" label-required />
          </div>
        </div>
        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="infoForm.busy" label="Update" class="is-radius" />
        </div>
      </form>
    </div>

    <div class="col-12">
      <NLDatatable :config="config" title="Historique de connexion" namespace="users" />
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import { user } from '../../plugins/user'

export default {
  layout: 'MainLayout',

  metaInfo() {
    return { title: 'Profil' }
  },

  data() {
    return {
      infoForm: new Form({
        username: '',
        email: '',
        first_name: '',
        last_name: ''
      }),
      passwordForm: new Form({
        password: '',
        current_password: '',
        password_confirmation: ''
      }),

      config: {
        data: null,
        columns: [
          {
            label: 'Appareil',
            field: 'device'
          },
          {
            label: 'Navigateur',
            field: 'browser'
          },
          {
            label: 'Version',
            field: 'browser_version'
          },
          {
            label: "Système d'exploitation",
            field: 'platform'
          },
          {
            label: 'Version',
            field: 'platform_version'
          },
          {
            label: 'Adresse IP',
            field: 'ip_address'
          },
          {
            label: 'Dernière connexion',
            field: 'last_activity'
          }
        ]
      }
    }
  },

  computed: mapGetters({
    user: 'auth/user',
    logins: 'auth/logins'
  }),

  created() {
    this.$store.dispatch('auth/fetchCurrentUserLogins').then(() => { this.config.data = this.logins })
    this.infoForm.keys().forEach(key => {
      this.infoForm[ key ] = this.user[ key ]
    })
  },

  methods: {
    updateProfile() {
      this.infoForm.patch('/api/settings/profile/' + user().id).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
        } else {
          this.$swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error)
      })
    },
    updatePassword() {
      this.passwordForm.patch('/api/settings/password/' + user().id).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.passwordForm.reset()
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
