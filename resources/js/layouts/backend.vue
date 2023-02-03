<template>
  <div class="main-layout">
    <div class="sidebar-container" :class="{ 'is-active': !showSidebar }">
      <Sidebar :showSidebar="showSidebar" />
    </div>
    <div class="main-container">
      <div class="header-container">
        <div class="title-side">
          <div>
            <app-breadcrumbs></app-breadcrumbs>
          </div>
        </div>
        <div class="actions-side">
          <div class="user-profile">
            <div class="avatar">
              <img :src="user?.avatar" alt="" />
            </div>
            <router-link :to="{ name: 'profile' }" class="username text-bold">
              {{ user?.username }}
            </router-link>
          </div>
          <button class="hamburger hamburger--elastic" :class="{ 'is-active': !showSidebar }" type="button"
            @click="toggleSidebar">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
      </div>
      <div class="content-container">
        <div class="container">
          <Child />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from '../components/Sidebar'
import Child from '../components/Child'
import { mapGetters } from 'vuex'

export default {
  name: 'MainLayout',
  middleware: [ 'auth', 'admin' ],
  components: {
    Sidebar,
    Child
  },
  computed: mapGetters({
    showSidebar: 'sidebar/showSidebar',
    user: 'auth/user',
  }),
  methods: {
    toggleSidebar() {
      this.$store.dispatch('sidebar/toggleSidebar')
    },
  }
}
</script>
