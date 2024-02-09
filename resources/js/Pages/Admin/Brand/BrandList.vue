<script setup>
import {router} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import Swal from "sweetalert2";

defineProps({
    brands:Array
});

const dialogVisible = ref(false);
const editMode = ref(false);
const addMode = ref(false);
const brandId=ref('');
const brandName=ref('');
const brandSlug=ref('');

watch(dialogVisible,(curr)=>{
    if(!curr){
        brandId.value='';
        brandName.value='';
        brandSlug.value='';
    }
})
const showAddModal = () => {
    dialogVisible.value = true;
    addMode.value=true;
    editMode.value=false;
}
const showEditModal = (brand) => {
    dialogVisible.value = true;
    addMode.value=false;
    editMode.value=true;

    brandId.value=brand.id
    brandName.value=brand.name;
    brandSlug.value=brand.slug;
}

const addBrand = async () => {
   try {
       await router.post(route('admin.brands.store', {"name":brandName.value, "slug":brandSlug.value}, {
           onSuccess:page=>{
               Swal.fire({
                   toast:true,
                   icon:'success',
                   position:'top-end',
                   timer: 2000,
                   showConfirmButton:false,
                   title:page.props.flash.success
               });
               dialogVisible.value=false;
               addMode.value=false;
           },
       }));
   } catch (err){
       console.log(err);
   }
};
const updateBrand=async()=>{
    try {
        await router.put(`/admin/brands/update/${brandId.value}`,{"name":brandName.value, "slug":brandSlug.value},{
            onSuccess:(page)=>{
                Swal.fire({
                    toast:true,
                    icon:'success',
                    position:'top-end',
                    timer: 2000,
                    showConfirmButton:false,
                    title:page.props.flash.success
                });
                dialogVisible.value=false;
                editMode.value=false;
            }
        });
    }catch (err){
        console.log(err);
    }


}
const  deleteBrand=(id)=>{
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(result=>{
        if(result.isConfirmed){
            try {
                router.delete(`/admin/brands/destroy/${id}`,{
                    onSuccess:(page)=>{
                        Swal.fire({
                            toast:true,
                            icon:'success',
                            timer: 2000,
                            position:'top-end',
                            showConfirmButton:false,
                            title:page.props.flash.success
                        })
                    }
                });
            }catch (err){
                console.log(err);
            }

        }
    });
}
</script>

<template>
    <el-dialog
        v-model="dialogVisible"
        :title="editMode? 'Edit brand': 'Add new brand'"
        width="500"
    >
        <form @submit.prevent="editMode ? updateBrand() : addBrand()" class="p-4 md:p-5">
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input v-model="brandName" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type brand name" required="">
                </div>
                <div class="col-span-2">
                    <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                    <input v-model="brandSlug" type="text" name="slug" id="slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type slug" required="">
                </div>

            </div>
            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                {{editMode ? 'Update Brand':'Add Brand'}}
            </button>
        </form>
    </el-dialog>

    <div class="flex justify-end">
        <button @click="showAddModal()" class="mb-4 flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1">
                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
            </svg>
             new Brand
        </button>
    </div>



<!--    Table of brands-->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Brand name
                </th>
                <th scope="col" class="px-6 py-3 mr-6 flex justify-end">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="brand in brands" :key="brand.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{brand.name}}
                </th>
                <td class="px-6 py-4 flex justify-end">
                    <button @click="showEditModal(brand)" class="mr-6 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                    <button @click="deleteBrand(brand.id)" class="font-medium text-red-700 dark:text-blue-500 hover:underline">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</template>
