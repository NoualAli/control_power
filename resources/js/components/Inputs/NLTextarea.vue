<template>
  <DefaultContainer :id="id || name" :form="form" :label="label" :name="name" :labelRequired="labelRequired"
    :length="length" :currentLength="currentLength" :helpText="helpText">
    <textarea v-on="$listeners" @input="onInput($event)" :id="id || name"
      :class="{ 'is-danger': form?.errors.has(name) }" class="input" :name="name" :autofocus="autofocus"
      :placeholder="placeholder || label" :value="value" :readonly="readonly" :disabled="disabled"
      :maxlength="length"></textarea>
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
    disabled: { type: Boolean, default: false },
    length: { type: Number | String, default: null },
    helpText: { type: String, default: null },
  },
  data() {
    return {
      currentLength: 0,
    }
  },
  model: {
    prop: "value",
    event: "update"
  },
  created() {
    if (this.length && this.value) {
      this.currentLength = this.value.length
    }
  },
  methods: {
    onInput($event) {
      let value = $event.target.value
      this.currentLength = value.length
      this.$emit('update', value.slice(0, this.length))
    }
  },
}
</script>
