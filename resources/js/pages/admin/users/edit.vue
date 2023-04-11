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
                <NLInput :form="form" name="firstname" label="Prénom" v-model="form.first_name" labelRequired />
              </div>

              <!-- Lastname -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLInput :form="form" name="last_name" label="Nom de famille" v-model="form.last_name" labelRequired />
              </div>

              <!-- Username -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLInput :form="form" name="username" label="Nom d'utilisateur" v-model="form.username" labelRequired />
              </div>

              <!-- Phone -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLInput :form="form" name="phone" label="N° de téléphone" v-model="form.phone" type="phone" />
              </div>

              <!-- Email -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLInput :form="form" name="email" label="Adresse e-mail" v-model="form.email" type="email"
                  labelRequired />
              </div>

              <!-- Dres -->
              <div class="col-12 col-lg-6 col-md-6">
                <NLSelect :form="form" name="dres" label="Dre" v-model="form.dres" :options="dresList" :multiple="true" />
              </div>

              <!-- Role -->
              <div class="col-12">
                <NLSelect :form="form" name="roles" label="Rôles" v-model="form.roles" :options="rolesList"
                  :multiple="true" />
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
import NLCheckableContainer from '../../../components/Inputs/NLCheckableContainer'
import NLRadio from '../../../components/Inputs/NLRadio'
import DefaultContainer from '../../../components/Inputs/DefaultContainer';
import { Form } from 'vform';
import Notification from '../../../components/Notification.vue';
import { mapGetters } from 'vuex';
import { confirm_update, toast_error, toast_success } from '../../../plugins/swal';
export default {
  components: {
    NLSelect,
    NLCheckableContainer, NLRadio, Notification, DefaultContainer
  },
  middleware: [ 'auth', 'admin' ],
  layout: 'backend',
  created() {
    this.$store.dispatch('roles/fetchAll').then(() => {
      this.rolesList = this.roles.all;
    })
    this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
      this.dresList = this.dres.all
    })
    this.$store.dispatch('users/fetch', this.$route.params.user).then((result) => {
      this.form.fill(this.user.current)
      this.form.roles = this.user.current.roles.map(item => item.id)
      console.log(this.user.current);
      this.form.dres = this.user.current.agencies.map(item => item.id)
    })
  },
  data() {
    return {
      form: new Form({
        username: null,
        email: null,
        first_name: null,
        last_name: null,
        roles: [],
        dres: [],
      }),
      passwordForm: new Form({
        password: null,
        password_confirmation: null,
      }),
      dresList: [],
      rolesList: [],
    }
  },
  computed: mapGetters({
    user: 'users/current',
    dres: 'dre/all',
    roles: 'roles/all'
  }),
  methods: {
    updateInfos() {
      confirm_update().then((action) => {
        if (action.isConfirmed) {
          this.form.put('/api/users/info/' + this.user.current.id).then(response => {
            if (response.data.status) {
              toast_success(response.data.message)
              this.$router.push({ name: 'users-index' })
            } else {
              swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error);
          })
        }
      })
    },
    updatePassword() {
      confirm_update().then((action) => {
        if (action.isConfirmed) {
          this.form.put('/api/users/password/' + this.user.current.id).then(response => {
            if (response.data.status) {
              swal.toast_success(response.data.message)
              this.passwordForm.reset()
              this.$router.push({ name: 'users-index' })
            } else {
              swal.alert_error(response.data.message)
            }
          }).catch(error => {
            console.log(error);
          })
        }
      })
    },
  }
}
</script>
