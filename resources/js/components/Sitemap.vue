<template>
    <header>
        <v-card-text>
            <v-btn
                x-small
                color="#637abe"
                dark
            >
              PHP
            </v-btn>
            <v-btn
                x-small
                color="#f7e01b"
                
            >
              JS
            </v-btn>
            <v-btn
                x-small
                color="#679f63"
                dark
            >
              Node.js
            </v-btn>
            <v-btn
                x-small
                color="#ac63be"
                dark
            >
              Регулярные выражения
            </v-btn>
            <v-btn
                x-small
                color="#1b413d"
                dark
            >
              Математика
            </v-btn>
            
        </v-card-text>
        
    </header>
</template>
<script>
    export default {
        name: 'Sitemap'
        
    }
</script>
<style lang="scss">
    header{
        width: 100%;
        position: fixed;
        background-color: #fff;
        z-index: 1;
    }
</style>