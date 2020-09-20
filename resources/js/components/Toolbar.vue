<template>
    <v-card
            color="grey lighten-4"
            flat
            height="200px"
            tile
    >
        <v-toolbar dense>

            <v-app-bar-nav-icon></v-app-bar-nav-icon>
            <v-toolbar-title>SPA</v-toolbar-title>
            <v-spacer></v-spacer>

            <div class="hidden-sm-and-down">

                <router-link to="/forum">
                    <v-btn text>Forum</v-btn>
                </router-link>

                <v-btn text>Ask Question</v-btn>

                <v-btn text>Category</v-btn>

                <router-link to="/login">
                    <v-btn text>Login</v-btn>
                </router-link>

            </div>

        </v-toolbar>
    </v-card>
</template>

<script>
    export default {
        name: "Toolbar"
    }
</script>

<style scoped>

</style>