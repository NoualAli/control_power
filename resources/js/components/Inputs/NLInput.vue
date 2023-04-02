<template>
  <DefaultContainer
    :id="id || name" :form="form" :label="label" :name="name" :label-required="labelRequired"
    :length="length" :current-length="currentLength" :help-text="helpText"
  >
    <div class="input-container" :class="{ 'is-password-input': type == 'password' }">
      <input
        :id="id || name" :maxlength="length" :class="[{ 'is-danger': form?.errors.has(name) }, 'input', { 'is-for-auth': isForAuth }]" :type="finalType"
        :name="name" :autocomplete="autocomplete"
        :autofocus="autofocus" :placeholder="placeholder || label" :value="value" :readonly="readonly"
        v-on="$listeners" @input="onInput($event)"
      >

      <div
        v-if="type == 'password'" class="show-password-btn has-icon" :class="{ 'is-danger': form?.errors.has(name) }"
        @click="toggleType"
      >
        <i class="las text-small" :class="eyeIcon" />
      </div>
    </div>
  </DefaultContainer>
</template>

<script>

import DefaultContainer from './DefaultContainer'
export default {
  name: 'NLInput',
  components: { DefaultContainer },
  model: {
    prop: 'value',
    event: 'update'
  },
  props: {
    form: { type: Object, required: false, default: null },
    autocomplete: { type: String, default: 'off' },
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
    helpText: { type: String, default: null }
  },
  emits: ['update'],

  data () {
    return {
      finalType: this.type,
      eyeIcon: 'las la-eye',
      isForAuth: false,
      currentLength: 0
    }
  },
  created () {
    if (this.length && this.value) {
      this.currentLength = this.value.length
    }
    this.finalType = this.readonly ? 'text' : this.type
    this.isForAuth = window.location.pathname === '/login'
  },
  methods: {
    /**
     * handle input event
     *
     * @param {Object} $event
     */
    onInput ($event) {
      let value = $event.target.value
      this.currentLength = value.length

      if (this.type === 'number') {
        value = this.sanitizeInput(value)
      }

      if (this.length) {
        value = value.slice(0, this.length)
      }

      this.$emit('update', value)
    },
    /**
     * Sanitize input from special chars
     *
     * @param {*} value
     */
    sanitizeInput (value) {
      return value.replace(/[^\w\s-+-]/gi, '')
    },
    /**
     * Used by password field to show input value
     */
    toggleType () {
      if (this.finalType === 'password') {
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
