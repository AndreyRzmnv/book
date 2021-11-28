<template>
  <v-data-table
    v-bind="$attrs"
    :headers="headers"
    :items="items"
    :options.sync="options"
    :server-items-length="totalItems"
    :loading="loading"
    must-sort
    :footer-props="footerProps"
    v-on="$listeners"
  >
    <template v-for="(_, slot) of $scopedSlots" #[slot]="scope">
      <slot
        :name="slot"
        v-bind="scope"
      />
    </template>
  </v-data-table>
</template>

<script>
import axios from 'axios'
import _debounce from 'lodash/debounce'

export default {
  name: 'DataTable',
  props: {
    url: {
      type: String,
      required: true
    },
    method: {
      type: String,
      default: 'get',
      validator: value => ['get', 'post'].indexOf(value) !== -1
    },
    headers: {
      type: Array,
      required: true
    },
    search: {
      type: String,
      default: ''
    },
    filters: {
      type: Object,
      default: () => {}
    },
    initialOptions: {
      type: Object,
      default: () => {}
    },
    initialFooterProps: {
      type: Object,
      default: () => {
        return {
          showFirstLastPage: true,
          showCurrentPage: true,
          itemsPerPageOptions: [20, 50, -1]
        }
      }
    }
  },

  data () {
    return {
      draw: 1,
      items: [],
      searchQuery: '',
      loading: true,
      totalItems: 0,
      cancelSource: null,
      options: this.initialOptions,
      footerProps: this.initialFooterProps,
      debouncedGetData: _debounce(this.getData, 300)
    }
  },

  computed: {
    columns: function () {
      const columns = {}
      this.headers.forEach((column, index) => {
        columns[index] = {
          data: column.value,
          name: column.name || column.value,
          searchable: column.searchable === undefined ? true : column.searchable,
          orderable: column.sortable === undefined ? true : column.sortable,
          search: {
            value: '',
            regex: false
          }
        }
      })
      return columns
    }
  },

  watch: {
    options: {
      handler () {
        this.debouncedGetData()
      },
      deep: true,
      
    },
    search: function () {
      if (this.options.page === 1) this.debouncedGetData()
      else this.options.page = 1
    },
    filters: {
      handler () {
        if (this.options.page === 1) this.debouncedGetData()
        else this.options.page = 1
      },
      deep: true
    }
  },

  methods: {
    cancelRequest () {
      // Axios cancelSource to stop current search if new value is entered
      if (this.cancelSource) {
        this.cancelSource.cancel('Start new search, stop active search')
      }
    },
    getUrlString (params, keys = [], isArray = false) {
      const p = Object.keys(params).map(key => {
        const val = params[key]

        if (Object.prototype.toString.call(val) === '[object Object]' || Array.isArray(val)) {
          if (Array.isArray(params)) {
            keys.push('')
          } else {
            keys.push(key)
          }
          return this.getUrlString(val, keys, Array.isArray(val))
        } else {
          let tKey = key
          if (keys.length > 0) {
            const tKeys = isArray ? keys : [...keys, key]
            tKey = tKeys.reduce((str, k) => { return str === '' ? k : `${str}[${k}]` }, '')
          }
          if (isArray) {
            return `${tKey}[]=${val}`
          } else {
            return `${tKey}=${val}`
          }
        }
      }).join('&')
      keys.pop()
      return p
    },
    getData () {
      this.cancelRequest()
      this.cancelSource = axios.CancelToken.source()
      // show loading of Vuetify Table
      this.loading = true

      const params = {
        datatable: true,
        length: this.options.itemsPerPage, // set how many records to fetch per page
        start: (this.options.page - 1) * this.options.itemsPerPage, // set offset
        draw: this.draw,
        columns: this.columns,
        search: {
          value: this.search ? this.search : '',
          regex: false
        }
      }
      const column = this.headers.findIndex(p => p.value === this.options.sortBy[0])
      if (column > -1) {
        params.order = {
          0: {
            column: column,
            dir: this.options.sortDesc[0] ? 'desc' : 'asc'
          }
        }
      }
      // Add filters to query
      if (this.filters) {
        const keys = Object.keys(this.filters)
        for (const key of keys) {
          if (this.filters[key]) {
            params[key] = this.filters[key]
          }
        }
      }

      axios
        .request({
          url: this.method === 'post' ? this.url : `${this.url}?${this.getUrlString(params)}`,
          method: this.method,
          data: this.method === 'post' ? params : null,
          cancelToken: this.cancelSource.token
        })
        .then(({ data }) => {
          this.draw++
          this.cancelSource = null
          this.items = data.data
          this.totalItems = data.recordsFiltered
          this.$emit('received', data)
        })
        .catch(error => {
          if (axios.isCancel(error)) {
            console.log('Request canceled', error.message)
          } else {
            console.log(error)
          }
        })
        .then(() => { this.loading = false })
    }
  }
}
</script>
