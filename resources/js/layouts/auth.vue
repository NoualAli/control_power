<template>
    <div class="global-auth-container">
        <div id="particles-js"></div>
        <div class="auth-container">
            <header class="header-container">
                <img src="/app/images/bna_logo_monochrome.svg" class="brand">
            </header>
            <main class="main-container">
                <child />
            </main>
            <div class="footer-container">
                <p>
                    &copy; {{ currentYear }} - Tous droits réservés - BNA
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import 'particles.js/particles.js'
/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
export default {
    name: 'AuthLayout',
    created() {
        particlesJS.load('particles-js', 'particles.json', function () {
            // console.log('callback - particles-js config loaded');
        });
    }
}
</script>
