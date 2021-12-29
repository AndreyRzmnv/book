<template>
  <v-app :style="{background: $vuetify.theme.themes[theme].background}">
    <navbar />
    <v-main>
      <v-container fluid>
        <h1>{{ title }}</h1>
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import Navbar from '../components/Admin/Navbar'

export default {
  name: 'AdminLayout',
  components: {
    Navbar
  },
  data: () => ({
    appName: window.config.appName
  }),
  metaInfo () {
    return { title: this.title }
  },
  computed: {
    title () {
      return this.$t('routes.' + this.$route.name)
    },
    theme () {
      return this.$vuetify.theme.dark ? 'dark' : 'light'
    }
  }
}
</script>
