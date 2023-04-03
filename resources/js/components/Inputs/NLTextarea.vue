<template>
  <DefaultContainer :id="id || name" :form="form" :label="label" :name="name" :label-required="labelRequired"
                    :length="length" :current-length="currentLength" :help-text="helpText"
  >
    <textarea :id="id || name" :class="{ 'is-danger': form?.errors.has(name) }" class="input"
              :name="name" :autofocus="autofocus" :placeholder="placeholder || label" :value="value"
              :readonly="readonly" :disabled="disabled" :maxlength="length" v-on="$listeners"
              @input="onInput($event)"
    />
  </DefaultContainer>
</template>

<script>

export default {
  name: 'NLTextarea',
  model: {
    prop: 'value',
    event: 'update'
  },
  props: {
    form: { type: Object, required: false },
    autocomplete: { type: String, default: 'off' },
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
    length: { type: [Number, String], default: null },
    helpText: { type: String, default: null }
  },
  data () {
    return {
      currentLength: 0
    }
  },
  created () {
    if (this.length && this.value) {
      this.currentLength = this.value.length
    }
  },
  methods: {
    onInput ($event) {
      let value = $event.target.value
      this.currentLength = value.length
      if (this.length) {
        value = value.slice(0, this.length)
      }
      this.$emit('update', value)
    }
  }
}
</script>
