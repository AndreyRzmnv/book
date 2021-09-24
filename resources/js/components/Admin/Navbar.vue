<template>

        <v-list dense nav>
            <v-subheader>BOOK AdminPanel</v-subheader>
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

</template>
<script>
    import axios from 'axios'
    export default {
        name: 'AdminNavbar',
        data: () => ({
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
    
</style>