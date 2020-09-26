<template>

    <v-card>

        <v-card-title primary-title>
           <div>
               <h3 class="headline mb-0">
                   <router-link :to="question.path">
                       {{question.title}}
                   </router-link>
               </h3>

               <div class="grey--text">
                   {{question.author}} at
                   {{question.created_at}}
               </div>
           </div>

        </v-card-title>

        <v-card-text>
            <div> {{question.body}}</div>
        </v-card-text>
        <v-spacer></v-spacer>
    </v-card>


</template>

<script>
    export default {
        props:['question'],
        name: "Question"
    }
</script>

<style scoped>

</style>