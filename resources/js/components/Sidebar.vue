<template>
  <div class="sidebar">
    <div class="sidebar-header" />
    <div class="sidebar-body">
      <div class="sidebar-title" />
      <router-link class="sidebar-item" :to="{ name: 'home' }">
        <i class="las la-tachometer-alt sidebar-icon" />
        <span class="icon-text">
          Tableau de bord
        </span>
      </router-link>
      <router-link v-if="can('view_page_users')" class="sidebar-item" :to="{ name: 'users-index' }">
        <i class="las la-users sidebar-icon" />
        <span class="icon-text">
          Utilisateurs
        </span>
      </router-link>
      <router-link v-if="can('view_page_roles')" class="sidebar-item" :to="{ name: 'roles-index' }">
        <i class="las la-user-shield sidebar-icon" />
        <span class="icon-text">
          Roles
        </span>
      </router-link>
      <router-link v-if="can('view_page_permissions')" class="sidebar-item" :to="{ name: 'permissions-index' }">
        <i class="las la-user-cog sidebar-icon" />
        <span class="icon-text">
          Permissions
        </span>
      </router-link>
      <router-link v-if="can('view_page_dres')" class="sidebar-item" :to="{ name: 'dre-index' }">
        <i class="las la-building sidebar-icon" />
        <span class="icon-text">
          Dre
        </span>
      </router-link>
      <router-link v-if="can('view_page_agencies')" class="sidebar-item" :to="{ name: 'agencies-index' }">
        <i class="las la-landmark sidebar-icon" />
        <span class="icon-text">
          Agences
        </span>
      </router-link>
      <router-link v-if="can('view_page_categories')" class="sidebar-item" :to="{ name: 'categories-index' }">
        <i class="las la-landmark sidebar-icon" />
        <span class="icon-text">
          Catégories
        </span>
      </router-link>
      <router-link v-if="can('view_page_families')" class="sidebar-item" :to="{ name: 'famillies-index' }">
        <i class="las la-tag sidebar-icon" />
        <span class="icon-text">
          Familles
        </span>
      </router-link>
      <router-link v-if="can('view_page_domains')" class="sidebar-item" :to="{ name: 'domains-index' }">
        <i class="las la-tags sidebar-icon" />
        <span class="icon-text">
          Domaines
        </span>
      </router-link>

      <router-link v-if="can('view_page_processes')" class="sidebar-item" :to="{ name: 'processes-index' }">
        <i class="las la-project-diagram sidebar-icon" />
        <span class="icon-text">
          Processus
        </span>
      </router-link>

      <router-link v-if="can('view_page_control_points')" class="sidebar-item" :to="{ name: 'control-points-index' }">
        <i class="las la-list-alt sidebar-icon" />
        <span class="icon-text">
          Points de contrôle
        </span>
      </router-link>

      <router-link v-if="can('create_mission')" class="sidebar-item" :to="{ name: 'missions-create' }">
        <i class="las la-calendar-day sidebar-icon" />
        <span class="icon-text">
          Répartition des missions de contrôle
        </span>
      </router-link>

      <router-link v-if="can('create_control_campaign')" class="sidebar-item" :to="{ name: 'campaigns-create' }">
        <i class="las la-calendar-plus sidebar-icon" />
        <span class="icon-text">
          Ajouter une campagne de contrôle
        </span>
      </router-link>

      <router-link v-if="can('view_page_control_campaigns')" class="sidebar-item" :to="{ name: 'campaigns' }">
        <i class="las la-calendar sidebar-icon" />
        <span class="icon-text">
          Suivi du planning annuel
        </span>
      </router-link>

      <router-link v-if="can('view_page_missions')" class="sidebar-item" :to="{ name: 'missions' }">
        <i class="las la-eye sidebar-icon" />
        <span class="icon-text">
          Suivi des réalisations des missions
        </span>
      </router-link>

      <router-link v-if="can('view_page_mission_details')" class="sidebar-item" :to="{ name: 'global-details' }">
        <i class="lab la-stack-overflow sidebar-icon" />
        <span class="icon-text">
          Anomalie • Notation • Plan de redressement
        </span>
      </router-link>

      <router-link
        v-if="can('view_page_major_facts,view_major_fact')" class="sidebar-item" :class="{ 'has-badge': unreadMajorFacts }"
        :to="{ name: 'major-facts' }"
      >
        <i class="las la-exclamation-triangle sidebar-icon" />
        <span class="icon-text">
          Faits majeur
        </span>
        <div v-if="unreadMajorFacts" class="badge is-blink">
          {{ unreadMajorFacts }}
        </div>
      </router-link>

      <router-link v-if="can('validate_report')" class="sidebar-item" :to="{ name: 'missions-not-validated' }">
        <i class="las la-clipboard-check sidebar-icon" />
        <span class="icon-text">
          Validation des rapports
        </span>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'references-pcf' }">
        <i class="las la-newspaper sidebar-icon" />
        <span class="icon-text">
          Références PCF
        </span>
      </router-link>
    </div>

    <div class="sidebar-footer d-flex justify-center align-center">
      <a href="logout" class="sidebar-item logout-btn" @click.prevent="logout">
        <i class="las la-sign-out-alt sidebar-icon" />
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
  data () {
    return {
      unreadMajorFacts: 0
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
  methods: {
    async logout () {
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
