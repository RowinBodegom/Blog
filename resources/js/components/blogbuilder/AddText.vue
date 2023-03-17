<template>
    <div>
        <button id="toggleTitle" @click="toggleTitle()">title toevoegen</button>
    </div>
    <div v-if="this.type === 'met'" class="blogbuilder--addtext">
        <input class="blogdetail__input__text blogdetail__input__text--title" type="text" name="title" v-model="title" placeholder="titel">
    </div>
    <div class="blogbuilder--addtext">
        <textarea class="blogdetail__input__text blogdetail__input__text--textarea" autocomplete="off" type="text" name="text" v-model="text" placeholder="schrijf een paragraaf"></textarea> 
    </div>
    <button class="blogdetail__input__button blogdetail__input__button--submit" @click="submit()">text toevoegen</button>
</template>

<script>
import axios from 'axios'

export default {
    name: "blogbuilder-addimg",
    // props are paramater given by the parent
    props: {
        data: Number,
    },
    // data presets
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
        // toggleTitle changes the type of the row to include a title or not
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
        // submit axios post creates a row with text
        submit(){
            const data = new FormData()

            data.append('blogpost_id', this.blog_ID)
            data.append('type', this.type)
            data.append('position', this.position)
            
            axios.post("/api/blogbuilder/createElement", data)
            .then((response) => {
                const text = new FormData();

                text.append('blogdetail_id', response.data);
                text.append('title', this.title);
                text.append('text', this.text);
                
                axios.post("/api/blogbuilder/createElement/text", text)
                window.location.reload();
            })
        }
    }
}
</script>