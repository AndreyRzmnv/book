<template>
    <v-btn
        color="blue darken-2"
        dark
        elevation="5"
        @click="$emit('showCreateForm')"
    >
        <v-icon>mdi-plus</v-icon>
        {{$t('add')}}
    </v-btn>
</template>
<script>
    export default {
        name: 'CreateButton'
    }
</script>