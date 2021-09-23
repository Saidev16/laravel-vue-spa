<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" :class="{'is-invalid': validationStatus($v.name)}" class="form-control" v-model="product.name" v-model.trim='$v.name.$model'>
                        <div v-if="!$v.name.required" class="invalid-feedback">The name field is required.</div>
                        <div v-if="!$v.name.minLength" class="invalid-feedback">The min length is 2 characters.</div>
                        <div v-if="!$v.name.minLength" class="invalid-feedback">The max length is 25 characters.</div>

                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <!-- <input type="text" class="form-control" v-model="product.category"> -->
                        <select :class="{'is-invalid': validationStatus($v.category)}" class="form-control mt-3" aria-label="Default select example" v-model="product.category" v-model.trim='$v.category.$model'>
                                <option selected>Open this select menu</option>
                                <option value="category1">category 1</option>
                                <option value="category2">category 2</option>
                                <option value="category3">category 3</option>
                                <option value="category4">category 4</option>
                        </select>
                        <div v-if="!$v.category.required" class="invalid-feedback">The name field is required.</div>


                    </div>
                    <div>
                        <label>Quantity</label>
                        <input type="text" :class="{'is-invalid': validationStatus($v.quantity)}" class="form-control" v-model="product.quantity" v-model.trim='$v.quantity.$model'>
                        <div v-if="!$v.quantity.required" class="invalid-feedback">The name field is required.</div>
                        <div v-if="!$v.quantity.numeric" class="invalid-feedback">this field should be a number</div>

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
import { required, minLength, maxLength,numeric } from 'vuelidate/lib/validators'

    export default {
        data() {
            return {
                product: {},
                name:'',
                category:'',
                quantity:''
            }
        },
        validations: {
        name: {required,minLength: minLength(2), maxLength: maxLength(24)},
        category: {required},
        quantity: {required,numeric},
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
            },
            submit: function() {

            this.$v.$touch();
            if (this.$v.$pendding || this.$v.$error) return;

            alert('Data Submit');
        },

        validationStatus: function(validation) {
            return typeof validation != "undefined" ? validation.$error : false;
        }


        }
    }
</script>