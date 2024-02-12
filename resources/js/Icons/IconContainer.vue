<template>
    <span v-bind="$attrs" :aria-hidden="false" :aria-label="title" :class="'material-design-icon' + iconName" role="img"
        @click="$emit('click', $event)">
        <slot></slot>
    </span>
</template>

<script>
export default {
    name: 'IconContainer',
    emits: [ 'click' ],
    props: {
        iconName: {
            type: String,
        },
    }
}
</script>
