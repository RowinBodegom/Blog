


<template>
    <div class="card">
        <div class="card__container">
            <div class="card__container--left">
                <img class="card__pfp" src="../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg">
                <div class="card__username">@{{data.userID.name}}</div>
            </div>
            <div class="card__container--right">
                <img @click="showEditBlog(data.id)" class="card__write" src="../../assets/draw.png">
                <img @click="deleteBlog(data.id)" class="card__bin" src="../../assets/bin.png">
                <div class="card__time">{{data.madedate}}</div>
            </div>
        </div>
        <div :id="'update' + data.id" class="card__update">
            <label for="titel">titel: </label><input type="text" v-model="title"><br>
            <label for="text">text: </label><input type="text" v-model="text"><br>
            <label for="img">foto: </label><input type="file" ref="files" name="img" v-on:change="getFiles()"><br>
            <button @click="editBlog(data.id)">update</button>
        </div>
        <img v-if="data.img === null" class="card__banner" src="/storage/blogImage/standard.png">
        <img v-else class="card__banner" :src="'/storage/blogImage/'+data.img">
        <div class="card__description">
            <p class="card__title">{{data.title}}</p>
            <p class="card__text">{{data.text}}</p>
            <button class="card__button card__button--detail">Lees verder</button>
        </div>
        {{data.id}}
    </div>
</template>


<script>

    import axios from 'axios'

    export default {
        name: "card",
        props: {
            data: Object
        },
        data(){
            return {
                title: null,
                text: null,
                img: null,
            }
        },
        methods: {
            getFiles(){
                this.img = this.$refs.files.files[0]
            },
            deleteBlog(data){
                axios.post("/api/deleteBlog/" + data)
                .then((response) => {
                    window.location.reload();
                })
                .catch((error) => {
                    console.warn(error);
                })
            },
            editBlog(id){
                const data = new FormData()
                data.append('title', this.title)
                data.append('text', this.text)
                data.append('img', this.img)
                data.append('id', id)

                axios.post("/api/editBlog", data)
                .then((response) => {
                    window.location.reload();
                })
                .catch((error) => {
                    console.warn(error);
                })
            },
            showEditBlog(data){
                document.getElementById("update" + data).classList.toggle("card__update--show");
            }
        }
    }
</script>