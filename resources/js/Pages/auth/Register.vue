<template>
    <div class="">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                    alt="Your Company">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create to your
                    account</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" @submit.prevent="submit">
                    <div>
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                        <div class="mt-2">
                            <input id="name" name="name" type="text" autocomplete="name" required v-model="form.name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="text-sm text-red-600" v-if="errors.name">{{ errors.name }}</div>

                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" required v-model="form.email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="text-sm text-red-600" v-if="errors.email">{{ errors.email }}</div>

                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>

                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                v-model="form.password"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="text-sm text-red-600" v-if="errors.password">{{ errors.password }}</div>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                            Up</button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Not a member?
                    <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Start a 14 day free
                        trial</a>
                </p>
            </div>
        </div>

    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"
import { router } from '@inertiajs/vue3'

import { ref } from 'vue'

const props = defineProps({
    errors: Object,
    msg: String,
})


const form = useForm({
    name: null,
    email: null,
    password: null,
})

function submit() {
    form.post('/register', {

        onSuccess: () => {
            Toastify({
                text: props.msg,
                className: "bg-blue-500",
                callback: () => {
                    router.visit('/login');
                }
            }).showToast();
        }
    })
}


</script>
