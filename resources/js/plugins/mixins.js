import Vue from 'vue'
import { $api } from '../appApi/api'

Vue.mixin({
  computed: {
    $api: () => $api
  }
})
