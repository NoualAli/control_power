<!-- <template>
  <transition name="page" mode="out-in">
    <slot>
      <router-view :key="$route.url" />
    </slot>
  </transition>
</template> -->
<template>
  <router-view :key="$route.url" v-slot="{Component}">
    <transition name="page" mode="out-in">
      <component :is="Component" />
    </transition>
  </router-view>
</template>

<script>
export default {
  name: 'Child'

}
</script>
