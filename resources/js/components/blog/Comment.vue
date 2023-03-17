<template>
    <div class="comment">
        <div class="comment__line" v-for="item of commentData">
            <img class="comment__pfp" src="/storage/blogImage/standard_pfp.png">
            <div class="comment__text">{{ item.text }}</div>
            <img @click="deleteComment(item.id)" class="comment__bin" src="../../../assets/bin.png">
        </div>
        <div class="comment__line" v-if="commentData.length < 3 || data[1] == 'unlimited'">
            <img class="comment__pfp" src="/storage/blogImage/standard_pfp.png">
            <input v-model='text' class="comment__input" type="text" name="text" placeholder="schrijf een opmerking..."  @keydown.enter="createComment()">
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    
    export default {
        name: "Comment",
        // props are paramater given by the parent
        props: {
            data: Array,
        },
        // data presets
        data(){
            return {
                commentData: [],
                text: null,
            }
        }, 
        created() {
            this.getComment();
        },
        methods: {
            // getComment axios get to fill the page data with comments
            getComment() {
                axios.get('/api/getComment/' + this.data[0] + '/' + this.data[1])
                .then(response => {
                    this.commentData = response.data;
                })
                .catch((error) => {
                    console.warn(error)
                })
            },
            // createComment axios post request to save a comment into the database
            createComment(){
                axios.post("/api/createComment", {
                    'user_id': 1,
                    'blogpost_id': this.data[0],
                    'text' : this.text,
                })
                .then((response) => {
                    this.getComment();
                    this.text = null;
                })
                .catch((error) => {
                    console.warn(error);
                })
            },
            //  deleteComment axios post for deleting a comment
            deleteComment(id){
                axios.post("/api/deleteComment", {
                    'comment_id': id,
                })
                .then((response) => {
                    window.location.reload();
                })
                .catch((error) => {
                    console.warn(error);
                })
            }
        }
    }
</script>