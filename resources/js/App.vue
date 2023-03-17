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

export default {
    name: "app",
    data(){
        return {
            user: {},
        }
    },
    created(){
        let user = JSON.parse(sessionStorage.getItem("user"));
        if(user !== null){
            this.user = user;
        }
        else{
            this.$router.push("/");
        }
    }
}
</script>