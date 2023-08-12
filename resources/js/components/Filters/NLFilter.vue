<template>
    <NLContainer v-if="isOpen" isFluid>
        <NLGrid gap="2">
            <NLColumn v-for="(filter, name) in filters" v-if="!hide(filter)" :key="'filter-' + name" :lg="columns(filter)">
                <NLSelect v-if="type(filter) == 'select'" v-model="filter.value" :name="name" :label="label(filter)"
                    :options="data(filter)" :multiple="multiple(filter)" />
                <NLGrid gap="2" v-if="type(filter) == 'date-range'">
                    <NLColumn :lg="columns(filter)" v-for="(attrData, attrName) in filter.attributes"
                        v-if="type(filter) === 'data-range'" :key="'filter-' + attrName" :class="data?.cols || 'col-lg-6'">
                        <NLInput v-model="attrData.value" :name="attrName" :label="attrData.label" type="date" />
                    </NLColumn>
                </NLGrid>
            </NLColumn>
        </NLGrid>
    </NLContainer>
</template>

<script>
import NLGrid from '../Grid/NLGrid'
export default {
    components: { NLGrid },
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
        }
    },
    computed: {
        columns() {
            return (filter) => filter?.cols || '2'
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
            return (filter) => filter?.data || []
        },
        hide() {
            return (filter) => filter?.hide || false
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
                for (const key in newValue) {
                    if (Object.hasOwnProperty.call(newValue, key)) {
                        const newItem = newValue[ key ]
                        const oldItem = Object.hasOwnProperty(oldValue, key) ? oldValue[ key ] : null
                        const newItemValue = newItem?.value;
                        // const oldItemValue = oldItem?.value || null;
                        // console.log(newItemValue, oldValue, key, Object.hasOwnProperty(oldValue, key));
                        // console.log(typeof Boolean(newItemValue));
                        if (newItemValue !== null && newItemValue !== '') {
                            this.$emit('filtered', this.filters)
                        }
                    }
                }
                // console.log(newValue, oldValue);
            },
            deep: true,
            immediate: true

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
            })
        },
        getUrl() {
            let urlPrefix = this.urlPrefix || this.parentUrlPrefix
            this.url = this.customUrl ? this.customUrl + urlPrefix : window.Laravel.baseUrl + '/api/' + urlPrefix
            this.url += '?fetchFilters=true'
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
            let unloaded = 0
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

<!-- <template>
    <NLContainer v-if="isOpen" isFluid>
        <NLGrid gap="2">
            <NLColumn v-for="(filter, name) in filters" v-if="!hide(filter)" :key="'filter-' + name" :lg="columns(filter)">
                <NLSelect v-if="type(filter) == 'select'" v-model="filter.value" :name="name" :label="label(filter)"
                    :options="data(filter)" :multiple="multiple(filter)" />
                <NLGrid gap="2" v-if="type(filter) == 'date-range'">
                    <NLColumn :lg="columns(filter)" v-for="(attrData, attrName) in filter.attributes"
                        v-if="type(filter) === 'data-range'" :key="'filter-' + attrName" :class="data?.cols || 'col-lg-6'">
                        <NLInput v-model="attrData.value" :name="attrName" :label="attrData.label" type="date" />
                    </NLColumn>
                </NLGrid>
            </NLColumn>
        </NLGrid>
    </NLContainer>
</template>

<script>
import NLGrid from '../Grid/NLGrid'
export default {
    components: { NLGrid },
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
            internalFilters: {},
            appliedFilters: []
        }
    },
    computed: {
        columns() {
            return (filter) => filter?.cols || '2'
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
            return (filter) => filter?.data || []
        },
        hide() {
            return (filter) => filter?.hide || false
        },
    },
    watch: {
        isOpen(newValue, oldValue) {
            if (newValue !== oldValue && newValue && !this.isLoaded) {
                this.loadData()
            } else {
                console.log('unload');
                this.unloadData()
            }
        },
        filters: {
            handler(newValue, oldValue) {
                // let valuesUpdated = 0
                // for (const key in newValue) {
                //     if (Object.hasOwnProperty.call(newValue, key)) {
                //         const newItem = newValue[ key ]?.value || []
                //         const oldItem = this.appliedFilters && Object.hasOwnProperty.call(this.appliedFilters, key) ? this.appliedFilters[ key ] : []
                //         const newItemValue = typeof newItem == 'array' || typeof newItem == 'object' ? newItem.join(',') : '';
                //         // if (key == 'family') {
                //         //     console.log('old item ' + key + ': ', oldItem);
                //         // }
                //         // const oldItemValue = typeof oldItem == 'array' ? oldItem?.value.join(',') : '';
                //         // if (key == 'family') {
                //         //     console.log('old item value ' + key + ': ', oldItemValue);
                //         //     console.log(newItemValue !== oldItemValue);
                //         // }
                //         // console.log(newItemValue, oldItemValue);
                //         // if (newItemValue !== oldItemValue) {
                //         //     valuesUpdated += 1
                //         // } else {
                //         //     valuesUpdated = 0
                //         // }
                //     }
                // }
                // this.loadData()
                this.$emit('filtered')
                // console.log(this.appliedFilters);
                // if (valuesUpdated) {
                //     console.log('values updated :' + valuesUpdated);
                //     this.appliedFilters = newValue
                // }
                // this.$emit('filtered', this.filters)
            },
            deep: true,
            immediate: false
        },
        appliedFilters(newValue, oldValue) {
            console.log(newValue, oldValue);
        }
    },
    created() {
        this.loadData()
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
            })
        },
        getUrl() {
            let urlPrefix = this.urlPrefix || this.parentUrlPrefix
            this.url = this.customUrl ? this.customUrl + urlPrefix : window.Laravel.baseUrl + '/api/' + urlPrefix
            this.url += this.formatQueryString()
        },
        formatQueryString() {
            let queryString = '?fetchFilters='
            let filters = []
            let keyPosition = 0
            for (const key in this.filters) {
                if (Object.hasOwnProperty.call(this.filters, key)) {
                    keyPosition += 1
                    const element = this.filters[ key ];
                    filters.push(key)
                    // if (keyPosition == 1) {
                    //     filters.push(key)
                    // } else if (keyPosition >= 2) {
                    //     if (element?.dependsOn) {
                    //         this.filters[ element?.dependsOn ].value ? filters.push(key) : null
                    //     } else {
                    //         filters.push(key)
                    //     }
                    // }
                }
            }
            if (filters?.length) {
                queryString += filters.join(',')
            }
            console.log(queryString);
            return queryString

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
            let unloaded = 0
            for (const key in this.filters) {
                if (Object.hasOwnProperty.call(this.filters, key)) {
                    if (this.filters[ key ].value) {
                        this.filters[ key ].value = null
                        unloaded += 1
                    }
                }
            }
            if (unloaded) {
                console.log('unloaded');
                this.$emit('unloaded')
            }
        },
    },
}
</script> -->
