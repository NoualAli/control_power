<template>
  <div class="my-6">
    <div class="table-header grid my-6">
      <div class="col-12 col-lg-4 d-flex align-center">
        <h2 class="title" v-if="title">
          {{ title }}
        </h2>
      </div>
      <div class="col-12 col-lg-8">
        <input type="search" class="input" placeholder="Faite votre recherche..." @input="search($event.target.value)"
          v-if="(searchable && config.data?.meta?.total) || appliedSearch !== ''">
      </div>
    </div>
    <div class="table-container">
      <table v-if="config.data?.meta?.total">
        <thead>
          <tr>
            <th :colspan="column.colspan ? column.colspan : null" :align="column.align ? column.align : 'left'"
              v-for="column in config.columns" v-if="!column.hide" :key="column.field">
              <span class="d-flex justify-between align-center">
                <span>
                  {{ column.label }}
                </span>
                <span @click="sortData(column.field)" v-if="column.orderable || config.orderAll">
                  <i class="icon las" :class="appliedSort[column.field].icon"></i>
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
            <td :colspan="column.colspan ? column.colspan : null" :align="column.align ? column.align : 'left'"
              v-for="column in config.columns" :key="column.field" v-if="!column.hide" :data-th="column.label"
              :class="{ 'p-0': column.isHtml, [applyClass(item, column)]: !column.isHtml }">
              <span v-if="column.isHtml" :class="applyClass(item, column)">
                <span v-html="showField(item, column)" :class="applyClass(item, column)"></span>
              </span>
              <span v-else>
                {{ showField(item, column) }}
              </span>
            </td>
            <td v-if="config.actions" class="cell-actions">
              <span class="d-flex align-center gap-4">
                <span v-for="(value, key) in config.actions" :key="key">
                  <button class="btn btn-success" @click.stop="show(item)" v-if="showAction(value, key, 'show', item)">
                    <i class="las la-eye icon"></i>
                  </button>
                  <button class="btn btn-warning" @click.stop="edit(item)" v-if="showAction(value, key, 'edit', item)">
                    <i class="las la-edit icon"></i>
                  </button>
                  <button class="btn btn-danger" @click.stop="destroy(item)"
                    v-if="showAction(value, key, 'delete', item)">
                    <i class="las la-trash icon"></i>
                  </button>
                  <slot name="actions" v-bind:item="item"></slot>
                </span>
              </span>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="no-data my-6" v-else>
        <NoData />
      </div>
    </div>
    <div class="pagination my-6 grid">
      <div class="col-12 col-lg-2 d-flex align-center justify-center">
        <div class="grid gap-2">
          <div class="col-4">
            <NLSelect name="per_page" :options="perPageOptions" v-model="appliedPerPage" @change="showMore()" />
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
      <div class="col-12 col-lg-1 d-flex justify-center align-center" v-if="showPagination()">
        <button @click="getPaginationData(link.url)" class="btn mx-2" :class="{ 'is-active': link.active }"
          v-for="(link, index) in config.data?.meta?.links" :key="link.label" v-if="showPreviousLink(index, link.url)">
          Précédent
        </button>
      </div>
      <div class="col-12 col-lg-8 d-flex align-center justify-center" v-if="showPagination()">
        <button @click="getPaginationData(link.url)" class="btn is-radius mx-2" :class="{ 'is-active': link.active }"
          v-for="(link, index) in config.data?.meta?.links" :key="index" v-if="showPageNumberLink(index)"
          :disabled="link.active">
          {{ link.label }}
        </button>
      </div>
      <div class="col-12 col-lg-1 d-flex justify-center align-center" v-if="showPagination()">
        <button @click="getPaginationData(link.url)" class="btn mx-2" :class="{ 'is-active': link.active }"
          v-for="(link, index) in config.data?.meta?.links" :key="link.label" v-if="showNextLink(index, link.url)">
          Suivant
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../plugins/api';
import NoData from './NoData';
export default {
  name: 'NLDatatable',
  emits: [ 'openDetails', 'delete', 'show', 'edit' ],
  components: {
    NoData
  },
  props: {
    title: { type: String | null, default: null },
    searchable: { type: Boolean, default: true },
    namespace: { type: String, required: true },
    rowKey: { type: String, default: 'id' },
    stateKey: { type: String, default: 'paginated' },
    config: { type: Object | null, required: true },
    filters: { type: Object | null, default: null }
  },
  data() {
    return {
      appliedSort: {},
      appliedFilters: {},
      appliedSearch: '',
      appliedPerPage: 10,
      perPageOptions: [
        { id: 10, label: 10 },
        { id: 25, label: 25 },
        { id: 50, label: 50 },
        { id: 100, label: 100 },
        { id: 250, label: 250 }
      ],
      current_page: 1,
      url: null,
      isBusy: false,
    }
  },
  computed: {
    getUrl() {
      return this.url ? this.url : this.config.data.meta.path
    },
  },
  created() {
    this.initSortable()
    this.updateState()
  },
  watch: {
    filters: {
      handler(value) {
        this.updateState(true)
        this.buildUrl()
        if (value) {
          this.updateState()
        }
      },
      immediate: true,
    }
  },
  methods: {
    /**
     * Emit delete event
     *
     * @param {Object} data
     */
    destroy(data) {
      this.$emit('delete', data)
    },
    /**
     * Emit show event
     *
     * @param {Object} data
     */
    show(data) {
      this.$emit('show', data)
    },
    /**
     * Emit edit event
     *
     * @param {Object} data
     */
    edit(data) {
      this.$emit('edit', data)
    },
    /**
     * Initialize sortable columns
     */
    initSortable() {
      Object.values(this.config.columns).forEach(column => {
        if (column.orderable) {
          this.appliedSort[ column.field ] = {}
          this.appliedSort[ column.field ].direction = null
          this.appliedSort[ column.field ].icon = 'la-sort'
          this.appliedSort[ column.field ].step = 1
        }
      })
    },
    /**
     * Show field value
     *
     * @param {Object} data
     * @param {String} field
     */
    getField(data, field) {
      if (field !== null && field !== undefined && field.includes('.')) {
        let fields = field.split('.')
        const relationshipName = fields[ 0 ]
        const relationshipValue = fields[ 1 ]
        if (relationshipName !== undefined && relationshipValue !== undefined && relationshipName !== null && relationshipValue !== null) {
          field = data[ relationshipName ] !== null ? data[ relationshipName ][ relationshipValue ] : '-'
        }
      } else {
        field = data[ field ] !== undefined ? data[ field ] : '-'
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
    showAction(value, key, action, item) {
      if (typeof value === 'function' && key == action) {
        return this.config.actions[ key ](item)
      } else {
        return key == action
      }
    },
    /**
     * Show field value
     *
     * @param {Object} item
     * @param {String} column
     */
    showField(item, column) {
      if (Object.hasOwnProperty.call(column, 'methods')) {
        if (Object.hasOwnProperty.call(column.methods, 'showField')) {
          return column.methods[ 'showField' ](item);
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
    applyClass(item, column) {
      if (Object.hasOwnProperty.call(column, 'methods')) {
        if (Object.hasOwnProperty.call(column.methods, 'style')) {
          return column.methods[ 'style' ](item);
        }
      }
    },
    /**
     * Build url with params
     */
    buildUrl() {
      this.url = this.config.data?.meta?.path + '?'
      const currentPage = this.current_page
      this.url += 'page=' + currentPage
      this.url += '&search=' + this.appliedSearch
      this.url += '&perPage=' + this.appliedPerPage

      for (const key in this.appliedSort) {
        if (Object.hasOwnProperty.call(this.appliedSort, key)) {
          let direction = this.appliedSort[ key ].direction
          if (direction) {
            this.url += '&order[' + key + ']=' + direction
          }
        }
      }
      if (this.filters) {
        for (const key in this.filters) {
          if (this.filters[ key ]) {
            if (Object.hasOwnProperty.call(this.filters, key)) {
              this.url += '&filter[' + key + ']=' + this.filters[ key ]
            }
          }
        }
      }
    },

    /**
     * Update table state
     * @param {Boolean} state
     */
    updateState(state = false) {
      {
        this.isBusy = state
      }
    },
    /**
     * Refresh data
     * @param {String} url
     */
    async getPaginationData(url) {
      this.updateState()
      let newUrl = new URL(url)
      this.current_page = newUrl.searchParams.get('page')
      this.buildUrl()
      await api.get(this.url).then((res) => {
        this.current_page = res.data.meta.current_page
        this.config.data = res.data
        this.$store.state[ this.namespace ][ this.stateKey ] = res.data
        this.updateState(false)
      })
    },
    /**
     * Sort data
     */
    async applySort() {
      this.updateState(true)
      this.buildUrl()
      await api.get(this.url).then((res) => {
        this.config.data = res.data
        this.$store.state[ this.namespace ][ this.stateKey ] = res.data
        this.updateState()
      })
    },

    /**
     * Search data
     * @param {*} value
     */
    async search(value) {
      this.updateState(true)
      this.appliedSearch = value
      this.current_page = 1
      this.buildUrl()

      await api.get(this.url).then((res) => {
        this.updateState()
        this.config.data = res.data
        this.$store.state[ this.namespace ][ this.stateKey ] = res.data
      })
    },
    /**
     * Show more data per page
     */
    async showMore() {
      this.updateState(true)
      // this.appliedSearch = value
      // this.current_page = 1
      this.buildUrl()

      await api.get(this.url).then((res) => {
        this.updateState()
        this.config.data = res.data
        this.$store.state[ this.namespace ][ this.stateKey ] = res.data
      })
    },
    /**
     * Apply data sorting
     *
     * @param {String} column
     */
    sortData(column) {
      if (this.appliedSort[ column ].direction == null) {
        this.appliedSort[ column ].direction = 'desc'
        this.appliedSort[ column ].icon = 'la-sort-down'
      } else if (this.appliedSort[ column ].step == 'desc') {
        this.appliedSort[ column ].direction = 'asc'
        this.appliedSort[ column ].icon = 'la-sort-up'
      } else {
        this.appliedSort[ column ].direction = null
        this.appliedSort[ column ].icon = 'la-sort'
      }
      this.applySort(this.appliedSort)
    },

    /**
     * @return {Boolean}
     */
    showPagination() {
      return this.config.data?.meta?.links.length >= 4
    },
    /**
     * @param {Number} index
     * @param {String|Null} url
     * @return {Boolean}
     */
    showPreviousLink(index, url) {
      return index == 0 && url !== null && this.config.data?.meta?.links.length >= 4
    },
    /**
     *
     * @param {Number} index
     * @return {Boolean}
     */
    showPageNumberLink(index) {
      return index > 0 && index < (this.config.data?.meta?.links.length - 1) && this.config.data?.meta?.links.length >= 4
    },
    /**
     *
     * @param {Number} index
     * @param {String|Null} url
     * @return {Boolean}
     */
    showNextLink(index, url) {
      return index == (this.config.data?.meta?.links.length - 1) && url !== null && this.config.data?.meta?.links.length >= 4
    }
  }
}
</script>
