<template>
    <div v-if="can('create_user')">
        <ContentHeader title="Ajouter un utilisateur" />
        <ContentBody>
            <NLForm :action="create" :form="form">
                <!-- Firstname -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.first_name" :form="form" name="firstname" label="Prénom" labelRequired
                        :length="50" />
                </NLColumn>

                <!-- Lastname -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.last_name" :form="form" name="last_name" label="Nom de famille" labelRequired
                        :length="50" />
                </NLColumn>

                <!-- Registration number -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.registration_number" :form="form" name="registration_number" label="Matricule"
                        type="number" :length="5" />
                </NLColumn>

                <!-- Username -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.username" :form="form" name="username" label="Nom d'utilisateur" label-required
                        :length="30" />
                </NLColumn>

                <!-- Email -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.email" :form="form" name="email" label="Adresse e-mail" label-required
                        type="email" :length="100" />
                </NLColumn>

                <!-- Phone -->
                <NLColumn lg="6" md="6">
                    <NLInput v-model="form.phone" :form="form" name="phone" label="N° de téléphone" type="phone" />
                </NLColumn>

                <!-- Role -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.role" :form="form" name="role" label="Rôle" placeholder="Choisissez un rôle"
                        :options="rolesList" labelRequired />
                </NLColumn>


                <!-- Dres / Agencies -->
                <NLColumn lg="6" md="6" v-if="[11, 13, 6, 5].includes(form.role)">
                    <NLSelect v-model="form.agencies" :form="form" name="agencies" label="DRE / Agences" :options="dresList"
                        placeholder="Choisissez une DRE / Agence" :multiple="dreOptions.selectMultiple"
                        :disableBranchNodes="dreOptions.disableBranchNodes" />
                </NLColumn>

                <!-- Gender -->
                <NLColumn lg="6" md="6">
                    <NLSelect v-model="form.gender" :form="form" name="gender" label="Genre"
                        placeholder="Choisissez un genre" :options="gendersList" labelRequired />
                </NLColumn>

                <NLColumn>
                    <NLGrid>
                        <!-- Password -->
                        <NLColumn lg="4" md="4">
                            <NLInput v-model="form.password" :form="form" label="Mot de passe" name="password"
                                type="password"
                                helpText="Si vous ne saisissez aucun mot de passe alors le mot de passe par défaut sera attribuer à l'utilisateur" />
                        </NLColumn>
                        <!-- Password Confirmation -->
                        <NLColumn lg="4" md="4">
                            <NLInput v-model="form.password_confirmation" :form="form" label="Confirmation du mot de passe"
                                name="password_confirmation" type="password" />
                        </NLColumn>
                    </NLGrid>
                </NLColumn>

                <!-- Active -->
                <NLColumn v-if="showIsActiveSwitch" lg="6">
                    <NLSwitch v-model="form.is_active" name="is_active" :form="form" label="Le compte est activé ?"
                        type="is-success" />
                </NLColumn>
                <!-- <NLColumn lg="6">
                    <NLSwitch v-model="form.is_for_testing" name="is_for_testing" :form="form" label="Utilisateur TEST"
                        type="is-success" />
                </NLColumn> -->
                <NLColumn>
                    <NLFlex lgJustifyContent="end">
                        <NLButton :loading="form.busy" label="Ajouter" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </ContentBody>
    </div>
</template>

<script>
import { Form } from 'vform'
import { mapGetters } from 'vuex'
import { hasRole } from '../../../plugins/user'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
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
                role: null,
                agencies: [],
                is_active: false,
                gender: 1,
                registration_number: null,
                is_for_testing: false,
                phone: null,
            }),
            dresList: [],
            rolesList: [],
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
            dreOptions: {
                selectMultiple: false,
                disableBranchNodes: false,
            },
            showIsActiveSwitch: hasRole([ 'root', 'admin' ]),
        }
    },
    watch: {
        /**
         * Manage DRE display and options
         * @param {Numeric | null} newValue
         * @param {Numeric|null} oldValue
         */
        "form.role"(newValue, oldValue) {
            // 11 -> da -> accès à une seule agence à la fois -> Selection agence uniquement
            // 6 -> ci -> accès à toutes les agences -> Selection agence uniquement
            // 13 -> dre -> accès à toutes les agences -> Selection DRE uniquement
            // 5 -> cdc -> accès à toutes les agences -> Selection DRE uniquement
            this.form.agencies = null
            this.dreOptions = {
                selectMultiple: false,
                disableBranchNodes: false,
            }
            if (newValue !== oldValue) {
                if ([ 13, 5 ].includes(newValue)) {
                    this.dresList.forEach(dre => delete dre.children)
                }

                if (newValue == 6) {
                    this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
                        this.dresList = this.dres.all
                    })
                    this.form.agencies = []
                    this.dreOptions.selectMultiple = true
                }

                if (newValue == 11) {
                    this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
                        this.dresList = this.dres.all
                    })
                    this.dreOptions.disableBranchNodes = true
                }
            }
        }
    },
    computed: mapGetters({
        roles: 'roles/all',
        dres: 'dre/all'
    }),
    created() {
        this.$store.dispatch('settings/updatePageLoading', true)
        this.$store.dispatch('roles/fetchAll').then(() => {
            this.rolesList = this.roles.all
            this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
                this.dresList = this.dres.all
                this.$store.dispatch('settings/updatePageLoading', false)
            })
        })
    },
    methods: {
        create() {
            this.form.post('users').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                this.$swal.catchError(error)
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
