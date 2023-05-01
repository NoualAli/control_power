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
              <img :src="user?.avatar" v-if="user?.avatar" />
              <i class="las la-user icon" v-else />
            </div>
            <router-link :to="{ name: 'profile' }" class="username text-bold">
              {{ user?.abbreviated_name }}
            </router-link>
          </div>
          <router-link :to="{ name: 'notifications' }" class="notification-link has-icon"
            :class="{ 'notified': totalUnreadNotifications > 0 }">
            <i class="las la-bell icon" :class="{ 'la-spin': totalUnreadNotifications > 0 }"></i>
          </router-link>
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
    notifications: 'notifications/unread'
  }),
  data() {
    return {
      totalUnreadNotifications: 0
    }
  },
  watch: {
    $route(to, from) {
      this.$store.dispatch('notifications/fetchUnreadNotifications').then(() => {
        this.totalUnreadNotifications = this.notifications.unread.totalUnread
      })
    },
    totalUnreadNotifications(newVal, oldVal) {
      // console.log(newVal, oldVal);
    }
  },
  methods: {
    toggleSidebar() {
      this.$store.dispatch('sidebar/toggleSidebar')
    },
  }
}
</script>
