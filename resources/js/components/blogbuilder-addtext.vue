<template>
    <div class="blogbuilder--addtext">
        <input class="blogbuilder--addtext__input--title" type="text" name="title" v-model="title" placeholder="titel">
    </div>
    <div class="blogbuilder--addtext">
        <textarea class="blogbuilder--addtext__input--text" autocomplete="off" type="text" name="text" v-model="text" placeholder="schrijf een paragraaf"></textarea> 
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "blogbuilder-addimg",
    props: {
        data: Number,
    },
    data(){
        return {
            blog_ID: this.data,
            type: "text",
            position: null,
            title: null,
            text: null,
        }
    },
    created(){
        axios.get("/api/getLengthBlogpostDetails/" + this.blog_ID)
        .then((response) => {
            this.position = response.data;
            console.log(this.position);
        })
        .catch((error) => {
            console.warn(error);
        })
    }
}
</script>