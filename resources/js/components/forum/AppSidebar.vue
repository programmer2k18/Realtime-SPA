<template>
    <v-card class="ml-2">
        <v-toolbar color="cyan" dark dense class="mt-2">
            <v-toolbar-title>
                Categories
            </v-toolbar-title>
        </v-toolbar>

        <v-row justify="space-around">
            <v-col
                    cols="12"
                    sm="12"
            >
                <v-sheet
                        elevation="10"
                        class="pa-4"
                >
                    <v-chip-group
                            column
                            active-class="primary--text"
                    >
                        <v-chip
                                v-for="category in categories"
                                :key="category.id"
                        >
                            {{ category.name }}
                        </v-chip>
                    </v-chip-group>
                </v-sheet>
            </v-col>
        </v-row>

    </v-card>
</template>

<script>
    export default {
        name: "AppSidebar",
        data(){
          return{
              categories:{}
          }
        },
        created(){
            axios.get('/api/category')
                .then(res => this.categories = res.data)
                .catch(error => alert('Something went wrong..'))
        }
    }
</script>

<style scoped>

</style>