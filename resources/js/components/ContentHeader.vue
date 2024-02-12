<template>
    <header class="content-header d-flex justify-between align-center py-5">
        <h2 v-if="hasTitle">
            <slot name="title"></slot>
        </h2>
        <NLFlex extraClass="actions" gap="2" alignItems="center" justifyContent="end">
            <slot name="left-actions"></slot>
        </NLFlex>
        <NLFlex extraClass="actions" gap="2" alignItems="center" justifyContent="end">
            <slot name="right-actions"></slot>
        </NLFlex>
    </header>
</template>

<script>
export default {
    name: "ContentHeader",
    props: {
        title: { type: String, default: null }
    },
    computed: {
        hasTitle() {
            return this.$slots.hasOwnProperty('title')
        },
        hasLeftActions() {
            return this.$slots.hasOwnProperty('left-actions')
        },
        hasRightActions() {
            return this.$slots.hasOwnProperty('right-actions')
        }
    },
}
</script>
