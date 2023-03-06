<template>
    <div class="comment">
        <div class="comment__line">
            <img class="comment__pfp" src="../../assets/michael-dam-mEZ3PoFGs_k-unsplash.jpg">
            <input v-model="text" class="comment__input" type="text" name="text" placeholder="schrijf een opmerking..."  @keydown.enter="createComment()">
        </div>
        <div class="comment__line" v-for="item of commentData">
            <img class="comment__pfp" src="../../assets/michael-dam-mEZ3PoFGs_k-unsplash.jpg">
            <div class="comment__text">{{item.text }}</div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "Comment",
        props: {
            data: Object
        },
        data(){
            return {
                commentData: [],
            }
        },
        created() {
            axios.get('api/getComment/' + this.data.id)
            .then(response => this.commentData = response.data) 
            .catch((error) => {
                console.warn(error)
            })
        },
        methods: {
            createComment(){
                axios.post("/api/createComment", {
                    'user_id': 1,
                    'blogpost_id': this.data.id,
                    'text' : this.text,
                })
                .then((response) => {
                    this.$router.push("/home");
                })
                .catch((error) => {
                    console.warn(error);
                })
            }
        }
    }
</script>