<template>
  <DefaultContainer :form="form" :name="name" :labelRequired="labelRequired" :label="label" :id="id">
    <div class="form-check-container" :class="{ 'is-inline': isInline }">
      <slot></slot>
    </div>
  </DefaultContainer>
</template>

<script>

import DefaultContainer from './DefaultContainer'
export default {
  components: { DefaultContainer },
  name: "NLCheckableContainer",
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    isInline: { type: Boolean, default: true },
    id: { type: String, default: null },
  },
  computed: {
    getId() {
      return this.id !== null && this.id !== '' ? this.id : this.name
    }
  },
}
</script>
