<template>
  <div>
    <v-tooltip bottom>
      <template #activator="{ on, attrs }">
          <v-btn
            color="error"
            icon
            v-bind="attrs"
            v-on="on"
            @click="showDialog = true"
          >
            <v-icon>mdi-delete</v-icon>
          </v-btn>
      </template>
      <span>{{ $t("delete") }}</span>
    </v-tooltip>
    <!-- Модальное окно -->
    <v-dialog v-model="showDialog" max-width="400">
      <v-card>
        <v-card-title>
          {{title}}
        </v-card-title>
        <v-card-actions>
          <v-spacer />
          <v-btn
            color="error"
            elevation="5"
            @click="submit"
          >
            {{$t('delete')}}
          </v-btn>
          <cancel-button @cancel="closeDialog" />
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from 'axios';
import CancelButton from '../CancelButton'
export default {
  name: 'DeleteButton',
  components: {
    CancelButton
  },
  props: {
    url: {
      type: String,
      required: true
    },
    title: {
      type: String,
      default: ''
    },
    
  },
  data () {
    return {
      showDialog: false
    }
  },
  methods: {
    submit() {
      axios.delete(this.url)
        .then((data) => {
          this.$emit('success', data)
          this.$toastr.s(this.$t('success'));
        })
        .catch(error => {
          this.$emit('error', error.response)
          this.$toastr.e(this.$t('error'));
        })
        .finally(() => {
          this.closeDialog();
        });
    },
    closeDialog(){
      this.showDialog = false;
    }

  }
}
</script>
