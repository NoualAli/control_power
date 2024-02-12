<template>
    <NLGrid class="box auth-box reset border-1 border-primary" gap="6" v-if="shouldReset">
        <NLColumn class="auth-box__header">
            <img src="/storage/assets/brand.svg" class="auth-brand">
            <span class="auth-box__title" v-if="showForm">
                1<sup>ère</sup> Connexion <br>
                Nouveau mot de passe
            </span>
            <span class="auth-box__title" v-else>
                <i class="las la-spinner la-spin icon"></i> Patientez un moment...
            </span>
        </NLColumn>
        <NLColumn class="form-container container">
            <form method="POST" @submit.prevent="reset" @keydown="form.onKeydown($event)" v-if="showForm">
                <NLGrid gap="2" class="my-2">
                    <!-- Firstname -->
                    <NLColumn lg="6" md="6">
                        <NLInput v-model="form.first_name" :form="form" name="firstname" label="Prénom" class="is-for-auth"
                            placeholder="Veuillez renseigner votre prénom" length="50" labelRequired />
                    </NLColumn>

                    <!-- Lastname -->
                    <NLColumn lg="6" md="6">
                        <NLInput v-model="form.last_name" :form="form" name="last_name" label="Nom de famille"
                            class="is-for-auth" placeholder="Veuillez renseigner votre nom de famille" length="50"
                            labelRequired />
                    </NLColumn>

                    <!-- Registration number -->
                    <NLColumn lg="6" md="6">
                        <NLInput v-model="form.registration_number" :form="form" name="registration_number"
                            class="is-for-auth" label="Matricule" type="number" length="5"
                            placeholder="Veuillez renseigner votre matricule" labelRequired />
                    </NLColumn>

                    <!-- Phone -->
                    <NLColumn lg="6" md="6">
                        <NLInput v-model="form.phone" :form="form" name="phone" class="is-for-auth" label="N° de téléphone"
                            type="phone" placeholder="Veuillez renseigner votre n° de téléphone" labelRequired />
                    </NLColumn>

                    <!-- Gender -->
                    <NLColumn>
                        <NLSelect v-model="form.gender" :form="form" name="gender" label="Genre" class="is-for-auth"
                            placeholder="Veuillez choisir votre genre" :options="gendersList" labelRequired />
                    </NLColumn>

                    <NLColumn lg="6">
                        <NLInput v-model="form.password" name="password" label="Mot de passe" class="is-for-auth"
                            placeholder="Veuillez renseigner un nouveau mot de passe" :form="form" type="password"
                            labelRequired />
                    </NLColumn>

                    <NLColumn lg="6">
                        <NLInput v-model="form.password_confirmation" name="password_confirmation"
                            label="Confirmation mot de passe" class="is-for-auth"
                            placeholder="Veuillez confirmer votre nouveau mot de passe" :form="form" type="password"
                            labelRequired />
                    </NLColumn>
                </NLGrid>
                <NLFlex lgJustifyContent="center">
                    <NLButton :loading="form.busy" label="Enregistrer" class="d-block w-100" />
                </NLFlex>
            </form>
            <div class="w-100 text-medium" v-else>
                <p class="text-center">
                    Vous allez être rediriger vers votre tableau de bord.
                </p>
            </div>
        </NLColumn>
        <NLColumn class="text-center d-block d-lg-none">
            VERSION {{ CURRENT_VERSION }} &copy; {{ currentYear }}
        </NLColumn>
    </NLGrid>
    <NLGrid class="box auth-box border-1 border-primary" gap="6" v-else>
        <NLColumn class="auth-box__header">
            <img src="/storage/assets/brand.svg" class="auth-brand">
            <span class="auth-box__title">
                Réinitialisation du mot de passe
            </span>
        </NLColumn>
        <NLColumn class="form-container container">
            <form method="POST" @submit.prevent="renew" @keydown="passwordForm.onKeydown($event)" v-if="showForm">
                <NLGrid gap="2" class="my-2">
                    <NLColumn>
                        <NLInput v-model="passwordForm.new_password" name="new_password" label="Nouveau mot de passe"
                            class="is-for-auth" placeholder="Veuillez renseigner un nouveau mot de passe"
                            :form="passwordForm" type="password" labelRequired />
                    </NLColumn>

                    <NLColumn>
                        <NLInput v-model="passwordForm.new_password_confirmation" name="new_password_confirmation"
                            label="Confirmation du nouveau mot de passe" class="is-for-auth"
                            placeholder="Veuillez confirmer votre nouveau mot de passe" :form="passwordForm" type="password"
                            labelRequired />
                    </NLColumn>
                </NLGrid>
                <NLFlex lgJustifyContent="center">
                    <NLButton :loading="passwordForm.busy" label="Réinitialiser" class="d-block w-100" />
                </NLFlex>
            </form>
            <div class="w-100 text-medium" v-else>
                <p class="text-center">
                    Vous allez être rediriger vers votre tableau de bord.
                </p>
            </div>
        </NLColumn>
        <NLColumn class="text-center d-block d-lg-none">
            VERSION {{ CURRENT_VERSION }} &copy; {{ currentYear }}
        </NLColumn>
    </NLGrid>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import { ls_get } from '../../plugins/crypto'
import * as APP from '~/store/global/version'
export default {
    layout: 'auth',
    metaInfo() {
        return { title: 'Réinitialisation du mot de passe' }
    },
    computed: {
        ...mapGetters({
            user: 'auth/user'
        }),
        CURRENT_VERSION() {
            return APP.CURRENT_VERSION
        }
    },
    data: () => ({
        gendersList: [
            {
                label: 'Homme',
                id: 1
            },
            {
                label: 'Femme',
                id: 2
            }
        ],
        form: new Form({
            first_name: null,
            last_name: null,
            email: null,
            gender: null,
            registration_number: null,
            phone: null,
            password: null,
            password_confirmation: null,
        }),
        passwordForm: new Form({
            new_password: null,
            new_password_confirmation: null,
        }),
        shouldReset: false,
        showForm: true,
    }),
    created() {
        particlesJS.load('particles-js', '../particles.json');
        this.$store.dispatch('settings/updatePageLoading', true)
        this.checkReset()
    },
    methods: {
        checkReset() {
            this.shouldReset = !this.user.first_name && !this.user.last_name
            this.$store('settings/updatePageLoading', true)
        },
        renew() {
            const user = JSON.parse(ls_get('user'))
            this.passwordForm.patch('settings/password/' + user?.id).then(response => {
                if (response.data.status) {
                    this.showForm = false
                    this.$swal.toast_success(response.data.message)
                    this.passwordForm.reset()
                    this.$store.dispatch('auth/fetchUser').then(() => this.$router.push({ name: 'home' }))
                } else {
                    this.$swal.alert_error(response.data.message)
                    this.showForm = true
                }
            }).catch(error => {
                this.$swal.catchError(error, true)
                this.showForm = true
            })
        },
        reset() {
            const user = JSON.parse(ls_get('user'))
            this.form.patch('settings/reset/' + user?.id).then(response => {
                if (response.data.status) {
                    this.showForm = false
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                    this.$store.dispatch('auth/fetchUser').then(() => this.$router.push({ name: 'home' }))
                } else {
                    this.$swal.alert_error(response.data.message)
                    this.showForm = true
                }
            }).catch(error => {
                // this.$swal.alert_error(error?.data?.message)
                this.$swal.catchError(error)
                this.showForm = true
            })
        },
    }
}
</script>
