<template>
    <Layout>
        <div>
            <DataTable id="myTable" class="display table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in  products " key="product.name">
                        <td><img class="w-[50px] h-[50px]" :src="'/' + product.images[0]" :alt="product.name"></td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.category.name }}</td>
                        <td>{{ product.unit }}</td>
                        <td>

                            <Link class="bg-blue-500 text-white py-2 px-3 rounded"
                                :href="'/dashboard/products/edit/' + product.id">
                            Edit
                            </Link>


                            <Link class="bg-blue-500 text-white py-2 px-3 rounded ml-2" as="button"
                                :href="'/dashboard/products/delete/' + product.id">
                            Delete</Link>


                        </td>
                    </tr>

                </tbody>
            </DataTable>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '../Shared/Layout.vue';
import { Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'

import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);



const props = defineProps({
    products: Object,
})

const products = props.products;



console.log(products);
</script>
