<template>
  <div class="sidebar">
    <div class="sidebar-header">
    </div>
    <div class="sidebar-body">
      <div class="sidebar-title">

      </div>
      <router-link class="sidebar-item" :to="{ name: 'home' }">
        <i class="las la-tachometer-alt sidebar-icon"></i>
        <span class="icon-text">
          Tableau de bord
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'users-index' }" v-if="can('view_page_users')">
        <i class="las la-users sidebar-icon"></i>
        <span class="icon-text">
          Utilisateurs
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'roles-index' }" v-if="can('view_page_roles')">
        <i class="las la-user-shield sidebar-icon"></i>
        <span class="icon-text">
          Roles
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'permissions-index' }" v-if="can('view_page_permissions')">
        <i class="las la-user-cog sidebar-icon"></i>
        <span class="icon-text">
          Permissions
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'dre-index' }" v-if="can('view_page_dres')">
        <i class="las la-building sidebar-icon"></i>
        <span class="icon-text">
          Dre
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'agencies-index' }" v-if="can('view_page_agencies')">
        <i class="las la-landmark sidebar-icon"></i>
        <span class="icon-text">
          Agences
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'famillies-index' }" v-if="can('view_page_families')">
        <i class="las la-tag sidebar-icon"></i>
        <span class="icon-text">
          Familles
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'domains-index' }" v-if="can('view_page_domains')">
        <i class="las la-tags sidebar-icon"></i>
        <span class="icon-text">
          Domaines
        </span>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'processes-index' }" v-if="can('view_page_processes')">
        <i class="las la-project-diagram sidebar-icon"></i>
        <span class="icon-text">
          Processus
        </span>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'control-points-index' }" v-if="can('view_page_control_points')">
        <i class="las la-list-alt sidebar-icon"></i>
        <span class="icon-text">
          Points de contrôle
        </span>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'missions-create' }" v-if="can('create_mission')">
        <i class="las la-calendar-day sidebar-icon"></i>
        <span class="icon-text">
          Répartition des missions de contrôle
        </span>
      </router-link>


      <router-link class="sidebar-item" :to="{ name: 'campaigns-create' }" v-if="can('create_control_campaign')">
        <i class="las la-calendar-plus sidebar-icon"></i>
        <span class="icon-text">
          Ajouter une campagne de contrôle
        </span>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'campaigns' }" v-if="can('view_page_control_campaigns')">
        <i class="las la-calendar sidebar-icon"></i>
        <span class="icon-text">
          Suivi du planning annuel
        </span>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'missions' }" v-if="can('view_page_missions')">
        <i class="las la-eye sidebar-icon"></i>
        <span class="icon-text">
          Suivi des réalisations des missions
        </span>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'global-details' }" v-if="can('view_page_mission_details')">
        <i class="lab la-stack-overflow sidebar-icon"></i>
        <span class="icon-text">
          Anomalie • Notation • Plan de redressement
        </span>
      </router-link>

      <router-link class="sidebar-item" :class="{ 'has-badge': unreadMajorFacts }" :to="{ name: 'major-facts' }"
        v-if="can('view_page_major_facts,view_major_fact')">
        <i class="las la-exclamation-triangle sidebar-icon"></i>
        <span class="icon-text">
          Faits majeur
        </span>
        <div class="badge is-blink" v-if="unreadMajorFacts">{{ unreadMajorFacts }}</div>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'missions-not-validated' }" v-if="can('validate_report')">
        <i class="las la-clipboard-check sidebar-icon"></i>
        <span class="icon-text">
          Validation des rapports
        </span>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'references-pcf' }">
        <i class="las la-newspaper sidebar-icon"></i>
        <span class="icon-text">
          Références PCF
        </span>
      </router-link>
    </div>

    <div class="sidebar-footer d-flex justify-center align-center">
      <a href="logout" @click.prevent="logout" class="sidebar-item logout-btn">
        <i class="las la-sign-out-alt sidebar-icon"></i>
        <span class="icon-text">
          {{ $t('logout') }}
        </span>
      </a>
    </div>
  </div>
</template>

<script>
import { Store } from 'vuex'
export default {
  data() {
    return {
      unreadMajorFacts: 0,
    }
  },
  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  },
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
  // created() {
  //   this.$store.dispatch('notifications/fetchTotalUnreadMajorFacts').then(() => {
  //     this.unreadMajorFacts = this.$store.getters[ 'notifications/total_unread_major_facts' ].total_unread_major_facts
  //   })
  // },
}
</script>
