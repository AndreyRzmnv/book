<template>
    <v-card>
      <v-card-text>
        <data-table
          ref="datatable"
          :url="url"
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
                @showDialog="showDialog(item)"
              >
              </edit-button>
              <delete-button
                :url="$api.subject.url.delete(item.id)"
                icon
                :title="$t('resources.subjects.titles.delete')"
                @successDeleting="successDeleting"
              />
            </div>
          </template>
        </data-table>
      </v-card-text>
      <v-dialog v-model="showForm" max-width="400">
        <subject-form
          :v-if="showForm"
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
import SubjectForm from './SubjectForm'
export default {
  components: {
    DataTable,
    EditButton,
    DeleteButton,
    SubjectForm,
  },
  data() {
    return {
      url: '',
      search: '',
      showForm: false,
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
        { text: this.$t('resources.subjects.dataTable.headers.actions'), value: 'actions', width: '1%'},
      ]
    },
    
  },
  created() {
    this.url = this.$api.subject.url.index();
    console.log(this);
  },
  methods: {
    showDialog(item){
      this.model = item;
      this.showForm = true;
    },
    successDeleting(data){
      this.$refs.datatable.getData();
    }
  },

}
</script>