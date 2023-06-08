<template>
    <div class="notification my-8" :class="type">
        <slot />
    </div>
</template>
<script>
export default {
    name: 'Notification',
    props: {
        type: {
            type: String, default: ''
        }
    }
}
</script>
