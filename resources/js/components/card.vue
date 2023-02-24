<template>
    <div class="card">
        <div class="card__container">
            <img class="card__pfp" src="../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg">
            <p class="card__username">@{{data.userID.name}}</p>
            <p class="card__time">{{data.madedate}}</p>
        </div>
        <img class="card__banner" src="../../assets/samsung-memory-IfFP9JT-a4s-unsplash.jpg">
        <p class="card__title">{{data.title}}</p>
        <p class="card__text">{{data.text}}</p>
        <button class="card__button--detail">Lees verder</button>
    </div>
    

    </template>
    
    <script>
    export default {
        
        name: "card",
        props: {
            data: Object
        }
    }
    </script>