<template>
    <InputContainer :id="getId" :form="form" :label="label" :name="name" :label-required="labelRequired"
        :length="length" :current-length="currentLength" :help-text="helpText" v-if="!readonly">
        <div class="input-container" :class="{ 'is-password-input': type == 'password' }">
            <input :id="getId" :maxlength="length"
                :class="[{ 'is-danger': form?.errors.has(name) }, 'input', { 'is-for-auth': isForAuth }]"
                :type="finalType" :name="name" :autocomplete="autocomplete" :autofocus="autofocus"
                :placeholder="placeholder || label" :value="modelValue" :readonly="readonly" v-bind="$attrs"
                @input="onInput" @keypresse="isNumber" step="0.01">

            <div v-if="type == 'password'" class="show-password-btn has-icon"
                :class="{ 'is-danger': form?.errors.has(name) }" @click="toggleType">
                <!-- <i class="las text-small" :class="eyeIcon" /> -->
                <NLIcon :name="eyeIcon" />
            </div>
        </div>
    </InputContainer>
    <div class="input-base-container" v-else>
        <label class="label">{{ label }}</label>
        <div class="input-container">
            <div class="input is-disabled">{{ modelValue || '-' }}</div>
        </div>
    </div>
</template>

<script>

import NLIcon from '../NLIcon'
import InputContainer from './InputContainer'
export default {
    name: 'NLInput',
    components: {
        NLIcon, InputContainer
    },
    props: {
        form: { type: Object, required: false, default: null },
        autocomplete: { type: String, default: 'off' },
        autofocus: { type: Boolean, default: false },
        type: { type: String, default: 'text' },
        name: { type: String },
        id: { type: String },
        label: { type: String, default: '' },
        labelRequired: { type: Boolean, default: false },
        placeholder: { type: String, default: '' },
        modelValue: { type: [ String, Number ], default: '' },
        readonly: { type: Boolean, default: false },
        length: { type: [ Number, String ], default: null },
        helpText: { type: String, default: null }
    },
    emits: [ 'update:modelValue' ],

    data() {
        return {
            finalType: this.type,
            eyeIcon: 'visibility',
            isForAuth: false,
            currentLength: 0
        }
    },
    created() {
        if (this.length && this.modelValue) {
            this.currentLength = this.modelValue.length
        }
        this.finalType = this.readonly ? 'text' : this.type
        this.isForAuth = window.location.pathname === '/login'
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
         * handle input event
         *
         * @param {Object} $event
         */
        onInput($event) {
            let value = $event.target.value
            this.currentLength = value.length

            if (this.type === 'number') {
                value = this.sanitizeInput(value)
            }

            if (this.length) {
                value = value.slice(0, this.length)
            }

            this.$emit('update:modelValue', value)
        },
        /**
         * Sanitize input from special chars
         *
         * @param {*} value
         */
        sanitizeInput(value) {
            return value
            // return value.replace(/[^\w\s-+-]/gi, '')
        },
        /**
         * Used by password field to show input value
         */
        toggleType() {
            if (this.finalType === 'password') {
                this.finalType = 'text'
                // this.eyeIcon = 'las la-eye-slash'
                this.eyeIcon = 'visibility_off'
            } else {
                this.finalType = 'password'
                // this.eyeIcon = 'las la-eye'
                this.eyeIcon = 'visibility'
            }
        },
        isNumber($event) {
            if (this.type !== 'number') return true
            const charCode = ($event.which) ? $event.which : $event.keyCode
            if ((!(charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46)) return true
            $event.preventDefault()
        }
    },
}
</script>
