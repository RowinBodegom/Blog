<template>
    <div class="card">
        <div class="card__container">
            <div class="card__container--left">
                <img class="card__pfp" src="/storage/blogImage/standard_pfp.png">
                <div class="card__username">@{{data.user_id.name}}</div>
            </div>
            <div class="card__container--right">
                <img @click="showEditBlog(data.id)" class="card__write" src="../../assets/draw.png">
                <img @click="deleteBlog(data.id)" class="card__bin" src="../../assets/bin.png">
                <div class="card__time">{{data.madedate}}</div>
            </div>
        </div>
        <blogUpdate :data="data"/>
        <img v-if="data.img === null" class="card__banner" src="/storage/blogImage/standard.png">
        <img v-else class="card__banner" :src="'/storage/blogImage/'+data.img">
        <div class="card__description">
            <p class="card__title">{{data.title}}</p>
            <p class="card__text">{{data.text}}</p>
            <button class="card__button card__button--detail">Lees verder</button> 
            <div class="comment__container">
                <Comment :data="data"/>
            </div>
        </div>
    </div>
</template>
    <script>
    import Comment from "../components/comment.vue";
    import blogUpdate from "../components/blog-update.vue";

    import axios from 'axios'
    export default {
        name: "card",
        components: {Comment,blogUpdate},
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
            showEditBlog(data){
                document.getElementById("update" + data).classList.toggle("card__update--show");
            }
        }
    }
</script>
