<template>

        <v-list dense>
            <v-subheader>BOOK AdminPanel</v-subheader>
            <v-list-item-group
                color="primary"
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
                        <v-list-item-title 
                            v-text="item.title"
                            
                        ></v-list-item-title>
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
            getMenuData: []
        }),
        computed: {
            menu(){
                return this.getMenuData;
                // [
                //     { text: 'Real-Time', icon: 'mdi-clock' },
                //     { text: 'Audience', icon: 'mdi-account' },
                //     { text: 'Conversions', icon: 'mdi-flag' },
                // ]
            }
        },
        created() {
            this.$api.menuApi.index().then((data) => { 
                this.getMenuData = data.data;
                console.log(this.getMenuData);
            })
        },
        methods: {
            setMenu(data){
                
            }
        }
    }
</script>
<style lang="scss">
    
</style>