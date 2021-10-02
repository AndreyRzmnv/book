<template>
    <v-card class="admin-navbar" tile >

        <v-list dense nav>
            <router-link :to="{ name: 'admin.dashboard' }" class="text-decoration-none font-weight-light">
            <v-subheader>
                
                {{ adminName }}
            </v-subheader>
            </router-link>
            
            <v-list-item-group
                color="primary"
                v-model="selectedItem"
                no-action
            >
                <v-list-item
                    v-for="(item, i) in menu"
                    :key="i"
                    :to="item.to"
                    
                >
                    <v-list-item-icon>
                        <v-icon v-text="item.icon"></v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title v-text="item.text"></v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-item-group>
        </v-list>
    </v-card>
</template>
<script>
    import axios from 'axios'
    export default {
        name: 'AdminNavbar',
        data: () => ({
            adminName: window.config.adminName,
            selectedItem: 0,
            getMenuData: []
        }),
        computed: {
            menu(){
                return this.getMenuData;
            }
        },
        created() {
            this.$api.menuApi.index().then((data) => { 
                this.getMenuData = data.data;
                // this.getMenuData = [
                //     { text: 'Real-Time', icon: 'mdi-clock' },
                //     { text: 'Audience', icon: 'mdi-account' },
                //     { text: 'Conversions', icon: 'mdi-flag' , to: {name: 'admin.subcategories.index'}},
                // ];
            })
        },
        methods: {
            
        }
    }
</script>
<style lang="scss">
    .admin-navbar {
        width: 200px;
        height: 1000px;
    }
    .admin-panel-name{
        text-decoration: none;
        outline: none;
        // color: red;
    }
</style>