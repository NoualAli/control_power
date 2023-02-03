<template>
  <DefaultContainer :id="getId" :form="form" :label="label" :name="name" :labelRequired="labelRequired">
    <div class="input-container" :class="{ 'is-password-input': type == 'password' }">
      <input :maxlength="length" v-on="$listeners" @input="$emit('update', $event.target.value)" :id="getId"
        :class="[{ 'is-danger': form?.errors.has(name) }, 'input', { 'is-for-auth': isForAuth }]" :type="finalType"
        :name="name" :autocomplete="autocomplete" :autofocus="autofocus" :placeholder="$t(finalPlaceholder)"
        :value="value" :readonly="readonly">

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
    length: { type: Number | null, default: 255 }
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
    }
  },
  computed: {
    finalPlaceholder() {
      if (!this.readonly) {
        return this.placeholder ? this.placeholder : this.label
      }
    },
    getId() {
      return this.id !== null && this.id !== '' ? this.id : this.name
    }
  },
  created() {
    this.finalType = this.readonly ? 'text' : this.type
    this.isForAuth = window.location.pathname == '/login'
  },
  methods: {
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
