<template>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="brand"></div>
            <div class="active-brand"></div>
        </div>
        <div class="sidebar-body">
            <div class="sidebar-title" />
            <NLSidebarItem label="Tableau de bord" route="home" iconName="la-tachometer-alt" />
            <NLSidebarItem label="Utilisateurs" route="users-index" iconName="la-users" v-if="can('view_user')" />
            <NLSidebarItem label="Roles" route="roles-index" iconName="la-user-shield" v-if="can('view_role')" />
            <NLSidebarItem label="Modules" route="modules-index" iconName="la-user-cog" v-if="can('view_module')" />
            <NLSidebarItem label="Localisations" route="locations-index" iconName="la-building"
                v-if="can('view_location')" />
            <!-- <NLSidebarItem label="Dre" route="dre-index" iconName="la-building" v-if="can('view_dres')" />
            <NLSidebarItem label="Agences" route="agencies-index" iconName="la-landmark" v-if="can('view_agencies')" /> -->
            <!-- <NLSidebarItem label="Catégories" route="categories-index" iconName="la-landmark"
                v-if="can('view_categories')" /> -->
            <NLSidebarItem label="Familles" route="families-index" iconName="la-tag" v-if="can('view_family')" />
            <NLSidebarItem label="Domaines" route="domains-index" iconName="la-tags" v-if="can('view_domain')" />
            <NLSidebarItem label="Processus" route="processes-index" iconName="la-project-diagram"
                v-if="can('view_process')" />
            <NLSidebarItem label="Points de contrôle" route="control-points-index" iconName="la-list-alt"
                v-if="can('view_control_point')" />
            <NLSidebarItem label="Champs" route="fields-index" iconPrefix="lab" iconName="la-wpforms"
                v-if="can('view_field')" />
            <NLSidebarItem label="Répartition des missions de contrôle" route="missions-create" iconName="la-calendar-day"
                v-if="can('create_mission')" />
            <NLSidebarItem label="Ajouter une campagne de contrôle" route="campaigns-create" iconName="la-calendar-plus"
                v-if="can('create_control_campaign')" />
            <NLSidebarItem label="Suivi du planning annuel" route="campaigns" iconName="la-calendar"
                v-if="can('view_control_campaign')" />
            <NLSidebarItem label="Suivi des réalisations des missions" route="missions" iconName="la-eye"
                v-if="can('view_mission')" />
            <NLSidebarItem label="Anomalie • Notation • Plan de redressement" route="global-details" iconPrefix="lab"
                iconName="la-stack-overflow" v-if="can('view_mission_details')" />
            <NLSidebarItem label="Faits majeur" route="major-facts" iconName="la-exclamation-triangle"
                v-if="can('view_major_fact')" />
            <NLSidebarItem label="Backup DB" route="admin-backup-db" v-if="is('root')" iconName="la-database" />
            <NLSidebarItem label="Fichiers" route="admin-server-files" v-if="is('root')" iconName="la-file-alt" />
            <a class="sidebar-item" href="/log-viewer" target="_blank" v-if="is('root')">
                <i class="las la-bug sidebar-icon"></i>
                <span class="sidebar-icon_text">
                    Logs
                </span>
            </a>
            <!-- <NLSidebarItem label="Bugs" route="bugs-index" iconName="la-bug" /> -->
            <!-- <NLSidebarItem label="Validation des rapports" route="missions-not-validated" iconName="la-clipboard-check"
                v-if="can('validate_report')" /> -->
            <!-- <router-link v-if="can('view_major_facts,view_major_fact')" class="sidebar-item"
                :class="{ 'has-badge': unreadMajorFacts }" :to="{ name: 'major-facts' }">
                <i class="las la-exclamation-triangle sidebar-icon" />
                <span class="icon-text">
                    Faits majeur
                </span>
                <div v-if="unreadMajorFacts" class="badge is-blink">
                    {{ unreadMajorFacts }}
                </div>
            </router-link> -->

            <NLSidebarItem label="Références PCF" route="references-pcf" iconName="la-newspaper" />
        </div>

        <div class="sidebar-footer">
            <a href="logout" @click.prevent="logout" class="sidebar-item logout-btn" :class="{ 'is-loading': isLogout }"
                v-if="!isLogout">
                <i class="las la-sign-out-alt sidebar-icon" v-if="!isLogout"></i>
                <i class="las la-spinner la-spin sidebar-icon" v-else></i>
                <span class="sidebar-icon_text" v-if="!isLogout">
                    Déconnexion
                </span>
                <span class="sidebar-icon_text" v-else>Déconnexion en cours</span>
            </a>
            <div class="sidebar-item logout-btn" :class="{ 'is-loading': isLogout }" v-else>
                <i class="las la-spinner la-spin sidebar-icon"></i>
                <span class="sidebar-icon_text">Déconnexion en cours</span>
            </div>
        </div>
    </div>
</template>

<script>
// import { Store } from 'vuex'
import NLSidebarItem from './NLSidebarItem.vue'
import NLSidebarSubmenu from './NLSidebarSubmenu.vue'
export default {
    name: "NLSidebar",
    components: { NLSidebarItem, NLSidebarSubmenu },
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
