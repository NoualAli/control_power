<template>
  <div class="repeater">
    <h2 class="mb-6" v-if="title">{{ title }}</h2>
    <!-- Repeater row -->
    <div class="grid my-6 form-row" v-for="(item, index) in form[name]" :key="name + '-row-' + index">
      <div class="col-11">
        <div class="grid">
          <div v-for="(input, id) in rowSchema" :key="name + '-input-' + input.name + '-' + index + '-id'" class="col-12"
            :class="input.style">

            <!-- Defining different inputs -->
            <NLInput :form="form" :label="input.label" :placeholder="input.placeholder" :type="input.type"
              :labelRequired="input.required" :name="name + '.' + index + '.' + id + '.' + input.name"
              v-model="form[name][index][id][input.name]" :id="name + '-row-' + index + '-' + input.name"
              v-if="isInput(input.type)" />

            <NLTextarea :form="form" :label="input.label" :placeholder="input.placeholder" :labelRequired="input.required"
              :name="name + '.' + index + '.' + id + '.' + input.name" v-model="form[name][index][id][input.name]"
              :id="name + '-row-' + index + '-' + input.name" v-if="input.type == 'textarea'" />

            <NLWyswyg :form="form" :label="input.label" :placeholder="input.placeholder" :labelRequired="input.required"
              :name="name + '.' + index + '.' + id + '.' + input.name" v-model="form[name][index][id][input.name]"
              :id="name + '-row-' + index + '-' + input.name" v-if="input.type == 'wyswyg'" />

            <NLSelect :labelRequired="input.required" :form="form" :label="input.label"
              v-model="form[name][index][id][input.name]" :name="name + '.' + index + '.' + id + '.' + input.name"
              :options="input.options" :id="name + '.' + index + '.' + id + '.' + input.name"
              :placeholder="input.placeholder || 'Choisissez une option...'" :multiple="input.multiple"
              v-if="input.type == 'select'" />
          </div>
        </div>
      </div>
      <!-- Remove current row -->
      <div class="col-1 p-0 d-flex justify-start align-center" v-if="index >= 0">
        <div class="btn btn-danger" :class="{ removeButtonStyle }" @click="removeRow(index)">
          {{ removeButtonLabel }}
        </div>
      </div>
    </div>


    <!-- Add new row -->
    <div class="d-flex justify-start align-center">
      <span class="btn" :class="{ addButtonStyle }" @click="addRow">
        {{ addButtonLabel }}
      </span>
    </div>
    <has-error :form="form" :field="name" class="text-danger mt-5" v-if="form" />
  </div>
</template>

<script>
import NLSelect from './NLSelect'
import DefaultContainer from './DefaultContainer'
import NLInput from './NLInput'
import Treeselect from '@riophae/vue-treeselect'
export default {
  name: 'NLRepeater',
  components: {
    NLSelect,
    DefaultContainer, NLInput, Treeselect
  },
  props: {
    addButtonLabel: { type: String, default: "Ajouter une ligne" },
    addButtonStyle: { type: String, default: null },
    removeButtonLabel: { type: String, default: "Supprimer" },
    removeButtonStyle: { type: String, default: null },
    name: { type: String, required: true },
    title: { type: String, default: null },
    form: { type: Object, required: false },
    rowSchema: { type: Array, required: true }
  },
  methods: {
    addRow() {
      const schema = []
      for (let index = 0; index < this.rowSchema.length; index++) {
        const element = this.rowSchema[ index ];
        const name = element.name
        let defaultValue = element.default !== undefined ? element.default : null
        defaultValue = element.multiple ? [] : null
        schema.push({ [ name ]: defaultValue, value: element.label })
      }
      if (this.form[ this.name ]) this.form[ this.name ].push(schema);
    },
    isInput(value) {
      return [ 'text', 'date', 'datetime', 'time', 'week', 'number', 'tel', 'email', 'month', 'url' ].includes(value)
    },
    removeRow(index) {
      this.form[ this.name ].splice(index, 1);
    },
  }
}
</script>
