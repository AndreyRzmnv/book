<template>
    <footer>
        <v-row>
            <v-col cols="12">
                <v-card-text>
                    <v-text-field 
                        dense
                        :label="$t('search')"
                        append-icon="mdi-magnify"
                    />
                </v-card-text>
            </v-col>
        </v-row>
        
    </footer>
</template>
<script>
    export default {
        name: 'Search'
        
    }
</script>
<style lang="scss">
    footer{
        width: 100%;
        height: 50px;
        position: fixed;
        background-color: #fff;
        z-index: 1;
        bottom: 0;
    }
</style>