<template>
  <div class="form-check">
    <label :class="{ 'radio-hidden': hideRadio }">
      <input v-on="$listeners" class="input-checkable" type="radio" :checked="isChecked" :value="value" :name="name"
        :id="id" @input="$emit('update', $event.target.value)">
      <div class="checkable is-radio"></div>
      {{ label }}
    </label>
  </div>
</template>

<script>
export default {
  name: "NLRadio",
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    label: { type: String, required: true },
    value: { type: String | Number | Boolean, default: undefined },
    checkedValue: { default: "" },
    hideRadio: { type: Boolean, default: false }
  },
  model: {
    prop: "checkedValue",
    event: "update"
  },
  computed: {
    isChecked() {
      return this.checkedValue == this.value
    },
    id() {
      return `${this.name}-${this.value}`
    }
  },
}
</script>

<style lang="scss" scoped>

</style>
