<template>
        <img class="banner" :src="banner"/>
        <div class="profile">
            <div class="user">
                <img class="user--picture" :src="person"/>
                <div>
                    <h1>gvfdkljgfdbjkf</h1>
                </div>
            </div>
            <div class="blog">
                <blogcreate/>
                <div class="blog__showblog">
                    <Card v-for="item of cardData" :data="item" />
                </div>
           </div>
        </div>
</template>

<script setup>
    
    import banner from "../../assets/luca-bravo-O453M2Liufs-unsplash.jpg";
    import person from "/storage/blogImage/standard_pfp.png";
    import logo from "../../assets/writing.png";
</script>

<script>

    import axios from 'axios'

    import Card from "../components/card.vue";
    import blogcreate from "../components/blog-create.vue";
    export default {
        data(){
            return {
                cardData: [],
            }
        },
        props: ["user"],
        components: {Card,blogcreate},
        created() {
            axios.get('/api/getCardProfile')
            .then(response => this.cardData = response.data) 
                .catch((error) => {
                    console.warn(error)
                })
        }
    }
</script>