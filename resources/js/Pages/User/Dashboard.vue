<script setup>
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";
import { DateTime } from 'luxon';
defineProps({
    orders:Array
})
const convertedDate=(date)=>{
    const utcDateTime = DateTime.fromMillis(Date.parse(date));
    return utcDateTime.setZone('Europe/Kyiv').toFormat('dd.MM.yyyy HH:mm:ss');
}
</script>

<template>
    <UserLayout>
        <div class="container mx-auto pt-24">
            <div class="relative overflow-x-auto">
                <table v-for="order in orders" :key="order.id" class="mb-20 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-s-lg w-1/5">
                            Order ID #{{order.id}}
                        </th>
                        <th scope="col" class="px-6 py-3 w-1/5">
                            Brand
                        </th>
                        <th scope="col" class="px-6 py-3 w-1/5">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 w-1/5">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3 rounded-e-lg w-1/5">
                            Price
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in order.order_items" :key="item.id" class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-1/5">
                            {{item.product.title}}
                        </th>
                        <th class="px-6 py-4 w-1/5">
                            {{item.product.brand.name}}
                        </th>
                        <th class="px-6 py-4 w-1/5">
                            {{item.product.category.name}}
                        </th>
                        <th class="px-6 py-4 w-1/5">
                            {{item.quantity}}
                        </th>
                        <td class="px-6 py-4 w-1/5">
                            ${{item.unit_price}}
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr class="font-semibold text-gray-900 dark:text-white bg-gray-50 ">
                        <th scope="row" class="px-6 py-2 text-base rounded-s-lg">Date:</th>
                        <th class="px-6 py-2">{{convertedDate(order.updated_at).split(' ')[0]}}</th>
                        <th class="px-6 py-2">{{convertedDate(order.updated_at).split(' ')[1]}}</th>
                        <th class="px-6 py-2 text-base">Total:</th>
                        <td class="px-6 py-2 rounded-e-lg text-base"> ${{order.total_price}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </UserLayout>
</template>


