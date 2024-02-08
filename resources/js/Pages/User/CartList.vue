<script setup>
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";
import {router, usePage} from "@inertiajs/vue3";
import {computed, reactive} from "vue";
defineProps({
    userAddress:Object
});
// const userAddress=usePage().props.userAddress;

const cart= computed(()=>usePage().props.cart.data.items);
const products= computed(()=>usePage().props.cart.data.products);
const total= computed(()=>usePage().props.cart.data.total);

const itemId=(id)=>cart.value.findIndex((item)=>item.product_id===id);

const update=(product, quantity)=>{
    router.patch(route('cart.update',product),{
        quantity,
    });
}
const form=reactive({
    address1:null,
    state:null,
    city:null,
    zipcode:null,
    country_code:null,
    type:null,
})
const formFilled=computed(()=>{
    return (form.address1!==null &&
    form.city!==null &&
    form.zipcode!==null &&
    form.country_code!==null &&
    form.type!==null)
});
const remove=(product)=>router.delete(route('cart.delete',product));

const submit=()=>{
    router.visit(route('checkout.store'),{
        method:'post',
        data: {
            carts: usePage().props.cart.data.items,
            products: usePage().props.cart.data.products,
            total: usePage().props.cart.data.total,
            address: form,

        }
    });
}

</script>

