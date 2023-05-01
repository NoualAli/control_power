<template>
  <div class="notification my-8">
    <div class="box" :class="type">
      <slot />
    </div>
  </div>
</template>
<script>
export default {
  name: 'Notification',
  props: {
    type: {
      type: String, default: ''
    }
  }
}
</script>
