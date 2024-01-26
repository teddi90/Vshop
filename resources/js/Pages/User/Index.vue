<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";

defineProps({
    products:Array
})
onMounted(() => {
    initFlowbite();
})


</script>

<template>
 <UserLayout>
         <div class="bg-white">
         <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
             <h2 class="text-2xl font-bold tracking-tight text-gray-900">Latest product list</h2>

             <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                 <div v-for="product in products" :key="product.id" class="group relative">
                     <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                         <img v-if="product.product_images.length>0" :src="`/${product.product_images[0].image}`" :alt="product.title" class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
                         <img v-else src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEX////MzMzS0tLKysr5+fnY2Nje3t7b29v19fXHx8fv7+/7+/vm5ubU1NTq6urx8fHErebOAAAFTUlEQVR4nO2cjXKjIBhFRRBEEN//bReIGn/QGmnl28w9s9MdbabmBOQCQaoKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAN+Jef6Sqn4W9bhhw9mT8ObbDVkZw7p/qIqWMuSPXUx/veH3lyEdw6Hr2u2530iyMoaM6fWZoeEBpsTyrKl/QZGEoZHv+LCL81bL/ItRMDS9fmcXf3dAjH9ZfiFSMFSrDgCfS1GtfO9CwNBtejh8LLchHg25FyNg2G87WXZ5PvvdlTJk80G770fG892raLXLvFh5w20l9VIxF+vxqM68WHlDuzPkbTzNty3PPagaisVxXmKUN9zXUu47NnJxnBf75Q33LY2/89qltt71Vz+hvGEyLdbn+pyLETDcVlMtpqSYq21O7BMwjIcLHftOit8oRAqGVb8osjCc2DWvPCP2SRiad987lKBgu+Y1Y6BIwtB30fow/uVcvcJ+K7geNn4GEUNP59wrFcTeLzY/N6FjOCNThuz2QJGeYWKsEbmbGPQMt0kxcTcxyBm6A0HGbiYGOcOjIrw9UKRmmEqKiXuJQcxQnH7vdisxiBkqfSLIbw0UaRkO/Py708PEMMe9OlqGP305fPhW1fEgmZThcFZHI136Dzp+3NCSMjxOion0GEOc3aOUDPdzUnuSsR/mPA7nAQgZmp+LMB37Y4YeNDaEDOWPd2FgP8YYxqI/8KBjaK74ebat5rvo030eOobNsdRpIS6Gk8nIIGM4XF0ntZkfdou6nYwMKoZmNy98yGqguKrbOlVPqRh215e6raYWNx9MIjKoGH60lu+dC3Zrv48MIoZnw8J9Ic6Vsd1NHe/DhIZhYg74lGmguO8j7GfHaRimJxCPGTuhMvW5bCODhOHRBOIxUSPdOm0jg4Th1bCfieuaDzpB21EGBcPuUod0he6Ox1qbUQYBw0tjii31yVhrPYgkYHg8B3zGNgkXrCOjvOHVMcVW4+x3y8gob5hs8jOpF5FR3FB83sxcYOFU3FD9QRGy5Sqj0oaXh4WfMtfT0ob9XxnOkVHY8MoE4k2melrmya7Z8E7YX8VRMDyJ7XzG0XBRw5thf9WwKW94bQ74vqItbdgqJSPqrzCFDZ+B8283ZIXy8NufP/RXleEmHO/DP0TJYoZPAsM/MNRhtexj6OcNhRBGPEiBjTEAAAAAAAAAAAAAAAAgh3FaM/EsYdYGNXQYpmWTu8e3bPIxg/+Pjo/rt3d7X3U6e186EnScvx4WydjmgzYdd6+9LqOhsNJON6SwohKucqqrjJUunG6ljHXZH8vWhLJ3St7eHeQhOm5s3GEvGFpdy3p6KHbQbdWxulHa1k0TFnJb3cjweJBhvVWcNZVgtVQ5G/U8QcdFpcJOZv4+FHE9ejM+HRMNw9uX4ROQ3L92CC2Tq2xYD6Aa/9LwDZq998T+YwRDER4m8IY2PqHWjoUSDF0448JmdW7aq8aXdTT0Pwy3RrQD8RapC++81SoYyri00CwMu2AYX+INTdVa1fsMaZkVQ/y/7nv/j3ZwxrfvS8/5spFxNYrQKcPwwzLp2nC/yrruXfhgaJfei5dh2HnWvnyiWVUlDNupRWqnh9Xu70H0IKNhVYceTF+3pp2WGMz34dLQhKZTMN33jY8Vp60Qtqf9ffbAXyUW2xehGGfKvH/Thd+GxihqSlYz56tnx5yzMsSo45rXxNOimpr6l5dp5wIJiR774zHa/etMFZYfmKkLG6Oi+s4FCb71FMbpg+0yvgERHmYgXzkzOdmaBgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP8V/wDWGTLczR9cDgAAAABJRU5ErkJggg==" :alt="product.title" class="h-full w-full object-cover object-center lg:h-full lg:w-full" />

                     </div>
                     <div class="mt-4 flex justify-between">
                         <div>
                             <h3 class="text-sm text-gray-700">
                                 <a :href="product.href">
                                     <span aria-hidden="true" class="absolute inset-0" />
                                     {{ product.title }}
                                 </a>
                             </h3>
                             <p class="mt-1 text-sm text-gray-500">{{ product.brand.name }}</p>
                         </div>
                         <p class="text-sm font-medium text-gray-900">$ {{ product.price }}</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </UserLayout>
</template>

