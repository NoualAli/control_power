<template>
    <div v-if="can('create_user')">
        <ContentHeader title="Ajouter un utilisateur" />
        <ContentBody>
            <form @submit.prevent="create" @keydown="form.onKeydown($event)">
                <div class="grid gap-10 my-4">
                    <!-- Firstname -->
                    <div class="col-12 col-lg-6 col-md-6">
                        <NLInput v-model="form.first_name" :form="form" name="firstname" label="Prénom" />
                    </div>

                    <!-- Lastname -->
                    <div class="col-12 col-lg-6 col-md-6">
                        <NLInput v-model="form.last_name" :form="form" name="last_name" label="Nom de famille" />
                    </div>

                    <!-- Username -->
                    <div class="col-12 col-lg-6 col-md-6">
                        <NLInput v-model="form.username" :form="form" name="username" label="Nom d'utilisateur"
                            label-required />
                    </div>

                    <!-- Email -->
                    <div class="col-12 col-lg-6 col-md-6">
                        <NLInput v-model="form.email" :form="form" name="email" label="Adresse e-mail" label-required
                            type="email" />
                    </div>

                    <!-- Phone -->
                    <div class="col-12 col-lg-6 col-md-6">
                        <NLInput v-model="form.phone" :form="form" name="phone" label="N° de téléphone" type="phone" />
                    </div>

                    <!-- Dres -->
                    <div class="col-12 col-lg-6 col-md-6">
                        <NLSelect v-model="form.dres" :form="form" name="dres" label="DRE" :options="dresList"
                            placeholder="Choisissez une DRE" :multiple="true" />
                    </div>

                    <!-- Roles -->
                    <div class="col-12">
                        <NLSelect v-model="form.roles" :form="form" name="roles" label="Rôles"
                            placeholder="Choisissez un rôle" :options="rolesList" :multiple="true" />
                    </div>

                    <!-- Password -->
                    <div class="col-12 col-lg-4">
                        <NLInput v-model="form.password" :form="form" label="Mot de passe" name="password" type="password"
                            label-required />
                    </div>
                    <!-- Password Confirmation -->
                    <div class="col-12 col-lg-4">
                        <NLInput v-model="form.password_confirmation" :form="form" label="Confirmation du mot de passe"
                            name="password_confirmation" type="password" label-required />
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
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth', 'admin' ],
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
                dres: []
            }),
            dresList: [],
            rolesList: []
        }
    },
    computed: mapGetters({
        roles: 'roles/all',
        dres: 'dre/all'
    }),
    created() {
        this.$store.dispatch('roles/fetchAll').then(() => {
            this.rolesList = this.roles.all
        })
        this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
            this.dresList = this.dres.all
        })
    },
    methods: {
        create() {
            this.form.post('/api/users').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                console.log(error)
            })
        },
        getPlaceholder(id) {
            if (id) {
                let placeholder = null
                placeholder = this.dres?.all.filter((dre) => dre.id == id)
                return placeholder[ 0 ] !== undefined ? placeholder[ 0 ]?.name : null
            }
        }
    }
}
</script>
