<template>
    <div class="global-auth-container">
        <div id="particles-js" class="p-0 m-0"></div>
        <div class="auth-container">
            <header class="header-container">
                <img src="/storage/assets/bna_logo_monochrome.svg" class="brand">
            </header>
            <main class="main-container">
                <child />
            </main>
            <div class="footer-container">
                <p>
                    VERSION {{ app_version }} &copy; {{ currentYear }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import 'particles.js/particles.js'
import * as APP from '~/store/global/version'
export default {
    name: 'AuthLayout',
    computed: {
        app_version() {
            return APP.CURRENT_VERSION
        }
    }
}
</script>
