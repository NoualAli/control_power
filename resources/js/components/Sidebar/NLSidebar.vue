<template>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="brand"></div>
            <div class="active-brand"></div>
        </div>
        <div class="sidebar-body">
            <div class="sidebar-title" />
            <NLSidebarItem label="Tableau de bord" route="home" iconName="dashboard">
            </NLSidebarItem>

            <NLSidebarItem label="Répartition des missions" route="missions-create" iconName="calendar_add_on"
                v-if="can('create_mission')" />
            <NLSidebarItem label="Nouvelle campagne" route="campaigns-create" iconName="calendar_add_on"
                v-if="can('create_control_campaign')">
            </NLSidebarItem>
            <NLSidebarItem label="Planning annuel" route="campaigns" iconName="calendar_month"
                v-if="can('view_control_campaign')">
            </NLSidebarItem>
            <NLSidebarItem label="Suivi des missions" route="missions" iconName="visibility" v-if="can('view_mission')">
            </NLSidebarItem>
            <NLSidebarItem label="Plans de redressement" route="anomalies" iconPrefix="lab" iconName="breaking_news"
                v-if="can('view_mission_detail')">
            </NLSidebarItem>
            <NLSidebarItem label="Faits majeurs" route="major-facts" iconName="brightness_alert"
                v-if="can('view_major_fact')">
            </NLSidebarItem>
            <NLSidebarItem label="Références" route="references-pcf" iconName="quick_reference_all">
            </NLSidebarItem>

            <NLSidebarSubmenu iconName="manage_accounts" label="Gestion utilisateurs"
                v-if="(can('view_user') || can('view_role') || can('view_module')) && is(['root', 'admin'])">
                <NLSidebarItem label="Utilisateurs" route="users-index" iconName="group" v-if="can('view_user')">
                </NLSidebarItem>
                <NLSidebarItem label="Roles" route="roles-index" iconName="shield_person" v-if="can('view_role')">
                </NLSidebarItem>
                <NLSidebarItem label="Modules" route="modules-index" iconName="shield_lock" v-if="can('view_module')">
                </NLSidebarItem>
            </NLSidebarSubmenu>

            <NLSidebarItem label="Utilisateurs" route="users-index" iconName="group"
                v-if="can('view_user') && !is(['root', 'admin'])">
            </NLSidebarItem>

            <NLSidebarSubmenu iconName="location_city" label="Localisations"
                v-if="can('view_dre') || can('view_agency') || can('view_category')">
                <NLSidebarItem label="DRE" route="dre-index" iconName="domain" v-if="can('view_dre')">
                </NLSidebarItem>
                <NLSidebarItem label="Agences" route="agencies-index" iconName="account_balance" v-if="can('view_agency')">
                </NLSidebarItem>
                <NLSidebarItem label="Catégories" route="categories-index" iconName="tag" v-if="can('view_category')">
                </NLSidebarItem>
            </NLSidebarSubmenu>

            <NLSidebarSubmenu iconName="tune" label="Gestion PCF"
                v-if="can('view_family') || can('view_domain') || can('view_process') || can('view_control_point') || can('view_field')">
                <NLSidebarItem label="Familles" route="families-index" iconName="tenancy" v-if="can('view_family')">
                </NLSidebarItem>
                <NLSidebarItem label="Domaines" route="domains-index" iconName="network_node" v-if="can('view_domain')">
                </NLSidebarItem>
                <NLSidebarItem label="Processus" route="processes-index" iconName="account_tree" v-if="can('view_process')">
                </NLSidebarItem>
                <NLSidebarItem label="Points de contrôle" route="control-points-index" iconName="list"
                    v-if="can('view_control_point')">
                </NLSidebarItem>
                <NLSidebarItem label="Champs" route="fields-index" iconName="dataset" v-if="can('view_field')">
                </NLSidebarItem>
                <NLSidebarItem label="Textes réglementaires" route="pcf-management" iconName="quick_reference_all"
                    v-if="can('view_field')">
                </NLSidebarItem>
            </NLSidebarSubmenu>

            <NLSidebarSubmenu iconName="dns" label="Gestion serveur" v-if="is('root')">
                <NLSidebarItem label="Backup DB" route="admin-backup-db" v-if="is('root')" iconName="database">
                </NLSidebarItem>
                <NLSidebarItem label="Fichiers" route="admin-server-files" v-if="is('root')" iconName="storage">
                </NLSidebarItem>
                <a class="sidebar-item" href="/log-viewer" target="_blank" v-if="is('root')">
                    <NLIcon name="description" />
                    <span class="sidebar-icon_text">
                        Logs
                    </span>
                </a>
                <a class="sidebar-item" href="/env-editor" target="_blank" v-if="is('root')">
                    <NLIcon name="settings_applications" />
                    <span class="sidebar-icon_text">
                        .env
                    </span>
                </a>
            </NLSidebarSubmenu>
        </div>

        <div class="sidebar-footer">
            <a href="logout" @click.prevent="logout" class="sidebar-item logout-btn" :class="{ 'is-loading': isLogout }"
                v-if="!isLogout">
                <NLIcon name="logout" v-if="!isLogout" class="sidebar-icon" />
                <!-- <i class="las la-sign-out-alt sidebar-icon" v-if="!isLogout"></i> -->
                <i class="las la-spinner la-spin sidebar-icon" v-else></i>
                <!-- <span class="sidebar-icon_text" v-if="!isLogout">
                    Déconnexion
                </span>
                <span class="sidebar-icon_text" v-else>Déconnexion en cours</span> -->
            </a>
            <div class="sidebar-item logout-btn" :class="{ 'is-loading': isLogout }" v-else>
                <i class="las la-spinner la-spin sidebar-icon"></i>
                <!-- <span class="sidebar-icon_text">Déconnexion en cours</span> -->
            </div>
        </div>
    </div>
</template>

<script>
import NLIcon from '../NLIcon'
// import { Store } from 'vuex'
import NLSidebarItem from './NLSidebarItem.vue'
import NLSidebarSubmenu from './NLSidebarSubmenu.vue'
export default {
    name: "NLSidebar",
    components: {
        NLIcon, NLSidebarItem, NLSidebarSubmenu
    },
    data() {
        return {
            isLogout: false
        }
    },
    methods: {
        async logout() {
            this.isLogout = true
            // Log out the user.
            await this.$store.dispatch('auth/logout')

            localStorage.clear()
            // Redirect to login.
            this.$router.push({ name: 'login' })
        }
    }
}
</script>
