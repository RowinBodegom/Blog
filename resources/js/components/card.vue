<template>
    <div class="card">
        <div class="card__container">
            <div class="card__container--left">
                <img class="card__pfp" src="../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg">
                <div class="card__username">@{{data.userID.name}}</div>
            </div>
            <div class="card__container--right">
                <img @click="editBlog(data.id)" class="card__write" src="../../assets/draw.png">
                <img class="card__bin" src="../../assets/bin.png">
                <div class="card__time">{{data.madedate}}</div>
            </div>
        </div>
        <div :id="'update' + data.id" class="card__update">
            <label for="">titel: </label><input type="text"><br>
            <label for="">text: </label><input type="text"><br>
            <label for="">foto: </label><input type="file"><br>
            <button>update</button>
        </div>
        <img v-if="data.img === null" class="card__banner" src="../../../storage/app/public/blogImage/standard.png">
        <img v-else class="card__banner" src="storage/app/public/blogImage/{{$data.img}}">
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
        methods: {
            deleteBlog(data){
                axios.post("/api/deleteBlog/" + data)
                .then((response) => {
                    window.location.reload();
                })
                .catch((error) => {
                    console.warn(error);
                })
            },
            editBlog(data){
                document.getElementById("update" + data).classList.toggle("card__update--show");
            }
        }
    }
</script>