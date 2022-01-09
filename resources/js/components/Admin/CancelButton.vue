<template>
    <v-btn
        color="grey darken-2"
        dark
        elevation="5"
        @click="$emit('cancel')"
    >
        {{$t('cancel')}}
    </v-btn>
</template>
<script>
    export default {
    name: 'CancelButton'
    }
</script>
