<template>
    <v-card>
      <v-card-text ref="dialogBlock" style="height: 500px; overflow: auto">
        <v-timeline
          align-top
          dense
        >
          <v-timeline-item
            color="pink"
            small
            v-for="(item, index) in messages" :key="index"
          >
            <v-row class="pt-1">
              <v-col cols="3">
                <strong>{{item.created_at}}</strong>
              </v-col>
              <v-col>
                <strong>{{item.user_name}}</strong>
                <div class="text-caption">
                  {{item.text}}
                </div>
              </v-col>
            </v-row>
          </v-timeline-item>
        </v-timeline>
        <div ref="qwe"></div>
      </v-card-text>
      <v-card-actions>
        <v-card-text>
          <v-text-field
            v-model="message"
            :label="$t('resources.dialogs.fields.message')"
            dense
          >
            <template #append-outer>
              <v-btn
                icon
                color="primary"
                @click="sendMessage"
              >
                <v-icon>
                  mdi-send
                </v-icon>
              </v-btn>
            </template>

          </v-text-field>
        </v-card-text>
      </v-card-actions>
    </v-card>
</template>

<script>
import ApiAutocomplete from '../../../../components/Admin/ApiAutocomplete'
import { io } from "socket.io-client";
import moment from "moment";

export default {
  components: {
    ApiAutocomplete,

  },
  data() {
    return {
        messages: [],
        message: '',
        
    }
  },
  computed: {
    // ...mapGetters({
      
    // }),
    socket () {
      return io('http://localhost:3000');
    }
    
  },
  created() {
      this.$api.dialog.show(this.$route.params.id).then((data) => {
          this.init(data.data.data)
      });
      
  },
  methods: {
    async init(data){
        this.messages = data;
        this.scrollBottom();
    },
    sendMessage(){
      this.messages.push({created_at: moment().format('DD.MM.YYYY'), text: this.message, user_name: 'Andrey'});
      this.scrollBottom();
    },
    scrollBottom() {
      setTimeout(() => {
        this.$refs.qwe.scrollIntoView();
      }, 1)
    }
  },

}
</script>