<template>
    <component :is="elementType" :class="[iconClass, extraClass]" @click="$emit('click', $event)">
        {{ icon }}
    </component>
</template>

<script>
export default {
    name: "NLIcon",
    props: {
        name: { type: String, default: "question_mark" },
        extraClass: { type: String },
        type: { type: String, default: "material" },
        prefix: { type: String, default: "las" },
    },
    computed: {
        elementType() {
            return this.type === "material" ? "span" : "i";
        },
        iconClass() {
            return this.type === "material"
                ? [ "material-icons", "material-symbols-rounded" ]
                : [ this.prefix, "la-" + this.name ];
        },
        icon() {
            return this.type === "material" ? this.name : null;
        },
    },
};
</script>
