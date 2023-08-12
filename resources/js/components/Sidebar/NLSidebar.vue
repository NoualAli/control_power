<template>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="brand"></div>
            <div class="active-brand"></div>
        </div>
        <div class="sidebar-body">
            <div class="sidebar-title" />
            <NLSidebarItem label="Tableau de bord" route="home" iconName="la-tachometer-alt" />
            <NLSidebarItem label="Utilisateurs" route="users-index" iconName="la-users" v-if="can('view_page_users')" />
            <NLSidebarItem label="Roles" route="roles-index" iconName="la-user-shield" v-if="can('view_page_roles')" />
            <NLSidebarItem label="Permissions" route="permissions-index" iconName="la-user-cog"
                v-if="can('view_page_permissions')" />
            <!-- <NLSidebarSubmenu label="Gestion utilisateurs" iconName="la-users-cog">
            </NLSidebarSubmenu> -->
            <NLSidebarItem label="Dre" route="dre-index" iconName="la-building" v-if="can('view_page_dres')" />
            <NLSidebarItem label="Agences" route="agencies-index" iconName="la-landmark" v-if="can('view_page_agencies')" />
            <NLSidebarItem label="Catégories" route="categories-index" iconName="la-landmark"
                v-if="can('view_page_categories')" />
            <NLSidebarItem label="Familles" route="families-index" iconName="la-tag" v-if="can('view_page_families')" />
            <NLSidebarItem label="Domaines" route="domains-index" iconName="la-tags" v-if="can('view_page_domains')" />
            <NLSidebarItem label="Processus" route="processes-index" iconName="la-project-diagram"
                v-if="can('view_page_processes')" />
            <NLSidebarItem label="Points de contrôle" route="control-points-index" iconName="la-list-alt"
                v-if="can('view_page_control_points')" />
            <NLSidebarItem label="Répartition des missions de contrôle" route="missions-create" iconName="la-calendar-day"
                v-if="can('create_mission')" />
            <NLSidebarItem label="Ajouter une campagne de contrôle" route="campaigns-create" iconName="la-calendar-plus"
                v-if="can('create_control_campaign')" />
            <NLSidebarItem label="Suivi du planning annuel" route="campaigns" iconName="la-calendar"
                v-if="can('view_page_control_campaigns')" />
            <NLSidebarItem label="Suivi des réalisations des missions" route="missions" iconName="la-eye"
                v-if="can('view_page_missions')" />
            <NLSidebarItem label="Anomalie • Notation • Plan de redressement" route="global-details" iconPrefix="lab"
                iconName="la-stack-overflow" v-if="can('view_page_mission_details')" />
            <NLSidebarItem label="Faits majeur" route="major-facts" iconName="la-exclamation-triangle"
                v-if="can('view_page_major_facts')" />
            <!-- <NLSidebarItem label="Bugs" route="bugs-index" iconName="la-bug" /> -->
            <!-- <NLSidebarItem label="Validation des rapports" route="missions-not-validated" iconName="la-clipboard-check"
                v-if="can('validate_report')" /> -->
            <!-- <router-link v-if="can('view_page_major_facts,view_major_fact')" class="sidebar-item"
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
            <a href="logout" @click.prevent="logout" class="sidebar-item logout-btn">
                <i class="las la-sign-out-alt sidebar-icon"></i>
                <span class="sidebar-icon_text">
                    Déconnexion
                </span>
            </a>
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
    // data() {
    //     return {
    //         unreadMajorFacts: 0
    //     }
    // },
    watch: {
        // $route(to, from) {
        //   this.dispatch('notifications/fetchTotalUnreadMajorFacts').then(() => {
        //     this.unreadMajorFacts = this.$store.getters[ 'notifications/total_unread_major_facts' ].total_unread_major_facts
        //   })
        // },
        // unreadMajorFacts: (newVal, oldVal) => {
        //   if (newVal !== oldVal) {
        //     this.$store.dispatch('notifications/fetchTotalUnreadMajorFacts').then(() => {
        //       // this.unreadMajorFacts = newVal
        //     })
        //   }
        // }
    },
    methods: {
        async logout() {
            // Log out the user.
            await this.$store.dispatch('auth/logout')

            // Redirect to login.
            this.$router.push({ name: 'login' })
        }
    }
    // created() {
    //   this.$store.dispatch('notifications/fetchTotalUnreadMajorFacts').then(() => {
    //     this.unreadMajorFacts = this.$store.getters[ 'notifications/total_unread_major_facts' ].total_unread_major_facts
    //   })
    // },
}
</script>
