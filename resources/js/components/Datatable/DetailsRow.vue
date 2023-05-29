<template>
    <tr class="details-row">
        <td :colspan="span">
            <NLContainer isFluid>
                <div class="details-row-loader-container" v-if="isLoading">
                    <div class="details-row-loader"></div>
                    <div class="details-row-loader-text">
                        Chargement en cours
                    </div>
                </div>
                <div v-else>
                    <div v-for="column in columns" class="py-2">
                        <span class="text-bold">
                            {{ label(column) }} :
                        </span>
                        &nbsp;
                        <span v-if="!isHtml(column) && !hasMany(column)">
                            {{ showField(column) }}
                        </span>
                        <span v-html="showField(column)" v-else></span>
                    </div>
                </div>
            </NLContainer>
        </td>
    </tr>
</template>

<script>
import NLContainer from '../NLContainer'
export default {
    components: { NLContainer },
    name: 'DetailsRow',
    props: {
        columns: { type: [ Object, null ], required: false, default: { label: '', field: '', hide: false, type: 'text' } },
        item: { type: [ Object, null ], required: false, default: null },
        rowId: { type: String, default: 'id', required: false },
        span: { type: Number, required: true },
        customUrl: { type: String, default: null, required: false },
        urlPrefix: { type: [ String, null ], required: false, default: null },
        parentUrlPrefix: { type: String, required: true },
    },
    computed: {
        label() {
            return (column) => column?.label || ''
        },
        isHtml() {
            return (column) => column?.isHtml || false
        },
        hasMany() {
            return (column) => column?.hasMany || false
        }
    },
    data() {
        return {
            url: null,
            isLoading: false,
            data: null,
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
                this.data = response.data
            }).catch(error => {
                this.isLoading = false
            })
        },
        getUrl() {
            let urlPrefix = this.urlPrefix || this.parentUrlPrefix
            this.url = this.customUrl ? this.customUrl + urlPrefix : window.Laravel.baseUrl + '/api/' + urlPrefix
            this.url = this.url + '/' + this.item[ this.rowId ]
        },
        showField(column) {
            let field = ''
            if (column.field.includes('.')) {
                let splited = column.field.split('.')
                let relationship = splited[ 0 ]
                let value = splited[ 1 ]
                field = this.hasMany(column) ? this.loadHasMany(this.data[ relationship ], value) : this.data[ relationship ][ value ]
            } else {
                field = this.data[ column.field ] || '-'
            }
            return field
        },
        loadHasMany(data, field) {
            let containerStart = '<div class="content mt-6"><ul class="text-normal">'
            let fields = ''
            let containerEnd = '</ul></div>'
            for (const key in data) {
                if (Object.hasOwnProperty.call(data, key)) {
                    const element = data[ key ] || null;
                    if (element) {
                        fields += `<li class="my-2">${element[ field ]}</li>`
                    }
                }
            }
            return containerStart + fields + containerEnd
        }
    }
}
</script>
