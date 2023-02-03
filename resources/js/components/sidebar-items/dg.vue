<template>
  <div>
    <div>
      <router-link class="sidebar-item" :to="{ name: 'home' }">
        <i class="las la-tachometer-alt sidebar-icon"></i>
        <span class="icon-text">
          Tableau de bord
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'campaigns' }">
        <i class="las la-calendar sidebar-icon"></i>
        <span class="icon-text">
          Suivi du planning annuel
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'missions-state' }">
        <i class="las la-question-circle sidebar-icon"></i>
        <span class="icon-text">
          État des missions
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'missions-validated' }">
        <i class="las la-file-alt sidebar-icon"></i>
        <span class="icon-text">
          Consultation des synthèse
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'global-details' }">
        <i class="lab la-stack-overflow sidebar-icon"></i>
        <span class="icon-text">
          Anomalie • Notation • Plan de redressement
        </span>
      </router-link>
      <router-link class="sidebar-item" :class="{ 'has-badge': unreadMajorFacts }" :to="{ name: 'major-facts' }">
        <i class="las la-exclamation-triangle sidebar-icon"></i>
        <span class="icon-text">
          Faits majeurs
        </span>
        <div class="badge is-blink" v-if="unreadMajorFacts">{{ unreadMajorFacts }}</div>
      </router-link>
      <router-link class="sidebar-item" to="#">
        <i class="las la-user-secret sidebar-icon"></i>
        <span class="icon-text">
          Missions inopinées
        </span>
      </router-link>
      <router-link class="sidebar-item" :to="{ name: 'references-pcf' }">
        <i class="las la-newspaper sidebar-icon"></i>
        <span class="icon-text">
          Références PCF
        </span>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    unreadMajorFacts: { type: Number, default: 0 }
  }
}
</script>
