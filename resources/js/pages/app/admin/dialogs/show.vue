<template>
    <v-card>
      <v-card-text style="height: 500px; overflow: auto">
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

          <!-- <v-timeline-item
            color="teal lighten-3"
            small
          >
            <v-row class="pt-1">
              <v-col cols="3">
                <strong>3-4pm</strong>
              </v-col>
              <v-col>
                <strong>Design Stand Up</strong>
                <div class="text-caption mb-2">
                  Hangouts
                </div>
                <v-avatar>
                  <v-img
                    src="https://avataaars.io/?avatarStyle=Circle&topType=LongHairFrida&accessoriesType=Kurt&hairColor=Red&facialHairType=BeardLight&facialHairColor=BrownDark&clotheType=GraphicShirt&clotheColor=Gray01&graphicType=Skull&eyeType=Wink&eyebrowType=RaisedExcitedNatural&mouthType=Disbelief&skinColor=Brown"
                  ></v-img>
                </v-avatar>
                <v-avatar>
                  <v-img
                    src="https://avataaars.io/?avatarStyle=Circle&topType=ShortHairFrizzle&accessoriesType=Prescription02&hairColor=Black&facialHairType=MoustacheMagnum&facialHairColor=BrownDark&clotheType=BlazerSweater&clotheColor=Black&eyeType=Default&eyebrowType=FlatNatural&mouthType=Default&skinColor=Tanned"
                  ></v-img>
                </v-avatar>
                <v-avatar>
                  <v-img
                    src="https://avataaars.io/?avatarStyle=Circle&topType=LongHairMiaWallace&accessoriesType=Sunglasses&hairColor=BlondeGolden&facialHairType=Blank&clotheType=BlazerSweater&eyeType=Surprised&eyebrowType=RaisedExcited&mouthType=Smile&skinColor=Pale"
                  ></v-img>
                </v-avatar>
              </v-col>
            </v-row>
          </v-timeline-item>

          <v-timeline-item
            color="pink"
            small
          >
            <v-row class="pt-1">
              <v-col cols="3">
                <strong>12pm</strong>
              </v-col>
              <v-col>
                <strong>Lunch break</strong>
              </v-col>
            </v-row>
          </v-timeline-item>

          <v-timeline-item
            color="teal lighten-3"
            small
          >
            <v-row class="pt-1">
              <v-col cols="3">
                <strong>9-11am</strong>
              </v-col>
              <v-col>
                <strong>Finish Home Screen</strong>
                <div class="text-caption">
                  Web App
                </div>
              </v-col>
            </v-row>
          </v-timeline-item> -->
        </v-timeline>
      </v-card-text>

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
        messages: []
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
      this.$api.dialog.show(this.$route.params.id).then((data) => {
          this.init(data.data.data)
      });
      let socket = io('http://localhost:3000')
      socket.on('connection2', function(data){
          console.log(data);
      });
    // console.log(this.socket);
  },
  methods: {
    init(data){
        console.log(data);
        this.messages = data;
       
    }
  },

}
</script>