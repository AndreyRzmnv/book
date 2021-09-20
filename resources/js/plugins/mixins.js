import Vue from 'vue'
import { $api } from '../routeApi/api'

Vue.mixin({
  computed: {
    $api: () => $api
  }
})
