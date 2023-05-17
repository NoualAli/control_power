<template>
    <div class="d-flex" :class="[gapPrefixed, fullCenter, justifyContent, alignItems, extraClass]">
        <slot></slot>
    </div>
</template >

<script>
export default {
    name: 'NLFlex',
    props: {
        extraClass: {
            type: String,
            required: false,
            default: null,
        },
        justifyContent: {
            type: String,
            default: null,
            required: false,
            validator(value) {
                return [
                    'justify-normal',
                    'justify-center',
                    'justify-start',
                    'justify-end',
                    'justify-left',
                    'justify-right',
                    'justify-between',
                    'justify-around',
                    'justify-evenly',
                    'justify-stretch',
                    'justify-revert-layer',
                ].includes(value)
            }
        },
        mdJstifyContent: {
            type: String,
            default: null,
            required: false,
            validator(value) {
                return [
                    'justify-md-center',
                    'justify-md-start',
                    'justify-md-end',
                    'justify-md-flex-start',
                    'justify-md-flex-end',
                    'justify-md-left',
                    'justify-md-right',
                    'justify-md-space-between',
                    'justify-md-space-around',
                    'justify-md-space-evenly',
                    'justify-md-stretch',
                    'justify-md-revert-layer',
                ].includes(value)
            }
        },
        lgJustifyContent: {
            type: String,
            default: null,
            required: false,
            validator(value) {
                return [
                    'justify-lg-center',
                    'justify-lg-start',
                    'justify-lg-end',
                    'justify-lg-flex-start',
                    'justify-lg-flex-end',
                    'justify-lg-left',
                    'justify-lg-right',
                    'justify-lg-space-between',
                    'justify-lg-space-around',
                    'justify-lg-space-evenly',
                    'justify-lg-stretch',
                    'justify-lg-revert-layer',
                ].includes(value)
            }
        },
        alignItems: {
            type: String,
            default: null,
            required: false,
            validator(value) {
                return [
                    'align-center',
                    'align-start',
                    'align-end',
                    'align-self-start',
                    'align-self-end',
                    'align-baseline',
                    'align-initial',
                    'align-inherit',
                    'align-revert-layer',
                ].includes(value)
            },
        },
        mdAlignItems: {
            type: String,
            default: null,
            required: false,
            validator(value) {
                return [
                    'align-md-center',
                    'align-md-start',
                    'align-md-end',
                    'align-md-flex-start',
                    'align-md-flex-end',
                    'align-md-self-start',
                    'align-md-self-end',
                    'align-md-baseline',
                    'align-md-initial',
                    'align-md-inherit',
                    'align-md-revert-layer',
                ].includes(value)
            },
        },
        lgAlignItems: {
            type: String,
            default: null,
            required: false,
            validator(value) {
                return [
                    'align-lg-center',
                    'align-lg-start',
                    'align-lg-end',
                    'align-lg-flex-start',
                    'align-lg-flex-end',
                    'align-lg-self-start',
                    'align-lg-self-end',
                    'align-lg-baseline',
                    'align-lg-initial',
                    'align-lg-inherit',
                    'align-lg-revert-layer',
                ].includes(value)
            },
        },
        direction: {
            type: String,
            default: null,
            required: false,
            validator(value) {
                return [
                    'is-row',
                    'is-column',
                    'is-row-reverse',
                    'is-column-reverse',
                ].includes(value)
            },
        },
        mdDirection: {
            type: String,
            default: null,
            required: false,
            validator(value) {
                return [
                    'is-md-row',
                    'is-md-column',
                    'is-md-row-reverse',
                    'is-md-column-reverse',
                ].includes(value)
            },
        },
        lgDirection: {
            type: String,
            default: null,
            required: false,
            validator(value) {
                return [
                    'is-lg-row',
                    'is-lg-column',
                    'is-lg-row-reverse',
                    'is-lg-column-reverse',
                ].includes(value)
            },
        },
        isFullCentered: {
            type: Boolean,
            default: false,
            required: false,
        },
        gap: {
            type: String,
            required: false,
            default: '6',
            validator(value) {
                return [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' ].includes(value)
            }
        },
    },
    computed: {
        gapPrefixed() {
            return 'gap-' + this.gap
        },
        fullCenter() {
            return this.isFullCentered ? 'full-center' : null
        },
    },
}
</script>
