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
          :url="$api.subject.url.index()"
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
              <v-btn
                  icon
                  color="blue"
                  :to="{name: 'admin.categories.index', params: { filters: { subject: { id: item.id, name: item.name } } } }"
                  dark
              >
                <v-icon>mdi-share</v-icon>
                
              </v-btn>
              <edit-button
                @showDialog="edit(item)"
              />
              
              <delete-button
                :url="$api.subject.url.delete(item.id)"
                :title="$t('resources.subjects.titles.delete')"
                @success="successDeleting"
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
        { text: this.$t('resources.subjects.fields.name'), value: 'name' },
        { text: this.$t('resources.subjects.fields.color'), value: 'color' },
        { text: this.$t('resources.subjects.fields.actions'), value: 'actions', width: '1%'},
      ]
    },
    
  },
  created() {

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