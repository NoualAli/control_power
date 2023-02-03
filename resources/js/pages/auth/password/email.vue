<template>
  <div class="grid vh-100">
    <div class="col-12 d-flex full-center">
      <form @submit.prevent="send" @keydown="form.onKeydown($event)" class="box">
        <h2 class="text-center mb-3">{{ $t('reset_password') }}</h2>
        <Notification v-if="status" type="is-success" :class="'my-6'">
          {{ status }}
        </Notification>
        <!-- Email -->
        <label class="form-label is-required" for="email" :class="{ 'text-danger': form.errors.has('email') }">
          {{ $t('Email') }}
        </label>
        <input v-model="form.email" id="email" :class="{ 'is-danger': form.errors.has('email') }" class="input"
          type="email" name="email" :placeholder="$t('email')">
        <has-error class="text-danger" :form="form" field="email" />
        <!-- <div class="col-12 col-lg-6 col-md-6">
        </div> -->
        <!-- Submit Button -->
        <v-button :loading="form.busy" class="btn btn-primary w-100 w-lg-auto w-md-auto text-white my-2 m-lg-0">
          {{ $t('send_password_reset_link') }}
        </v-button>
      </form>
    </div>
  </div>
</template>

<script>
import Notification from '../../../components/Notification'
import Form from 'vform'

export default {
  components: { Notification },
  layout: 'auth',
  middleware: 'guest',

  metaInfo() {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send() {
      const { data } = await this.form.post('/api/password/email')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
