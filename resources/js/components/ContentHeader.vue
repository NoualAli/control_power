<template>
  <header class="content-header d-flex justify-between align-center py-5">
    <!-- <h2 class="title" v-if="title">
      {{ title }}
    </h2> -->
    <slot name="title"></slot>
    <div class="actions">
      <slot name="actions"></slot>
    </div>
  </header>
</template>

<script>
export default {
  name: "ContentHeader",
  props: {
    title: { type: String, default: null }
  }
}
</script>

<style lang="scss" scoped>

</style>
