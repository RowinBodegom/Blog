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
                <img v-if="user.profile_picture !== null" @click="showSub()" class="header__person--foto" :src="'/storage/profilePicture/'+user.profile_picture"/>
                <img v-else @click="showSub()" class="header__person--foto"  :src="'/storage/profilePicture/standard_pfp.png'"/>
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