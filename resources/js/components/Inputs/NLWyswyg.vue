<template>
  <div>
    <DefaultContainer :id="getId" :form="form" :label="label" :name="name" :labelRequired="labelRequired">
      <VueEditor :editor-toolbar="editorSettings" @input="updateValue" :id="name"
        :class="[{ 'is-danger': form?.errors.has(name) }]" :name="name" :autocomplete="autocomplete"
        :autofocus="autofocus" :placeholder="finalPlaceholder" :value="value" />
    </DefaultContainer>
  </div>
</template>

<script>
import DefaultContainer from './DefaultContainer'
import { VueEditor } from "vue2-editor";

export default {
  name: "NLWyswyg",
  components: {
    DefaultContainer, VueEditor
  },
  props: {
    form: { type: Object, required: false },
    autocomplete: { type: String, default: "off" },
    autofocus: { type: Boolean, default: false },
    type: { type: String, default: 'text' },
    name: { type: String, required: true },
    id: { type: String, default: null },
    label: { type: String, default: '' },
    labelRequired: { type: Boolean, default: false },
    placeholder: { type: String, default: '' },
    value: { type: String | Number, default: '' },
    readonly: { type: Boolean, default: false },
    length: { type: Number | null, default: 255 }
  },
  data() {
    return {
      editorSettings: [
        [ { 'header': [ 1, 2, 3, 4, 5, 6, false ] } ],
        // [ { 'font': [] } ],
        [ { 'size': [ 'small', 'medium', 'large' ] } ],
        [ { 'align': [] } ],
        [ { 'list': 'ordered' }, { 'list': 'bullet' } ],
        [ 'bold', 'italic', 'underline', 'strike' ],
        [ 'blockquote' ],
        [ { 'script': 'sub' }, { 'script': 'super' } ],
        [ { 'indent': '-1' }, { 'indent': '+1' } ],
        [ { 'direction': 'ltr' }, { 'direction': 'rtl' } ],
        [ { 'color': [] }, { 'background': [] } ],
        [ 'link' ],
      ]
    }
  },
  model: {
    prop: "value",
    event: "update"
  },
  computed: {
    finalPlaceholder() {
      if (!this.readonly) {
        return this.placeholder ? this.placeholder : this.label
      }
    },
    getId() {
      return this.id !== null && this.id !== '' ? this.id : this.name
    }
  },
  methods: {
    updateValue(e) {
      this.form[ this.name ] = e
    },
  }
}
</script>
