<template>
  <div class="grid vh-100">
    <div class="col-12 d-flex full-center">
      <form @submit.prevent="reset" @keydown="form.onKeydown($event)" class="box">
        <h2 class="text-center mb-3">{{ $t('reset_password') }}</h2>
        <Notification v-if="status" type="is-success" :class="'my-6'">
          {{ status }}
        </Notification>

        <div class="grid">
          <!-- Email -->
          <div class="col-12">
            <label class="form-label is-required" for="email" :class="{ 'text-danger': form.errors.has('email') }">
              {{ $t('Email') }}
            </label>
            <input v-model="form.email" id="email" :class="{ 'is-danger': form.errors.has('email') }" class="input"
              type="email" name="email" :placeholder="$t('email')">
            <has-error class="text-danger" :form="form" field="email" />
          </div>

          <!-- Password -->
          <div class="col-12 col-lg-6 col-md-6">
            <label class="form-label is-required" for="password"
              :class="{ 'text-danger': form.errors.has('password') }">
              {{ $t('Password') }}
            </label>
            <input v-model="form.password" id="password" :class="{ 'is-danger': form.errors.has('password') }"
              class="input" type="password" name="password" :placeholder="$t('password')">
            <has-error class="text-danger" :form="form" field="password" />
          </div>

          <!-- Password Confirmation -->
          <div class="col-12 col-lg-6 col-md-6">
            <label class="form-label" for="password_confirmation">{{ $t('confirm_password') }}</label>
            <input v-model="form.password_confirmation" id="password_confirmation"
              :class="{ 'is-danger': form.errors.has('password_confirmation') }" class="input" type="password"
              name="password_confirmation" :placeholder="$t('confirm_password')">
            <has-error class="text-danger" :form="form" field="password_confirmation" />
          </div>
        </div>

        <!-- Submit Button -->
        <v-button :loading="form.busy" class="btn btn-primary w-100 w-lg-auto w-md-auto text-white my-2 m-lg-0">
          {{ $t('reset_password') }}
        </v-button>
      </form>
      <!-- $t('reset_password') -->
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  layout: 'auth',
  middleware: 'guest',

  metaInfo() {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      token: '',
      email: '',
      password: '',
      password_confirmation: ''
    })
  }),

  created() {
    this.form.email = this.$route.query.email
    this.form.token = this.$route.params.token
  },

  methods: {
    async reset() {
      const { data } = await this.form.post('/api/password/reset')

      this.status = data.status

      this.form.reset()
      setTimeout(() => {
        window.location.href = '/login'
      }, 3000)
    }
  }
}
</script>
