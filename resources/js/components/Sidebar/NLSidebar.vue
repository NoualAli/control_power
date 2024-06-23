<template>
    <div class="sidebar">
        <NLSidebarHeader />
        <NLSidebarBody />
        <NLSidebarFooter />
    </div>
</template>

<script>
import NLSidebarBody from './NLSidebarBody'
import NLSidebarFooter from './NLSidebarFooter'
import NLSidebarHeader from './NLSidebarHeader.vue'
export default {
    name: "NLSidebar",
    components: {
        NLSidebarHeader,
        NLSidebarBody,
        NLSidebarFooter,
    },
}
</script>
