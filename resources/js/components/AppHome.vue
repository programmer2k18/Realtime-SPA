<template>

    <v-app>
           <div>

               <Toolbar></Toolbar>
               <router-view></router-view>
               <app-footer></app-footer>

           </div>
    </v-app>

</template>

<script>

    import Toolbar from "./Toolbar";
    import AppFooter from "./AppFooter";
    import Login from "./login/login";

    export default {
        name: "AppHome",
        components: {Login, AppFooter, Toolbar}
    }

</script>

<style scoped>

</style>