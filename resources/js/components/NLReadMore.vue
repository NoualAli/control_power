<template>
    <div>
        <div class="my-2 content text-normal" v-html="displayedContent"></div>
        <div class="text-bold text-small is-clickable" @click="toggleReadMore" v-if="value.length > maxDisplayLength">
            {{ isReadMore ? "Lire moins" : "Lire plus" }}
        </div>
    </div>
</template>

<script>
export default {
    name: 'NLReadMore',
    props: {
        value: { type: [ String, Number, null ], required: true, default: null },
        maxDisplayLength: { type: [ String, Number ], required: false, default: 250 }
    },
    data() {
        return {
            isReadMore: false,
        };
    },
    computed: {
        displayedContent() {
            return this.isReadMore
                ? this.value
                : this.value.slice(0, this.maxDisplayLength);
        },
    },
    methods: {
        toggleReadMore() {
            this.isReadMore = !this.isReadMore;
        },
    },
};
</script>
