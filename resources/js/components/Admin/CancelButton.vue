<template>
    <v-btn
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
