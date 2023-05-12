<template>
  <NLCheckableContainer :id="getId" :form="form" :name="name" :label-required="labelRequired">
    <div class="form-check">
      <label :for="getId">
        <input :id="getId" type="checkbox" :class="[{ 'is-danger': form?.errors.has(name) }, 'input-checkable']"
               :value="selected" :name="name" @input="updateValue"
        >
        <div class="checkable is-checkbox" />
        {{ label }}
      </label>
    </div>
  </NLCheckableContainer>
</template>

<script>
import NLCheckableContainer from './NLCheckableContainer'
export default {
  name: 'NLCheckbox',
  components: { NLCheckableContainer },
  model: {
    prop: 'value',
    event: 'change'
  },
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    id: { type: String, default: null },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    value: { type: [String, Number, Boolean], default: false }
  },
  data () {
    return {
      selected: this.value
    }
  },
  computed: {
    getId () {
      return this.id ? this.id : this.name
    }
  },
  methods: {
    updateValue (event) {
      this.selected = event.target.checked
      this.$emit('change', this.selected)
    }
  }
}
</script>
