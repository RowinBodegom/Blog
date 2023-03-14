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

    import Card from "../components/card.vue";
    import smallCard from "../components/smallCard.vue";
    import Category from "../components/category-buttons.vue";
    import blogcreate from "../components/blog-create.vue";

    export default {
        name: "home",
        components: {Card,Category,blogcreate,smallCard},
         props: {
            user: Object,
        },
        data(){
            return {
                cardData: [],
                categorydata: [],
                smallCardData: [],
            }
        },
        created() {
            axios.get('api/getCards/' + this.user.id)
            .then(response => this.cardData = response.data)
                .catch((error) => {
                    console.warn(error)
                })

            axios.get('/api/getCategory')
            .then(response => this.categorydata = response.data)
                .catch((error) => {
                    console.warn(error)
                })
            axios.get('api/getSmallCard/' + this.user.id)
            .then(response => this.smallCardData = response.data)
                .catch((error) => {
                    console.warn(error)
                })
        }
    }
</script>

<style scoped>

</style>
