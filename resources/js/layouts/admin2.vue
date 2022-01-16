<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <navbar2/>
    </v-navigation-drawer>

    <v-app-bar app dense>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>{{ title }}</v-toolbar-title>
      <v-spacer/>
      <user-menu></user-menu>
    </v-app-bar>

    <v-main>
      <v-container fluid>
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
    import Navbar2 from '../components/Admin/Navbar2'
    import UserMenu from '../components/Admin/UserMenu'
    export default {
        name: 'admin2',
        components: {
            UserMenu,
            Navbar2
        },
        data: () => ({
            drawer: null,
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
