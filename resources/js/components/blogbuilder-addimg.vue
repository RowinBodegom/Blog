<template>
    <div class="blogbuilder-addtext">
        <div>
            <select class="createblog__select" id="select" @change="changeImgType()">
                <option class="createblog__option" value="" hidden>kies een format</option>
                <template v-for="item of formatArray">
                    <option class="createblog__option">{{ item }}</option>
                </template>
            </select>
        </div>
        <div>
            <input type="file" ref="files" name="img" v-on:change="getFiles()"/>
        </div>
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
            formatArray: [
                'normal',
                'slideshow'
            ],
            type: "img",
            position: null,
            display_type: null,
            img: [],
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
        getFiles(){
            this.img.push(this.$refs.files.files[0]);
            console.log(this.img);
        },
        changeImgType(){
            this.display_type = document.getElementById("select").value;
            console.log(this.display_type);
        },
    }
}
</script>