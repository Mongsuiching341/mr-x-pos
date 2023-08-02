<template>
    <div>
        <Layout>
            <form @submit.prevent="submit">

                <div class="product-data flex flex-wrap gap-3 w-[80%]">
                    <div class="basis[300px] flex-grow  ">
                        <label for="product-name" class="block text-sm font-medium leading-6 text-gray-900">Product
                            Name</label>
                        <div class="mt-2">
                            <input id="name" name="name" type="text" required v-model="form.name"
                                class="block w-full rounded-md border-2 outline-none py-1.5 px-2 text-gray-900   placeholder:text-gray-400 focus:ring-2  focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="basis[300px] flex-grow ">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Product
                            Price</label>
                        <div class="mt-2">
                            <input v-model="form.price" id="price" name="price" type="text" required
                                class="block w-full rounded-md border-2 outline-none py-1.5 px-2 text-gray-900   placeholder:text-gray-400 focus:ring-2  focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class=" basis[300px] flex-grow ">
                        <label for="unit" class="block text-sm font-medium leading-6 text-gray-900">Unit</label>
                        <div class="mt-2">
                            <input v-model="form.unit" id="unit" name="unit" type="text" required
                                class="block w-full rounded-md border-2 outline-none py-1.5 px-2 text-gray-900   placeholder:text-gray-400 focus:ring-2  focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class=" basis[300px] flex-grow ">
                        <label for="unit" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                        <div class="mt-2">
                            <select v-model="form.category_id" name="category_id"
                                class="block w-full rounded-md border-2 outline-none py-1.5 px-2 text-gray-900    focus:ring-2  focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option disabled selected>What is the best TV show?</option>
                                <option v-for="category in categories" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class=" w-full">
                        <label for="description"
                            class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea v-model="form.description"
                                class="block w-full rounded-md border-2 outline-none py-1.5 px-2 text-gray-900   focus:ring-2  focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                name="description"></textarea>

                        </div>
                    </div>
                </div>
                <div class="w-[40%] mt-3">
                    <label for="product-images" class="block text-sm font-medium leading-6 text-gray-900">Upload product
                        image</label>
                    <input @input="changeImg" class="bg-blue-100" type="file" name="images" id="product-images" multiple>
                    <div class="preview w-full mt-4 p-4 rounded flex">
                        <li class=" list-none" v-for="img in  urls ">
                            <img class="w-[100px] h-[100px]" :src="img" alt="">
                        </li>
                    </div>
                </div>


                <button
                    class="flex  justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    type="submit">Add Product</button>
            </form>
        </Layout>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '../Shared/Layout.vue';
import { ref } from 'vue';
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"
import { usePage } from '@inertiajs/vue3'


const props = defineProps({
    categories: Object,
    msg: String,
})

const previewImg = ref([])
const urls = ref([])

function changeImg(event) {
    if (event.target.files[0]) {

        previewImg.value.push(event.target.files[0]);

        const file = event.target.files[0];
        const url = URL.createObjectURL(file);

        urls.value.push(url);

        form.images = previewImg.value;

    }
}

const form = useForm({
    name: null,
    price: null,
    unit: null,
    description: null,
    category_id: null,
    images: null,
})

const page = usePage()

function submit() {
    form.post('/dashboard/products-create', {
        onSuccess: () => {
            Toastify({
                text: page.props.flash.msg ??= props.msg,
                className: "bg-blue-500",
            }).showToast();
        }
    })
}

</script>
