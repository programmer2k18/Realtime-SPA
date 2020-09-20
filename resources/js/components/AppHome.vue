<template>

    <v-app>
           <div>
               <Toolbar></Toolbar>
               <app-footer></app-footer>
           </div>
    </v-app>

</template>

<script>

    import Toolbar from "./Toolbar";
    import AppFooter from "./AppFooter";

    export default {
        name: "AppHome",
        components: {AppFooter, Toolbar}
    }

</script>

<style scoped>

</style>