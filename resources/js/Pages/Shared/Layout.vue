<template>
    <div class="flex ">
        <Sidebar />
        <div class="flex-1">
            <Navbar />
            <div class="content p-6">
                <slot />
            </div>
        </div>
    </div>
</template>

<script setup>
import Sidebar from '../../components/Sidebar.vue'
import Navbar from '../../components/Navbar.vue';
</script>

