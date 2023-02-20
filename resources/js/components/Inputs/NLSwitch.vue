<template>
  <NLCheckableContainer :name="name" :form="form" :label="label" :id="id || name" :helpText="helpText">
    <input type="checkbox" :class="[{ 'is-danger': form?.errors.has(name) }, 'switch-input']" v-model="selected"
      @change="updateValue" :name="name" :id="id || name">
    <div class="switch" :data-true-label="trueLabel" :data-false-label="falseLabel" @click="updateValue"></div>
  </NLCheckableContainer>
</template>

<script>
import NLCheckableContainer from './NLCheckableContainer'
export default {
  name: 'NLSwitch',
  components: { NLCheckableContainer },
  model: {
    prop: 'value',
    event: 'change'
  },
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    label: { type: String, required: true },
    value: { type: Boolean, default: false },
    id: { type: String | null, default: null },
    trueLabel: { type: String | null, default: 'Oui' },
    falseLabel: { type: String | null, default: 'Non' },
    helpText: { type: String, default: null },
  },
  data() {
    return {
      selected: this.value,
    }
  },
  watch: {
    value(newVal, oldVal) {
      if (newVal !== oldVal) this.selected = newVal
    }
  },
  // updated() {
  //   this.selected = this.value;
  // },
  methods: {
    updateValue() {
      this.selected = !this.selected
      this.$emit('change', this.selected);
    },
  },
}
</script>
