
<template>
        <v-container>
            <v-row justify="space-around">
                <v-card style="width: 100%">
                    <v-card-text>
                        <v-timeline
                                align-top
                                dense
                        >
                            <v-timeline-item small
                            v-for="(reply,index) in this.question.replies"
                            :key="reply.reply_id">

                                <div>
                                    <div class="font-weight-normal">
                                        <strong>{{ reply.author }}</strong> @{{ reply.commented_at }}
                                    </div>

                                    <edit-reply
                                            v-if="editing"
                                            :reply="reply"
                                            :question="question"
                                            :index="index"
                                    ></edit-reply>
                                    <div v-else>{{ reply.body }}</div>

                                </div>

                                <div v-if="!editing">
                                    <v-btn icon @click="likeReply(reply)">
                                        {{reply.likes}}
                                        <v-icon>mdi-heart</v-icon>
                                    </v-btn>

                                    <v-btn  @click="editReply(reply.reply_id,index)"
                                            icon v-if="checkAuthorization(reply.user_id)"
                                    >
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-btn>

                                    <v-btn  @click="deleteReply(reply.reply_id,index)"
                                            icon v-if="checkAuthorization(reply.user_id)">
                                        <v-icon>mdi-delete</v-icon>
                                    </v-btn>
                                </div>

                            </v-timeline-item>

                        </v-timeline>
                    </v-card-text>
                </v-card>
            </v-row>
        </v-container>
</template>

<script>

    import EditReply from "./editReply";
    export default {

        name: "reply",
        components: {EditReply},
        props:['question'],
        data(){
            return{
                editing:false,
                liked:false,
                count:0
            }
        },
        created(){
            EventBus.$on('UpdatedSuccessfully',()=>{this.editing = false});
            EventBus.$on('cancelReply',()=>{this.editing = false});
        },
        methods:{
            checkAuthorization(user_id){
                return User.ownsTheQuestion(user_id);
            },
            deleteReply(reply_id, index){
                axios.delete('/api/'+this.question.path+'/reply/'+reply_id)
                    .then(res => {
                        if(res.status == 200)
                            this.question.replies.splice(index,1);
                    })
                    .catch(error => alert('Something went wrong, please try again..'))
            },
            editReply(reply_id, index){
                this.editing = true;
            },
            likeReply(reply){
                if (User.loggedIn()){
                    if (reply.liked)
                        this.liked = true;
                    this.liked ? this.dislike(reply):this.like(reply);
                }
            },
            like(reply){
                axios.post('/api/like/'+reply.reply_id)
                     .then(res => {
                         this.liked = true;
                         reply.likes++;
                     })
                     .catch(error => alert('something went wrong'));
            },
            dislike(reply){
                axios.delete('/api/unlike/'+reply.reply_id)
                    .then(res => {
                        this.liked = false;
                        reply.likes--;
                    })
                    .catch(error => alert('something went wrong'));
            }
        }
    }
</script>
