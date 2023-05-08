<template>
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
</template>

<script>
export default {
    name: 'AuthLayout'
}
</script>
