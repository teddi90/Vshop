<script setup>
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";
import {router} from "@inertiajs/vue3";
import Swal from "sweetalert2";
import {ref} from "vue";

const props= defineProps({
    product:Object
});


const currentImg=ref(props.product.product_images[0]?.image);
const setCurrentImg = (inx) => {
    currentImg.value=props.product.product_images[inx].image;
}
const addToCart=(product)=>{
    router.post(`/cart/store/${product.id}`, product, {
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
    <UserLayout>
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-24 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <div class="flex flex-wrap w-1/2">

                        <div class="relative md:p-2 p-1 w-full mb-3 h-[400px]">
                            <img v-if="currentImg" :alt="product.title" class=" absolute inset-0 w-full h-full object-cover object-center block rounded" :src="`/${currentImg}`">
                            <img v-else  :alt="product.title" class="w-full h-full object-cover object-center block rounded"  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEX////MzMzS0tLKysr5+fnY2Nje3t7b29v19fXHx8fv7+/7+/vm5ubU1NTq6urx8fHErebOAAAFTUlEQVR4nO2cjXKjIBhFRRBEEN//bReIGn/QGmnl28w9s9MdbabmBOQCQaoKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAN+Jef6Sqn4W9bhhw9mT8ObbDVkZw7p/qIqWMuSPXUx/veH3lyEdw6Hr2u2530iyMoaM6fWZoeEBpsTyrKl/QZGEoZHv+LCL81bL/ItRMDS9fmcXf3dAjH9ZfiFSMFSrDgCfS1GtfO9CwNBtejh8LLchHg25FyNg2G87WXZ5PvvdlTJk80G770fG892raLXLvFh5w20l9VIxF+vxqM68WHlDuzPkbTzNty3PPagaisVxXmKUN9zXUu47NnJxnBf75Q33LY2/89qltt71Vz+hvGEyLdbn+pyLETDcVlMtpqSYq21O7BMwjIcLHftOit8oRAqGVb8osjCc2DWvPCP2SRiad987lKBgu+Y1Y6BIwtB30fow/uVcvcJ+K7geNn4GEUNP59wrFcTeLzY/N6FjOCNThuz2QJGeYWKsEbmbGPQMt0kxcTcxyBm6A0HGbiYGOcOjIrw9UKRmmEqKiXuJQcxQnH7vdisxiBkqfSLIbw0UaRkO/Py708PEMMe9OlqGP305fPhW1fEgmZThcFZHI136Dzp+3NCSMjxOion0GEOc3aOUDPdzUnuSsR/mPA7nAQgZmp+LMB37Y4YeNDaEDOWPd2FgP8YYxqI/8KBjaK74ebat5rvo030eOobNsdRpIS6Gk8nIIGM4XF0ntZkfdou6nYwMKoZmNy98yGqguKrbOlVPqRh215e6raYWNx9MIjKoGH60lu+dC3Zrv48MIoZnw8J9Ic6Vsd1NHe/DhIZhYg74lGmguO8j7GfHaRimJxCPGTuhMvW5bCODhOHRBOIxUSPdOm0jg4Th1bCfieuaDzpB21EGBcPuUod0he6Ox1qbUQYBw0tjii31yVhrPYgkYHg8B3zGNgkXrCOjvOHVMcVW4+x3y8gob5hs8jOpF5FR3FB83sxcYOFU3FD9QRGy5Sqj0oaXh4WfMtfT0ob9XxnOkVHY8MoE4k2melrmya7Z8E7YX8VRMDyJ7XzG0XBRw5thf9WwKW94bQ74vqItbdgqJSPqrzCFDZ+B8283ZIXy8NufP/RXleEmHO/DP0TJYoZPAsM/MNRhtexj6OcNhRBGPEiBjTEAAAAAAAAAAAAAAAAgh3FaM/EsYdYGNXQYpmWTu8e3bPIxg/+Pjo/rt3d7X3U6e186EnScvx4WydjmgzYdd6+9LqOhsNJON6SwohKucqqrjJUunG6ljHXZH8vWhLJ3St7eHeQhOm5s3GEvGFpdy3p6KHbQbdWxulHa1k0TFnJb3cjweJBhvVWcNZVgtVQ5G/U8QcdFpcJOZv4+FHE9ejM+HRMNw9uX4ROQ3L92CC2Tq2xYD6Aa/9LwDZq998T+YwRDER4m8IY2PqHWjoUSDF0448JmdW7aq8aXdTT0Pwy3RrQD8RapC++81SoYyri00CwMu2AYX+INTdVa1fsMaZkVQ/y/7nv/j3ZwxrfvS8/5spFxNYrQKcPwwzLp2nC/yrruXfhgaJfei5dh2HnWvnyiWVUlDNupRWqnh9Xu70H0IKNhVYceTF+3pp2WGMz34dLQhKZTMN33jY8Vp60Qtqf9ffbAXyUW2xehGGfKvH/Thd+GxihqSlYz56tnx5yzMsSo45rXxNOimpr6l5dp5wIJiR774zHa/etMFZYfmKkLG6Oi+s4FCb71FMbpg+0yvgERHmYgXzkzOdmaBgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP8V/wDWGTLczR9cDgAAAABJRU5ErkJggg==">

                        </div>
                        <template v-if="product.product_images.length>1">
                            <div v-for="(img,inx) in product.product_images" class="  pr-3 last:pr-0 sm:w-1/2 lg:w-1/3">
                                <div class="h-[100px] relative after:content-[''] after:bg-black after:opacity-60 after:z-1 after:absolute after:left-0 after:top-0 after:h-[100%] after:w-[100%] "
                                    :class="{ 'relative border-2 border-gray-800  rounded': currentImg===img.image, 'after:hidden':currentImg!==img.image}">
                                <img @click="setCurrentImg(inx)"
                                    :alt="product.title" class="w-full h-full object-cover object-center block rounded" :src="`/${img.image}`">
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{product.brand.name}}</h2>
                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{product.title}}</h1>
                        <h3 class="text-xs title-font text-gray-500 tracking-widest">{{product.category.name}}</h3>

                        <p v-if="product.description" class="leading-relaxed">{{product.description}}</p>
                        <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                            <div class="flex">
                                <span class="mr-3">Quantity: {{product.quantity}}</span>
                            </div>
                        </div>
                        <div class="flex">
                            <span class="title-font font-medium text-2xl text-gray-900">${{product.price}}</span>
                            <button @click="addToCart(product)" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </UserLayout>
</template>
<style>

</style>



