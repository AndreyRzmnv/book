<template>
    <v-card>
      <v-card-text>
        <v-row>
          <v-col cols="auto">
            <create-button
              @showCreateForm="create"
            />
          </v-col>
          <v-col cols="12" sm="6" md="4" xl="3">
            <v-text-field
              v-model="search"
              dense
              append-icon="mdi-magnify"
              :label="$t('search')"
              clearable
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="6" md="4" xl="3">
            <api-autocomplete
              v-model="filters.subject"
              :url="$api.subject.url.search()"
              :label="$t('resources.categories.filters.subject')"
              
              dense
              lazy-load
            />
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-text>
        <data-table
          ref="datatable"
          :url="$api.category.url.index()"
          :headers="headers"
          :search="search"
          :filters="filters"
        >
          <template #item.actions="{ item }">
            <div
              v-if="item.actions"
              class="d-inline-flex"
            >
              <v-btn
                  icon
                  color="blue"
                  :to="{name: 'admin.subcategories.index', params: { filters: { category: {id: item.id, name: item.name}}} }"
                  dark
              >
                <v-icon>mdi-share</v-icon>
              </v-btn>
              <edit-button
                @showDialog="edit(item)"
              />
              
              <delete-button
                :url="$api.category.url.delete(item.id)"
                :title="$t('resources.categories.titles.delete')"
                @success="successDeleting"
              />
            </div>
          </template>
          <template></template>
        </data-table>
      </v-card-text>
      <v-dialog v-model="showForm" max-width="400">
        <category-form
          :v-if="showForm"
          :key="formKey"
          :model="model"
          @cancel="closeForm"
          @success="successForm"
        />
      </v-dialog>

    </v-card>
</template>

<script>
import ApiAutocomplete from '../../../../components/Admin/ApiAutocomplete'
import DataTable from '../../../../components/Admin/DataTable/DataTable'
import EditButton from '../../../../components/Admin/DataTable/EditButton'
import DeleteButton from '../../../../components/Admin/DataTable/DeleteButton'
import CreateButton from '../../../../components/Admin/CreateButton'
import CategoryForm from './CategoryForm'
export default {
  components: {
    ApiAutocomplete,
    DataTable,
    EditButton,
    DeleteButton,
    CreateButton,
    CategoryForm,
  },
  data() {
    return {
      search: '',
      showForm: false,
      formKey: 1,
      model: null,
      defaultFilters: {
        subject: null,
      },
      filters: {
        subject: null,
      },
        
      
    }
  },
  computed: {
    // ...mapGetters({
      
    // }),
    headers () {
      return [
        { text: 'ID', value: 'id'},
        { text: this.$t('resources.categories.fields.name'), value: 'name' },
        { text: this.$t('resources.categories.fields.subject'), value: 'subject.name' },
        { text: this.$t('resources.categories.fields.actions'), value: 'actions', width: '1%'},
      ]
    },
    
  },
  created() {
    if(this.$route.params.filters){
      this.filters = this.$route.params.filters;
    }
  },
  methods: {
    create(){
      this.model = null;
      this.formKey++;
      this.showForm = true;
    },
    edit(item){
      this.model = item;
      this.formKey++;
      this.showForm = true;
    },
    closeForm(){
      this.showForm = false;
    },
    successForm(){
      this.closeForm();
      this.$refs.datatable.getData();
    },
    successDeleting(){
      this.$refs.datatable.getData();
    }
  },

}
</script>