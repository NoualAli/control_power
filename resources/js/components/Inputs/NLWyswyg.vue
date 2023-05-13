<template>
    <div>
        <DefaultContainer :id="id || name" :form="form" :label="label" :name="name" :label-required="labelRequired"
            :length="length" :current-length="currentLength">
            <VueEditor :id="id || name" v-model.trim="currentValue" :editor-toolbar="editorSettings"
                :class="[{ 'is-danger': form?.errors.has(name) }]" :name="name" :autocomplete="autocomplete"
                :autofocus="autofocus" :max-length="length" :placeholder="placeholder || label" :value="modelValue"
                :help-text="helpText" v-bind="$attrs" @input="onInput($event)" @ready="quill => { editorQuill = quill }" />
        </DefaultContainer>
    </div>
</template>

<script>
import DefaultContainer from './DefaultContainer'
import { VueEditor } from 'vue3-editor'

export default {
    name: 'NLWyswyg',
    components: {
        DefaultContainer, VueEditor
    },
    props: {
        form: { type: Object, required: false },
        autocomplete: { type: String, default: 'off' },
        autofocus: { type: Boolean, default: false },
        type: { type: String, default: 'text' },
        name: { type: String, required: true },
        id: { type: String, default: null },
        label: { type: String, default: '' },
        labelRequired: { type: Boolean, default: false },
        placeholder: { type: String, default: '' },
        modelValue: { type: [ String, Number ], default: '' },
        readonly: { type: Boolean, default: false },
        length: { type: [ Number, null ], default: null },
        helpText: { type: String, default: null }
    },
    data() {
        return {
            editorQuill: null,
            currentLength: 0,
            currentValue: '',
            editorSettings: [
                [ { header: [ 1, 2, 3, 4, 5, 6, false ] } ],
                [ { size: [ 'small', 'medium', 'large' ] } ],
                [ { align: [] } ],
                [ { list: 'ordered' }, { list: 'bullet' } ],
                [ 'bold', 'italic', 'underline', 'strike' ],
                [ 'blockquote' ],
                [ { script: 'sub' }, { script: 'super' } ],
                [ { indent: '-1' }, { indent: '+1' } ],
                [ { direction: 'ltr' }, { direction: 'rtl' } ],
                [ { color: [] }, { background: [] } ]
            ]
        }
    },
    watch: {
        currentValue: {
            immediate: true,
            deep: true,
            handler(newValue, oldValue) {
                if (!!this.length && this.editorQuill.getLength() >= this.length) {
                    this.editorQuill.deleteText(this.length, this.editorQuill.getLength())
                }
                this.$emit('update:modelValue', this.trim(newValue))
            }
        },
        modelValue: {
            immediate: true,
            deep: true,
            handler(newValue, oldValue) {
                if (!newValue || newValue.length === 0) {
                    this.currentValue = newValue
                }
                if (newValue && (newValue !== oldValue)) {
                    this.currentValue = newValue
                }
            }
        }
    },
    created() {
        this.currentValue = this.modelValue !== null ? this.modelValue : ''
    },
    methods: {
        onInput(value) {
            this.currentValue = value
            this.currentLength = this.editorQuill.getLength() - 1
            this.$emit('update:modelValue', this.currentValue)
        },
        trim(html) {
            const tmp = document.createElement("div");
            tmp.innerHTML = html.trim();

            // Remove empty tags
            const emptyTags = tmp.querySelectorAll(":empty");
            emptyTags.forEach((tag) => {
                tag.parentNode.removeChild(tag);
            });

            // Trim non-empty tags
            const nonEmptyTags = tmp.querySelectorAll("*:not(:empty)");
            nonEmptyTags.forEach((tag) => {
                tag.textContent = tag.textContent.trim();
            });

            // Return the updated HTML
            return tmp.innerHTML;

        }
    }
}
</script>
