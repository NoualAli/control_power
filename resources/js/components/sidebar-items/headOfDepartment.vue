<template>
  <div>
    <router-link class="sidebar-item" :to="{ name: 'home' }">
      <i class="las la-tachometer-alt sidebar-icon"></i>
      <span class="icon-text">
        Tableau de bord
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'missions-create' }">
      <i class="las la-calendar-day sidebar-icon"></i>
      <span class="icon-text">
        Répartition des missions de contrôle
      </span>
    </router-link>

    <router-link class="sidebar-item" :to="{ name: 'missions' }">
      <i class="las la-eye sidebar-icon"></i>
      <span class="icon-text">
        Suivi des réalisations des missions
      </span>
    </router-link>

    <router-link class="sidebar-item" :to="{ name: 'missions-not-validated' }">
      <i class="las la-clipboard-check sidebar-icon"></i>
      <span class="icon-text">
        Validation des rapports
      </span>
    </router-link>

    <router-link class="sidebar-item" :to="{ name: 'missions-validated' }">
      <i class="las la-clipboard-list sidebar-icon"></i>
      <span class="icon-text">
        Consultation des rapports
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'major-facts' }">
      <i class="las la-exclamation-triangle sidebar-icon"></i>
      <span class="icon-text">
        Faits majeurs
      </span>
    </router-link>

    <router-link class="sidebar-item" :to="{ name: 'references-pcf' }">
      <i class="las la-newspaper sidebar-icon"></i>
      <span class="icon-text">
        Références PCF
      </span>
    </router-link>
  </div>
</template>
