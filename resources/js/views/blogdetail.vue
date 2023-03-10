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
                        <img class="blogdetail__pfp" v-if="mainData.user_id.profile_picture != 'img'" :src="'/storage/blogImage/'+mainData.user_id.profile_picture">
                        <img class="blogdetail__pfp" v-else src="/storage/blogImage/standard_pfp.png">
                    </div>
                    <div class="blogdetail__container--smallcard">
                        <div class="blogdetail__cardtitle">Meer van deze blogger</div>
                        <smallCard :data="smallCardData"/>
                    </div> 
                </div>
                
            </div>
            <div class="blogdetail__menu--right">
                <div class="blogdetail__container blogdetail__container--top">
                    <div>
                        <button class="blogdetail__button blogdetail__button--category" v-for="item of categoryData">{{item}}</button>
                    </div>
                    <div class="blogdetail__container--icon">
                        <img class="blogdetail__icon blogdetail__icon--update" src="../../assets/draw.png">
                        <img class="blogdetail__icon blogdetail__icon--delete" src="../../assets/bin.png">
                    </div>
                </div>
                <div class="blogdetail__text blogdetail__text--title">{{ mainData['title'] }}</div>
                <div class="blogdetail__text blogdetail__text--opening">{{ mainData['text'] }}</div>
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

import smallCard from "../components/smallCard.vue";
import Comment from "../components/comment.vue";

export default {
    name: "blogdetail",
    components: {smallCard,Comment},
    props: ["user"],
    data(){
        return {
            blogpost_id : this.$route.params.id,
            mainData : null, /** this is going to be an array */
            user_id : [],
            categoryData : [],
            smallCardData : [],
        }
    },
    
    async created() {
        await axios.get('/api/obtainBlogpostData/' + this.blogpost_id)
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
    }
}
</script>

<style scoped>

</style>
