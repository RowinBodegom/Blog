<template>
    
    <div class="blog__createblog">
        <img class="blog__createblog--picture" :src="logo"/>
        <input autocomplete="off" type="text" name="text" v-model="text" @click="clickHandler()" placeholder="schrijf een blog">
        <div class="blog__createblog__container" id="createblogContainer">
            <label for="title">titel blog:</label><input type="text" name="title" v-model="title">
            <label for="img">foto blog:</label>
            <input type="file" ref="files" name="img" v-on:change="getFile()">
            <button @click="createBlog()">make blog</button>
        </div>
    </div>
</template>

<script setup>
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
            const data = new FormData()
            data.append('title', this.title)
            data.append('text', this.text)
            data.append('img', this.img)

            axios.post("/api/createBlog", data)
            .then((response) => {
                this.clickHandler();
            })
            .catch((error) => {
                console.warn(error);
            })
        },
        clickHandler(){
            document.getElementById("createblogContainer").classList.toggle("blog__createblog__container--show");
        }
    }
}
</script>