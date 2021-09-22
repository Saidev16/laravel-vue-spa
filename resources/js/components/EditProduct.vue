<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <!-- <input type="text" class="form-control" v-model="product.category"> -->
                        <select class="form-control mt-3" aria-label="Default select example" v-model="product.category">
                                <option selected>Open this select menu</option>
                                <option value="category1">category 1</option>
                                <option value="category2">category 2</option>
                                <option value="category3">category 3</option>
                                <option value="category4">category 4</option>
                        </select>
                    </div>
                    <div>
                        <label>Quantity</label>
                        <input type="text" class="form-control" v-model="product.quantity">
                    </div>
                        <div class="form-group">
                            <label >Status</label>
                            <select class="form-control mt-3" aria-label="Default select example" v-model="product.status">
                                <option selected>Open this select menu</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                product: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/products/${this.$route.params.id}`)
                .then((res) => {
                    this.product = res.data;
                });
        },
        methods: {
            updateProduct() {
                this.axios
                    .patch(`http://localhost:8000/api/products/${this.$route.params.id}`, this.product)
                    .then((res) => {
                        this.$router.push({ name: 'home' });
                    });
            }
        }
    }
</script>