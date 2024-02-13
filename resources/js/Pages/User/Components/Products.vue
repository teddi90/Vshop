<script setup xmlns="http://www.w3.org/1999/html">
import {router, Link} from "@inertiajs/vue3";
import Swal from "sweetalert2";

defineProps({
    products:Array,
    isThreeColumns:{
        type:Boolean,
        default:false
    }
});
const addToCart = (product) => {
    router.post(`/cart/store/${product.id}`, product, {
        // router.post(route('cart.store'), product, {
        onSuccess: (page) => {
            Swal.fire({
                toast: true,
                icon: 'success',
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                title: page.props.flash.success
            });
        },
    });
}
</script>

<template>
    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 xl:gap-x-8"
         :class="{'lg:grid-cols-3':isThreeColumns,'lg:grid-cols-4':!isThreeColumns}">
        <div v-for="product in products" :key="product.id" class="group relative">
            <div
                class="z-10 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                <img v-if="product.product_images.length>0" :src="`/${product.product_images[0].image}`"
                     :alt="product.title"
                     class="h-full w-full object-cover object-center lg:h-full lg:w-full"/>
                <img v-else
                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEX////MzMzS0tLKysr5+fnY2Nje3t7b29v19fXHx8fv7+/7+/vm5ubU1NTq6urx8fHErebOAAAFTUlEQVR4nO2cjXKjIBhFRRBEEN//bReIGn/QGmnl28w9s9MdbabmBOQCQaoKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAN+Jef6Sqn4W9bhhw9mT8ObbDVkZw7p/qIqWMuSPXUx/veH3lyEdw6Hr2u2530iyMoaM6fWZoeEBpsTyrKl/QZGEoZHv+LCL81bL/ItRMDS9fmcXf3dAjH9ZfiFSMFSrDgCfS1GtfO9CwNBtejh8LLchHg25FyNg2G87WXZ5PvvdlTJk80G770fG892raLXLvFh5w20l9VIxF+vxqM68WHlDuzPkbTzNty3PPagaisVxXmKUN9zXUu47NnJxnBf75Q33LY2/89qltt71Vz+hvGEyLdbn+pyLETDcVlMtpqSYq21O7BMwjIcLHftOit8oRAqGVb8osjCc2DWvPCP2SRiad987lKBgu+Y1Y6BIwtB30fow/uVcvcJ+K7geNn4GEUNP59wrFcTeLzY/N6FjOCNThuz2QJGeYWKsEbmbGPQMt0kxcTcxyBm6A0HGbiYGOcOjIrw9UKRmmEqKiXuJQcxQnH7vdisxiBkqfSLIbw0UaRkO/Py708PEMMe9OlqGP305fPhW1fEgmZThcFZHI136Dzp+3NCSMjxOion0GEOc3aOUDPdzUnuSsR/mPA7nAQgZmp+LMB37Y4YeNDaEDOWPd2FgP8YYxqI/8KBjaK74ebat5rvo030eOobNsdRpIS6Gk8nIIGM4XF0ntZkfdou6nYwMKoZmNy98yGqguKrbOlVPqRh215e6raYWNx9MIjKoGH60lu+dC3Zrv48MIoZnw8J9Ic6Vsd1NHe/DhIZhYg74lGmguO8j7GfHaRimJxCPGTuhMvW5bCODhOHRBOIxUSPdOm0jg4Th1bCfieuaDzpB21EGBcPuUod0he6Ox1qbUQYBw0tjii31yVhrPYgkYHg8B3zGNgkXrCOjvOHVMcVW4+x3y8gob5hs8jOpF5FR3FB83sxcYOFU3FD9QRGy5Sqj0oaXh4WfMtfT0ob9XxnOkVHY8MoE4k2melrmya7Z8E7YX8VRMDyJ7XzG0XBRw5thf9WwKW94bQ74vqItbdgqJSPqrzCFDZ+B8283ZIXy8NufP/RXleEmHO/DP0TJYoZPAsM/MNRhtexj6OcNhRBGPEiBjTEAAAAAAAAAAAAAAAAgh3FaM/EsYdYGNXQYpmWTu8e3bPIxg/+Pjo/rt3d7X3U6e186EnScvx4WydjmgzYdd6+9LqOhsNJON6SwohKucqqrjJUunG6ljHXZH8vWhLJ3St7eHeQhOm5s3GEvGFpdy3p6KHbQbdWxulHa1k0TFnJb3cjweJBhvVWcNZVgtVQ5G/U8QcdFpcJOZv4+FHE9ejM+HRMNw9uX4ROQ3L92CC2Tq2xYD6Aa/9LwDZq998T+YwRDER4m8IY2PqHWjoUSDF0448JmdW7aq8aXdTT0Pwy3RrQD8RapC++81SoYyri00CwMu2AYX+INTdVa1fsMaZkVQ/y/7nv/j3ZwxrfvS8/5spFxNYrQKcPwwzLp2nC/yrruXfhgaJfei5dh2HnWvnyiWVUlDNupRWqnh9Xu70H0IKNhVYceTF+3pp2WGMz34dLQhKZTMN33jY8Vp60Qtqf9ffbAXyUW2xehGGfKvH/Thd+GxihqSlYz56tnx5yzMsSo45rXxNOimpr6l5dp5wIJiR774zHa/etMFZYfmKkLG6Oi+s4FCb71FMbpg+0yvgERHmYgXzkzOdmaBgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP8V/wDWGTLczR9cDgAAAABJRU5ErkJggg=="
                     :alt="product.title"
                     class="h-full w-full object-cover object-center lg:h-full lg:w-full"/>

                <div
                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 cursor-pointer">
                    <div class="bg-blue-700 p-2 rounded-full mr-2">
                        <a @click.prevent="addToCart(product)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="bg-blue-700 p-2 rounded-full">
                        <Link :href="`/products/${product.id}`">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>

                        </Link>
                    </div>
                </div>
            </div>
            <div class="relative z-10 mt-4 flex justify-between">
                <div>
                    <p class="text-sm text-gray-700">{{ product.title }}</p>
                    <p class="mt-1 text-sm text-gray-500">{{ product.brand.name }}</p>
                </div>
                <p class="text-sm font-medium text-gray-900">${{ product.price }}</p>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
