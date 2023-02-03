<template>
  <div class="grid">
    <div class="col-12">
      <form @submit.prevent="updateProfile" @keydown="infoForm.onKeydown($event)">

        <h2>Mettez à jour vos informations</h2>

        <div class="grid gap-3 my-4">
          <!-- Firstname -->
          <div class="col-12 col-lg-4 col-md-6">
            <NLInput :form="infoForm" name="firstname" label="firstname" v-model="infoForm.first_name" />
          </div>

          <!-- Lastname -->
          <div class="col-12 col-lg-4 col-md-6">
            <NLInput :form="infoForm" name="last_name" label="lastname" v-model="infoForm.last_name" />
          </div>

          <!-- Username -->
          <div class="col-12 col-lg-4 col-md-6">
            <NLInput :form="infoForm" name="username" label="username" v-model="infoForm.username" labelRequired />
          </div>

          <!-- Phone -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="infoForm" name="phone" label="phone" v-model="infoForm.phone" type="phone" />
          </div>

          <!-- Email -->
          <div class="col-12 col-lg-6 col-md-6">
            <NLInput :form="infoForm" name="email" label="email" v-model="infoForm.email" labelRequired type="email" />
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
            <NLInput :form="passwordForm" v-model="passwordForm.current_password" label="current_password"
              name="current_password" type="password" labelRequired />
          </div>

          <!-- Password -->
          <div class="col-12 col-lg-4">
            <NLInput :form="passwordForm" v-model="passwordForm.password" label="Password" name="password"
              type="password" labelRequired />
          </div>
          <!-- Password Confirmation -->
          <div class="col-12 col-lg-4">
            <NLInput :form="passwordForm" v-model="passwordForm.password_confirmation" label="confirm_password"
              name="password_confirmation" type="password" labelRequired />
          </div>
        </div>
        <!-- Submit Button -->
        <div class="d-flex justify-end align-center">
          <NLButton :loading="infoForm.busy" label="Update" class="is-radius" />
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import { user } from '../../plugins/user'

export default {
  layout: 'backend',

  metaInfo() {
    return { title: 'Profil' }
  },

  data: () => ({
    infoForm: new Form({
      username: '',
      email: '',
      first_name: '',
      last_name: '',
    }),
    passwordForm: new Form({
      password: '',
      current_password: '',
      password_confirmation: ''
    }),
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  created() {
    this.infoForm.keys().forEach(key => {
      this.infoForm[ key ] = this.user[ key ]
    })
  },

  methods: {
    updateProfile() {
      this.infoForm.patch('/api/settings/profile/' + user().id).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
        } else {
          swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error);
      })
    },
    updatePassword() {
      this.passwordForm.patch('/api/settings/password/' + user().id).then(response => {
        if (response.data.status) {
          swal.toast_success(response.data.message)
          this.passwordForm.reset()
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
