<template>
    <Header/>
    <router-view v-bind:user="user"></router-view>
    <Footer/>
</template>

<script setup>
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
</script>

<script>
import axios from 'axios'

export default {
    name: "app",
    data(){
        return {
            user: [],
        }
    },
    created(){
        let userID = localStorage.getItem("userID");
        let token = localStorage.getItem("token");
        if(userID !== null && token !== null){
            axios.post('api/getUser', {
                'id': userID,
                'token': token,
            })
            .then(response => this.user = response.data)
            .catch((error) => {
                console.warn(error)
            })
        }
    }
}
</script>