<template>
    <NLGrid extraClass="pagination my-6">
        <NLColumn lg="2" extraClass="d-flex align-center justify-center">
            <NLGrid gap="2">
                <NLColumn lg="4" v-if="total > 10">
                    <NLSelect name="per_page" :options="perPageChoices" v-model="perPage" class="disable-clear-value" />
                </NLColumn>
                <NLColumn lg="8" extraClass="d-flex align-center justify-center gap-1">
                    <span>
                        Total {{ total }}
                    </span>
                    <span>
                        de {{ from }} à {{ to }}
                    </span>
                </NLColumn>
            </NLGrid>
        </NLColumn>
        <NLColumn lg="1" extraClass="d-flex justify-center align-center">
            <NLButton @click="handlePageChange(previousLink)" v-if="previousLink">
                <!-- Précédent -->
                <NLIcon name="navigate_before" />
            </NLButton>
        </NLColumn>
        <NLColumn lg="8" extraClass="d-flex justify-center align-center gap-2">
            <NLButton @click="handlePageChange(link?.url)"
                :class="{ 'is-active': link.active, 'is-disabled': link.active || link.label == '...' }"
                v-for="(link, index) in numericLinks" :key="'numeric-link-' + index" :id="'numeric-link-' + index"
                :disabled="link.active || link.label == '...'" v-if="numericLinks?.length > 1" :label="link.label">
            </NLButton>
        </NLColumn>
        <NLColumn lg="1" extraClass="d-flex justify-center align-center">
            <NLButton @click="handlePageChange(nextLink)" v-if="nextLink">
                <!-- Suivant -->
                <NLIcon name="navigate_next" />
            </NLButton>
        </NLColumn>
    </NLGrid>
</template>
<script>
export default {
    name: 'TablePagination',
    empits: [ 'pageChange', 'perPageChange' ],
    props: {
        data: { type: [ Object, null ], required: true },
        perPageChoices: { type: Array, required: false, default: () => [ { id: 10, label: '10' }, { id: 25, label: '25' }, { id: 50, label: '50' }, { id: 100, label: '100' }, { id: 250, label: '250' } ] },
    },
    watch: {
        perPage(newValue, oldValue) {
            if (newValue !== oldValue) {
                this.$emit('perPageChange', newValue)
            }
        },
    },
    data() {
        return {
            perPage: 10,
        }
    },
    methods: {
        /**
         * Handle page change
         *
         * @param {String}
         */
        handlePageChange(url) {
            let page = url?.split('?')[ 1 ].split('=')[ 1 ]
            this.$emit('pageChange', page)
        },
    },
    computed: {
        /**
         * Get url from data
         */
        url() {
            return this.data?.meta?.path
        },

        /**
         * Get amount of total data
         */
        total() {
            return this.data?.meta?.total ?? 0
        },

        /**
         * Get length of showed data
         */
        count() {
            return this.data?.data?.length
        },

        /**
         * Show viewed data (from part)
         */
        from() {
            return this.data?.meta?.from
        },

        /**
         * Show viewed data (to part)
         */
        to() {
            return this.data?.meta?.to
        },

        /**
         * Get links list
         */
        links() {
            return this.data?.meta?.links
        },

        /**
         * Show numeric links
         */
        numericLinks() {
            return this.data?.meta?.links.filter(link => link.label !== '&laquo; Précédent' && link.label !== 'Suivant &raquo;')
        },

        /**
         * Show previous link
         */
        previousLink() {
            return this.data?.links?.prev
        },

        /**
         * Show next link
         */
        nextLink() {
            return this.data?.links?.next
        },
        /**
         * Check if should show pagination or not
         */
        showPagination() {
            return this.total > this.data?.meta?.per_page
        },
    },
}
</script>
