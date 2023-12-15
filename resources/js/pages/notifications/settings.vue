<template>
    <NLForm :action="updateNotifications" :form="notificationsForm">
        <NLColumn>
            <h2>Paramètres du centre des notifications</h2>
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
                            <NLSwitch label="Plateforme" v-model="notificationsForm[type.id].database_is_enabled" />
                        </NLColumn>
                        <NLColumn lg="2">
                            <NLSwitch label="Email" v-model="notificationsForm[type.id].email_is_enabled" />
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
</template>

<script>
import { Form } from 'vform'
import { mapGetters } from 'vuex'
export default {
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            notificationsForm: new Form({}),
            notificationsSettingsList: [],
        }
    },
    computed: {
        ...mapGetters({
            notifications: 'notifications/settings',
        }),
    },
    created() {
        this.$store.dispatch('notifications/fetchSettings', user().id).then(() => {
            this.notificationsSettingsList = this.notifications.settings
            this.initNotifications()
            this.$store.dispatch('settings/updatePageLoading', false)
        })
    },
    methods: {
        updateNotifications() {
            this.$swal.confirm_update().then((action) => {
                if (action.isConfirmed) {
                    this.notificationsForm.put('notifications/settings/' + user().id).then(response => {
                        if (response.data.status) {
                            this.$swal.toast_success(response.data.message)
                        } else {
                            this.$swal.alert_error(response.data.message)
                        }
                    }).catch(error => {
                        console.log(error)
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
    }
}
</script>

<style lang="scss" scoped></style>
