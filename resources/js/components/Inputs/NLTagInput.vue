<template>
    <InputContainer :id="getId" :form="form" :label="label" :name="name" :label-required="labelRequired"
        :help-text="helpText">
        <div class="input-container d-flex justify-start align-center is-column gap-2">
            <input :id="getId" :class="[{ 'is-danger': form?.errors.has(name) }, 'input']" type="text" :name="name"
                :placeholder="placeholder || label" :value="tag" v-bind="$attrs" @input="onInput"
                @keydown.prevent.tab="addTag" @keydown.enter="addTag" @keydown.back="">
            <ul class="tags w-100" v-if="tags.length">
                <li v-for="(tag, index) in tags" class="tag">
                    {{ tag }}
                    <i class="las la-times close" @click="removeTag(index)"></i>
                </li>
            </ul>
        </div>
    </InputContainer>
</template>

<script>

import NLInput from './NLInput'
import InputContainer from './InputContainer'
export default {
    name: 'NLTagInput',
    components: {
        NLInput, InputContainer
    },
    props: {
        form: { type: Object, required: false, default: null },
        name: { type: String },
        id: { type: String },
        label: { type: String, default: '' },
        labelRequired: { type: Boolean, default: false },
        placeholder: { type: String, default: '' },
        modelValue: { type: [ String, Array ], default: '' },
        helpText: { type: String, default: null }
    },
    emits: [ 'update:modelValue' ],

    data() {
        return {
            tags: [],
            tag: null,
        }
    },
    created() {
        this.formatTags()
    },
    updated() {
        this.formatTags()
    },
    computed: {
        getId() {
            if (this.id) {
                return this.id
            } else if (!this.id && this.name) {
                return this.name
            } else {
                return ''
            }
        }
    },
    methods: {
        /**
         * Convert tags string to array
         */
        formatTags() {
            if (typeof this.tags == 'string') {
                this.tags = this.modelValue.split(',')
            } else {
                this.tags = this.modelValue
            }
        },
        /**
         * Push new tag to tags array
         * @param {Event} tag
         */
        addTag(tag) {
            tag.preventDefault()
            let value = tag.target.value.replace(',', '').trim()
            if (!this.tags.includes(value) && value.length) {
                this.tags.push(value)
                this.$emit('update:modelValue', this.tags)
            }
            this.tag = null
        },

        /**
         * Remove specified tag from tags array
         * @param {Number} index
         */
        removeTag(index) {
            if (this.tags.length) {
                this.tags.splice(index, 1);

                this.$emit('update:modelValue', this.tags)
            }
        },
        /**
         * Update tag value
         *
         * @param {Object} $event
         */
        onInput($event) {
            if ($event.data == ',') {
                this.addTag($event)
            } else {
                this.tag = $event.target.value
            }
        },
    },
}
</script>
