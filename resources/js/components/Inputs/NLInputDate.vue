<template>
    <InputContainer :id="getId" :form="form" :label="label" :name="name" :label-required="labelRequired"
        :help-text="helpText" v-if="!readonly">
        <div class="input-container">
            <input :id="getId" :class="[{ 'is-danger': form?.errors.has(name) }, 'input']" :type="type" :name="name"
                :autocomplete="autocomplete" :autofocus="autofocus" :placeholder="placeholder || label" :value="modelValue"
                :readonly="readonly" v-bind="$attrs" @input="onInput" @keypresse="isNumber" :max="max" :min="min">
        </div>
    </InputContainer>
    <div class="input-base-container" v-else>
        <label class="label">{{ label }}</label>
        <div class="content text-normal bg-parimary my-2">{{ modelValue }}</div>
    </div>
</template>

<script>

import InputContainer from './InputContainer'
export default {
    name: 'NLInputDate',
    components: { InputContainer },
    props: {
        form: { type: Object, required: false, default: null },
        autocomplete: { type: String, default: 'off' },
        autofocus: { type: Boolean, default: false },
        type: {
            type: String, default: 'date', validator: (value) => {
                return [ 'date', 'datetime', 'time', 'month', 'week' ].includes(value)
            }
        },
        name: { type: String },
        id: { type: String },
        label: { type: String, default: '' },
        labelRequired: { type: Boolean, default: false },
        placeholder: { type: String, default: '' },
        modelValue: { type: [ String, Number ], default: '' },
        readonly: { type: Boolean, default: false },
        length: { type: [ Number, String ], default: null },
        helpText: { type: String, default: null },
        max: { type: String, default: null },
        min: { type: String, default: null },
    },
    emits: [ 'update:modelValue' ],
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
         * handle input event
         *
         * @param {Object} $event
         */
        onInput($event) {
            let value = $event.target.value
            this.$emit('update:modelValue', value)
        },
    },
}
</script>
