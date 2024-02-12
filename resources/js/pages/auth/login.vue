<template>
    <NLGrid class="box auth-box border-1 border-primary" gap="6">
        <NLColumn class="auth-box__header">
            <img src="/storage/assets/brand.svg" class="auth-brand">
            <span class="auth-box__title" v-if="showForm">
                S'identifier
                <br>
                à votre compte
            </span>
            <span class="auth-box__title" v-else>
                <i class="las la-spinner la-spin icon"></i> Patientez un moment...
            </span>
        </NLColumn>
        <NLColumn class="form-container container">
            <form method="POST" @submit.prevent="login" @keydown="form.onKeydown($event)" v-if="showForm">
                <NLGrid gap="2" class="my-2">
                    <NLColumn>
                        <NLInput v-model="form.authLogin" name="authLogin" placeholder="Identifiant" :form="form"
                            class="is-for-auth" />
                    </NLColumn>
                    <NLColumn>
                        <NLInput v-model="form.password" name="password" class="is-for-auth" placeholder="Mot de passe"
                            :form="form" type="password" />
                    </NLColumn>
                </NLGrid>
                <NLFlex lgJustifyContent="center">
                    <NLButton :loading="isLoading" loadingLabel="Connexion en cours" label="Connexion"
                        class="d-flex flex-row w-100">
                        <i class="las la-sign-in-alt icon"></i>
                    </NLButton>
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
import { mapGetters } from 'vuex'
import NLInput from '../../components/Inputs/NLInput'
import NLButton from '../../components/Inputs/NLButton.vue'
import Form from 'vform'
import * as APP from '~/store/global/version'
export default {
    components: { NLInput, NLButton },
    layout: 'auth',
    middleware: 'guest',

    metaInfo() {
        return { title: 'Connexion' }
    },

    data: () => ({
        form: new Form({
            authLogin: null,
            password: null
        }),
        isLoading: false,
        remember: false,
        showForm: true,
    }),
    computed: {
        ...mapGetters({
            user: 'auth/user'
        }),
        CURRENT_VERSION() {
            return APP.CURRENT_VERSION
        }
    },
    created() {
        particlesJS.load('particles-js', '../particles.json');
    },
    methods: {
        getLoginName(login) {
            const mailFormat = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/
            return login.match(mailFormat) ? 'email' : 'username'
        },
        login() {
            // Submit the form.
            this.isLoading = true
            this.form.post('login').then(response => {
                // Save the token.
                this.$store.dispatch('auth/saveToken', {
                    token: response.data.token,
                    remember: this.remember
                })
                this.$store.dispatch('auth/fetchUser').then(() => {
                    this.isLoading = false
                    if (this.user.is_active) {
                        this.showForm = false
                        return this.redirect(this.user.must_change_password)
                    } else {
                        this.$store.dispatch('auth/logout')
                        return this.$swal.alert_error("Votre compte est suspendu temporairement, veuillez contacter les administrateurs pour plus d'informations !", "Erreur 401")
                    }
                })
                // Fetch the user.
            }).catch(error => {
                this.isLoading = false
                this.$swal.catchError(error);
                this.$swal.catchError(error, true)
            })

        },
        redirect(mustChangePassword) {
            if (mustChangePassword) {
                this.$router.push({ name: 'password.reset' })
            } else {
                this.$router.push({ name: 'home' })
            }
        }
    }
}
</script>
