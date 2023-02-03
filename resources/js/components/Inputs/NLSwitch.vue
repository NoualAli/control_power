<template>
  <NLCheckableContainer :name="name" :form="form" :label="label" :id="getId">
    <input type="checkbox" :class="[{ 'is-danger': form?.errors.has(name) }, 'switch-input']" v-model="selected"
      @change="updateValue" :name="name" :id="getId">
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
  },
  data() {
    return {
      selected: this.value,
    }
  },
  updated() {
    this.selected = this.value;
  },
  methods: {
    updateValue() {
      this.selected = !this.selected
      this.$emit('change', this.selected);
    },
  },
  computed: {
    getId() {
      return this.id !== null && this.id !== '' ? this.id : this.name
    }
  },
}
</script>

<style lang="scss" scoped>

</style>
