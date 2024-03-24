<template>
    <div v-if="can('edit_user')">
        <ContentBody>
            <NLGrid class="my-4">
                <!-- Update User informations -->
                <NLColumn>
                    <NLForm :action="updateInfos" :form="form">
                        <NLColumn>
                            <h2>Informations du compte</h2>
                        </NLColumn>
                        <!-- Firstname -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.first_name" :form="form" name="first_name" label="Prénom"
                                labelRequired :length="50" />
                        </NLColumn>

                        <!-- Lastname -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.last_name" :form="form" name="last_name" label="Nom de famille"
                                labelRequired :length="50" />
                        </NLColumn>

                        <!-- Registration number -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.registration_number" :form="form" name="registration_number"
                                label="Matricule" type="number" :length="5" />
                        </NLColumn>

                        <!-- Username -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.username" :form="form" name="username" label="Nom d'utilisateur"
                                labelRequired :length="30" />
                        </NLColumn>

                        <!-- Email -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.email" :form="form" name="email" label="Adresse e-mail" type="email"
                                labelRequired :length="100" />
                        </NLColumn>

                        <!-- Phone -->
                        <NLColumn lg="6" md="6">
                            <NLInput v-model="form.phone" :form="form" name="phone" label="N° de téléphone"
                                type="phone" />
                        </NLColumn>


                        <!-- Role -->
                        <NLColumn lg="6" md="6">
                            <NLSelect v-model="form.role" :form="form" name="role" label="Rôle"
                                placeholder="Choisissez un rôle" :options="rolesList" labelRequired />
                        </NLColumn>

                        <!-- Structures -->
                        <NLColumn lg="6" md="6" v-if="this.showStructures">
                            <NLSelect v-model="form.structures" :form="form" name="structures" label="Structures"
                                :options="structuresList" placeholder="Choisissez une structure"
                                :multiple="structuresOptions.selectMultiple"
                                :disableBranchNodes="structuresOptions.disableBranchNodes" />
                        </NLColumn>

                        <!-- Gender -->
                        <NLColumn lg="6" md="6">
                            <NLSelect v-model="form.gender" :form="form" name="gender" label="Genre"
                                placeholder="Choisissez un genre" :options="gendersList" labelRequired />
                        </NLColumn>
                        <NLColumn></NLColumn>

                        <!-- Active -->
                        <NLColumn v-if="showIsActiveSwitch" lg="6">
                            <NLSwitch v-model="form.is_active" name="is_active" :form="form"
                                label="Le compte est activé ?" type="is-success" />
                        </NLColumn>
                        <!-- Testing -->
                        <!-- <NLColumn lg="6">
                            <NLSwitch v-model="form.is_for_testing" name="is_for_testing" :form="form"
                                label="Utilisateur TEST" type="is-success" />
                        </NLColumn> -->

                        <NLColumn>
                            <NLFlex lgJustifyContent="end">
                                <NLButton :loading="form.busy" label="Mettre à jour" />
                            </NLFlex>
                        </NLColumn>

                    </NLForm>
                </NLColumn>

                <!-- Update Password -->
                <NLColumn>
                    <NLForm :action="updatePassword" :form="passwordForm">
                        <NLColumn>
                            <h2>Mot de passe</h2>
                        </NLColumn>
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

                <!-- Update notifications -->
                <NLColumn>
                    <NLForm :action="updateNotifications" :form="notificationsForm">
                        <NLColumn>
                            <h2>Notifications</h2>
                        </NLColumn>
                        <NLColumn v-for="(notification, groupIndex) in notificationsSettingsList">
                            <NLGrid>
                                <NLColumn>
                                    <h3>{{ notification.label }}</h3>
                                </NLColumn>
                                <NLColumn v-for="(type, typeIndex) in notification.settings">
                                    <NLGrid extraClass="border-bottom-1 border-primary">
                                        <NLColumn lg="8">
                                            <NLFlex extraClass="w-100 h-100" alignItems="center">
                                                <b>{{ type.label }}</b>
                                            </NLFlex>
                                        </NLColumn>
                                        <NLColumn lg="2">
                                            <NLSwitch label="Plateforme"
                                                v-model="notificationsForm[type.id].database_is_enabled" />
                                        </NLColumn>
                                        <NLColumn lg="2">
                                            <NLSwitch label="Email"
                                                v-model="notificationsForm[type.id].email_is_enabled" />
                                        </NLColumn>
                                    </NLGrid>
                                </NLColumn>
                            </NLGrid>
                        </NLColumn>
                        <NLColumn>
                            <NLFlex lgJustifyContent="end">
                                <NLButton :loading="notificationsForm.busy" label="Mettre à jour" />
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
                phone: null,
                role: null,
                structures: [],
                is_active: true,
                gender: true,
                is_active: true,
                registration_number: null,
                is_for_testing: false,
            }),
            passwordForm: new Form({
                password: null,
                password_confirmation: null
            }),
            notificationsForm: new Form({}),
            structuresList: [],
            showStructures: false,
            rolesList: [],
            notificationsSettingsList: [],
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
            structuresOptions: {
                selectMultiple: false,
                disableBranchNodes: false,
            },
            showIsActiveSwitch: hasRole([ 'root', 'admin' ]),
        }
    },
    computed: {
        ...mapGetters({
            user: 'users/current',
            dres: 'dre/all',
            regionalInspections: 'regionalInspections/all',
            roles: 'roles/all',
            notifications: 'notifications/settings',
        }),
    },
    watch: {
        /**
         * Manage DRE display and options
         * @param {Numeric | null} newValue
         * @param {Numeric|null} oldValue
         */
        "form.role"(newValue, oldValue) {
            if (newValue !== oldValue) {
                this.initStructures(newValue)
            }
        }
    },
    created() {
        this.initData()
    },
    methods: {
        initData() {
            this.$store.dispatch('settings/updatePageLoading', true)
            this.$store.dispatch('roles/fetchAll').then(() => {
                this.rolesList = this.roles.all
                this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
                    this.structuresList = this.dres.all
                    this.$store.dispatch('users/fetch', this.$route.params.user).then(() => {
                        this.form.username = this.user.current.username
                        this.form.email = this.user.current.email
                        this.form.first_name = this.user.current.first_name
                        this.form.last_name = this.user.current.last_name
                        this.form.phone = this.user.current.phone
                        this.form.is_active = this.user.current.is_active
                        this.form.gender = this.user.current.gender
                        this.form.registration_number = this.user.current.registration_number
                        this.form.is_for_testing = this.user.current.is_for_testing
                        this.form.role = this.user.current.active_role_id

                        if ([ 13, 5 ].includes(Number(this.user.current.active_role_id))) {
                            this.showStructures = true
                            this.form.structures = 'd-' + this.user?.current?.dres[ 0 ]?.id
                        }
                        if (Number(this.user.current.active_role_id) == 6) {
                            this.showStructures = true
                            this.form.structures = this.user?.current?.agencies.map(item => item.id)
                        }
                        if (Number(this.user.current.active_role_id) == 11) {
                            this.showStructures = true
                            this.form.structures = this.user?.current?.agencies[ 0 ]?.id
                        }

                        if (Number(this.user.current.active_role_id) == 19) {
                            this.showStructures = true
                            this.form.structures = this.user?.current?.regional_inspections[ 0 ]?.id
                        }

                        this.initStructures(Number(this.user.current.active_role_id))
                        this.$store.dispatch('notifications/fetchSettings', this.user.current.id).then(() => {
                            this.notificationsSettingsList = this.notifications.settings
                            this.initNotifications()
                            this.$store.dispatch('settings/updatePageLoading', false)
                        })
                    })
                })
            })
        },
        updateInfos() {
            this.$swal.confirm_update().then((action) => {
                if (action.isConfirmed) {
                    this.form.put('users/info/' + this.user.current.id).then(response => {
                        if (response.data.status) {
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                    }).catch(error => {
                        this.$swal.catchError(error)
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
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                    }).catch(error => {
                        this.$swal.catchError(error)
                    })
                }
            })
        },
        updateNotifications() {
            this.$swal.confirm_update().then((action) => {
                if (action.isConfirmed) {
                    this.notificationsForm.put('notifications/settings/' + this.user.current.id).then(response => {
                        if (response.data.status) {
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                    }).catch(error => {
                        this.$swal.catchError(error)
                    })
                }
            })
        },
        initNotifications() {
            this.notificationsSettingsList.forEach(group => {
                group.settings.forEach(setting => {
                    this.notificationsForm[ setting.id ] = {
                        'database_is_enabled': setting?.database_is_enabled == '1',
                        'email_is_enabled': setting?.email_is_enabled == '1'
                    }
                })
            })
        },
        initStructures(value, oldValue) {
            // 11 -> da -> accès à une seule agence à la fois -> Selection agence uniquement
            // 6 -> ci -> accès à toutes les agences -> Selection agence uniquement
            // 13 -> dre -> accès à toutes les agences -> Selection DRE uniquement
            // 5 -> cdc -> accès à toutes les agences -> Selection DRE uniquement
            // this.form.structures = null
            this.structuresOptions = {
                selectMultiple: false,
                disableBranchNodes: false,
            }
            if ([ 13, 5 ].includes(value)) {
                this.showStructures = true
                this.structuresList.forEach(dre => delete dre.children)
            }

            if (value == 6) {
                this.showStructures = true
                this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
                    this.structuresList = this.dres.all
                })
                this.structuresOptions.selectMultiple = true
            }

            if (value == 11) {
                this.showStructures = true
                this.$store.dispatch('dre/fetchAll', { withAgencies: true }).then(() => {
                    this.structuresList = this.dres.all
                })
                this.structuresOptions.disableBranchNodes = true
            }

            if (value == 19) {
                this.$store.dispatch('regionalInspections/fetchAll').then(() => {
                    this.structuresList = this.regionalInspections.all
                })
            }
        }
    }
}
</script>
