<template>
  <DefaultContainer :id="id || name" :form="form" :label="label" :name="name" :labelRequired="labelRequired"
    :helpText="helpText">
    <treeselect :class="[{ 'is-danger': form?.errors.has(name) }, 'select']" v-model="selected" @input="updateValue"
      :value="value" :name="name" :multiple="multiple" :options="options" :placeholder="placeholder"
      :loadingText="loadingText" :noOptionsText="noOptionsText" search-nested>
    </treeselect>
  </DefaultContainer>
</template>

<script>
import Treeselect from 'vue3-treeselect'
// import Treeselect from '@riophae/vue-treeselect'
export default {
  components: { Treeselect },
  name: "NLSelect",
  props: {
    form: { type: Object, required: false },
    name: { type: String, required: true },
    id: { type: String, default: null },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    placeholder: { type: String, default: 'Choisissez une option' },
    loadingText: { type: String, default: 'Chargement en cours...' },
    noOptionsText: { type: String, default: 'Aucune option disponible' },
    multiple: { type: Boolean, default: false },
    value: { type: String | Array, default: () => [] },
    options: { required: true },
    helpText: { type: String, default: null },
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
  updated() {
    this.selected = this.value;
  },
  methods: {
    updateValue() {
      this.$emit('change', this.selected);
    },
  },
}
</script>
