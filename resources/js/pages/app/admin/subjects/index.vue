<template>
    <v-card>
      <v-card-title>
        <create-button
          @showCreateForm="create"
        />
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
                :url="$api.subject.url.delete(item.id)"
                :title="$t('resources.subjects.titles.delete')"
                @deletingSuccess="deletingSuccess"
              />
            </div>
          </template>
          <template></template>
        </data-table>
      </v-card-text>
      <v-dialog v-model="showForm" max-width="400">
        <subject-form
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
import SubjectForm from './SubjectForm'
export default {
  components: {
    DataTable,
    EditButton,
    DeleteButton,
    CreateButton,
    SubjectForm,
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
        { text: 'ID', value: 'id', width: '1%'},
        { text: this.$t('resources.subjects.dataTable.headers.name'), value: 'name' },
        { text: this.$t('resources.subjects.dataTable.headers.color'), value: 'color' },
        { text: this.$t('resources.subjects.dataTable.headers.actions'), value: 'actions', width: '1%'},
      ]
    },
    
  },
  created() {
    this.url = this.$api.subject.url.index();
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