
<template>
<AdminLayout>
    <ProductList :products="products"/>
</AdminLayout>
</template>
<script setup>
defineProps({
    products:Object
})
import AdminLayout from "@/Pages/Admin/Components/AdminLayout.vue";
import ProductList from "@/Pages/Admin/Product/ProductList.vue";
</script>

