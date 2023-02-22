<template>
    <Header/>
    <router-view></router-view>
</template>

<script setup>
import Header from './components/Header.vue';
</script>

<script>
export default {
    name: "app"
}
</script>
