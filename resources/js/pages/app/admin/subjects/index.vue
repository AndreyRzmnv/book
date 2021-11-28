<template>
  <div>
    <v-card>
      <v-card-text>
        <!-- <v-data-table
      :headers="headers"
      :items="desserts"
      :items-per-page="5"
      class="elevation-0 m-4"


      ref="datatable"
        :url="url"
        :initial-options="options"
        :headers="headers"
        :search="search"
        :filters="filters"
    ></v-data-table> -->
      <data-table
        ref="datatable"
        :url="url"
        :headers="headers"
        :search="search"
        :filters="filters"
      >
      
        <!-- <template #item.actions="{ item }">
          <div v-if="Array.isArray(item.actions)" class="d-inline-flex">
            <v-tooltip v-if="item.actions.includes('update')" bottom>
              <template #activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  icon
                  plain
                  v-bind="attrs"
                  :to="{ name: 'manufacturers.edit', params: { id: item.id } }"
                  v-on="on"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>
              <span>{{ $t("edit") }}</span>
            </v-tooltip>
            <delete-button
              v-if="item.actions.includes('delete')"
              :url="getDeleteUrl(item)"
              icon
              :message="$t('resources.manufacturers.actions.delete')"
              @success="$refs.datatable.getData()"
            />
          </div>
        </template>
        <template #item.conditions_in_1c_name="{ item }">
          <span>{{item.conditions_in_1c_name}}</span><br>
          <span
            v-if="item.conditions_in_1c == 0"
          >
            {{item.conditions_in_1c_comment}}
          </span>
        </template>
        <template #item.name="{ item }" v-if="can('open-manufacturers')">
          <v-btn
          color="none"
            small
            text
            :to="{ name: 'manufacturers.edit', params: { id: item.id } }"
          >
            {{item.name}}
          </v-btn>
          <a :href="$api.manufacturer.url.edit(item.id)"></a>
        </template> -->
      </data-table>

      </v-card-text>
    </v-card>
    
  </div>
</template>

<script>

export default {
  data() {
    return {
      url: '',
      search: '',
      defaultFilters: {

      },
      filters: {
        
      },
        
      
    }
  },
  computed: {
    // ...mapGetters({
      
    // }),
    headers () {
      return [
        { text: this.$t('resources.subjects.dataTable.headers.name'), value: 'name' },
        { text: this.$t('resources.subjects.dataTable.headers.actions'), value: 'actions' },
      ]
    },
    
  },
  created() {
    // console.log(this.$api);
    this.url = this.$api.subject.url.index();
    // console.log(this.url);
  },
  methods: {
    
    
  },

}
</script>