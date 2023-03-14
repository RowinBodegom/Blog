<template>
    <Header v-bind:user="user"/>
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
            user: {},
        }
    },
    created(){
        let person = JSON.parse(sessionStorage.getItem("user"));
        if(person !== null){
            this.user = person;
        }
        else{
            this.$router.push("/");
        }
    }
}
</script>