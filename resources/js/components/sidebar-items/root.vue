<template>
  <div>
    <router-link class="sidebar-item" :to="{ name: 'home' }">
      <i class="las la-tachometer-alt sidebar-icon"></i>
      <span class="icon-text">
        Tableau de bord
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'users-index' }">
      <i class="las la-users sidebar-icon"></i>
      <span class="icon-text">
        Utilisateurs
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'roles-index' }">
      <i class="las la-user-shield sidebar-icon"></i>
      <span class="icon-text">
        Roles
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'permissions-index' }">
      <i class="las la-user-cog sidebar-icon"></i>
      <span class="icon-text">
        Permissions
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'dre-index' }">
      <i class="las la-building sidebar-icon"></i>
      <span class="icon-text">
        Dre
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'agencies-index' }">
      <i class="las la-landmark sidebar-icon"></i>
      <span class="icon-text">
        Agences
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'famillies-index' }">
      <i class="las la-tag sidebar-icon"></i>
      <span class="icon-text">
        Familles
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'domains-index' }">
      <i class="las la-tags sidebar-icon"></i>
      <span class="icon-text">
        Domaines
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'processes-index' }">
      <i class="las la-project-diagram sidebar-icon"></i>
      <span class="icon-text">
        Processus
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'control-points-index' }">
      <i class="las la-list-alt sidebar-icon"></i>
      <span class="icon-text">
        Points de contrôle
      </span>
    </router-link>
  </div>
</template>

<script>
export default {

}
</script>