<template>
    <UserLayout>
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
                <div class="lg:w-2/3 md:w-1/2 rounded-lg sm:mr-10 p-10">

                    <!--  Cart List  -->
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-16 py-3">
                                    <span class="sr-only">Image</span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Qty
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products" :key="product.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4">
                                    <img v-if="product.product_images.length" :src="`/${product.product_images[0].image}`" class="w-16 md:w-32 max-w-full max-h-full" :alt="product.title">
                                    <img v-else src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEX////MzMzS0tLKysr5+fnY2Nje3t7b29v19fXHx8fv7+/7+/vm5ubU1NTq6urx8fHErebOAAAFTUlEQVR4nO2cjXKjIBhFRRBEEN//bReIGn/QGmnl28w9s9MdbabmBOQCQaoKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAN+Jef6Sqn4W9bhhw9mT8ObbDVkZw7p/qIqWMuSPXUx/veH3lyEdw6Hr2u2530iyMoaM6fWZoeEBpsTyrKl/QZGEoZHv+LCL81bL/ItRMDS9fmcXf3dAjH9ZfiFSMFSrDgCfS1GtfO9CwNBtejh8LLchHg25FyNg2G87WXZ5PvvdlTJk80G770fG892raLXLvFh5w20l9VIxF+vxqM68WHlDuzPkbTzNty3PPagaisVxXmKUN9zXUu47NnJxnBf75Q33LY2/89qltt71Vz+hvGEyLdbn+pyLETDcVlMtpqSYq21O7BMwjIcLHftOit8oRAqGVb8osjCc2DWvPCP2SRiad987lKBgu+Y1Y6BIwtB30fow/uVcvcJ+K7geNn4GEUNP59wrFcTeLzY/N6FjOCNThuz2QJGeYWKsEbmbGPQMt0kxcTcxyBm6A0HGbiYGOcOjIrw9UKRmmEqKiXuJQcxQnH7vdisxiBkqfSLIbw0UaRkO/Py708PEMMe9OlqGP305fPhW1fEgmZThcFZHI136Dzp+3NCSMjxOion0GEOc3aOUDPdzUnuSsR/mPA7nAQgZmp+LMB37Y4YeNDaEDOWPd2FgP8YYxqI/8KBjaK74ebat5rvo030eOobNsdRpIS6Gk8nIIGM4XF0ntZkfdou6nYwMKoZmNy98yGqguKrbOlVPqRh215e6raYWNx9MIjKoGH60lu+dC3Zrv48MIoZnw8J9Ic6Vsd1NHe/DhIZhYg74lGmguO8j7GfHaRimJxCPGTuhMvW5bCODhOHRBOIxUSPdOm0jg4Th1bCfieuaDzpB21EGBcPuUod0he6Ox1qbUQYBw0tjii31yVhrPYgkYHg8B3zGNgkXrCOjvOHVMcVW4+x3y8gob5hs8jOpF5FR3FB83sxcYOFU3FD9QRGy5Sqj0oaXh4WfMtfT0ob9XxnOkVHY8MoE4k2melrmya7Z8E7YX8VRMDyJ7XzG0XBRw5thf9WwKW94bQ74vqItbdgqJSPqrzCFDZ+B8283ZIXy8NufP/RXleEmHO/DP0TJYoZPAsM/MNRhtexj6OcNhRBGPEiBjTEAAAAAAAAAAAAAAAAgh3FaM/EsYdYGNXQYpmWTu8e3bPIxg/+Pjo/rt3d7X3U6e186EnScvx4WydjmgzYdd6+9LqOhsNJON6SwohKucqqrjJUunG6ljHXZH8vWhLJ3St7eHeQhOm5s3GEvGFpdy3p6KHbQbdWxulHa1k0TFnJb3cjweJBhvVWcNZVgtVQ5G/U8QcdFpcJOZv4+FHE9ejM+HRMNw9uX4ROQ3L92CC2Tq2xYD6Aa/9LwDZq998T+YwRDER4m8IY2PqHWjoUSDF0448JmdW7aq8aXdTT0Pwy3RrQD8RapC++81SoYyri00CwMu2AYX+INTdVa1fsMaZkVQ/y/7nv/j3ZwxrfvS8/5spFxNYrQKcPwwzLp2nC/yrruXfhgaJfei5dh2HnWvnyiWVUlDNupRWqnh9Xu70H0IKNhVYceTF+3pp2WGMz34dLQhKZTMN33jY8Vp60Qtqf9ffbAXyUW2xehGGfKvH/Thd+GxihqSlYz56tnx5yzMsSo45rXxNOimpr6l5dp5wIJiR774zHa/etMFZYfmKkLG6Oi+s4FCb71FMbpg+0yvgERHmYgXzkzOdmaBgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP8V/wDWGTLczR9cDgAAAABJRU5ErkJggg==" :alt="product.title" class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{product.title}}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <button @click.prevent="update(product, cart[itemId(product.id)].quantity-1)"
                                                :disabled="cart[itemId(product.id)].quantity <= 1"
                                                class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                :class="cart[itemId(product.id)].quantity > 1 ? 'cursor-pointer text-purple-600' : 'cursor-not-allowed text-gray-300 dark:text-gray-500'" type="button">
                                            <span class="sr-only">Quantity button</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                            </svg>
                                        </button>
                                        <div>
                                            <input type="number" id="first_product"
                                                   v-model="cart[itemId(product.id)].quantity"
                                                   class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" required>
                                        </div>
                                        <button @click.prevent="update(product, cart[itemId(product.id)].quantity+1)"
                                                class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                                            <span class="sr-only">Quantity button</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    ${{product.price * cart[itemId(product.id)].quantity}}
                                </td>
                                <td class="px-6 py-4">
                                    <button @click.prevent="remove(product)" type="button" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                </div>
                <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Summary</h2>
                    <p class="leading-relaxed mb-5 text-gray-600">Total: {{total}}$</p>
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Shopping Address</h2>
                    <div v-if="userAddress">
                        <p class="leading-relaxed mb-5 text-gray-600"> {{userAddress.address1}}, {{userAddress.city}},  {{userAddress.zipcode}}</p>
                        <p class="leading-relaxed mb-5 text-gray-600">or you can add new below</p>
                    </div>
                    <div v-else>
                        <p class="leading-relaxed mb-5 text-gray-600">Add shipping address to continue</p>
                    </div>

                    <form @submit.prevent="submit">
                        <div class="relative mb-4">
                            <label for="address" class="leading-7 text-sm text-gray-600">Address 1</label>
                            <input v-model="form.address1" type="text" id="address" name="address" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="city" class="leading-7 text-sm text-gray-600">City</label>
                            <input v-model="form.city" type="text" id="city" name="city" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="state" class="leading-7 text-sm text-gray-600">State</label>
                            <input v-model="form.state" type="text" id="state" name="state" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">

                        </div>
                        <div class="relative mb-4">
                            <label for="zipcode" class="leading-7 text-sm text-gray-600">Zipcode</label>
                            <input v-model="form.zipcode" type="text" id="zipcode" name="zipcode" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="country-code" class="leading-7 text-sm text-gray-600">Country Code</label>
                            <input v-model="form.country_code" type="text" id="country-code" name="country-code" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="relative mb-4">
                            <label for="address-type" class="leading-7 text-sm text-gray-600">Address type</label>
                            <input v-model="form.type" type="text" id="address-type" name="address-type" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <button v-if="formFilled || userAddress" type="submit"
                                class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Checkout</button>
                        <button v-else type="submit"
                                class="text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-lg">Add Address to continue</button>
                    </form>
                    <p class="text-xs text-gray-500 mt-3">Continue Shopping</p>
                </div>
            </div>
        </section>
    </UserLayout>
</template>


