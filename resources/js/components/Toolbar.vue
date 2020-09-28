<template>
    <v-card
            color="grey lighten-4"
            flat
            tile
    >
        <v-toolbar dense>

            <v-app-bar-nav-icon></v-app-bar-nav-icon>
            <v-toolbar-title>SPA</v-toolbar-title>
            <v-spacer></v-spacer>

            <div class="hidden-sm-and-down">


                <router-link
                   v-for="item in items"
                   v-if="item.show"
                   :key="item.title"
                   :to="item.to"
                    >
                    <v-btn text>{{item.title}}</v-btn>
                </router-link>
            </div>

        </v-toolbar>
    </v-card>
</template>

<script>
    export default {
        name: "Toolbar",
        data(){
            return{
                items:[
                    {title:'Forum',to:'/forum',show:true},
                    {title:'Ask Question', to:'/ask', show:User.loggedIn()},
                    {title:'Category', to:'/Category/Create', show:User.loggedIn()},
                    {title:'Login', to:'/login', show: !User.loggedIn()},
                    {title:'Logout', to:'/logout', show: User.loggedIn()},
                ]
            }
        },
        created() {
            EventBus.$on('logout',()=>{
                User.logout()
            })
        }
    }
</script>

<style scoped>

</style>