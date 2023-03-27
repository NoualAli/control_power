<template>
  <div>
    <DefaultContainer :id="id || name" :form="form" :label="label" :name="name" :labelRequired="labelRequired"
      :length="length" :currentLength="currentLength">
      <VueEditor :editor-toolbar="editorSettings" @input="onInput($event)" v-on="$listeners" :id="id || name"
        :class="[{ 'is-danger': form?.errors.has(name) }]" :name="name" :autocomplete="autocomplete"
        :autofocus="autofocus" @ready="quill => editorQuill = quill" :max-length="length"
        :placeholder="placeholder || label" :value="currentValue" :helpText="helpText" />
    </DefaultContainer>
  </div>
</template>

<script>
import DefaultContainer from './DefaultContainer'
import { VueEditor } from "vue3-editor";

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
    length: { type: Number | null, default: null },
    helpText: { type: String, default: null },
  },
  watch: {
    currentValue: function (currentValue) {
      if (!!this.length && this.editorQuill.getLength() >= this.length) {
        this.editorQuill.deleteText(this.length, this.editorQuill.getLength());
      }
    }
  },
  data() {
    return {
      editorQuill: null,
      currentLength: 0,
      currentValue: null,
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
      ]
    }
  },
  created() {
    this.currentValue = this.value
  },
  model: {
    prop: "value",
    event: "update"
  },
  methods: {
    onInput(value) {
      this.currentValue = value
      this.currentLength = this.editorQuill.getLength() - 1
      this.$emit('update', this.currentValue)
    }
  }
}
</script>
