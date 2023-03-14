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
                <img @click="showSub()" class="header__person--foto" :src="person"/>
                <nav class="header__submenubar" id="subMenu">
                    <ul>
                        <li @click="logout()">logout</li>
                        <li>your account</li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</template>

<script setup>
    import logo from "../../assets/writing-wit.png";
    import person from "/storage/blogImage/standard_pfp.png";
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
                    console.log("gfjklghdjghgjgdfgnclkbhfg");
                    document.getElementById("subMenu").classList.remove("header__submenubar--show");
                    localStorage.clear();
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