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
          :url="url"
          :headers="headers"
          :search="search"
          :filters="filters"
        >
          <template #item.color="{ item }">
            <v-btn
                x-small
                :color="item.color"
                dark
            >
              {{item.name}}
            </v-btn>

          </template>
          <template #item.actions="{ item }">
            <div
              v-if="item.actions"
              class="d-inline-flex"
            >
              <edit-button
                @showDialog="edit(item)"
              />
              
              <delete-button
                :url="$api.category.url.delete(item.id)"
                :title="$t('resources.categories.titles.delete')"
                @deletingSuccess="deletingSuccess"
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
          @success="formSuccess"
        />
      </v-dialog>

    </v-card>
</template>

<script>
import DataTable from '../../../../components/Admin/DataTable/DataTable'
import EditButton from '../../../../components/Admin/DataTable/EditButton'
import DeleteButton from '../../../../components/Admin/DataTable/DeleteButton'
import CreateButton from '../../../../components/Admin/CreateButton'
import CategoryForm from './CategoryForm'
export default {
  components: {
    DataTable,
    EditButton,
    DeleteButton,
    CreateButton,
    CategoryForm,
  },
  data() {
    return {
      url: '',
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
        { text: this.$t('resources.categories.fields.name'), value: 'name' },
        { text: this.$t('resources.categories.fields.subject'), value: 'subject.name' },
        { text: this.$t('resources.categories.fields.actions'), value: 'actions', width: '1%'},
      ]
    },
    
  },
  created() {
    this.url = this.$api.category.url.index();
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
    formSuccess(){
      this.closeForm();
      this.$refs.datatable.getData();
    },
    deletingSuccess(data){
      this.$refs.datatable.getData();
    }
  },

}
</script>