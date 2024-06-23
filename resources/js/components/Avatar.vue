<template>
  <div class="avatar">
    <img :src="avatar" :alt="alt">
  </div>
</template>

<script>
export default {
  props: {
    avatar: { type: [String, null] },
    alt: { type: [String, null], default: 'Avatar' }
  }
}
</script>
