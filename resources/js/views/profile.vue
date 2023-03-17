<template>
    <div class="profile">
        <img class="profile__banner" :src="banner"/>
        <div class="profile__container">
            <div class="profile__menu profile__menu--left">
                <img class="profile__user--picture" :src="person"/>
                <div class="profile__container--userdata">
                    <p class="profile__user--name">{{ userData.name }}</p>
                    <p class="profile__user--username">{{ userData.username }}</p>
                    <p class="profile__user--description">{{ userData.description }}</p>
                    <followersCount v-if="userData.length !== 0" :userData="userData" :user="user"/>
                </div>
                
            </div>
            <div class="profile__blog">
                <div>
                    <blogcreate/>
                </div>
                <div class="profile__blog--showblog">
                    <Card v-for="item of cardData" :data="item" :user="user"/>
                </div>
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

    import Card from "../components/card/Card.vue";
    import blogcreate from "../components/blog/Create.vue";
    import followersCount from "../components/blog/Followers-count.vue";
    export default {
        name: 'profile',
        props: ["user"],
        data(){
            return {
                user_id : this.$route.params.id,
                cardData: [],
                userData: [],
            }
        },
        components: {Card,blogcreate,followersCount},
        async created() {
            await axios.get('/api/getProfileCards/' + this.user_id)
                .then(response =>{
                    this.cardData = response.data
                })
                .catch((error) => {
                    console.warn(error)
                });
            await axios.get('/api/getUserData/' + this.user_id)
                .then(response => {
                    this.userData = response.data
                }) 
                .catch((error) => {
                    console.warn(error)
                });
        },
    }
</script>