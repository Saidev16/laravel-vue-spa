<template>
    <div  >
        <h2 class="text-center">Products List</h2>
        <div class="row ">

            <div class="input-group float-right mb-3 d-flex justify-content-end mr-4">
                <div class="form-outline">
                    <input type="search" id="form1" class="form-control " placeholder="Search..." v-model="search" />
                </div>
            </div>

        </div>

        <div class="table-responsive">
        <table class="table ">
            <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in filtredProducts" :key="product.id">
                <td>{{ product.name }}</td>
                <td>{{ product.category }}</td>
                <td>{{ product.quantity }}</td>
                <td> <a v-bind:href="'/ProductStatus/'+ product.id"  ><button class="btn btn-primary">{{ product.status }} </button></a>  </td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                products: [],
                search : "",
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/products/')
                .then(response => {
                    this.products = response.data;
                });
        },
         computed: {
            filtredProducts() {
            return this.products.filter((product) =>
            {
                return product.name.match(this.search)
            });

                }
        },
        methods: {
            deleteProduct(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/products/${id}`)
                    .then(response => {
                        let i = this.products.map(data => data.id).indexOf(id);
                        this.products.splice(i, 1)
                    });
            },
              // Add computed section:
        computed: {
            filtredProducts() {
            return this.products.filter((product) =>
            {
                return product.name.match(this.search)
            });

                }
        }

        } 
        
    }
</script>