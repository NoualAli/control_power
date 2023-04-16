<template>
  <div class="my-6">
    <div class="table-header grid my-6">
      <div v-if="filters && showFilters" class="col-12">
        <div class="grid gap-2">
          <div
            v-for="(filter, filterName) in isNotHideFilter" :key="'filter-' + filterName"
            class="col-12" :class="filter?.cols || 'col-lg-2'"
          >
            <NLSelect
              v-if="!filter.type" v-model="filter.value" :name="filterName" :label="filter.label"
              :options="filter?.data" :multiple="filter.multiple"
            />

            <div v-if="filter.type && filter.type == 'date-range'" class="grid gap-2">
              <div
                v-for="(attrData, attrName) in attrsDataRangeFilter" :key="'filter-' + attrName "
                class="col-12" :class="data?.cols || 'col-lg-6'"
              >
                <NLInput v-model="attrData.value" :name="attrName" :label="attrData.label" type="date" />
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-12">
            <button class="btn btn-danger has-icon" @click="resetFilter">
              <i class="las la-backspace icon"></i>
            </button>
          </div> -->
        </div>
      </div>
      <div class="col-12 col-lg-4 d-flex align-center">
        <h2 v-if="title" class="title">
          {{ title }}
        </h2>
      </div>
      <div class="col-12 col-lg-8 d-flex justify-end alin-center gap-2">
        <div class="d-flex align-center">
          <input
            v-if="(searchable && config.data?.meta?.total) || appliedSearch !== ''" type="search" class="input m-0"
            placeholder="Faite votre recherche..." @input="search($event.target.value)"
          >
        </div>
        <div v-if="(filters && config.data?.meta?.total)">
          <button v-if="!showFilters" class="btn btn-success has-icon" @click="showFilters = !showFilters">
            <i class="las la-filter icon" />
          </button>
          <button v-else class="btn btn-danger has-icon" @click="resetFilter">
            <i class="las la-times-circle icon" />
          </button>
        </div>
      </div>
    </div>
    <div class="table-container">
      <table v-if="config.data?.meta?.total">
        <thead>
          <tr>
            <!-- v-if becomes filter  -->
            <th
              v-for="column in config.columns" v-if="!column?.hide"
              :key="column.field" :colspan="column.colspan ? column.colspan : null" :align="column.align ? column.align : 'left'"
            >
              <span class="d-flex justify-between align-center">
                <span>
                  {{ column.label }}
                </span>
                <span v-if="column.orderable || config.orderAll" @click="sortData(column.field)">
                  <i class="icon las" :class="appliedSort[column.field].icon" />
                </span>
              </span>
            </th>
            <th v-if="config.actions" class="cell-actions">
              Actions
            </th>
          </tr>
        </thead>
        <tbody :class="{ 'is-busy': isBusy }">
          <tr v-for="item in config.data?.data" :key="item[rowKey]">
            <!-- v-if becomes filter  -->
            <td
              v-for="column in config.columns" v-if="!column?.hide"
              :key="column.field" :colspan="column.colspan ? column.colspan : null" :align="column.align ? column.align : 'left'" :data-th="column.label"
              :class="{ 'p-0': column.isHtml, [applyClass(item, column)]: !column.isHtml }"
            >
              <span v-if="column.isHtml" :class="applyClass(item, column)">
                <!-- to be checked  about v-html and the necessity of this  -->

                <span :class="applyClass(item, column)" v-html="showField(item, column)" />
              </span>
              <span v-else>
                {{ showField(item, column) }}
              </span>
            </td>
            <td v-if="config.actions" class="cell-actions">
              <span class="d-flex justify-start align-center gap-4">
                <!-- v-if  reconsider its necessity and its effect later on make  -->
                <!-- <template /> -->
                <span
                  v-for="(value, key) in config.actions" v-if="showAction(value, key, 'show', item) || showAction(value, key, 'edit', item) || showAction(value, key, 'delete', item)"
                  :key="key"
                >
                  <button v-if="showAction(value, key, 'show', item)" class="btn btn-success" @click.stop="show(item)">
                    <i class="las la-eye icon" />
                  </button>
                  <button v-if="showAction(value, key, 'edit', item)" class="btn btn-warning" @click.stop="edit(item)">
                    <i class="las la-edit icon" />
                  </button>
                  <button
                    v-if="showAction(value, key, 'delete', item)" class="btn btn-danger"
                    @click.stop="destroy(item)"
                  >
                    <i class="las la-trash icon" />
                  </button>
                </span>
                <slot name="actions" :item="item" />
              </span>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-else class="no-data my-6">
        <NoData />
      </div>
    </div>
    <div class="pagination my-6 grid">
      <div v-if="config?.data?.data?.length" class="col-12 col-lg-2 d-flex align-center justify-center">
        <div class="grid gap-2 w-100">
          <div class="col-4">
            <NLSelect v-model="appliedPerPage" name="per_page" :options="perPageOptions" @change="showPerPage()" />
          </div>
          <div class="col-8 d-flex align-center justify-center gap-2">
            <span v-if="config.data?.meta?.total || appliedSearch !== ''">
              {{ config.data?.meta?.total }}
            </span>
            <span>
              de {{ config.data?.meta.from }} à {{ config.data?.meta.to }}
            </span>
          </div>
        </div>
      </div>
      <div v-if="showPagination()" class="col-12 col-lg-1 d-flex justify-center align-center">
        <button
          v-for="(link, index) in config.data?.meta?.links" v-if="showPreviousLink(index, link.url)" :key="link.label"
          class="btn mx-2" :class="{ 'is-active': link.active }" @click="getPaginationData(link.url)"
        >
          Précédent
        </button>
      </div>
      <div v-if="showPagination()" class="col-12 col-lg-8 d-flex align-center justify-center">
        <button
          v-for="(link, index) in config.data?.meta?.links" v-if="showPageNumberLink(index)" :key="index"
          class="btn is-radius mx-2" :class="{ 'is-active': link.active }" :disabled="link.active"
          @click="getPaginationData(link.url)"
        >
          {{ link.label }}
        </button>
      </div>
      <div v-if="showPagination()" class="col-12 col-lg-1 d-flex justify-center align-center">
        <button
          v-for="(link, index) in config.data?.meta?.links" v-if="showNextLink(index, link.url)" :key="link.label"
          class="btn mx-2" :class="{ 'is-active': link.active }" @click="getPaginationData(link.url)"
        >
          Suivant
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import api from '~/plugins/api'
import * as swal from '~/plugins/swal'
import NoData from './NoData'
// import { saveAs } from 'file-saver';
export default {
  name: 'NLDatatable',
  components: {
    NoData
  },
  props: {
    title: { type: [String, null], default: null },
    searchable: { type: Boolean, default: true },
    namespace: { type: String, required: true },
    rowKey: { type: String, default: 'id' },
    stateKey: { type: String, default: 'paginated' },
    config: { type: [Object, null], required: true, defaul: { data: {}, columns: [] } },
    filters: { type: [Object, null], default: null },
    filtersQueryKey: { type: [String, null], default: 'onlyFiltersData' },
    exportable: { type: Boolean, default: true }
  },
  emits: ['delete', 'show', 'edit', 'searchDone', 'sortDone', 'dataUpdated', 'perPageUpdated', 'filterReset'],
  data () {
    return {
      appliedSort: {},
      appliedSearch: '',
      appliedPerPage: 10,
      filterData: {},
      export: false,
      showFilters: false,
      perPageOptions: [
        { id: 10, label: 10 },
        { id: 25, label: 25 },
        { id: 50, label: 50 },
        { id: 100, label: 100 },
        { id: 250, label: 250 }
      ],
      current_page: 1,
      url: null,
      isBusy: false
    }
  },
  computed: {
    getUrl () {
      return this.url ? this.url : this.config?.data?.meta?.path
    },
    isNotHideFilter () {
      return this.filters.filter(filter => !filter?.hide)
    },
    attrsDataRangeFilter () {
      return this.filters.filter(filter => filter.type && filter.type === 'data-range').attributes
    }
  },
  watch: {
    filters: {
      handler () {
        this.handleFilter()
      },
      deep: true,
      immediate: true
    }
  },
  created () {
    this.initSortable()
    this.updateState()
  },
  methods: {
    handleFilter () {
      const loadData = []
      if (this.filters) {
        for (const key in this.filters) {
          if (Object.hasOwnProperty.call(this.filters, key)) {
            if (this.filters[key]?.type === 'date-range' && this.filters[key] !== undefined) {
              const parent = this.filters[key]
              const fields = parent.attributes
              const values = []
              for (const subfieldKey in fields) {
                if (Object.hasOwnProperty.call(fields, subfieldKey)) {
                  const element = fields[subfieldKey]
                  if (element.value !== null && element.value !== undefined) {
                    values.push(subfieldKey + '|' + element.value)
                  }
                }
              }
              if (values.length) {
                parent.value = values.join(',')
              }
              loadData.push(!!(parent.value !== null && parent.value.length && parent.value !== undefined))
            } else {
              loadData.push(this.filters[key].value !== null)
            }
          }
        }
      }
      if (loadData.some(value => value)) {
        this.buildUrl()
        this.updateState(true)
        api.get(this.getUrl).then(response => {
          this.updateState()
          this.config.data = response.data
        }).catch(error => {
          this.updateState()
          swal.alert_error(error)
        })
      } else {
        this.buildUrl()
        this.updateState(true)
        // this.getPaginationData(this.getUrl)
        this.updateState()
      }
    },
    resetFilter () {
      this.showFilters = false
      for (const key in this.filters) {
        if (Object.hasOwnProperty.call(this.filters, key)) {
          const element = this.filters[key]
          element.value = null
          if (element.attributes) {
            for (const key in element.attributes) {
              if (Object.hasOwnProperty.call(element.attributes, key)) {
                const subfield = element.attributes[key]
                subfield.value = null
              }
            }
          }
        }
      }
      this.$emit('filterReset')
    },
    exportData () {
      this.export = true
      this.buildUrl()
      api.get(this.url, {
        responseType: 'blob',
        onDownloadProgress: (progressEvent) => {
          this.isBusy = true
          const size = progressEvent.target.getResponseHeader('Content-Length')
          const loaded = progressEvent.loaded
          const progress = Math.round((loaded / size) * 100)
          swal.loading(progress)
        }
      }).then(response => {
        this.isBusy = false
        // const file = response.data.file
        // const fileName = response.data.fileName
        // saveAs(file, fileName)
      })
    },
    /**
     * Emit delete event
     *
     * @param {Object} data
     */
    destroy (data) {
      this.$emit('delete', data)
    },
    /**
     * Emit show event
     *
     * @param {Object} data
     */
    show (data) {
      this.$emit('show', data)
    },
    /**
     * Emit edit event
     *
     * @param {Object} data
     */
    edit (data) {
      this.$emit('edit', data)
    },
    /**
     * Initialize sortable columns
     */
    initSortable () {
      Object.values(this.config.columns).forEach(column => {
        if (column.orderable) {
          this.appliedSort[column.field] = {}
          this.appliedSort[column.field].direction = null
          this.appliedSort[column.field].icon = 'la-sort'
          this.appliedSort[column.field].step = 1
        }
      })
    },
    /**
     * Show field value
     *
     * @param {Object} data
     * @param {String} field
     */
    getField (data, field) {
      if (field !== null && field !== undefined && field.includes('.')) {
        const fields = field.split('.')
        const relationshipName = fields[0]
        const relationshipValue = fields[1]
        if (relationshipName !== undefined && relationshipValue !== undefined && relationshipName !== null && relationshipValue !== null) {
          field = data[relationshipName] !== null ? data[relationshipName][relationshipValue] : '-'
        }
      } else {
        field = data[field] !== undefined ? data[field] : '-'
      }
      return field
    },
    /**
     * Handle default actions
     *
     * @param {String} value
     * @param {String} key
     * @param {String} action
     * @param {Object} item
     */
    showAction (value, key, action, item) {
      if (typeof value === 'function' && key === action) {
        return this.config.actions[key](item)
      } else {
        return key === action
      }
    },
    /**
     * Show field value
     *
     * @param {Object} item
     * @param {String} column
     */
    showField (item, column) {
      if (Object.hasOwnProperty.call(column, 'methods')) {
        if (Object.hasOwnProperty.call(column.methods, 'showField')) {
          return column.methods.showField(item)
        }
      }
      return this.getField(item, column.field)
    },
    /**
     * Apply specific class
     *
     * @param {Object} item
     * @param {String} column
     */
    applyClass (item, column) {
      if (Object.hasOwnProperty.call(column, 'methods')) {
        if (Object.hasOwnProperty.call(column.methods, 'style')) {
          return column.methods.style(item)
        }
      }
    },
    /**
     * Build url with params
     */
    buildUrl () {
      this.url = this.config.data?.meta?.path + '?'
      const currentPage = this.current_page
      this.url += 'page=' + currentPage
      this.url += '&search=' + this.appliedSearch
      this.url += '&perPage=' + this.appliedPerPage
      if (this.export) {
        this.url += '&export'
      }

      for (const key in this.appliedSort) {
        if (Object.hasOwnProperty.call(this.appliedSort, key)) {
          const direction = this.appliedSort[key].direction
          if (direction) {
            this.url += '&order[' + key + ']=' + direction
          }
        }
      }
      if (this.filters) {
        for (const key in this.filters) {
          if (this.filters[key].value !== null) {
            if (Object.hasOwnProperty.call(this.filters, key)) {
              this.url += '&filter[' + key + ']=' + this.filters[key].value
            }
          }
        }
      }
      const additionalParams = this.$route.params
      if (additionalParams) {
        for (const key in additionalParams) {
          if (additionalParams[key].value !== null) {
            if (Object.hasOwnProperty.call(additionalParams, key)) {
              this.url += '&' + key + '=' + additionalParams[key]
            }
          }
        }
      }
      // this.$route.params.forEach((value, key) => this.url += "&" + value + "=" + key)
    },
    /**
     * Update table state
     * @param {Boolean} state
     */
    updateState (state = false) {
      this.isBusy = state
    },
    /**
     * Refresh data
     * @param {String} url
     */
    async getPaginationData (url) {
      this.updateState()
      let newUrl = ''
      try {
        newUrl = new URL(url)
      } catch (error) {
        console.log(url)
      }
      this.current_page = newUrl?.searchParams?.get('page')
      this.buildUrl()
      await api.get(this.url).then((res) => {
        this.current_page = res.data.meta.current_page
        this.config.data = res.data
        this.$store.state[this.namespace][this.stateKey] = res.data
        this.updateState(false)
        this.$emit('dataUpdated', res)
      })
    },
    /**
     * Sort data
     */
    async applySort () {
      this.updateState(true)
      this.buildUrl()
      await api.get(this.url).then((res) => {
        this.config.data = res.data
        this.$store.state[this.namespace][this.stateKey] = res.data
        this.updateState()
        this.$emit('sortDone', res)
      })
    },
    /**
     * Search data
     * @param {*} value
     */
    async search (value) {
      this.updateState(true)
      this.appliedSearch = value
      this.current_page = 1
      this.buildUrl()

      await api.get(this.url).then((res) => {
        this.updateState()
        this.config.data = res.data
        this.$store.state[this.namespace][this.stateKey] = res.data
        this.$emit('searchDone', value)
      })
    },
    /**
     * Show more data per page
     */
    async showPerPage () {
      this.updateState(true)
      this.buildUrl()

      await api.get(this.url).then((res) => {
        this.updateState()
        this.config.data = res.data
        this.$store.state[this.namespace][this.stateKey] = res.data
        this.$emit('perPageUpdated', res)
      })
    },
    /**
     * Apply data sorting
     *
     * @param {String} column
     */
    sortData (column) {
      if (this.appliedSort[column].direction == 'asc') {
        this.appliedSort[column].direction = 'desc'
        this.appliedSort[column].icon = 'la-sort-down'
      } else if (this.appliedSort[column].step == 'desc') {
        this.appliedSort[column].direction = 'asc'
        this.appliedSort[column].icon = 'la-sort-up'
      } else {
        this.appliedSort[column].direction = null
        this.appliedSort[column].icon = 'la-sort'
      }
      this.applySort(this.appliedSort)
    },

    /**
     * @return {Boolean}
     */
    showPagination () {
      return this.config.data?.meta?.links.length >= 4
    },
    /**
     * @param {Number} index
     * @param {String|Null} url
     * @return {Boolean}
     */
    showPreviousLink (index, url) {
      return index === 0 && url !== null && this.config.data?.meta?.links.length >= 4
    },
    /**
     *
     * @param {Number} index
     * @return {Boolean}
     */
    showPageNumberLink (index) {
      return index > 0 && index < (this.config.data?.meta?.links.length - 1) && this.config.data?.meta?.links.length >= 4
    },
    /**
     *
     * @param {Number} index
     * @param {String|Null} url
     * @return {Boolean}
     */
    showNextLink (index, url) {
      return index === (this.config.data?.meta?.links.length - 1) && url !== null && this.config.data?.meta?.links.length >= 4
    }
  }
}
</script>
