<template>
    <v-card>
      qwe

    </v-card>
</template>

<script>
import ApiAutocomplete from '../../../../components/Admin/ApiAutocomplete'
import { io } from "socket.io-client";

export default {
  components: {
    ApiAutocomplete,

  },
  data() {
    return {

    }
  },
  computed: {
    // ...mapGetters({
      
    // }),
    // socket () {
    //   return io('http://localhost:3000');
    // }
    
  },
  created() {
      let socket = io('http://localhost:3000')
      socket.on('connection2', function(data){
          console.log(data);
      });
    // console.log(this.socket);
  },
  methods: {
    
  },

}
</script>