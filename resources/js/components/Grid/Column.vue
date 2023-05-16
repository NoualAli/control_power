<template>
  <div :class="[smPrefixed, mdPrefixed, lgPrefixed, extraClass]">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'Column',
  props: {
    extraClass: {
      type: String,
      required: false,
      default: null,
    },
    sm: {
      type: String,
      required: false,
      default: '12',
    },
    md: {
      type: String,
      required: false,
      default: '12',
    },
    lg: {
      type: String,
      required: false,
      default: '12',
    }
  },
  computed: {
    smPrefixed() {
      return 'col-' + this.sm
    },
    mdPrefixed() {
      return 'col-md-' + this.md
    },
    lgPrefixed() {
      return 'col-lg-' + this.lg
    }
  }
}
</script>
