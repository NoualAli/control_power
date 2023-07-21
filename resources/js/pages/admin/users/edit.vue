<template>
    <div v-if="can('edit_user')">
        <ContentBody>
            <NLGrid class="my-4">
                <!-- Update User informations -->
                <NLColumn>
                    <NLForm :action="updateInfos" :form="form">
                        <!-- Firstname -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.first_name" :form="form" name="firstname" label="Prénom"
                                label-required />
                        </NLColumn>

                        <!-- Lastname -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.last_name" :form="form" name="last_name" label="Nom de famille"
                                label-required />
                        </NLColumn>

                        <!-- Username -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.username" :form="form" name="username" label="Nom d'utilisateur"
                                label-required />
                        </NLColumn>

                        <!-- Phone -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.phone" :form="form" name="phone" label="N° de téléphone" type="phone" />
                        </NLColumn>

                        <!-- Email -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.email" :form="form" name="email" label="Adresse e-mail" type="email"
                                label-required />
                        </NLColumn>

                        <!-- Dres -->
                        <NLColumn lg="6" md="6">
                            <NLSelect v-model="form.dres" :form="form" name="dres" label="DRE"
                                placeholder="Choisissez une DRE" :options="dresList" :multiple="true" />
                        </NLColumn>

                        <!-- Role -->
                        <NLColumn>
                            <NLSelect v-model="form.roles" :form="form" name="roles" placeholder="Choisissez un rôle"
                                label="Rôles" :options="rolesList" :multiple="true" />
                        </NLColumn>
                        <NLColumn>
                            <NLFlex lgJustifyContent="end">
                                <NLButton :loading="form.busy" label="Mettre à jour" />
                            </NLFlex>
                        </NLColumn>
                    </NLForm>
                    <form @submit.prevent="updateInfos" @keydown="form.onKeydown($event)">
                        <div class="grid gap-10 my-4">
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-end align-center">
                        </div>
                    </form>
                </NLColumn>

                <!-- Update Password -->
                <NLColumn>
                    <NLForm :action="updatePassword" :form="form">
                        <!-- Password -->
                        <NLColumn lg="4" md="4">
                            <NLInput v-model="passwordForm.password" :form="passwordForm" label="Mot de passe"
                                name="password" type="password" label-required />
                        </NLColumn>
                        <!-- Password Confirmation -->
                        <NLColumn lg="4" md="4">
                            <NLInput v-model="passwordForm.password_confirmation" :form="passwordForm"
                                label="Confirmation mot de passe" name="password_confirmation" type="password"
                                label-required />
                        </NLColumn>
                        <NLColumn>
                            <NLFlex lgJustifyContent="end">
                                <NLButton :loading="passwordForm.busy" label="Mettre à jour" />
                            </NLFlex>
                        </NLColumn>
                    </NLForm>
                </NLColumn>
            </NLGrid>
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
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('roles/fetchAll').then(() => {
            this.rolesList = this.roles.all
            this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
                this.dresList = this.dres.all
                this.$store.dispatch('users/fetch', this.$route.params.user).then(() => {
                    this.form.fill(this.user.current)
                    this.form.roles = this.user.current.roles.map(item => item.id)
                    this.form.dres = this.user.current.agencies.map(item => item.id)
                    this.$store.dispatch('settings/updatePageLoading', false)
                })
            })
        })
    },
    methods: {
        updateInfos() {
            this.$swal.confirm_update().then((action) => {
                if (action.isConfirmed) {
                    this.form.put('users/info/' + this.user.current.id).then(response => {
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
        updatePassword() {
            this.$swal.confirm_update().then((action) => {
                if (action.isConfirmed) {
                    this.passwordForm.put('users/password/' + this.user.current.id).then(response => {
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
