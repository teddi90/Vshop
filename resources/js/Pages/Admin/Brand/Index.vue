<script setup>
import AdminLayout from "@/Pages/Admin/Components/AdminLayout.vue";
import BrandList from "@/Pages/Admin/Brand/BrandList.vue";
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";
const brands=computed(()=>{
   return  usePage().props.brands
});
</script>

<template>
    <AdminLayout>
        <BrandList :brands="brands"/>
    </AdminLayout>
</template>

