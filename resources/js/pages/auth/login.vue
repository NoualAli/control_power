<!-- eslint-disable vue/multi-word-component-names -->
<!-- eslint-disable vue/valid-model-definition -->
<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <div class="box auth-box grid gap-6">
    <div class="col-12 auth-box__header">
      <img src="/images/brand.svg" class="auth-brand">
      <span class="auth-box__title">
        S'identifier
        <br>
        à votre compte
      </span>
    </div>
    <div class="col-12 form-container container">
      <form method="POST" @submit.prevent="login" @keydown="form.onKeydown($event)">
        <div class="grid gap-2 my-2">
          <div class="col-12">
            <NLInput
              v-model="form.authLogin" name="authLogin" placeholder="Email / Username" :form="form"
              class="is-for-auth"
            />
          </div>
          <div class="col-12">
            <NLInput
              v-model="form.password" name="password" class="is-for-auth" placeholder="Password" :form="form"
              type="password"
            />
          </div>
        </div>
        <div class="d-flex justify-center align-center">
          <NLButton :loading="form.busy" label="login" class="is-radius d-block w-100" />
        </div>
      </form>
    </div>
    <div class="col-12 text-center d-block d-lg-none">
      <p class="">
        &copy; 2022 - Tous droits réservés - DCP 104
      </p>
    </div>
  </div>
</template>

<script>
import NLInput from '../../components/Inputs/NLInput'
import NLButton from '../../components/Inputs/NLButton.vue'
import Form from 'vform'

export default {
  components: { NLInput, NLButton },
  layout: 'auth',
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      authLogin: null,
      password: null
    }),
    remember: false
  }),

  methods: {
    getLoginName (login) {
      const mailFormat = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/
      return login.match(mailFormat) ? 'email' : 'username'
    },
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')
      // Save the token.
      // console.log(data)
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },

    redirect () {
      console.log(this)
      console.log(this.$)
      console.log(this.$router)
      this.$router.push({ name: 'home' })
    }
  }
}
</script>
