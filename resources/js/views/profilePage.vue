<template>
        <img class="banner" :src="banner"/>
        <div class="profilePage">
            <div class="user">
                <img class="user--picture" :src="person"/>
                <div>
                    <h1>gvfdkljgfdbjkf</h1>
                </div>
            </div>
            <div class="blog">
                <div class="blog__createblog">
                    <img class="blog__createblog--picture" :src="logo"/>
                    <p @click="clickHandler()">schrijf een blog</p>
                    <div class="blog__createblog-container" id="createblogContainer">
                        <label for="title">titel blog:</label><input type="text" name="title" v-model="title">
                        <label for="text">text blog:</label><input type="text" name="text" v-model="text">
                        <label for="img">foto blog:</label>
                        <input type="file" ref="files" name="img" v-on:change="getFile()">
                        <button @click="createBlog()">make blog</button>
                    </div>
                </div>
                <div class="blog__showblog">
                    <div v-for="n in 2" class="blog__showblog-card">
                        <img class="blog__showblog-card--picture" :src="person"/>
                        <h2></h2>
                        <img class="blog__showblog-card--bigpicture" :src="person"/>
                    </div>
                </div>
            </div>
        </div>
</template>

<script setup>
    import banner from "../../assets/luca-bravo-O453M2Liufs-unsplash.jpg";
    import person from "../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg";
    import logo from "../../assets/writing.png";
</script>

<script>

import axios from 'axios'

export default {
    data(){
        return {
            title: null,
            text: null,
            img: null,
        }
    },
    methods: {
        getFile(){
            this.img = this.$refs.files.files[0]
        },
        
        createBlog(){
            axios.post("/api/createBlog", {
                'title': this.title,
                'text': this.text,
            })
            .then(() => {
                console.log(this.img);
                axios.post("/api/createBlogImg", 
                {
                    'img': this.img,
                },
                {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    }
                }
                )
            })
            .then((response) => {
                this.$router.push("/profilePage");
            })
            .catch((error) => {
                console.warn(error);
            })
        },
        clickHandler(){
            document.getElementById("createblogContainer").classList.toggle("blog__createblog-container--show");
        }
    }
}
</script>