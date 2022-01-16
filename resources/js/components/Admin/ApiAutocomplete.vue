<template>
  <v-autocomplete
    v-model="model"
    v-bind="$attrs"
    :items="displayedItems"
    :loading="isLoading"
    :search-input.sync="search"
    no-filter
    :item-text="itemText"
    :item-value="itemValue"
    return-object
    :hide-no-data="hasNext"
    clearable
    @focus="onFocus"
    v-on="$listeners"
  >
    <template v-for="(_, slot) of $scopedSlots" #[slot]>
      <slot :name="slot" />
    </template>

    <!-- <template #item="{ item }">
      <text-highlight :queries="queries">
        {{ typeof itemText === 'function' ? itemText(item) : item[itemText] }}
      </text-highlight>
    </template> -->

    <template #append-item>
      <v-list-item
        v-if="hasNext"
        v-intersect="onIntersect"
      >
        {{ $t('loading') }}
      </v-list-item>
    </template>
  </v-autocomplete>
</template>

<script>
import axios from 'axios'
import debounce from 'lodash/debounce'
import _cloneDeep from 'lodash/cloneDeep'

export default {
  name: 'ApiAutocomplete',
  inheritAttrs: false,
  props: {
    url: {
      type: String,
      required: true
    },
    params: {
      type: Object,
      default: null
    },
    value: {
      type: Object,
      default: null
    },
    itemText: {
      type: [String, Array, Function],
      default: 'name'
    },
    itemValue: {
      type: [String, Array, Function],
      default: 'id'
    },
    lazyLoad: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      items: [],
      isLoading: false,
      loaded: false,
      search: null,
      hasNext: true,
      currentPage: 0,
      cancelSource: null
    }
  },
  computed: {
    model: {
      get () {
        return this.value
      },
      set (model) {
        this.$emit('input', model)
      }
    },
    displayedItems: function () {
      return (this.items.length === 0 && this.model) ? [this.model] : this.items
    },
    queries: function () {
      return this.search ? this.search.split(' ') : ''
    }
  },

  watch: {
    search (search) {
      if (!this.model || this.model[this.itemText] !== search) {
        this.debouncedGetData(search, 1)
      }
    }
  },

  created () {
    this.debouncedGetData = debounce(this.getData, 500)
    if (!this.lazyLoad) {
      this.debouncedGetData(this.search)
    }
  },

  methods: {
    onIntersect (entries, observer) {
      if (entries[0].isIntersecting || this.currentPage === 0) {
        this.debouncedGetData(this.search, this.currentPage + 1)
      }
    },
    onFocus () {
      if (!this.loaded && !this.isLoading && !this.model) {
        this.debouncedGetData(this.search)
      }
    },
    cancelRequest () {
      // Axios cancelSource to stop current search if new value is entered
      if (this.cancelSource) {
        this.cancelSource.cancel('Start new search, stop active search')
      }
    },
    getData (search, page) {
      this.cancelRequest()
      this.cancelSource = axios.CancelToken.source()

      this.isLoading = true

      const params = this.params ? _cloneDeep(this.params) : {}
      params.page = page
      if (search) {
        params.q = search
      }

      const config = {
        cancelToken: this.cancelSource.token,
        params: params
      }

      axios.get(this.url, config)
        .then(({ data }) => {
          this.cancelSource = null
          const meta = ('meta' in data) ? data.meta : data
          this.currentPage = meta.current_page
          this.hasNext = meta.current_page < meta.last_page
          if (this.currentPage === 1) {
            this.items = []
          }
          this.items.push(...data.data)
          this.loaded = true
        })
        .catch(error => {
          if (axios.isCancel(error)) {
            console.log('Request canceled', error.message)
          } else {
            console.log(error)
          }
        })
        .finally(() => {
          this.isLoading = false
        })
    }
  }
}
</script>
