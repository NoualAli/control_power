<template>
  <div class="main-layout">
    <div class="sidebar-container" :class="{ 'is-active': !showSidebar }">
      <Sidebar :show-sidebar="showSidebar" />
    </div>
    <div class="main-container">
      <div class="header-container">
        <div class="title-side">
          <div>
            <!-- <app-breadcrumbs /> -->
            <AmBreadcrumbs
              :show-current-crumb="true"
            />
          </div>
        </div>
        <div class="actions-side">
          <div class="user-profile">
            <div class="avatar">
              <img :src="user?.avatar" alt="">
            </div>
            <router-link :to="{ name: 'profile' }" class="username text-bold">
              {{ user?.username }}
            </router-link>
          </div>
          <router-link
            :to="{ name: 'notifications' }" class="notification-link has-icon"
            :class="{ 'notified': totalUnreadNotifications > 0 }"
          >
            <i class="las la-bell icon" :class="{ 'la-spin': totalUnreadNotifications > 0 }" />
          </router-link>
          <button
            class="hamburger hamburger--elastic" :class="{ 'is-active': !showSidebar }" type="button"
            @click="toggleSidebar"
          >
            <span class="hamburger-box">
              <span class="hamburger-inner" />
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
  components: {
    Sidebar,
    Child
  },
  middleware: ['auth', 'admin'],
  data () {
    return {
      totalUnreadNotifications: 0
    }
  },
  computed: mapGetters({
    showSidebar: 'sidebar/showSidebar',
    user: 'auth/user',
    notifications: 'notifications/unread'
  }),
  watch: {
    $route (to, from) {
      this.$store.dispatch('notifications/fetchUnreadNotifications').then(() => {
        this.totalUnreadNotifications = this.notifications.unread.totalUnread
      })
    },
    totalUnreadNotifications (newVal, oldVal) {
      // console.log(newVal, oldVal);
    }
  },
  methods: {
    toggleSidebar () {
      this.$store.dispatch('sidebar/toggleSidebar')
    }
  }
}
</script>
