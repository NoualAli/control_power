<template>
    <th @click="handleSorting" :colspan="colspan" :align="align"
        :class="[{ 'is-sortable': sortable, 'is-active': direction !== null }, thClass]" v-if="!hide" ref="table-header">
        <slot :column="column"></slot>
        {{ label }}
        <i class="las la-arrow-down" :class="{ 'la-arrow-down': direction == 'asc', 'la-arrow-up': direction == 'desc' }"
            v-if="sortable && (direction == 'asc' || direction == 'desc')"></i>
    </th>
</template>

<script>
export default {
    name: 'TableHeader',
    emits: [ 'sorted' ],
    props: {
        column: {
            type: [ Object, null ],
            required: false,
            default: null,
        },
    },
    data() {
        return {
            direction: null
        }
    },
    computed: {
        thClass() {
            if (typeof this.column?.extraClass?.th == 'function') {
                return this.column?.extraClass?.th(this.item)
            }
            return this.column?.extraClass?.th || ''
        },
        hide() {
            return !!this.column?.hide || false
        },
        label() {
            return this.column?.label || null
        },
        field() {
            return this.column?.field || null
        },
        colspan() {
            return this.column?.colspan || 1
        },
        align() {
            return this.column?.align || 'left'
        },
        isHtml() {
            return this.column?.isHtml || false
        },
        sortable() {
            return this.column?.sortable || false
        }
    },
    methods: {
        handleSorting() {
            if (this.sortable) {
                if (!this.direction) {
                    this.direction = 'desc'
                } else if (this.direction == 'desc') {
                    this.direction = 'asc'
                } else {
                    this.direction = null
                }
                this.$emit('sorted', { column: this.column, direction: this.direction })
            }
        }
    }
}
</script>
