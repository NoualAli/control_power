<template>
  <div class="form-check-container" :class="{ 'is-inline': isInline }">
    <label class="form-label" :for="id" :class="{ 'text-danger': form?.errors.has(name), 'is-required': labelRequired }"
      v-if="label">
      {{ $t(label) }}
    </label>
    <slot></slot>
    <has-error :form="form" :field="name" class="text-danger" v-if="form" />
  </div>
</template>

<script>

import DefaultContainer from './DefaultContainer'
export default {
  components: { DefaultContainer },
  name: "NLCheckableContainer",
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    id: { type: String, required: true },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    isInline: { type: Boolean, default: true },
    helpText: { type: String, default: null },
  },
}
</script>
