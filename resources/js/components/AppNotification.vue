<template>

    <div class="text-center">
        <v-menu bottum offset-y>

            <template v-slot:activator="{ on, attrs }">
                <v-btn
                        icon
                        dark
                        v-bind="attrs"
                        v-on="on"
                >
                    <v-icon color="red">mdi-bell</v-icon>

                </v-btn>
            </template>

            <v-list>
                <v-list-item v-for="(notification,index) in unread"
                             :key="notification.id">

                    <router-link :to="notification.data.path">
                        <v-list-item-title style="color: darkgray"
                                           @click="markAsRead(notification,index)">
                            {{notification.data.reply_body}}
                        </v-list-item-title>
                    </router-link>

                </v-list-item>

                <v-divider></v-divider>

                <v-list-item v-for="notification in read"
                             :key="notification.id">
                    <router-link :to="notification.data.path">
                        <v-list-item-title>
                                {{notification.data.reply_body}}
                        </v-list-item-title>
                    </router-link>
                </v-list-item>

            </v-list>

        </v-menu>
    </div>

</template>

<script>
    export default {
        name: "AppNotification",
        data(){
            return{
                read:{},
                unread:{},
                unreadCount:0
            }
        },
        created(){
            if (User.loggedIn())
                this.getNotifications();
        },
        methods:{
            getNotifications(){
                axios.get('/api/notifications')
                    .then(res =>{
                        this.read = res.data.read;
                        this.unread = res.data.unread;
                        this.unreadCount = res.data.unread.length;
                    })
                    .catch(error => alert('Something went wrong'))
            },
            markAsRead(notification,index){
                axios.put('/api/notification/markAsRead',{id:notification.id})
                    .then(res =>{
                        this.read.push(notification);
                        this.unread.splice(index,1);
                        this.unreadCount--;
                    })
                    .catch(error => alert('Something went wrong'))
            },
        }
    }
</script>

<style scoped>

</style>