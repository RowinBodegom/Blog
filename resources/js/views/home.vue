<template>
    <div class="home__container home__container--main">
        <Category :data="categorydata"/>
        <div class="home__container home__container--secondary">
            <Createpost/>
            <div class="home__container home__container--tertiary">
                <Card v-for="item of cardData" :data="item" />
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    import Card from "../components/card.vue";
    import Category from "../components/home_components/home_category.vue";
    import Createpost from "../components/home_components/home_createpost.vue";

    export default {
        name: "home",
        components: {Card,Category,Createpost},

        data(){
            return {
                cardData: [],
                categorydata: [],
            }
        },
        created() {
            axios.get('api/getCards')
            .then(response => this.cardData = response.data) 
                .catch((error) => {
                    console.warn(error)
                })

            axios.get('api/getCategory')
            .then(response => this.cardData = response.data)
                .catch((error) => {
                    console.warn(error)
                })
        }
    }
</script>

<style scoped>

</style>
