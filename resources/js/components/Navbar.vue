<template>
  <div>
    <v-app-bar color="white" dense app>
      <template>
        <v-app-bar-nav-icon @click="drawer = !drawer" />
        <v-spacer />
        <!-- <user-menu /> -->
      </template>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      app
    >
		<v-list-item>
			<v-list-item-content>
				<v-list-item-title class="title">
					<router-link
					  :to="{ name: 'home' }"
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
    </v-navigation-drawer>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import LocaleDropdown from "./LocaleDropdown";
// import UserMenu from "./UserMenu";

export default {
  components: {
    LocaleDropdown,
    // UserMenu,
  },
  data: () => ({
    drawer: true,
    showSearch: false,
  }),

  computed: {
    items() {
      return [
        {
          title: this.$t("menu.sim"),
          icon: "mdi-sim-outline",
          submenu: [
            {
              title: this.$t("menu.incoming"),
              to: { name: "incoming.index" },
              // visible: this.permission('read incoming'),
            },
            // {
            //   title: this.$t("menu.implementation"),
            //   to: { name: "implementation.index" },
            //   visible: this.permission('read implementation'),
            // },
            // {
            //   title: this.$t("menu.verification"),
            //   to: { name: "verification.index" },
            //   visible: this.permission('read verification'),
            // },
            // {
            //   title: this.$t("menu.unregistered"),
            //   to: { name: "unregistered.index" },
            //   visible: this.permission('read unregistered'),
            // },
            // {
            //   title: this.$t("menu.write_off"),
            //   to: { name: "write_off.index" },
            //   visible: this.permission('read write_off'),
            // },
            // {
            //   title: this.$t("menu.log_files"),
            //   to: { name: "log_files.index" },
            //   visible: this.can('read log_files'),
            // },
            // {
            //   title: this.$t("menu.log_movements"),
            //   to: { name: "log_movements.index" },
            //   visible: this.can('read log_movements'),
            // }
          ],
        },
        // {
        //   title: this.$t("menu.settings"),
        //   icon: "mdi-cog-outline",
        //   submenu: [
        //     {
        //       title: this.$t("menu.branches"),
        //       to: { name: "branches.index" },
        //       visible: this.can('read branches'),
        //     },
        //     {
        //       title: this.$t("menu.users"),
        //       to: { name: "users.index" },
        //       visible: this.can('read users'),
        //     },
        //     {
        //       title: this.$t("menu.operators"),
        //       to: { name: "operators.index" },
        //       visible: this.can('read operators'),
        //     },
        //     {
        //       title: this.$t("menu.cities"),
        //       to: { name: "cities.index" },
        //       visible: this.can('read cities'),
        //     },
        //     {
        //       title: this.$t("menu.limitation_remuneration"),
        //       to: { name: "limitation-remuneration.index" },
        //       visible: this.can('read limitation_remuneration'),
        //     },
        //     {
        //       title: this.$t("menu.main_settings"),
        //       to: { name: "main_settings.index" },
        //       visible: this.can('read main_settings'),
        //     },
        //   ],
        // },
        // {
        //   title: this.$t("menu.references"),
        //   icon: "mdi-folder-open",
        //   submenu: [
        //     {
        //       title: this.$t("menu.rates"),
        //       to: { name: "rates.index" },
        //       visible: this.can('read rates'),
        //     },
        //   ],
        // },
        // {
        //   title: this.$t("menu.reports"),
        //   icon: "mdi-chart-line",
        //   submenu: [
        //     {
        //       title: this.$t("menu.sim_remains"),
        //       to: { name: "sim_remains.index" },
        //       visible: this.can('read sim_remains'),
        //     },
        //     {
        //       title: this.$t("menu.sim_reports"),
        //       to: { name: "sim_reports.index" },
        //       visible: this.can('read sim_reports'),
        //     },
        //     {
        //       title: this.$t("menu.one_sim"),
        //       to: { name: "one-sim.index" },
        //       visible: this.can('read one_sim'),
        //     },
        //     {
        //       title: this.$t("menu.rewards"),
        //       to: { name: "rewards.index" },
        //       visible: this.can('read rewards'),
        //     },
        //     {
        //       title: this.$t("menu.activations"),
        //       to: { name: "activations.index" },
        //       visible: this.can('read activations'),
        //     },
        //     {
        //       title: this.$t("menu.realization"),
        //       to: { name: "realization.index" },
        //       visible: this.can('read realization'),
        //     },
        //     {
        //       title: this.$t("menu.total_city_balance"),
        //       to: { name: "total_city_balance.index" },
        //       visible: this.can('read total_city_balance'),
        //     },
        //     {
        //       title: this.$t("menu.total_agent_balance"),
        //       to: { name: "total_agent_balance.index" },
        //       visible: this.can('read total_agent_balance'),
        //     },
        //     {
        //       title: this.$t("menu.total_city_unregistered"),
        //       to: { name: "total_city_unregistered.index" },
        //       visible: this.can('read total_city_unregistered'),
        //     },
        //     {
        //       title: this.$t("menu.total_agent_activation"),
        //       to: { name: "total_agent_activation.index" },
        //       visible: this.can('read total_agent_activation'),
        //     },
        //     {
        //       title: this.$t("menu.total_city_remuneration"),
        //       to: { name: "total_city_remuneration.index" },
        //       visible: this.can('read total_city_remuneration'),
        //     },
        //     {
        //       title: this.$t("menu.total_agent_remuneration"),
        //       to: { name: "total_agent_remuneration.index" },
        //       visible: this.can('read total_agent_remuneration'),
        //     }
        //   ],
        // },
        // {
        //   title: this.$t("menu.vo"),
        //   icon: "mdi-cellphone-basic",
        //   submenu: [
        //     {
        //       title: this.$t("menu.references"),
        //       icon: "mdi-cellphone-basic",
        //       // to: { name: "total_agent_remuneration.index" },
        //       // visible: this.can('read total_agent_remuneration'),
        //       submenu: [
        //         {
        //           title: this.$t("menu.additional_blocked_statuses"),
        //           to: { name: "additional_blocked_statuses.index" },
        //           // visible: this.can('read additional_status_blocked'),
        //         }
        //       ],
        //     }
        //   ],
        // }
      ];
    },
    availableItems() {

      for(let i in this.items){
        this.items[i].submenu = this.items[i].submenu.filter(item => {
          return item.visible === undefined || item.visible})
      }
      let data = this.items.filter(
        (item) => item.visible === undefined || item.visible  
      );
      return data;
    },
    ...mapGetters({
      mainSettings: "main-settings/mainSettings",
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
