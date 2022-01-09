<template>
  <v-tooltip bottom>
    <template #activator="{ on, attrs }">
        <v-btn
          color="primary"
          icon
          v-bind="attrs"
          v-on="on"
          @click="showDialog"
        >
        <v-icon>mdi-pencil</v-icon>
        </v-btn>
    </template>
    <span>{{ $t("edit") }}</span>
    </v-tooltip>
</template>

<script>

export default {
  name: 'EditButton',
  props: {
    url: {
      type: String,
      default: null
    }
    
  },

  data () {
    return {
      
    }
  },

  computed: {
    
  },

  watch: {
    
  },

  methods: {
    showDialog(){
      this.$emit('showDialog');
    }
    
    
  }
}
</script>
