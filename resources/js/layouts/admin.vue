<template>
    <div class="admin-panel">
        <v-card class="admin-navbar">
            <admin-navbar />
        </v-card>
        <div class="admin-content">
            <child />
        </div>
        
    </div>
</template>

<script>
export default {
  name: 'AdminLayout'
}
</script>

<style lang="scss">

    .admin-panel {
        width: 100%;
        display: flex;
    }
    .admin-navbar {
        width: 200px;
        height: 1000px;
    }
</style>