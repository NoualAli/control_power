<template>
  <DefaultContainer :id="getId" :form="form" :label="label" :name="name" :labelRequired="labelRequired">
    <textarea v-on="$listeners" @input="$emit('update', $event.target.value)" :id="getId"
      :class="{ 'is-danger': form?.errors.has(name) }" class="input" :name="name" :autofocus="autofocus"
      :placeholder="finalPlaceholder" :value="value" :readonly="readonly" :disabled="disabled"></textarea>
  </DefaultContainer>
</template>

<script>

export default {
  name: "NLTextarea",
  props: {
    form: { type: Object, required: false },
    autocomplete: { type: String, default: "off" },
    autofocus: { type: Boolean, default: false },
    type: { type: String, default: 'text' },
    name: { type: String, required: true },
    id: { type: String, default: null },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    placeholder: { type: String, default: '' },
    value: { type: String, default: '' },
    readonly: { type: Boolean, default: false },
    disabled: { type: Boolean, default: false }
  },
  model: {
    prop: "value",
    event: "update"
  },
  computed: {
    finalPlaceholder() {
      return this.placeholder ? this.placeholder : this.label
    },
    getId() {
      return this.id !== null && this.id !== '' ? this.id : this.name
    }
  },
}
</script>
