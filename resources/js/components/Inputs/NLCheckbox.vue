<template>
  <NLCheckableContainer :id="getId" :form="form" :name="name" :labelRequired="labelRequired">
    <div class="form-check">
      <label :for="getId">
        <input type="checkbox" :class="[{ 'is-danger': form?.errors.has(name) }, 'input-checkable']" :id="getId"
          :value="selected" @input="updateValue" :name="name">
        <div class="checkable is-checkbox"></div>
        {{ label }}
      </label>
    </div>
  </NLCheckableContainer>
</template>

<script>
import NLCheckableContainer from './NLCheckableContainer'
export default {
  components: { NLCheckableContainer },
  name: "NLCheckbox",
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    id: { type: String, default: null },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    value: { type: String | Number | Boolean, default: false },
  },
  model: {
    prop: 'value',
    event: 'change'
  },
  data() {
    return {
      selected: this.value,
    };
  },
  computed: {
    getId() {
      return this.id ? this.id : this.name
    }
  },
  methods: {
    updateValue(event) {
      this.selected = event.target.checked
      this.$emit('change', this.selected)
    }
  }
}
</script>
