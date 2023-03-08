<template>
    
    <div class="blog__createblog">
        <img class="blog__createblog--picture" :src="logo"/>
        <input autocomplete="off" type="text" name="text" v-model="text" @click="clickHandler()" placeholder="schrijf een blog">
        <div class="blog__createblog__container" id="createblogContainer">
            <label for="title">titel blog:</label><input type="text" name="title" v-model="title">
            <label for="img">foto blog:</label>
            <input type="file" ref="files" name="img" v-on:change="getFile()">
            <select id="select" @change="addCategory()">
                <option value="" selected hidden>Choose a category</option>
                <template v-for="item of categoryData">
                    <option v-if="!selected.includes(item) ">{{ item.name }}</option>
                </template>
            </select>
            <div>
                <button v-for="item of selected" @click="removeCategory(item.name)">{{ item.name }}</button>
            </div>
            <button @click="createBlog()">make blog</button>
        </div>
    </div>
</template>

<script setup>
import logo from "../../assets/writing.png";
</script>

<script>

import axios from 'axios'

export default {
    data(){
        return {
            categoryData: [],
            title: null,
            text: null,
            img: null,
            select: null,
            selected: [],
        }
    },
    created(){
        axios.get('api/getAllCategory')
        .then(response => {
            this.categoryData = response.data;
        }) 
        .catch((error) => {
            console.warn(error)
        })
    },
    methods:{
        getFile(){
            this.img = this.$refs.files.files[0]
        },
        createBlog(){
            const data = new FormData()
            data.append('title', this.title)
            data.append('text', this.text)
            data.append('img', this.img)

            axios.post("/api/createBlog", data)
            .then((response) => {
                this.addCategoryToBlogpost(response);
                this.clickHandler();
            })
            .catch((error) => {
                console.warn(error);
            })
        },
        addCategoryToBlogpost(blogpost_id){
            axios.post("/api/linkCategoryToBlogpost",{
                'blogpost_id' : blogpost_id,
                'category' : this.selected,
            })
        },
        clickHandler(){
            document.getElementById("createblogContainer").classList.toggle("blog__createblog__container--show");
        },
        addCategory(){
            this.select = document.getElementById("select").value;
            this.selected.push(this.categoryData.find(element => element.name === this.select));
            this.selected.push()
        },
        removeCategory(name){
            this.selected.splice(this.selected.indexOf(this.selected.find(element => element.name === name)), 1);
        }
    }
}
</script>