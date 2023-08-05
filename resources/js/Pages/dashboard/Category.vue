<template>
    <Layout>
        <DeleteModal @deleteProduct="deleteMe(categoryId)" @hideModal="hideModal" :showModal="showModal" />
        <div>
            <DataTable id="myTable" class="display table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in  categories " :key="category.name">
                        <td>{{ category.name }}</td>
                        <td>{{ category.id }}</td>
                        <td>
                            <Link class="bg-blue-500 text-white py-2 px-3 rounded"
                                :href="'/dashboard/products/categories/' + category.id + '/edit'">
                            Edit
                            </Link>


                            <button @click=" passCategoryIdAndShowModal(category.id)"
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

const categoryId = ref(null);
const showModal = ref(false);


const props = defineProps({
    categories: Object,
})

// const products = props.products;
const page = usePage();


function passCategoryIdAndShowModal(id) {
    categoryId.value = id;
    showModal.value = true
}

function hideModal() {
    showModal.value = false
}

function deleteMe(id) {
    router.delete('/dashboard/products/categories/' + id, {

        onSuccess() {
            showModal.value = false
            router.visit('/dashboard/products/categories')
            Toastify({
                text: page.props.flash.msg ??= props.msg,
                className: "bg-blue-500",
            }).showToast();
        }
    })
}


// console.log(products);
</script>
