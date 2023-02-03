<template>
  <div>
    <label class="form-label" :for="id" :class="{ 'text-danger': form?.errors.has(name), 'is-required': labelRequired }"
      v-if="label">
      {{ $t(label) }}
    </label>
    <slot></slot>
    <!-- <div class="text-small text-bold d-flex justify-end align-center">
      / {{ length }}
    </div> -->
    <has-error :form="form" :field="name" class="text-danger" v-if="form" />
  </div>
</template>

<script>
export default {
  name: 'DefaultContainer',
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    id: { type: String, required: true },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    length: { type: Number | null, default: 255 }
  },
}
</script>
