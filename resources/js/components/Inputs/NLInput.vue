<template>
  <DefaultContainer :id="id || name" :form="form" :label="label" :name="name" :labelRequired="labelRequired"
    :length="length" :currentLength="currentLength" :helpText="helpText">
    <div class="input-container" :class="{ 'is-password-input': type == 'password' }">

      <input :maxlength="length" v-on="$listeners" @input="onInput($event)" :id="id || name"
        :class="[{ 'is-danger': form?.errors.has(name) }, 'input', { 'is-for-auth': isForAuth }]" :type="finalType"
        :name="name" :autocomplete="autocomplete" :autofocus="autofocus" :placeholder="placeholder || label"
        :value="value" :readonly="readonly" />

      <div class="show-password-btn has-icon" v-if="type == 'password'" :class="{ 'is-danger': form?.errors.has(name) }"
        @click="toggleType">
        <i class="las text-small" :class="eyeIcon"></i>
      </div>
    </div>
  </DefaultContainer>
</template>

<script>

import DefaultContainer from './DefaultContainer'
export default {
  components: { DefaultContainer },
  name: "NLInput",
  emits: [ 'update' ],
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
    value: { type: String | Number, default: '' },
    readonly: { type: Boolean, default: false },
    length: { type: Number | null, default: null },
    helpText: { type: String, default: null },
  },
  model: {
    prop: 'value',
    event: 'update'
  },

  data() {
    return {
      finalType: this.type,
      eyeIcon: 'las la-eye',
      isForAuth: false,
      currentLength: 0,
    }
  },
  created() {
    if (this.length && this.value) {
      this.currentLength = this.value.length
    }
    this.finalType = this.readonly ? 'text' : this.type
    this.isForAuth = window.location.pathname == '/login'
  },
  methods: {
    /**
     * handle input event
     *
     * @param {Object} $event
     */
    onInput($event) {
      let value = $event.target.value
      this.currentLength = value.length

      if (this.type == 'number') {
        value = this.sanitizeInput(value)
      }

      this.$emit('update', value.slice(0, this.length))
    },
    /**
     * Sanitize input from special chars
     *
     * @param {*} value
     */
    sanitizeInput(value) {
      return value.replace(/[^\w\s-\+\-]/gi, '');
    },
    /**
     * Used by password field to show input value
     */
    toggleType() {
      if (this.finalType == 'password') {
        this.finalType = 'text'
        this.eyeIcon = 'las la-eye-slash'
      } else {
        this.finalType = 'password'
        this.eyeIcon = 'las la-eye'
      }
    }
  }
}
</script>
