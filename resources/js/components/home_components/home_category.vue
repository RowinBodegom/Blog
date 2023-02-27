<template>
    <div class="category_-container--buttons">
        <button class="category__button category__button--blue">one</button>
        <button class="category__button category__button--white">{{data}}</button>
        <button class="category__button category__button--orange">tres</button>
    </div>
    
    </template>
    
    <script>
    export default {
        name: "home_category",
        props: {
            data: Object
        }
    }
    </script>
    
    <style scoped>
    
    </style>
    