<template>
    <div class="comment">
        <div class="comment__line" v-for="item of commentData">
            <img class="comment__pfp" src="/storage/blogImage/standard_pfp.png">
            <div class="comment__text">{{ item.text }}</div>
        </div>
        <div class="comment__line">
            <img class="comment__pfp" src="/storage/blogImage/standard_pfp.png">
            <input v-model='text' class="comment__input" type="text" name="text" placeholder="schrijf een opmerking..."  @keydown.enter="createComment()">
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    
    export default {
        name: "Comment",
        props: {
            data: Number
        },
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
            getComment() {
                axios.get('/api/getComment/' + this.data)
                .then(response => {
                    this.commentData = response.data;
                    console.log(this.commentData);
                }) 
                
                .catch((error) => {
                    console.warn(error)
                })
            },
            createComment(){
                axios.post("/api/createComment", {
                    'user_id': 1,
                    'blogpost_id': this.data,
                    'text' : this.text,
                })
                .then((response) => {
                    this.getComment();
                    this.text = null;
                })
                .catch((error) => {
                    console.warn(error);
                })
            }
        }
    }
</script>