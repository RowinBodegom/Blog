
<template>
    <form v-on:submit="'updateProfile'">
        <input type="text" v-model="name" placeholder="new name" >
        <input type="number" v-model="password" placeholder="new password">
        <input type="text" v-model="passwordAgain" placeholder="new password again">
        <button></button>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            username: null,
            password: null,
            checkbox: false,
        }
    },
    methods: {

    }
}
</script>