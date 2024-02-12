<template>
    <slot name="filter"></slot>
    <NLFlex extraClass="my-6">
        <!-- <NLHeading type="2">{{ title }}</NLHeading> -->
        <NLFlex alignItems="center" gap="2">
            <NLButton class="btn-filter" :class="{ 'btn-danger': filterIsOpen }" v-if="hasFilters"
                @click.stop="(e) => this.handleFilterState(e)">
                <NLIcon name="filter_list" v-if="!filterIsOpen" />
                <NLIcon name="filter_list_off" v-if="filterIsOpen" />
            </NLButton>
            <SearchBar @search="(e) => this.$emit('search', e)" :searchValue="searchValue" v-if="isSearchable" />
        </NLFlex>
        <NLFlex extraClass="actions" gap="2" alignItems="center" justifyContent="end">
            <slot name="table-actions"></slot>
        </NLFlex>
    </NLFlex>
    <div class="table-container">
        <table>
            <TableHead>
                <slot name="head"></slot>
            </TableHead>
            <TableBody>
                <slot name="body"></slot>
            </TableBody>
            <TableFoot>
                <slot name="foot"></slot>
            </TableFoot>
        </table>
        <slot name="pagination"></slot>
        <NLComponentLoader :isLoading="isLoading" />
    </div>
</template>

<script>
import NLComponentLoader from '../NLComponentLoader'
import NLIcon from '../NLIcon'
import NLButton from '../Inputs/NLButton'
import NLFlex from '../Grid/NLFlex'
import NLSelect from '../Inputs/NLSelect'
import SearchBar from './SearchBar'
import TableFoot from './TableFoot'
import TableBody from './TableBody'
import TableHead from './TableHead'

export default {
    components: {
        NLComponentLoader,
        NLIcon,
        NLButton,
        NLFlex,
        NLSelect,
        SearchBar,
        TableFoot,
        TableBody,
        TableHead,
    },
    emits: [ 'search', 'toggleFilter' ],
    props: {
        isLoading: { type: Boolean, required: false, default: true },
        title: { type: [ String, null ], default: null },
        filters: { type: [ Object, Array ], required: false, default: () => { } },
        isSearchable: { type: Boolean, require: false, default: true },
        searchValue: { type: [ String, null ], required: false, default: null }
    },
    data() {
        return {
            filterIsOpen: false
        }
    },
    computed: {
        hasFilters() {
            if (typeof this.filters == 'object') {
                return Object.values(this.filters).length
            } else if (typeof this.filters == 'array') {
                return this.filters.length
            }
        },
    },
    methods: {
        handleFilterState(e) {
            this.filterIsOpen = !this.filterIsOpen
            this.$emit('toggleFilter', e)
        }
    }
}
</script>
