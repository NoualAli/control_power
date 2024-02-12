<template>
    <NLModal :show="show" @close="close">
        <template #title>
            Configurer votre exportation excel
        </template>
        <template #default>
            <NLGrid class="box">
                <NLColumn lg="6">
                    <NLSwitch label="Garder la recherche actuelle" v-model="keep_search" />
                </NLColumn>
                <!-- <NLColumn lg="6">
                    <NLSwitch label="Garder les filtres actuels" v-model="keep_filters" />
                </NLColumn> -->
                <NLColumn lg="6">
                    <NLSwitch label="Garder le trie actuel" v-model="keep_sorting" />
                </NLColumn>
                <NLColumn lg="6">
                    <NLSwitch label="Garder la pagination actuelle" v-model="keep_current_pagination" />
                </NLColumn>
                <!-- <NLColumn lg="6">
                    <NLSwitch label="Depuis la page actuelle" v-model="keep_current_page" />
                </NLColumn> -->
            </NLGrid>
        </template>
        <template #footer>
            <button class="btn btn-office-excel has-icon" @click.stop="exportExcel">
                <NLIcon name="table" />
                Exporter
            </button>
        </template>
    </NLModal>
</template>

<script>
import NLGrid from '../components/Grid/NLGrid'
import NLSwitch from '../components/Inputs/NLSwitch'
import NLColumn from '../components/Grid/NLColumn'
import NLForm from '../components/NLForm'
import NLModal from '../components/NLModal'
export default {
    components: {
        NLGrid,
        NLSwitch,
        NLColumn,
        NLForm,
        NLModal
    },
    props: {
        show: { type: Boolean, required: true },
        hideOptions: { type: Boolean, required: false },
        route: { type: [ String, null ], required: true },
    },
    emits: [ 'close' ],
    watch: {
        show(newVal, oldVal) {
            if (!newVal) {
                this.keep_filters = false
                this.keep_sorting = false
                this.keep_current_pagination = false
                this.keep_current_page = false
                this.keep_search = false
            } else {
                this.url = this.route
            }
        },
        keep_filters(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.url += '&export[keep_filters]=1'
            } else {
                this.url += '&export[keep_filters]=0'
            }
        },
        keep_sorting(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.url += '&export[keep_sorting]=1'
            } else {
                this.url += '&export[keep_sorting]=0'
            }
        },
        keep_current_pagination(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.url += '&export[keep_current_pagination]=1'
            } else {
                this.url += '&export[keep_current_pagination]=0'
            }
        },
        keep_current_page(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.url += '&export[keep_current_page]=1'
            } else {
                this.url += '&export[keep_current_page]=0'
            }
        },
        keep_search(newVal, oldVal) {
            if (newVal !== oldVal && newVal) {
                this.url += '&export[keep_search]=1'
            } else {
                this.url += '&export[keep_search]=0'
            }
        },
    },
    data() {
        return {
            url: this.route,
            keep_filters: false,
            keep_sorting: false,
            keep_current_pagination: false,
            keep_current_page: false,
            keep_search: false
        }
    },
    updated() {
        if (this.hideOptions) {
            this.exportExcel()
        }
        this.getUrl('keep_filters', this.keep_filters)
        this.getUrl('keep_sorting', this.keep_sorting)
        this.getUrl('keep_current_pagination', this.keep_current_pagination)
        this.getUrl('keep_current_page', this.keep_current_page)
        this.getUrl('keep_search', this.keep_search)
    },
    created() {
        this.getUrl('keep_filters', this.keep_filters)
        this.getUrl('keep_sorting', this.keep_sorting)
        this.getUrl('keep_current_pagination', this.keep_current_pagination)
        this.getUrl('keep_current_page', this.keep_current_page)
        this.getUrl('keep_search', this.keep_search)
    },
    methods: {
        close() {
            this.url = this.route
            this.keep_filters = false
            this.keep_sorting = false
            this.keep_current_pagination = false
            this.keep_current_page = false
            this.keep_search = false
            this.$emit('close')
        },
        exportExcel() {
            window.open(this.url, '_blank')
            this.close()
        },
        getUrl(filter, value) {
            if (filter == 'keep_filters' && value) {
                this.url += '&export[keep_filters]=1'
            } else if (filter == 'keep_filters' && !value) {
                this.url += '&export[keep_filters]=0'
            }
            if (filter == 'keep_sorting' && value) {
                this.url += '&export[keep_sorting]=1'
            } else if (filter == 'keep_sorting' && !value) {
                this.url += '&export[keep_sorting]=0'
            }
            if (filter == 'keep_current_pagination' && value) {
                this.url += '&export[keep_current_pagination]=1'
            } else if (filter == 'keep_current_pagination' && !value) {
                this.url += '&export[keep_current_pagination]=0'
            }
            if (filter == 'keep_current_page' && value) {
                this.url += '&export[keep_current_page]=1'
            } else if (filter == 'keep_current_page' && !value) {
                this.url += '&export[keep_current_page]=0'
            }
            if (filter == 'keep_search' && value) {
                this.url += '&export[keep_search]=1'
            } else if (filter == 'keep_search' && !value) {
                this.url += '&export[keep_search]=0'
            }
        }
    }
}
</script>
