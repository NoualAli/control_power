<template>
  <div>
    <router-link class="sidebar-item" :to="{ name: 'home' }">
      <i class="las la-tachometer-alt sidebar-icon"></i>
      <span class="icon-text">
        Tableau de bord
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'missions' }">
      <i class="las la-edit sidebar-icon"></i>
      <span class="icon-text">
        Réalisation des missions
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'missions-not-validated' }">
      <i class="las la-calendar sidebar-icon"></i>
      <span class="icon-text">
        Suivi des missions
      </span>
    </router-link>
    <router-link class="sidebar-item" :to="{ name: 'missions-validated' }">
      <i class="las la-file-alt sidebar-icon"></i>
      <span class="icon-text">
        Consultation des missions
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

<script>
export default {

}
</script>
