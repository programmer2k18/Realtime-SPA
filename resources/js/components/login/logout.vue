<template>
    
</template>

<script>
    export default {
        name: "logout",
        created() {
            EventBus.$emit('logout')
        }
    }
</script>

<style scoped>

</style>