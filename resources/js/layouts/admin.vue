<template>
    <v-app>
        
        <div class="admin-panel">
            
            
            <admin-navbar />
            
            <div class="admin-content">
                <navbar />
                <child />
            </div>
            
        </div>
    </v-app>
    
</template>

<script>
import Navbar from '~/components/Admin/Header'
export default {
    name: 'AdminLayout',
    components: {
        Navbar
    }
}
</script>

<style lang="scss">

    .admin-panel {
        width: 100%;
        display: flex;
    }
    .admin-content{
        width: 100%;
    }
    
</style>