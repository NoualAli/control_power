<template>
  <div class="box auth-box grid gap-6">
    <div class="col-12 auth-box__header">
      <img src="/images/brand.svg" class="auth-brand">
      <span class="auth-box__title">
        1<sup>ère</sup> Connexion <br>
        Nouveau mot de passe
      </span>
    </div>
    <div class="col-12 form-container container">
      <form method="POST" @submit.prevent="renew" @keydown="form.onKeydown($event)">
        <div class="grid gap-2 my-2">
          <div class="col-12">
            <NLInput
              v-model="form.current_password" name="current_password" class="is-for-auth"
              placeholder="Mot de passe actuel" :form="form" type="password"
            />
          </div>
          <div class="col-12">
            <NLInput
              v-model="form.password" name="password" class="is-for-auth" placeholder="Mot de passe" :form="form"
              type="password"
            />
          </div>
          <div class="col-12">
            <NLInput
              v-model="form.password_confirmation" name="password_confirmation" class="is-for-auth" placeholder="Confirmation mot de passe"
              :form="form" type="password"
            />
          </div>
        </div>
        <div class="d-flex justify-center align-center">
          <NLButton :loading="form.busy" label="Continuer" class="is-radius d-block w-100" />
        </div>
      </form>
    </div>
    <div class="col-12 text-center d-block d-lg-none">
      <p class="">
        &copy; 2023 - Tous droits réservés - BNA
      </p>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
export default {
  layout: 'auth',
  // middleware: 'auth',
  metaInfo () {
    return { title: 'Réinitialisation du mot de passe' }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },
  data: () => ({
    form: new Form({
      current_password: null,
      password: null,
      password_confirmation: null,
      mustChangePassword: true
    })
  }),

  methods: {
    renew () {
      const user = JSON.parse(localStorage.getItem('user'))
      this.form.patch('/api/settings/password/' + user?.id).then(response => {
        if (response.data.status) {
          this.$swal.toast_success(response.data.message)
          this.form.reset()
          this.$store.dispatch('auth/fetchUser').then(() => this.$router.push({ name: 'home' }))
        } else {
          this.$swal.alert_error(response.data.message)
        }
      }).catch(error => {
        console.log(error)
      })
      // this.status = data.status
    }
  }
}
</script>
