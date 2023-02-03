<template>
  <div class="form-check">
    <label :for="id">
      <input v-on="$listeners" class="input-checkable" type="checkbox" :value="value" :name="name" :id="id"
        @input="$emit('update', $event.target.value)">
      <div class="checkable is-checkbox"></div>
      {{ label }}
    </label>
  </div>
</template>

<script>

export default {
  name: "NLCheckbox",
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    label: { type: String, required: true },
    value: { type: String | Number | Boolean, default: undefined },
  },
  model: {
    prop: "checkedValue",
    event: "update"
  },
  computed: {
    updateCheckedVal() {
      const index = this.form[ this.name ].indexOf(this.value)
      if (index > -1) {
        this.form[ this.name ].splice(index, 1)
      } else {
        this.form[ this.name ].push(this.value)
      }
    },
    id() {
      return `${this.name}-${this.value}`
    }
  }
}
</script>
