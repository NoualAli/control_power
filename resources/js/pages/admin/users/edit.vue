<template>
  <div v-if="can('edit_user')">
    <ContentBody>
      <div class="grid gap-10 my-4">
        <!-- Update User informations -->
        <div class="col-12">
          <form @submit.prevent="updateInfos" @keydown="form.onKeydown($event)">
            <div class="grid gap-10 my-4">
              <!-- Firstname -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLInput v-model="form.first_name" :form="form" name="firstname" label="Prénom" label-required />
              </div>

              <!-- Lastname -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLInput v-model="form.last_name" :form="form" name="last_name" label="Nom de famille" label-required />
              </div>

              <!-- Username -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLInput v-model="form.username" :form="form" name="username" label="Nom d'utilisateur" label-required />
              </div>

              <!-- Phone -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLInput v-model="form.phone" :form="form" name="phone" label="N° de téléphone" type="phone" />
              </div>

              <!-- Email -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLInput
                  v-model="form.email" :form="form" name="email" label="Adresse e-mail" type="email"
                  label-required
                />
              </div>

              <!-- Dres -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLSelect v-model="form.dres" :form="form" name="dres" label="Dre" :options="dresList" :multiple="true" />
              </div>

              <!-- Role -->
              <div class="col-12">
                <NLSelect
                  v-model="form.roles" :form="form" name="roles" label="Rôles" :options="rolesList"
                  :multiple="true"
                />
              </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-end align-center">
              <NLButton :loading="form.busy" label="Update" class="is-radius" />
            </div>
          </form>
        </div>

        <!-- Update Password -->
        <div class="col-12">
          <form @submit.prevent="updatePassword" @keydown="passwordForm.onKeydown($event)">
            <div class="grid gap-10 my-4">
              <!-- Password -->
              <div class="col-12 col-lg-4">
                <NLInput
                  v-model="passwordForm.password" :form="passwordForm" label="Mot de passe" name="password"
                  type="password" label-required
                />
              </div>
              <!-- Password Confirmation -->
              <div class="col-12 col-lg-4">
                <NLInput
                  v-model="passwordForm.password_confirmation" :form="passwordForm"
                  label="Confirmation mot de passe" name="password_confirmation" type="password" label-required
                />
              </div>
            </div>
            <!-- Submit Button -->
            <div class="d-flex justify-end align-center">
              <NLButton :loading="passwordForm.busy" label="Update" class="is-radius" />
            </div>
          </form>
        </div>
      </div>
    </ContentBody>
  </div>
</template>

<script>
import NLSelect from '../../../components/Inputs/NLSelect'
// import NLCheckableContainer from '../../../components/Inputs/NLCheckableContainer'
// import NLRadio from '../../../components/Inputs/NLRadio'
// import DefaultContainer from '../../../components/Inputs/DefaultContainer'
import { Form } from 'vform'
// import Notification from '../../../components/Notification.vue'
import { mapGetters } from 'vuex'
// eslint-disable-next-line camelcase
export default {
  components: {
    NLSelect
    // NLCheckableContainer,
    // NLRadio,
    // Notification,
    // DefaultContainer
  },
  layout: 'backend',
  middleware: ['auth', 'admin'],
  data () {
    return {
      form: new Form({
        username: null,
        email: null,
        first_name: null,
        last_name: null,
        phone: null,
        roles: [],
        dres: []
      }),
      passwordForm: new Form({
        password: null,
        password_confirmation: null
      }),
      dresList: [],
      rolesList: []
    }
  },
  computed: mapGetters({
    user: 'users/current',
    dres: 'dre/all',
    roles: 'roles/all'
  }),
  created () {
    this.$store.dispatch('roles/fetchAll').then(() => {
      this.rolesList = this.roles.all
    })
    this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
      this.dresList = this.dres.all
    })
    this.$store.dispatch('users/fetch', this.$route.params.user).then((result) => {
      this.form.fill(this.user.current)
      this.form.roles = this.user.current.roles.map(item => item.id)
      console.log(this.user.current)
      this.form.dres = this.user.current.agencies.map(item => item.id)
    })
  },
  methods: {
    updateInfos () {
      this.$swal.confirm_update().then((action) => {
        if (action.isConfirmed) {
          this.form.put('/api/users/info/' + this.user.current.id).then(response => {
            if (response.data.status) {
              this.$swal.toast_success(response.data.message)
              this.$router.push({ name: 'users-index' })
            } else {
              this.$swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error)
          })
        }
      })
    },
    updatePassword () {
      this.$swal.confirm_update().then((action) => {
        if (action.isConfirmed) {
          this.passwordForm.put('/api/users/password/' + this.user.current.id).then(response => {
            if (response.data.status) {
              this.$swal.toast_success(response.data.message)
              this.passwordForm.reset()
              this.$router.push({ name: 'users-index' })
            } else {
              this.$swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error)
          })
        }
      })
    }
  }
}
</script>
