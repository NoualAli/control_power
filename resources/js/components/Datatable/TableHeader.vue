<template>
    <th @click="handleSorting" :colspan="colspan" :align="align"
        :class="[{ 'is-sortable': sortable, 'is-active': direction !== null }, thClass]" v-if="!hide" ref="table-header">
        <span v-if="!isHtml">
            <slot :column="column"></slot>
            {{ label }}
            <!-- <NLIcon name="arrow_downward" v-if="direction == 'asc'"/>
            <NLIcon name="arrow_downward" v-if="direction == 'down'"/> -->
            <i class="las la-arrow-down"
                :class="{ 'la-arrow-down': direction == 'asc', 'la-arrow-up': direction == 'desc' }"
                v-if="sortable && (direction == 'asc' || direction == 'desc')"></i>
        </span>
        <span
            :class="[{ 'd-flex justify-center align-center': align == 'center', 'd-flex justify-start align-center': align == 'left', 'd-flex justify-end align-center': align == 'right' }]"
            v-html="label" v-else></span>
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
                let sortingColumn = typeof this.sortable !== 'boolean' ? this.sortable : this.column.field
                this.$emit('sorted', { column: this.column, sortingColumn, direction: this.direction })
            }
        }
    }
}
</script>
