<template>
    <header class="header">
        <div class="header__logo">
            <img class="header__logo--foto" :src="logo"/>
            <p class="header__logo--text">BLOG.</p>
        </div>
        <div class="header__bars">
            <nav class="header__navbar">
                <ul class="header__menubar">
                    <li><a class="header__link" href="/home">Home</a></li>
                    <li><a class="header__link" href="">Ontdek</a></li>
                    <li><a class="header__link" href="">Volgend</a></li>
                    <li><a class="header__link" href="">Categorieën</a></li>
                    <li><a class="header__link" href="">Top posts</a></li>
                </ul>
            </nav>
            <div class="header__subnavigationbar">
                <img v-if="defaultPic" @click="showSub()" class="header__person--foto" :src="'/storage/profilePicture/'+user.profile_picture" alt="waddap"/>
                <img v-else @click="showSub()" class="header__person--foto"  :src="'/storage/profilePicture/standard_pfp.png'" alt="hoi"/>
                <nav class="header__submenubar" id="subMenu">
                    <ul>
                        <li @click="logout()">logout</li>
                        <li><a href="/updateUser">your account</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</template>

<script setup>
    import logo from "../../assets/writing-wit.png";
</script>

<script>

import axios from 'axios';
export default {
    props: {
        user: {
            default: null,
            type: Object,
        },
    },
    data(){
        return{
            defaultPic: true,
        }
    },
    created(){
        if(sessionStorage.getItem("user") === null || this.user.profile_picture === null){
            this.defaultPic = false;
        }
    },
    methods: {
        logout(){
                axios.get("/api/logout/" + this.user.id)
                .then((response) => {
                    document.getElementById("subMenu").classList.remove("header__submenubar--show");
                    sessionStorage.clear();
                    this.$router.push("/");
                })
                .catch((error) => {
                    console.warn(error);
                })
            },
        showSub(){
            document.getElementById("subMenu").classList.toggle("header__submenubar--show");
        },

    }
}
</script>