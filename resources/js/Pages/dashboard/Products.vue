<template>
    <Layout>
        <DeleteModal @deleteProduct="deleteMe(productId)" @hideModal="hideModal" :showModal="showModal" />
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
                                :href="'/dashboard/products/' + product.id + '/edit'">
                            Edit
                            </Link>


                            <button @click="passproductIdAndShowModal(product.id)"
                                class="bg-blue-500 text-white py-2 px-3 rounded ml-2">Delete</button>


                        </td>
                    </tr>

                </tbody>
            </DataTable>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '../Shared/Layout.vue';
import DeleteModal from '../../components/DeleteModal.vue';
import { Link, router, usePage } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);

const productId = ref(null);
const showModal = ref(false);


const props = defineProps({
    products: Object,
    msg: Object,
})

const products = props.products;
const page = usePage();


function passproductIdAndShowModal(id) {
    productId.value = id;
    showModal.value = true
}

function hideModal() {
    showModal.value = false
}

function deleteMe(id) {
    router.delete('/dashboard/products/' + id, {

        onSuccess() {
            showModal.value = false
            router.visit('/dashboard/products')
            Toastify({
                text: page.props.flash.msg ??= props.msg,
                className: "bg-blue-500",
            }).showToast();
        }
    })
}


console.log(products);
</script>
