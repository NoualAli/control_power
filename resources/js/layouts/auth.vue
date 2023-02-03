<template>
  <div class="auth-container">
    <header class="header-container">
      <img src="/images/logo.svg" class="brand">
    </header>
    <main class="main-container">
      <child />
    </main>
    <div class="footer-container">
      <p>
        &copy; 2022 - Tous droits réservés - DCP 104
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AuthLayout'
}
</script>
