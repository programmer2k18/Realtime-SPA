<template>
   <v-container fluid-grid-list-md>
      <v-layout row wrap>
         <v-flex xs8>
               <Question
                  v-for="question in questions"
                  :key="question.path"
                  :question="question"

               ></Question>
             <hr>
         </v-flex>

         <v-flex xs4>
             <app-sidebar></app-sidebar>
         </v-flex>

      </v-layout>
   </v-container>


</template>

<script>
    import Question from "./Question";
    import AppSidebar from "./AppSidebar";
    export default {
       name: "Forum",

       data(){
         return{
            questions:{}
         }
       },
       created(){
         axios.get('api/question')
                 .then(res => this.questions = res.data)
                 .catch(error=>alert('Something went wrong, Please try again'))
       },
       components: {AppSidebar, Question}
    }
</script>

<style scoped>

</style>