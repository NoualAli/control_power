<template>
  <transition name="page" mode="out-in">
    <slot>
      <router-view :key="$route.url" />
    </slot>
  </transition>
</template>

<script>
export default {
  name: 'Child',
  mounted () {
    console.log('im  inside a child')
    console.log(this.$route)
  }
}
</script>
