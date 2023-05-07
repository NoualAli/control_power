<template>
  <div class="auth-container">
    <header class="header-container">
      <img src="/storage/images/logo.svg" class="brand">
    </header>
    <main class="main-container">
      <child />
    </main>
    <div class="footer-container">
      <p>
        &copy; 2023 - Tous droits réservés - BNA
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AuthLayout'
}
</script>
