<template>
    <div class="blogdetail">
        <div class="blogdetail__banner">
            <img v-if="mainData.img === null" class="blogdetail__banner--img" src="/storage/blogImage/standard.png">
            <img v-else class="blogdetail__banner--img" :src="'/storage/blogImage/'+mainData.img">
        </div>
        <div class="blogdetail__container blogdetail__container--main">
            <div class="blogdetail__menu--left">
                <div class="blogdetail__test">
                <div class="blogdetail__container--img" v-if="mainData.length != 0">
                        <img class="blogdetail__pfp" v-if="mainData.user_id.profile_picture === null" src="/storage/blogImage/standard_pfp.png">
                        <img class="blogdetail__pfp" v-else :src="'/storage/blogImage/'+mainData.user_id.profile_picture" >
                    </div>
                    <div class="blogdetail__container--smallcard">
                        <div class="blogdetail__cardtitle">Meer van deze blogger</div>
                        <smallCard :data="smallCardData"/>
                    </div> 
                </div>
                
            </div>
            <div class="blogdetail__menu--right">
                <div class="blogdetail__mode blogdetail__mode--edit" v-if="mode === 'edit'">
                    je kan nu de pagina bewerken
                </div>
                <div class="blogdetail__mode blogdetail__mode--delete" v-else-if="mode === 'delete'">
                    je kan nu stukken van de pagina verwijderen
                </div>
                <div class="blogdetail__container blogdetail__container--top">
                    <div>
                        <button class="blogdetail__button blogdetail__button--category" v-for="item of categoryData">{{item}}</button>
                    </div>
                    <div v-if="user.userID === user_id" class="blogdetail__container--icon">
                        <img @click="toggleEdit()" class="blogdetail__icon blogdetail__icon--update" src="../../assets/draw.png">
                        <img @click="toggleDelete()" class="blogdetail__icon blogdetail__icon--delete" src="../../assets/bin.png">
                    </div>
                </div>
                <div class="blogdetail__text blogdetail__text--title">{{ mainData['title'] }}</div>
                <div class="blogdetail__text blogdetail__text--opening">{{ mainData['text'] }}</div>

                <div class="blogdetail__container--content" v-for="item of content">
                    <Image v-if="item.type == 'afbeelding'" :data="item.data" :modifier="mode"/>
                    <Slideshow v-else-if="item.type == 'diavoorstelling'" :data="item.data" :modifier="mode"/>
                    <WithTitle v-else-if="item.type == 'met'" :data="item.data" :modifier="mode"/>
                    <WithoutTitle v-else-if="item.type == 'zonder'" :data="item.data" :modifier="mode"/>
                </div>

                <div v-if="user.userID === user_id" class="blogdetail__container--builder">
                    <blogbuilderCreate :data="parseInt(this.$route.params.id)"/>
                </div>

                <div class="blogdetail__reacties">
                    <div class="blogdetail__reacties--container">
                        <div class="blogdetail__reacties--title">reacties</div>
                        <Comment v-if="mainData" :data="[mainData.id, 'unlimited']"/>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    
</template>

<script>
import axios from 'axios'

import Image from "../components/blogdetail/Image.vue";
import Slideshow from "../components/blogdetail/Slideshow.vue";
import WithoutTitle from "../components/blogdetail/WithoutTitle.vue";
import WithTitle from "../components/blogdetail/WithTitle.vue";

import smallCard from "../components/card/SmallCard.vue";
import Comment from "../components/blog/Comment.vue";
import blogbuilderCreate from "../components/blogbuilder/Create.vue";

export default {
    name: "blogdetail",
    // componets that we use in this template
    components: {smallCard,Comment,blogbuilderCreate,Image,Slideshow,WithoutTitle,WithTitle},
    // props are paramater given by the parent
    props: {
        user: Object,
    },
    // data presets
    data(){
        return {
            blogpost_id : this.$route.params.id,
            mainData : [], /** this is going to be an array */
            user_id : [],
            loginUserId: null,
            categoryData : [],
            smallCardData : [],
            content : [],
            mode: 'view',
        }
    },
    
    async created() {
        axios.get('/api/obtainBlogpostData/' + this.blogpost_id)
        .then((response) => {
                this.mainData = response.data;
                this.user_id = this.mainData['user_id']['id'];
            })
        .catch((error) => {
            console.warn(error)
        })
        await axios.get('/api/getLinkedCategoryBlogpost/' + this.blogpost_id)
        .then((response) => {
            if(response){
                this.categoryData = response.data;
            } else {
                this.categoryData = ['geen categorieën'];
            }
            })
        .catch((error) => {
            console.warn(error)
        })
        await axios.get('/api/getSmallCardDataBlogdetail/' + this.user_id)
        .then((response) => {
                this.smallCardData = response.data;
            })
        .catch((error) => {
            console.warn(error)
        })
        await axios.get('/api/blogdetail/getContent/' + this.blogpost_id)
        .then((response) => {
                this.content = response.data;
            })
        .catch((error) => {
            console.warn(error)
        })
    },
    methods: {
        toggleEdit(){
            if(this.mode != 'edit'){
                this.mode = 'edit';
            } else {
                this.mode = 'view'
            }
            
        },
        toggleDelete(){
            if(this.mode != 'delete'){
                this.mode = 'delete';
            } else {
                this.mode = 'view'
            }
        }
    },
}
</script>

<style scoped>

</style>
