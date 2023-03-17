<template>
    <div class="card">
        <div class="card__container">
            <div class="card__container--left">
                <img class="card__pfp" src="/storage/blogImage/standard_pfp.png">
                <router-link :to='"/profile/"+ item.user_id.id' class="card__username">@{{item.user_id.name}}</router-link>
            </div>

            <div v-if="user.userID == item.user_id.id" class="card__container--right">
                <img @click="showEditBlog(item.id)" class="card__write" src="../../../assets/draw.png">
                <img @click="deleteBlog(item.id)" class="card__bin" src="../../../assets/bin.png">
                <div class="card__time">{{item.madedate}}</div>
            </div>
        </div>
        <div v-if="user.userID == item.user_id.id" :id="'update' + item.id" class="card__update">
            <blogUpdate :data="item"/>
            <button class="card__update__button" @click="hideEditBlog(item.id)">Annuleren</button>
        </div>
        <img v-if="item.img === null" class="card__banner" src="/storage/blogImage/standard.png">
        <img v-else class="card__banner" :src="'/storage/blogImage/'+item.img">
        <div class="card__description">
            <p class="card__title">{{item.title}}</p>
            <p class="card__text">{{item.text}}</p>
            <div class="card__container--button">
                <button class="card__button card__button--detail" @click="sendToPost(item.id)">Lees verder</button>
                <button v-if="totalComments != 0" class="card__button card__button--commentTotal">{{ totalComments }} reacties</button>
            </div>
            <div class="comment__container">
                <Comment :data="[item.id, 'limited']"/>
            </div>
        </div>
    </div>
</template>
    <script>
    import Comment from "../blog/Comment.vue";
    import blogUpdate from "../blog/Update.vue";

    import axios from 'axios'
    export default {
        name: "card",
        // componets that we use in this template
        components: {Comment,blogUpdate},
        // props are paramater given by the parent
        props: {
            data: Object,
            user: {
                default: {},
                type: Object,
            },
        },
        // data presets
        data(){
            return {
                showUpdateBlog: false,
                title: null,
                text: null,
                img: null,
                totalComments: null,
                item: this.data,
            }
        },
        created(){
            axios.get("/api/getCommentTotal/" + this.item.id)
                .then((response) => {
                    this.totalComments = response.data;
                })
                .catch((error) => {
                    console.warn(error);
                })
        },
        methods: {
            // getFile gets the file form a input when input changes
            getFiles(){
                this.img = this.$refs.files.files[0]
            },
            // deleteblog axios post sends id to delete data
            deleteBlog(data){
                axios.post("/api/deleteBlog/" + data)
                .then((response) => {
                    window.location.reload();
                })
                .catch((error) => {
                    console.warn(error);
                })
            },
            // sendToPost when called pushes the user to the view thats been given
            sendToPost($id){
                this.$router.push({name:"blogdetail", params: {id: $id}});
            },
            // showEditBlog when called shows the blogEdit features
            showEditBlog(data){
                if(this.showUpdateBlog == false){
                    document.getElementById("update" + data).classList.toggle("card__update--show");
                    this.showUpdateBlog = true
                }
            },
            // showEditBlog when called hides the blogEdit features
            hideEditBlog(data){
                if(this.showUpdateBlog == true){
                    document.getElementById("update" + data).classList.toggle("card__update--show");
                    this.showUpdateBlog = false
                }
            },
            // goToProfile when called pushes the user to the view thats been given
            goToProfile($id){
                this.$router.get({name:"profile", params: {id: $id}});
            },
            // reloadData axios get when called rewrites the old data with the new oness
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
