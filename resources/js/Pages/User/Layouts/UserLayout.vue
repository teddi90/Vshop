<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Header from "@/Pages/User/Layouts/Header.vue";
import Footer from "@/Pages/User/Layouts/Footer.vue";
import Hero from "@/Pages/User/Layouts/Hero.vue";

onMounted(() => {
    initFlowbite();
})


</script>

<template>
    <!--    Header  -->
    <Header/>
    <!--    Header end   -->
    <Hero/>

    <!--        Main         -->
    <slot/>

    <!--        Main end     -->

    <!--    Footer   -->
    <Footer/>
    <!--    Footer end   -->
</template>

