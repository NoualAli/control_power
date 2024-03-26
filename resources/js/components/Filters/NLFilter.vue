<template>
    <NLContainer v-if="isOpen" extraClass="box" isFluid>
        <NLGrid gap="2">
            <NLColumn v-for="(filter, name) in filters" v-show="!filter?.hide" :key="'filter-' + name"
                :lg="columns(filter)">
                <NLSelect v-show="type(filter) == 'select' && !filter?.hide" v-model="filter.value" :name="name"
                    :label="label(filter)" :options="data(filter)" :multiple="multiple(filter)" />
                <NLInputDate v-show="type(filter) == 'date' == !filter.hide" v-model="filter.value" :name="name"
                    :label="filter.label" />
            </NLColumn>
        </NLGrid>
        <NLComponentLoader :isLoading="isLoading"></NLComponentLoader>
    </NLContainer>
</template>

<script>
import NLGrid from '../Grid/NLGrid'
import NLComponentLoader from '../NLComponentLoader'
export default {
    components: { NLGrid, NLComponentLoader },
    name: 'NLFilter',
    emits: [ 'filtered', 'unloaded' ],
    props: {
        isOpen: { type: Boolean, required: false, default: false },
        filters: { type: [ Object, null ], required: false, default: () => { } },
        customUrl: { type: String, default: null, required: false },
        urlPrefix: { type: [ String, null ], required: false, default: null },
        parentUrlPrefix: { type: String, required: true },
    },
    data() {
        return {
            isLoading: false,
            isLoaded: false,
            url: null,
            filter: null,
            activeFilterParams: '',
            forceReload: 1,
            oldFilterParams: ''
        }
    },
    computed: {
        columns() {
            return (filter) => filter.hide ? 0 : filter?.cols || '2'
        },
        type() {
            return (filter) => filter?.type || 'select'
        },
        label() {
            return (filter) => filter?.label || ''
        },
        multiple() {
            return (filter) => filter?.multiple || false
        },
        data() {
            return (filter) => {
                if (typeof filter.data == 'function') {
                    return filter?.data() || []
                } else {
                    return filter?.data || []
                }
            }
        },
        hide() {
            return (filter) => !!filter?.hide
        },
    },
    watch: {
        isOpen(newValue, oldValue) {
            if (newValue !== oldValue && newValue && !this.isLoaded) {
                this.loadData()
            } else {
                this.unloadData()
            }
        },
        filters: {
            handler(newValue, oldValue) {
                this.oldFilterParams = this.activeFilterParams
                this.activeFilterParams = ''
                for (const key in newValue) {
                    if (Object.hasOwnProperty.call(newValue, key)) {
                        const newItem = newValue[ key ]
                        const newItemValue = newItem?.value;
                        if (newItemValue !== null && newItemValue !== '' && newItemValue !== undefined) {
                            this.activeFilterParams += `&filter[${key}]=${newItemValue}`
                        }
                    }
                }
                this.$emit('filtered', this.filters)
            },
            deep: true,
            immediate: true
        },
        activeFilterParams: function (newValue, oldValue) {
            if (newValue !== oldValue) {
                this.loadData()
            } else {
                this.$emit('filtered', this.filters)
            }
        }
    },
    methods: {
        loadData() {
            this.isLoading = true
            this.getUrl()
            api.get(this.url).then(response => {
                this.isLoading = false
                this.hydrateFiltersData(response.data)
                this.isLoaded = true
            }).catch(error => {
                this.isLoading = false
                this.$swal.catchError(error)
            })
        },
        getUrl() {
            let urlPrefix = this.urlPrefix || this.parentUrlPrefix
            this.url = this.customUrl ? this.customUrl + urlPrefix : window.Laravel.baseUrl + '/api/' + urlPrefix
            this.url += '?fetchFilters=true'
            this.url += this.activeFilterParams
        },
        hydrateFiltersData(data) {
            for (const key in data) {
                if (Object.hasOwnProperty.call(data, key)) {
                    const item = data[ key ];
                    if (Object.hasOwnProperty.call(this.filters, key)) {
                        this.filters[ key ].data = item
                    }
                }
            }
        },

        unloadData() {
            for (const key in this.filters) {
                if (Object.hasOwnProperty.call(this.filters, key)) {
                    this.filters[ key ].value = null
                }
            }
            this.$emit('unloaded')
        },
    },
}
</script>
