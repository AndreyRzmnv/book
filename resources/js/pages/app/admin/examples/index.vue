<template>
    <v-card>
      <v-card-title>
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
      </v-card-title>
      <v-card-text>
        <data-table
          ref="datatable"
          :url="$api.example.url.index()"
          :headers="headers"
          :search="search"
          :filters="filters"
        >
          <template #item.actions="{ item }">
            <div
              v-if="item.actions"
              class="d-inline-flex"
            >
              <edit-button
                @showDialog="edit(item)"
              />
              
              <delete-button
                :url="$api.example.url.delete(item.id)"
                :title="$t('resources.examples.titles.delete')"
                @success="successDeleting"
              />
            </div>
          </template>
          <template></template>
        </data-table>
      </v-card-text>
      <v-dialog v-model="showForm" max-width="400">
        <example-form
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
import DataTable from '../../../../components/Admin/DataTable/DataTable'
import EditButton from '../../../../components/Admin/DataTable/EditButton'
import DeleteButton from '../../../../components/Admin/DataTable/DeleteButton'
import CreateButton from '../../../../components/Admin/CreateButton'
import ExampleForm from './ExampleForm'
export default {
  components: {
    DataTable,
    EditButton,
    DeleteButton,
    CreateButton,
    ExampleForm,
  },
  data() {
    return {
      search: '',
      showForm: false,
      formKey: 1,
      model: null,
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
        { text: 'ID', value: 'id'},
        { text: this.$t('resources.examples.fields.name'), value: 'name' },
        { text: this.$t('resources.examples.fields.subject'), value: 'subcategory.category.subject.name' },
        { text: this.$t('resources.examples.fields.category'), value: 'subcategory.category.name' },
        { text: this.$t('resources.examples.fields.subcategory'), value: 'subcategory.name' },
        { text: this.$t('resources.examples.fields.actions'), value: 'actions', width: '1%'},
      ]
    },
    
  },
  created() {
    
  },
  methods: {
    create(){
      this.$router.push({ name: 'admin.examples.create' })
    },
    edit(item){
      this.$router.push({ name: 'admin.examples.edit', params: {id: item.id} })
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