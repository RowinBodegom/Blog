<template>
    <div class="home__container home__container--main">
        <div class="home__leftBlock">
            <div class="home__leftBlock--items">
                <div class="home__category">
                    <Category :data="categorydata"/>
                </div>
                
                <div class="home__top-posts">
                    <div class="home__top-posts--title">Top posts</div>
                    <smallCard :data="smallCardData"/>
                </div> 
            </div>
        </div>
        
        <div class="home__container home__container--secondary">
            <blogcreate/>
            <div class="home__container home__container--tertiary">
                <Card v-for="item of cardData" :data="item" :user="user" />
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    import Card from "../components/card/Card.vue";
    import smallCard from "../components/card/SmallCard.vue";
    import Category from "../components/category/ButtonInBlog.vue";
    import blogcreate from "../components/blog/Create.vue";

    export default {
        name: "home",
        // componets that we use in this template
        components: {Card,Category,blogcreate,smallCard},
        // props are paramater given by the parent
         props: {
            user: Object,
        },
        // data presets
        data(){
            return {
                cardData: [],
                categorydata: [],
                smallCardData: [],
            }
        },
        created() {
            axios.get('api/getCards/' + this.user.userID)
            .then(response => this.cardData = response.data)
                .catch((error) => {
                    console.warn(error)
                })
            axios.get('/api/getCategory')
            .then(response => this.categorydata = response.data)
                .catch((error) => {
                    console.warn(error)
                })
            axios.get('api/getSmallCard/' + this.user.userID)
            .then(response => this.smallCardData = response.data)
                .catch((error) => {
                    console.warn(error)
                })
        }
    }
</script>

<style scoped>

</style>
