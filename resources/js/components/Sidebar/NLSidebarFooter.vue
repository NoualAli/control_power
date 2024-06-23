<template>
    <div class="sidebar-footer">
        <a href="logout" @click.prevent="logout" class="sidebar-item logout-btn" :class="{ 'is-loading': isLogout }"
            v-if="!isLogout">
            <NLIcon name="logout" v-if="!isLogout" class="sidebar-icon" />
            <i class="las la-spinner la-spin sidebar-icon" v-else></i>
        </a>
        <div class="sidebar-item logout-btn" :class="{ 'is-loading': isLogout }" v-else>
            <i class="las la-spinner la-spin sidebar-icon"></i>
        </div>
    </div>
</template>

<script>
export default {
    name: 'NLSidebarFooter',
    data() {
        return {
            isLogout: false
        }
    },
    methods: {
        async logout() {
            this.isLogout = true
            // Log out the user.
            await this.$store.dispatch('auth/logout')

            localStorage.clear()
            // Redirect to login.
            this.$router.push({ name: 'login' })
        }
    }
}
</script>
