<template>
    <div class="tiles-list">
        <tile
            v-for="n in 20"
            :key="n"
        ></tile>
    </div>
</template>
<script>
    export default {
        name: 'TilesList'
        
    }
</script>
<style lang="scss">
    .tiles-list{
        padding-top: 50px;
        display: flex;
        flex-wrap: wrap;
    }
    @media (max-width: 473px) {
        .tiles-list{
            padding-top: 80px;
        }
    }
    @media (max-width: 313px) {
        .tiles-list{
            padding-top: 100px;
        }
    }
</style>