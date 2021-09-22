<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" v-model="product.category">
                    </div>
                    <div>
                        <label>Quantity</label>
                        <input type="text" class="form-control" v-model="product.quantity">
                    </div>
                        <div class="form-group">
                            <label >Status</label>
                            <select class="form-control" aria-label="Default select example" v-model="product.status">
                                <option selected>Open this select menu</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    
                    <button type="submit" class="btn btn-primary">Create</button>
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
        methods: {
            addProduct() {
                this.axios
                    .post('http://localhost:8000/api/products', this.product)
                    .then(response => (
                        this.$router.push({ name: 'home' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>