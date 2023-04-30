<template>
  <DefaultContainer
    :id="id || name" :form="form" :label="label"
    :name="name" :label-required="labelRequired" :help-text="helpText"
  >
    <!-- <treeselect
      v-model="selected" :class="[{ 'is-danger': form?.errors.has(name) }, 'select']" :value="modelValue"
      :name="name" :multiple="multiple" :options="options" :placeholder="placeholder" :loading-text="loadingText"
      :no-options-text="noOptionsText" search-nested v-bind="$attrs"
    /> -->

    <treeselect
      v-bind="$attrs" :key=" forcedKey " ref="treeselect"
      v-model="selected" :class="[{ 'is-danger': form?.errors.has(name) }, 'select']" :value="modelValue" :name="name" :multiple="multiple"
      :options="options" :placeholder="placeholder" :loading-text="loadingText" :no-options-text="noOptionsText" search-nested
    />
  </DefaultContainer>
</template>

<script>
// import Treeselect from 'vue3-treeselect'
import Treeselect from '@veigit/vue3-treeselect'
// @veigit/vue3-treeselect
// import Treeselect from '@riophae/vue-treeselect'
export default {
  name: 'NLSelect',
  components: { Treeselect },
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
    modelValue: { type: [String, Array, Number], default: () => [] },
    options: { type: Array, required: true },
    helpText: { type: String, default: null }
  },
  // emits: ['update:modelValue'],
  data () {
    return {
      forcedKey: false,
      selected: this.modelValue
    }
  },
  watch: {
    selected (newValue, oldValue) {
      // console.log('here in selected')
      this.$emit('update:modelValue', newValue)
    },
    modelValue (newValue, oldValue) {
      if (!newValue || newValue.length === 0) {
        // console.log('here inside')
        this.$refs.treeselect.clear()
      }
      if (newValue && (newValue !== oldValue)) {
        this.selected = newValue
        this.forcedKey = true
      }
    }
  },
  methods: {
    justRandomFunction ($event) {
      console.log($event)
    }
  }

}
</script>
