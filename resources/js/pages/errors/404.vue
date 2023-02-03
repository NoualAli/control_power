<template>
  <div class="container-fluid text-center d-flex full-center is-column">
    <img src="/images/404.svg" class="vh-lg-70 vh-50 vw-100" alt="">
    <div class="links">
      <router-link :to="{ name: 'home' }" class="btn has-icon text-bold">
        <i class="las la-hand-point-left icon"></i>
        {{ $t('go_home') }}
        <i class="las la-home icon"></i>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NotFound',
  layout: 'backend'
}
</script>
