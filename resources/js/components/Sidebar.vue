<template>
    <div class="flex flex-col w-[200px] h-screen  bg-blue-600 p-4">
        <div class="logo">
            <h1 class="text-white text-3xl ">Pos.</h1>
        </div>
        <div class="flex flex-col  mt-5 space-y-5">
            <Link href="/dashboard" class="text-white"><font-awesome-icon icon="fa-solid fa-house" class="mr-2 " />
            Dashboard</Link>

            <div className="dropdown dropdown-right  ">
                <label tabIndex={0} class="m-1 cursor-pointer  block text-white"><font-awesome-icon
                        icon="fa-solid fa-book-bookmark" class="mr-2" />Product</label>
                <ul tabIndex={0} class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <Link href="/dashboard/products">Products</Link>
                    </li>
                    <li>
                        <Link href="/dashboard/products-create">Create Product</Link>
                    </li>
                    <li>
                        <Link href="/dashboard/categories">Categories</Link>
                    </li>
                </ul>
            </div>
            <div className="dropdown dropdown-right  ">
                <label tabIndex={0} class="m-1 cursor-pointer  block text-white"><font-awesome-icon
                        icon="fa-solid fa-book-bookmark" class="mr-2" />Sales</label>
                <ul tabIndex={0} class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <Link href="/dashboard/invoices">Invoices</Link>
                    </li>
                    <li>
                        <Link href="/dashboard/create-invoice">Create Invoice</Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

</script>

<style lang="scss" scoped></style>