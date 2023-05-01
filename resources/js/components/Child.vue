<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <router-view :key="$route.url" v-slot="{Component}">
    <transition name="page" mode="out-in">
      <component :is="Component" />
    </transition>
  </router-view>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: 'Child'

}
</script>
