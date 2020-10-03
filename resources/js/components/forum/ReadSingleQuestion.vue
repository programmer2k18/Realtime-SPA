<template>

    <v-card>

        <v-container fluid>

            <v-card-title primary-title>
                <div>
                    <h3 class="headline mb-0">
                        {{question.title}}
                    </h3>

                    <div class="grey--text">
                        {{question.author}} at
                        {{question.created_at}}
                    </div>
                </div>
                <v-spacer></v-spacer>
                <v-btn color="blue">{{Object.keys(this.question.replies).length}} Replies</v-btn>
            </v-card-title>

            <v-card-text>

                <div> {{question.body}}</div>
            </v-card-text>

            <v-card-actions v-if="OwnerOfQuestion">

                <router-link :to="question.path" icon style="text-decoration:none">
                    <v-icon color="blue">mdi-pencil</v-icon>
                </router-link>

                <v-btn icon small @click="deleteQuestion">
                    <v-icon  color="red">mdi-delete</v-icon>
                </v-btn>

            </v-card-actions>

            <create-reply
            :question="question"
            ></create-reply>

            <reply
                   :question="question"
                   :key="question.title">
            </reply>

        </v-container>

    </v-card>


</template>

<script>
    import Reply from "../replies/reply";
    import CreateReply from "../replies/createReply";
    export default {
        name: "ReadSingleQuestion",
        components: {CreateReply, Reply},
        data(){
            return{
                question:{},
                OwnerOfQuestion:null
            }
        },

        created() {

            axios.get('/api/question/'+this.$route.params.slug)
                .then(res => {
                    this.question = res.data;
                    this.OwnerOfQuestion = User.ownsTheQuestion(this.question.user_id)
                })
                .catch(error=>alert('Something went wrong, Please try again'))

        },
        methods:{

            deleteQuestion(){
                axios.delete('/api/question/'+this.question.path.split('/')[1])
                     .then(res => this.$router.push({name:'forum'}))
                     .catch(error => alert('Something went wrong'))
            }
        }
    }
</script>

<style scoped>

</style>