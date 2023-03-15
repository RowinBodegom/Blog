<template>
    <div class="createblog">
        <div id="createblog__container--1" class="createblog__container">
            <div class="createblog__container--title">
                <label class="createblog__lable createblog__lable--title" for="title">Titel:</label>
                <input class="createblog__input--title" type="text" name="title" v-model="title">
            </div>
        </div>
        <div class="createblog__container--text">
            <img class="createblog__picture" :src="logo"/>
            <textarea class="createblog__input--text" autocomplete="off" type="text" name="text" v-model="text" @click="showCreate()" placeholder="schrijf een blog"></textarea> 
        </div>
        <div id="createblog__container--2" class="createblog__container">
            <div>
                <div class="createblog__container--file">
                <label class="createblog__lable createblog__lable--file" for="img">Foto:</label>
                <input class="createblog__button createblog__button--file" type="file" ref="files" name="img" v-on:change="getFile()">
            </div>
            <div class="createblog__container--select">
                <select class="createblog__select" id="select" @change="addCategory()">
                    <option class="createblog__option" value="" selected hidden>Choose a category</option>
                    <template v-for="item of categoryData">
                        <option class="createblog__option" v-if="!selected.includes(item) ">{{ item.name }}</option>
                    </template>
                </select>
                <div class="createblog__container--categorybuttons">
                    <button class="createblog__button createblog__button--category createblog__hover--orange" v-for="item of selected" @click="removeCategory(item.name)">{{ item.name }}</button>
                </div>
            </div>
            </div>
            
            <button class="createblog__button createblog__button--submit createblog__hover--orange" @click="createBlog()">maak blog</button>
            <button class="createblog__button createblog__button--cancel createblog__hover--orange" @click="hideCreate()">Annuleren</button>
        </div>
    </div>
</template>

<script setup>
import logo from "../../../assets/writing.png";
</script>

<script>

import axios from 'axios'

export default {
    data(){
        return {
            showCreateBlog : false,
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
            console.log(this.$refs.files.files[0]);
            this.img = this.$refs.files.files[0];
        },
        createBlog(){
            const data = new FormData()
            
            data.append('title', this.title)
            data.append('text', this.text)
            data.append('img', this.img)

            axios.post("/api/createBlog", data)
            .then((response) => {
                this.addCategoryToBlogpost(response);
                this.hideCreate();
                this.title = null;
                this.text = null;
                this.img = null;
                this.select = null;
                this.selected = [];
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
        showCreate(){
            if(this.showCreateBlog == false){
                document.getElementById("createblog__container--1").classList.toggle("createblog__container--show");
                document.getElementById("createblog__container--2").classList.toggle("createblog__container--show");  
                this.showCreateBlog = true
            }
        },
        hideCreate(){
            if(this.showCreateBlog == true){
                document.getElementById("createblog__container--1").classList.toggle("createblog__container--show");
                document.getElementById("createblog__container--2").classList.toggle("createblog__container--show");  
                this.showCreateBlog = false
                this.title = null;
                this.text = null;
                this.img = null;
                this.select = null;
                this.selected = [];
            }
        },
        addCategory(){
            this.select = document.getElementById("select").value;
            this.selected.push(this.categoryData.find(element => element.name === this.select));
            this.selected.push()
        },
        removeCategory(name){
            this.selected.splice(this.selected.indexOf(this.selected.find(element => element.name === name)), 1);
        },
    }
}
</script>