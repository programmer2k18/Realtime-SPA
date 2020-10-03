<template>
    <div>
        <ValidationObserver ref="observer" v-slot="{ validate, reset }">
            <form>

                <ValidationProvider v-slot="{ errors }" name="body" rules="required">
                    <v-text-field
                            v-model="body"
                            :error-messages="errors"
                            label="Description"
                            type="textarea"
                            required
                    ></v-text-field>
                </ValidationProvider>

                <v-btn class="mr-4" @click="updateReply" color="green">Save</v-btn>
                <v-btn @click="cancel">Cancel</v-btn>
            </form>
        </ValidationObserver>
    </div>
</template>

<script>
    import { required,max } from 'vee-validate/dist/rules'
    import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
    setInteractionMode('eager')

    extend('required', {
        ...required,
        message: '{_field_} can not be empty',
    });

    extend('max', {
        ...max,
        message: '{_field_} may not be greater than {length} characters',
    });

    export default {
        name: "editReply",
        components: {
            ValidationProvider,
            ValidationObserver,
        },
        props:['reply','question','index'],
        data(){
            return {
                body:''
            }
        },
        created(){
            this.body = this.reply.body;
        },
        methods:{
            updateReply(){

                let Data = {'body':this.body}
                axios.patch('/api/'+this.question.path+'/reply/'+this.reply.reply_id,Data)
                    .then(res => {
                        if(res.status == 200) {
                            this.question.replies[this.index].body = res.data.body;
                            EventBus.$emit('UpdatedSuccessfully');
                        }
                    })
                    .catch(error => this.errors = error.response.data.error)
            },
            cancel(){
                EventBus.$emit('cancelReply');
            }
        }
    }
</script>

<style scoped>

</style>