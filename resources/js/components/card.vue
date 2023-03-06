<template>
    <div class="card">
        <div class="card__container">
            <div class="card__container--left">
                <img class="card__pfp" src="../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg">
                <div class="card__username">@{{data.user_id.name}}</div>
            </div>
            <div class="card__container--right">

                <div class="card__time">{{data.madedate}}</div>
            </div>
        </div>
        <img class="card__banner" src="../../assets/samsung-memory-IfFP9JT-a4s-unsplash.jpg">
        <div class="card__description">
            <p class="card__title">{{data.title}}</p>
            <p class="card__text">{{data.text}}</p>
            <button class="card__button card__button--detail">Lees verder</button> 
            <div class="comment__container">
                <Comment :data="data"/>
            </div>
            
        </div>
        
    </div>
</template>
    
    <script>
    import Comment from "../components/comment.vue";
    export default {
        
        name: "card",
        components: {Comment},
        props: {
            data: Object
        }
    }
    </script>