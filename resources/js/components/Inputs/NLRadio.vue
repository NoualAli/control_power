<template>
  <div class="form-check">
    <label :class="{ 'radio-hidden': hideRadio }">
      <input
        :id="id" class="input-checkable" type="radio" :checked="isChecked" :value="value" :name="name"
        v-on="$listeners" @input="$emit('update', $event.target.value)"
      >
      <div class="checkable is-radio" />
      {{ label }}
    </label>
  </div>
</template>

<script>
export default {
  name: 'NLRadio',
  model: {
    prop: 'checkedValue',
    event: 'update'
  },
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    label: { type: String, required: true },
    value: { type: [String, Number, Boolean], default: undefined },
    checkedValue: { type: String, default: '' },
    hideRadio: { type: Boolean, default: false }
  },
  computed: {
    isChecked () {
      return this.checkedValue === this.value
    },
    id () {
      return `${this.name}-${this.value}`
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
