<template>
    <v-container>

        <div class="row">

            <div class="col-sm-6">
                <ValidationObserver ref="observer" v-slot="{ validate, reset }">
                    <form>

                        <ValidationProvider v-slot="{ errors }" name="name" rules="required">
                            <v-text-field
                                    v-model="name"
                                    :error-messages="errors"
                                    label="Category Name"
                                    type="text"
                                    required
                            ></v-text-field>
                        </ValidationProvider>

                        <v-btn class="mr-4" @click="update" color="green" v-if="editSlug">Save Changes</v-btn>
                        <v-btn class="mr-4" @click="create" color="green" v-else>Create Category</v-btn>
                        <v-btn @click="clear">Cancel</v-btn>
                    </form>
                </ValidationObserver>
            </div>

            <div class="col-sm-6">
                <v-card class="ml-2">

                    <v-toolbar color="cyan" dark dense class="mt-2">
                        <v-toolbar-title>
                            Categories
                        </v-toolbar-title>
                    </v-toolbar>

                    <v-list>
                        <v-list-item-group color="primary">
                            <v-list-item
                                    v-for="(category,index) in categories"
                                    :key="category.id"
                            >

                                <v-list-item-content>
                                    <v-list-item-title v-text="category.name"></v-list-item-title>
                                </v-list-item-content>

                                <v-btn @click="edit(index)" class="mr-2" color="blue">Edit</v-btn>
                                <v-btn @click="deleteCategory(category,index)" color="red">Delete</v-btn>
                            </v-list-item>

                        </v-list-item-group>

                    </v-list>
                </v-card>
            </div>


        </div>

    </v-container>
</template>

<script>
    import { required, email, max } from 'vee-validate/dist/rules'
    import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
    import axios from 'axios';
    setInteractionMode('eager')

    extend('required', {
        ...required,
        message: '{_field_} can not be empty',
    });

    export default {
        components: {
            ValidationProvider,
            ValidationObserver,
        },
        data: () => ({
            name: '',
            categories:{},
            editSlug:null,
            editIndex:null,
            errors:{}
        }),

        created(){
            axios.get('/api/category')
                .then(res => this.categories = res.data)
                .catch(error => alert('Something went wrong..'))
        },

        methods: {

            create () {
                this.$refs.observer.validate();
                let categoryData = {'name':this.name};
                axios.post('/api/category',categoryData)
                    .then(res => {
                        this.clear();
                        this.categories.unshift(res.data);
                    })
                    .catch(error => this.errors = error.response.data.error)
            },

            deleteCategory(category,index){

                axios.delete('/api/'+category.slug)
                    .then(res => {
                        if(res.status == 200)
                            this.categories.splice(index,1);
                    })
                    .catch(error => this.errors = error.response.data.error)
            },

            edit(index){
                this.name = this.categories[index].name;
                this.editSlug = this.categories[index].slug;
                this.editIndex = index;

            },
            update(){
                axios.patch('/api/'+this.editSlug, {name:this.name})
                    .then(res => {
                        if(res.status == 200) {
                            this.categories[this.editIndex].name = res.data.name;
                            this.categories[this.editIndex].slug = res.data.slug;
                            this.editSlug=null;
                            this.name=null;
                        }
                    })
                    .catch(error => this.errors = error.response.data.error)
            },

            clear () {
                this.name = null;
            },
        },
    }
</script>