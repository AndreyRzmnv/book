<template>
  <v-menu
    v-if="user"
    v-model="menu"
    :close-on-content-click="false"
    :nudge-width="200"
    bottom
    offset-y
    transition="scale-transition"
    origin="top right"
  >
    <template #activator="{ on }">
      <v-btn icon large v-on="on">
        <v-avatar size="32px" item>
          <v-img
            v-if="photo"
            :src="photo"
            alt=""
          />
          <v-icon v-else x-large dark>
            mdi-account-circle
          </v-icon>
        </v-avatar>
      </v-btn>
    </template>

    <v-card>
      <v-list>
        <v-list-item>
          <v-list-item-avatar>
            <v-img
              v-if="photo"
              :src="photo"
              alt=""
            />
            <v-icon v-else x-large>
              mdi-account-circle
            </v-icon>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>{{ name }}</v-list-item-title>
            <v-list-item-subtitle>{{ roles.join(', ') }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-divider />

      <v-list>
        <!-- <v-list-item>
          <v-list-item-action>
            <v-switch
              v-model="darkTheme"
              color="primary"
            />
          </v-list-item-action>
          <v-list-item-title>
            {{ $t('dark_theme') }}
          </v-list-item-title>
        </v-list-item> -->

        <!-- <v-list-item>
          <v-list-item-title>
            {{ $t('language') }}
            <locale-dropdown />
          </v-list-item-title>
        </v-list-item> -->

        <!-- <v-list-item>
          <v-list-item-title>
            <zadarma-webrtc />
          </v-list-item-title>
        </v-list-item> -->

<!--        <v-list-item>-->
<!--          <v-list-item-title>-->
<!--            Статус подключения: {{ connectionState }}-->
<!--          </v-list-item-title>-->
<!--        </v-list-item>-->
      </v-list>

      <v-card-actions>
        <v-btn color="primary" :to="{ name: 'user.profile' }" @click="menu = false">
          <v-icon>mdi-account</v-icon>
          {{ $t('profile') }}
        </v-btn>
        <v-spacer />
        <v-btn color="primary" @click.prevent="logout">
          <v-icon>mdi-logout</v-icon>
          {{ $t('logout') }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-menu>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from "../LocaleDropdown";

export default {
  components: { LocaleDropdown },
  data: () => ({
    menu: false
  }),

  computed: {
    // darkTheme: {
    //   get () {
    //     return this.$vuetify.theme.dark
    //   },
    //   set (value) {
    //     this.$vuetify.theme.dark = value
    //     localStorage.setItem('theme', value ? 'dark' : 'light')
    //   }
    // },
    roles: function () {
      return this.user && this.user.roles
        ? this.user.roles
        : []
    },
    name: function () {
      return this.user ? this.user.name : '-'
    },
    photo: function () {
      return this.user && this.user.photo && this.user.photo.photo_url
    },
    ...mapGetters({
      user: 'auth/user',
      connectionState: 'channels/connectionState'
    })
  },

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')
      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
