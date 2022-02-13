<template>
  <div>
		<v-list-item>
			<v-list-item-content>
				<v-list-item-title class="title">
					<router-link
					  :to="{ name: 'admin.dashboard' }"
					  tag="span"
					  style="cursor: pointer"
					  exact
				  >
						book
					</router-link>
			  </v-list-item-title>
			  <!-- <v-list-item-subtitle> -->
				<!-- subtext -->
			  <!-- </v-list-item-subtitle> -->
			</v-list-item-content>
		</v-list-item>

      <v-list dense nav>
        <div v-for="(item, index) in availableItems" :key="index">
          <v-list-group
            v-if="item.submenu" no-action 
          >
            <template v-slot:activator>
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-list-item-icon
                    v-bind="attrs"
                    v-on="on"
                  >
                    <v-icon>{{ item.icon }}</v-icon>
                  </v-list-item-icon>
                  <v-list-item-content
                    v-bind="attrs"
                    v-on="on"
                  >
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                  </v-list-item-content>
                </template>
                <span>{{ item.title }}</span>
              </v-tooltip>
            </template>
            <template
              v-for="(subItem, subIndex) in item.submenu"
            >
              <v-list-group
                v-if="subItem.submenu"
                :key="subIndex"
                sub-group
              >
                <template v-slot:activator>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-list-item-content
                        v-bind="attrs"
                        v-on="on"
                      >
                        <v-list-item-title>{{ subItem.title }}</v-list-item-title>
                      </v-list-item-content>
                    </template>
                    <span>{{ subItem.title }}</span>
                  </v-tooltip>
                  
                </template>
                <v-list-item
                  v-for="(subItem2, subIndex2) in subItem.submenu"
                  :key="subIndex2"
                  link
                  :to="subItem2.to"
                >
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-list-item-icon
                        v-bind="attrs"
                        v-on="on"
                      >
                        <v-icon size="6" right>mdi-checkbox-blank-circle</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content
                        v-bind="attrs"
                        v-on="on"
                      >
                        <v-list-item-title>{{ subItem2.title }}</v-list-item-title>
                      </v-list-item-content>
                    </template>
                    <span>{{ subItem2.title }}</span>
                  </v-tooltip>
                 
                </v-list-item>
              </v-list-group>
              <div v-else>
                <v-list-item
                  :to="subItem.to"
                >
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                      <v-list-item-icon
                        v-bind="attrs"
                        v-on="on"
                      >
                        <v-icon size="6" right>mdi-checkbox-blank-circle</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content
                        v-bind="attrs"
                        v-on="on"
                      >
                        <v-list-item-title>{{ subItem.title }}</v-list-item-title>
                      </v-list-item-content>
                    </template>
                    <span>{{ subItem.title }}</span>
                  </v-tooltip>
                  
                </v-list-item>
              </div>
            </template>
          </v-list-group>
          <div v-else>
            <v-list-item :to="item.to">
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </div>
        </div>
      </v-list>
    
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import LocaleDropdown from "../LocaleDropdown";
import UserMenu from "./UserMenu";

export default {
  name: 'Navbar',
  components: {
    LocaleDropdown,
    UserMenu,
  },
  data: () => ({
    drawer: true,
    showSearch: false,
  }),

  computed: {
    items() {
      return [
        {
            title: this.$t("menu.examples"),
            icon: "mdi-apps",
            to: { name: "admin.examples.index" },
            visible: true,
        },
        {
            title: this.$t("menu.subjects"),
            icon: "mdi-bookmark-multiple",
            to: { name: "admin.subjects.index" },
            visible: true,
        },
        {
            title: this.$t("menu.categories"),
            icon: "mdi-folder",
            to: { name: "admin.categories.index" },
            visible: true,
        },
        {
            title: this.$t("menu.subcategories"),
            icon: "mdi-folder-multiple",
            to: { name: "admin.subcategories.index" },
            visible: true,
        },
        {
            title: this.$t("menu.chat"),
            icon: "mdi-comment",
            to: { name: "admin.chat.index" },
            visible: true,
        }
      ];
    },
    availableItems() {

    //   for(let i in this.items){
    //     this.items[i].submenu = this.items[i].submenu.filter(item => {
    //       return item.visible === undefined || item.visible})
    //   }
      let data = this.items.filter(
        (item) => item.visible === undefined || item.visible  
      );
      return data;
    },
    ...mapGetters({
    //   mainSettings: "main-settings/mainSettings",
      auth: "auth/check",
      // can: "auth/can",
      // permission: "auth/permission",
    }),
  },
  watch: {
    showSearch: function (newSearch, oldSearch) {
      if (this.showSearch) {
        this.$nextTick(() => this.$refs.searchField.focus());
      }
    },
  },

  /*computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }*/
};
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -0.375rem 0;
}
</style>
