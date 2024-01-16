<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <!--   navbar   -->
        <Navbar/>

        <!-- Sidebar -->
        <Sidebar/>

        <main class="p-4 md:ml-64 h-auto pt-20">
            <slot/>
        </main>


    </div>
</template>
<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Navbar from "@/Pages/Admin/Components/Navbar.vue";
import Sidebar from "@/Pages/Admin/Components/Sidebar.vue";


onMounted(() => {
    initFlowbite();
})
</script>

