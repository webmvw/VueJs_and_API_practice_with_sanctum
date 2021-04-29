
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Create Category</h5>
                        <router-link :to="{name:'CategoryList'}" class="btn btn-success btn-sm">Category List</router-link>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="createCategory">
                                  <div class="mb-3">
                                    <label for="name" class="form-label">Category Name</label>

                                    <input v-model="categoryform.name" type="text" class="form-control" id="name" :class="{ 'is-invalid': categoryform.errors.has('name') }">
                                    <has-error :form="categoryform" field="name"></has-error>
                                   </div> 
                                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Form, HasError, AlertError } from 'vform'
    export default {
        data(){
            return{
                categoryform: new Form({
                    name: '',
                }), 
            }
        },
        methods:{
            createCategory(){
                this.categoryform.post('/api/category').then(({ data }) => {
                    this.categoryform.name = '';
                    this.$toast.success({
                        title:'Success',
                        message:'Category created successfully!!'
                    })
                });
            }
        }
    }
</script>