<template>
    <div class="has-tooltip">
        <slot></slot>
        <div :class="'tooltip is-' + type" v-if="isHtml">
            <slot name="content"></slot>
        </div>
        <div :class="'tooltip is-' + type" v-else>
            {{ title }}
        </div>
    </div>
</template>

<script>
export default {
    name: 'NLTooltip',
    props: {
        title: {
            type: String,
            default: 'Undefined title'
        },
        type: {
            type: String,
            default: 'top',
            validator(value) {
                return [ 'top', 'bottom', 'left', 'right' ].includes(value)
            }
        }
    },

    computed: {
        isHtml() {
            return this.$slots.hasOwnProperty('content')
        }
    }
}
</script>
