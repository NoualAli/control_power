<template>
  <div class="notification my-8">
    <div class="box" :class="type">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'notification',
  props: {
    type: {
      type: String,
    }
  }
}
</script>
