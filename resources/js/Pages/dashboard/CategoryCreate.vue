<template>
    <div>
        <Layout>
            <form @submit.prevent="submit">

                <div class="product-data flex flex-wrap gap-3 w-[80%]">
                    <div class="basis[300px] flex-grow  ">
                        <label for="product-name" class="block text-sm font-medium leading-6 text-gray-900">Category
                            Name</label>
                        <div class="mt-2">
                            <input id="name" name="name" type="text" required v-model="form.name"
                                class="block w-full rounded-md border-2 outline-none py-1.5 px-2 text-gray-900   placeholder:text-gray-400 focus:ring-2  focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <button
                    class="mt-4 flex  justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    type="submit">Add Category</button>
            </form>
        </Layout>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '../Shared/Layout.vue';
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"
import { usePage } from '@inertiajs/vue3'



const form = useForm({
    name: null,
})

const page = usePage();

function submit() {
    form.post('/dashboard/categories', {
        onSuccess() {
            Toastify({
                text: page.props.flash.msg ??= props.msg,
                className: "bg-blue-500",
            }).showToast();
        }
    })
}



</script>
