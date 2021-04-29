
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-5">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Category</h5>
                        <router-link :to="{name:'CreateCategory'}" class="btn btn-success btn-sm">Add Category</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(category, i) in categories" :key="category.id">
                                    <td>{{ i+1 }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.slug }}</td>
                                    <td>
                                        <router-link :to="{name:'EditCategory', params:{id:category.id}}" class="btn btn-success btn-sm">Edit</router-link>
                                        <a @click.prevent="deleteCategory(category)" href="" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                categories: [],
            }
        },
        methods: {
            loadCategories(){
                axios.get('/api/category').then(response =>[
                    this.categories = response.data
                ]);
            },
            deleteCategory(category){
                axios.delete(`/api/category/${category.id}`).then(()=>{
                    this.$toast.success({
                        title:'Success',
                        message:'Category Deleted successfully!!'
                    })
                });
                let index = this.categories.indexOf(category);
                this.categories.splice(index, 1);
            }
        },
        mounted(){
            this.loadCategories(); 
        }
    }
</script>