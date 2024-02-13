<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Header from "@/Pages/User/Layouts/Header.vue";
import Footer from "@/Pages/User/Layouts/Footer.vue";

onMounted(() => {
    initFlowbite();
})


</script>

<template>
    <!--    Header  -->
    <Header/>
    <!--    Header end   -->

    <!--        Main         -->
    <slot/>

    <!--        Main end     -->

    <!--    Footer   -->
    <Footer/>
    <!--    Footer end   -->
</template>

