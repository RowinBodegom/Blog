<template>
    <p class="category__title">Categorieën</p>
    <div class="category__container--buttons">
        <button class="category__button category__button--blue">Alle blogs</button>
        <button v-for="name in data" class="category__button category__button--white">{{ name["name"] }}</button>
        <button class="category__button category__button--orange">Bekijk alle categorieën</button>
    </div>
    
    </template>
    
    <script>
    export default {
        name: "home_category",
        // props are paramater given by the parent
        props: {
            data: Object
        }
    }
    </script>
    
    <style scoped>
    
    </style>
    