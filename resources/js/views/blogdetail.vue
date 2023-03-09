<template>
    <div>{{ this.mainData }}</div>
</template>

<script>
import axios from 'axios'

export default {
    name: "blogdetail",
    data(){
        return {
            blogpost_id : this.$route.params.id,
            mainData : [],
        }
    },
    created(){
        
        axios.get('api/getBlogpost/' + this.blogpost_id)
            .then((response) => {
                this.mainData = response.data
            })
    }
}
</script>

<style scoped>

</style>
