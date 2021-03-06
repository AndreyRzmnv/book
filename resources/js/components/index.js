import Vue from 'vue'
import Card from './Card.vue'
import Child from './Child.vue'
import Button from './Button.vue'
import Checkbox from './Checkbox.vue'
import Sitemap from './Sitemap.vue'
import Search from './Search.vue'
import Tile from './Tile.vue'
import TilesList from './TilesList.vue'
// import DataTable from './DataTable.vue'

import { HasError, AlertError, AlertSuccess } from 'vform/components/bootstrap5'

// Components that are registered globaly.
[
  Card,
  Child,
  Button,
  Checkbox,
  HasError,
  AlertError,
  AlertSuccess,
  Sitemap,
  Search,
  Tile,
  TilesList,
  // DataTable,

].forEach(Component => {
  Vue.component(Component.name, Component)
})
