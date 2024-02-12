<template>
    <div class="main-layout">
        <div class="sidebar-container" :class="{ 'is-active': !showSidebar }">
            <NLSidebar :show-sidebar="showSidebar" />
        </div>
        <div class="main-container">
            <div class="header-container">
                <div class="title-side">
                    <!--  -->
                    <div>
                        <AmBreadcrumbs>
                            <template #crumb="{ crumb }">
                                <template
                                    v-if="(crumb.link !== '/' || (crumb.current && crumb.link == '/')) && crumb.label !== ''">
                                    <router-link v-if="!crumb.current" class="am-breadcrumbs__link" :to="crumb.link">
                                        {{ crumb.label }}
                                        /
                                    </router-link>
                                    <span v-else class="am-breadcrumbs__link"
                                        :class="{ 'am-breadcrumbs__link_current': crumb.current }">
                                        {{ crumb.label }}
                                    </span>
                                </template>
                                <template v-else />
                                {{}}
                            </template>
                        </AmBreadcrumbs>
                    </div>
                </div>
                <div class="actions-side">
                    <!-- <b class="app_version text-white">
                        V {{ CURRENT_VERSION }}
                    </b> -->
                    <div class="user-profile">
                        <router-link :to="{ name: 'profile' }" class="username text-bold d-flex full-center gap-2">
                            <div class="avatar">
                                <NLIcon name="person" />
                            </div>
                            {{ user?.abbreviated_name }}
                        </router-link>
                    </div>
                    <router-link :key="totalUnreadNotifications" :to="{ name: 'notifications' }" class="notification-link"
                        :class="{ 'notified text-small': totalUnreadNotifications > 0 }"
                        :data-total-notifications="totalUnreadNotifications > 9 ? '+9' : totalUnreadNotifications">
                        <!-- <i class="las la-bell icon" :class="{ 'la-spin': totalUnreadNotifications > 0 }" /> -->
                        <NLIcon name="notifications" />
                    </router-link>
                    <router-link :to="{ name: 'bugs-index' }" class="bug-link">
                        <NLIcon name="bug_report" />
                    </router-link>
                    <!-- <button class="d-lg-none d-block hamburger hamburger--elastic" :class="{ 'is-active': !showSidebar }"
                        type="button" @click="toggleSidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button> -->
                </div>
            </div>
            <div class="content-container">
                <NLContainer extraClass="py-6">
                    <Child />
                </NLContainer>
                <NLPageLoader :isLoading="pageLoadingState" />
            </div>
        </div>
    </div>
</template>

<script>
import NLBreadcrumb from '../components/NLBreadcrumb'
import NLIcon from '../components/NLIcon'
import NLSidebar from '../components/Sidebar/NLSidebar'
import Child from '../components/Child'
import { mapGetters } from 'vuex'
import NLPageLoader from '../components/NLPageLoader'
import * as APP from '~/store/global/version'
// import NLBreadcurmb from '../components/NLBreadcrumb'
export default {
    name: 'MainLayout',
    components: {
        NLBreadcrumb,
        NLBreadcrumb,
        NLIcon,
        NLSidebar,
        Child,
        NLPageLoader
    },
    middleware: [ 'auth' ],
    data() {
        return {
            totalUnreadNotifications: 0
        }
    },
    computed: {
        ...mapGetters({
            showSidebar: 'sidebar/showSidebar',
            user: 'auth/user',
            notifications: 'notifications/totalUnread',
            pageLoadingState: 'settings/pageIsLoading',
        }),
        CURRENT_VERSION() {
            return APP.CURRENT_VERSION
        }
    },
    watch: {
        "notifications.totalUnread"(newValue, oldValue) {
            if (newValue !== this.totalUnreadNotifications) {
                this.totalUnreadNotifications = newValue
            }

        },
        $route(to, from) {
            if (to.path !== '/login') {
                this.$store.dispatch('notifications/fetchTotalUnreadNotifications').then(() => {
                    this.totalUnreadNotifications = this.notifications.totalUnread
                })
            }
        },
    },
    created() {
        this.$store.dispatch('notifications/fetchTotalUnreadNotifications').then(() => {
            this.totalUnreadNotifications = this.notifications.totalUnread
        })
    },
    // updated() {
    //     this.$store.dispatch('notifications/fetchTotalUnreadNotifications').then(() => {
    //         this.totalUnreadNotifications = this.notifications.totalUnread
    //     })
    // },
    methods: {
        toggleSidebar() {
            this.$store.dispatch('sidebar/toggleSidebar')
        }
    }
}
</script>
<style>
.scroll-container {
    /* width: 300px; */
    /* Adjust as needed */
    /* height: 200px; */
    /* Adjust as needed */
    overflow: hidden;
    position: relative;
}


/* Hide default scrollbar */
.content-container::-webkit-scrollbar {
    display: none !important;
}

/* Style your custom scrollbar */
.scrollbar {
    position: absolute;
    top: 0;
    right: 0;
    width: 10px;
    /* Width of scrollbar */
    height: 100%;
    background-color: #ccc;
    /* Background color of scrollbar */
}

.thumb {
    width: 100%;
    background-color: #999;
    /* Color of scrollbar thumb */
    cursor: pointer;
}
</style>
