<template>
    <NLCheckableContainer :id="getId" :name="name" :form="form" :label="label" :help-text="helpText">
        <input :id="getId" :key="refresh" v-model="selected" type="checkbox"
            :class="[{ 'is-danger': form?.errors.has(name), 'readonly': readonly }, 'switch-input']" :name="name"
            @change="updateValue">
        <div class="switch" :class="[type, { 'readonly': readonly }]" @click="updateValue" />
    </NLCheckableContainer>
</template>

<script>
import NLIcon from '../NLIcon'
import NLCheckableContainer from './NLCheckableContainer'
export default {
    name: 'NLSwitch',
    components: {
        NLIcon, NLCheckableContainer
    },
    props: {
        form: { type: Object, required: false },
        name: { type: String },
        label: { type: String, required: true },
        modelValue: { type: Boolean, default: false },
        id: { type: [ String, null ], default: null },
        helpText: { type: String, default: null },
        type: { type: String, default: null },
        readonly: { type: Boolean, default: false }
    },
    emits: [ 'update:modelValue', 'switched' ],
    data() {
        return {
            refresh: false,
            selected: this.modelValue
        }
    },
    watch: {
        modelValue(newValue, oldValue) {
            if (newValue !== oldValue) {
                this.selected = newValue
                this.refresh = true
            }
        },
        selected(newValue, oldValue) {
            this.$emit('update:modelValue', this.selected)
        }
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
        updateValue() {
            if (!this.readonly) {
                this.selected = !this.selected
                this.$emit('switched', this.selected)
            }
        }
    }
}
</script>
