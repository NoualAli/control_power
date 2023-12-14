<template>
    <input type="search" @keyup="handleSearch" v-model.trim.lazy="appliedSearch" class="input m-0 search-bar"
        placeholder="Faite votre recherche...">
</template>

<script>
export default {
    name: 'SearchBar',
    emits: [ 'search' ],
    props: {
        searchValue: { type: [ String, null ], required: false, default: null }
    },
    data() {
        return {
            appliedSearch: '',
        }
    },
    watch: {
        appliedSearch(newValue, oldValue) {
            if (newValue !== oldValue) {
                this.$emit('search', newValue)
            }
        }
    },
    created() {
        if (this.searchValue) {
            this.appliedSearch = this.searchValue
        }
    },
    methods: {
        handleSearch(e, forceSearch) {
            if (e.key == 'Backspace' && e.target.value == '') {
                this.appliedSearch = ''
            } else if (e.key == 'Enter' && e.target.value) {
                this.appliedSearch = e.target.value
            }
            return
        }
    }
}
</script>
