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
                    <Card v-for="item of cardData" :data="item" />
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

    import Card from "../components/card.vue";

    export default {
        data(){
            return {
                cardData: [],
                title: null,
                text: null,
                img: null,
            }
        },
        components: {Card},
        created() {
            axios.get('api/getCardProfile')
            .then(response => this.cardData = response.data) 
                .catch((error) => {
                    console.warn(error)
                })
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