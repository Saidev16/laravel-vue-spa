<template>
    <div  >
        <h2 class="text-center">Products List</h2>
        <div class="row ">

            <div class="input-group float-right mb-3 d-flex justify-content-end mr-4">
                <div class="form-outline">
                    <input type="search" id="form1" class="form-control " placeholder="Search..." v-model="search"
                    @keyup="filterMember"
                     />
                </div>
            </div>

        </div>

        <div class="table-responsive">
        <table class="table ">
            <thead>
            <tr>
                <th>Name</th>
                <th> <select class="form-control  btn-mini " aria-label="Default select example" 
                     v-model="category" v-on:change="filterMember"
                >
                                <option selected value="" >Category</option>
                                <option value="category1">category 1</option>
                                <option value="category2">category 2</option>
                                <option value="category3">category 3</option>
                                <option value="category4">category 4</option>
                            </select></th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in saveData" :key="product.id">
                <!-- <td>{{ product.name }}</td> -->
                <td><router-link :to="{name: 'edit', params: { id: product.id }}" >{{ product.name }}</router-link></td>
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
                category:"",
                saveData : [],
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/products/')
                .then(response => {
                    this.products = response.data;
                    this.saveData = response.data;
                });
        },
         computed: {
            filtredProducts() {
            return this.saveData.filter((product) =>
            {
                console.log('hi')
               return  this.saveData = product.name.match(this.search);

            });

            },
            

            

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


        filterMember: function(evt){
            // console.log(this.search);
            this.saveData = this.products;
            if( this.search ){
                this.saveData.filter((product) =>
            {
                var search = this.search;
                var newData = this.products.filter(function (e){ return e.name == search ;})
                 console.log(newData);

            });

            };

            var val = evt.target.value;

            if (val == '') {
                this.saveData = this.products;

            } else if(val){ 
                this.saveData = this.products.filter(function (e){ return e.category == val;})

            }
        }    
    






        } ,
        
    }
</script>

<style>
.btn-mini {
    width: 120px;
}


</style>