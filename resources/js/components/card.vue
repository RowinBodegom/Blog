<template>
    <div class="card">
        <div class="card__container">
            <div class="card__container--left">
                <img class="card__pfp" src="/storage/blogImage/standard_pfp.png">
                <div class="card__username">@{{item.user_id.name}}</div>
            </div>
            <div v-if="this.user.id === item.user_id.id" class="card__container--right">
                <img @click="showEditBlog(item.id)" class="card__write" src="../../assets/draw.png">
                <img @click="deleteBlog(item.id)" class="card__bin" src="../../assets/bin.png">
                <div class="card__time">{{item.madedate}}</div>
            </div>
        </div>
        <div :id="'update' + item.id" class="card__update">
            <blogUpdate :data="item"/>
            <button class="card__update__button" @click="hideEditBlog(item.id)">Annuleren</button>
        </div>
        <img v-if="item.img === null" class="card__banner" src="/storage/blogImage/standard.png">
        <img v-else class="card__banner" :src="'/storage/blogImage/'+item.img">
        <div class="card__description">
            <p class="card__title">{{item.title}}</p>
            <p class="card__text">{{item.text}}</p>
            <button class="card__button card__button--detail" @click="sendToPost(item.id)">Lees verder</button>
            <div class="comment__container">
                <Comment :data="item.id"/>
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
            data: Object,
            user: {
                default: {},
                type: Object,
            },
        },
        data(){
            return {
                showUpdateBlog: false,
                title: null,
                text: null,
                img: null,
                item: this.data,
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
            sendToPost($id){
                this.$router.push({name:"blogdetail", params: {id: $id}});
            },
            showEditBlog(data){
                if(this.showUpdateBlog == false){
                    document.getElementById("update" + data).classList.toggle("card__update--show");
                    this.showUpdateBlog = true
                }
            },
            hideEditBlog(data){
                if(this.showUpdateBlog == true){
                    document.getElementById("update" + data).classList.toggle("card__update--show");
                    this.showUpdateBlog = false
                }
            },
            reloadData(){
                axios.get("/api/reloadBlogData/" + this.item.id)
                .then((response) => {
                    this.item = response.data;
                    this.hideEditBlog(this.item.id);
                })
                .catch((error) => {
                    console.warn(error);
                })
            },

        }
    }
</script>
