<template>
    <div class="profile">
        <img class="profile__banner" :src="banner"/>
        <div class="profile__container">
            <div class="profile__menu profile__menu--left">
                <img class="profile__user--picture" :src="person"/>
                <div class="profile__container--userdata">
                    <div class="profile__user--name">{{ this.name }}</div> 
                    <div class="profile__user--username">@{{ this.userData.username }}</div>
                    <div class="profile__user--description">{{ this.userData.description }}</div>
                    <followersCount/>
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

    import Card from "../components/card.vue";
    import blogcreate from "../components/blog-create.vue";
    import followersCount from "../components/followers-count.vue";
    export default {
        name: 'profile',
        props: ["user"],
        data(){
            return {
                user_id : this.$route.params.id,
                cardData: [],
                userData: [],
                name: '',
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
                    this.name = this.userData.name.toUpperCase();
                }) 
                    .catch((error) => {
                        console.warn(error)
                    });
        },
    }
</script>