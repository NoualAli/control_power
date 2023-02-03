<template>
  <header class="b-header">
    <div class="b-brand">
      <router-link to="/">
        <img src="/../../images/brand.png" alt="Brand" />
      </router-link>
    </div>

    <nav class="b-navbar" :class="{ 'is-active': showMenu }">
      <div class="bn-start">
        <b-buttonn>Click Me</b-buttonn>
      </div>
      <div class="bn-end">
        <div class="b-dropdown dropdown">
          <div class="b-dropdown-btn" @click="toggleDropdownMenu">
            <v-gravatar :email="user.email" />
          </div>
          <ul class="b-dropdown-menu" :class="{ 'is-active': showDropdown }">
            <li class="b-dropdown-item">
              <router-link :to="{ name: 'settings.profile' }" class="">
                <fa icon="cog" fixed-width />
                {{ $t('profile') }}
              </router-link>
            </li>
            <li class="b-dropdown-item">
              <router-link :to="{ name: 'settings.password' }" class="">
                <fa icon="cog" fixed-width />
                {{ $t('password') }}
              </router-link>
            </li>
            <li class="b-dropdown-item">
              <a href="#" class="" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t('logout') }}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <button class="hamburger hamburger--elastic" :class="{ 'is-active': showMenu }" type="button" @click="toggleNavbar">
      <span class="hamburger-box">
        <span class="hamburger-inner"></span>
      </span>
    </button>
  </header>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName,
    showMenu: false,
    showDropdown: false
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  mounted() {
    let dropdowns = document.querySelectorAll('.b-navbar')
  },

  methods: {
    toggleDropdownMenu() {
      this.showDropdown = !this.showDropdown;
    },
    toggleNavbar() {
      this.showMenu = !this.showMenu;
    },
    async logout() {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
