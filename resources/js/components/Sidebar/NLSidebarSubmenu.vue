<template>
    <div class="sidebar-submenu" :class="{ 'expanded': expanded }">
        <a class="sidebar-item sidebar-submenu-title" :class="{ 'is-active': expanded }" @click="handle">
            <div class="left-side">
                <NLIcon :name="iconName" />
                <span class="sidebar-icon_text">
                    {{ label }}
                </span>
            </div>
            <div class="right-side">
                <NLIcon :name="expanded ? 'expand_less' : 'expand_more'" extraClass="expand-icon" />
            </div>
        </a>
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'NLSidebarSubmenu',
    props: {
        iconPrefix: { type: String, default: "las" },
        iconName: { type: String, required: false },
        label: { type: String, required: true }
    },
    data() {
        return {
            expanded: false
        }
    },
    created() {
        let self = this;
        window.addEventListener('click', function (e) {
            if (!self.$el.contains(e.target)) {
                self.expanded = false
            }
        })
    },
    methods: {
        handle() {
            this.expanded = !this.expanded
        }
    }
}
</script>
