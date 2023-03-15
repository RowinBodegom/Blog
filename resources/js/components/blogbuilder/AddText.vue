<template>
    <div>
        <button id="toggleTitle" @click="toggleTitle()">title toevoegen</button>
    </div>
    <div v-if="this.type === 'met'" class="blogbuilder--addtext">
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
            type: "zonder",
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
    },
    methods: {
        toggleTitle(){
            if(this.type === "zonder"){
                this.type = "met";
                const button = document.getElementById("toggleTitle");
                button.innerHTML = "title weghalen";
            } else {
                this.type = "zonder";
                document.getElementById("toggleTitle").innerHTML = "title toevoegen";
            }
        },
    }
}
</script>