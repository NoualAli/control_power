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
      <router-link class="sidebar-item" :to="{ name: 'users-index' }" v-can="'view_user'">
        <i class="las la-users sidebar-icon"></i>
        <span class="icon-text">
          Utilisateurs
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'roles-index' }" v-can="'view_role'">
        <i class="las la-user-shield sidebar-icon"></i>
        <span class="icon-text">
          Roles
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'permissions-index' }" v-can="'view_permission'">
        <i class="las la-user-cog sidebar-icon"></i>
        <span class="icon-text">
          Permissions
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'dre-index' }" v-can="'view_dre'">
        <i class="las la-building sidebar-icon"></i>
        <span class="icon-text">
          Dre
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'agencies-index' }" v-can="'view_agency'">
        <i class="las la-landmark sidebar-icon"></i>
        <span class="icon-text">
          Agences
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'famillies-index' }" v-can="'view_familly'">
        <i class="las la-tag sidebar-icon"></i>
        <span class="icon-text">
          Familles
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'domains-index' }" v-can="'view_domain'">
        <i class="las la-tags sidebar-icon"></i>
        <span class="icon-text">
          Domaines
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'processes-index' }" v-can="'view_process'">
        <i class="las la-project-diagram sidebar-icon"></i>
        <span class="icon-text">
          Processus
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'control-points-index' }" v-can="'view_control_point'">
        <i class="las la-list-alt sidebar-icon"></i>
        <span class="icon-text">
          Points de contrôle
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'missions-create' }" v-can="'create_mission'">
        <i class="las la-calendar-day sidebar-icon"></i>
        <span class="icon-text">
          Répartition des missions de contrôle
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'campaigns-create' }" v-can="'create_control_campaign'">
        <i class="las la-calendar-plus sidebar-icon"></i>
        <span class="icon-text">
          Ajouter une campagne de contrôle
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'campaigns' }" v-can="'view_control_campaign'">
        <i class="las la-calendar sidebar-icon"></i>

        <span class="icon-text">
          Suivi du planning annuel
        </span>
      </router-link>
      <!-- <router-link class="sidebar-item" :to="{ name: 'missions-state' }" v-can="'view_mission'">
        <i class="las la-question-circle sidebar-icon"></i>
        <span class="icon-text">
          État des missions
        </span>
      </router-link> -->
      <router-link class="sidebar-item" :to="{ name: 'missions' }" v-can="'view_mission'">
        <i class="las la-eye sidebar-icon"></i>
        <span class="icon-text">
          Suivi des réalisations des missions
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'missions-validated' }" v-can="'view_mission'">
        <i class="las la-file-alt sidebar-icon"></i>
        <span class="icon-text">
          Consultation des rapports
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'global-details' }" v-can="'view_mission'">
        <i class="lab la-stack-overflow sidebar-icon"></i>
        <span class="icon-text">
          Anomalie • Notation • Plan de redressement
        </span>
      </router-link>
      <router-link class="sidebar-item" :class="{ 'has-badge': unreadMajorFacts }" :to="{ name: 'major-facts' }"
        v-can="'view_major_fact'">
        <i class="las la-exclamation-triangle sidebar-icon"></i>
        <span class="icon-text">
          Faits majeurs
        </span>
        <div class="badge is-blink" v-if="unreadMajorFacts">{{ unreadMajorFacts }}</div>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'missions-not-validated' }" v-can="'validate_report'">
        <i class="las la-clipboard-check sidebar-icon"></i>
        <span class="icon-text">
          Validation des rapports
        </span>
      </router-link>

      <router-link class="sidebar-item" :to="{ name: 'missions-validated' }" v-can="'view_report'">
        <i class="las la-clipboard-list sidebar-icon"></i>
        <span class="icon-text">
          Consultation des rapports
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
    $route(to, from) {
      this.$store.dispatch('notifications/fetchTotalUnreadMajorFacts').then(() => {
        this.unreadMajorFacts = this.$store.getters[ 'notifications/total_unread_major_facts' ].total_unread_major_facts
      })
    }
  },
  created() {
    this.$store.dispatch('notifications/fetchTotalUnreadMajorFacts').then(() => {
      this.unreadMajorFacts = this.$store.getters[ 'notifications/total_unread_major_facts' ].total_unread_major_facts
    })
  },
}
</script>
