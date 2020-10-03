<template>
    <v-container>
        <ValidationObserver ref="observer" v-slot="{ validate, reset }">
            <form>

                <ValidationProvider v-slot="{ errors }" name="body" rules="required">
                    <v-text-field
                            v-model="body"
                            :error-messages="errors"
                            label="Provide a comment here..."
                            type="textarea"
                            required
                    ></v-text-field>
                </ValidationProvider>


                <v-btn class="mr-4" @click="create" color="green">Comment</v-btn>
                <v-btn @click="clear">Clear</v-btn>
            </form>
        </ValidationObserver>
    </v-container>

</template>

<script>

    import { required, max } from 'vee-validate/dist/rules'
    import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
    import axios from 'axios';

    setInteractionMode('eager');

    extend('required', {
        ...required,
        message: '{_field_} can not be empty',
    });

    extend('max', {
        ...max,
        message: '{_field_} may not be greater than {length} characters',
    });


    export default {
        components: {
            ValidationProvider,
            ValidationObserver,
        },
        name: "createReply",
        props:['question'],
        data(){
            return{
                body:''
            }
        },
        methods:{
            create(){
                let data = {body:this.body,user_id:User.userData(),question_id:this.question.id};
                axios.post('/api/'+this.question.path+'/reply',data)
                     .then(res =>{
                         this.clear();
                         this.question.replies.unshift(res.data);
                     })
                     .catch(error => alert('Something went wrong'))
            },
            clear(){
                this.body=null;
            }
        }
    }
</script>
