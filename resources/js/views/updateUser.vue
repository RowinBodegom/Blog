
<template>
    <section class="updateUserForm">
        <input class="updateUserForm__input" type="text" v-model="name" placeholder="new name">
        <input class="updateUserForm__input" type="email" v-model="name" placeholder="mail">
        <input class="updateUserForm__input" type="password" v-model="password" placeholder="new password">
        <input class="updateUserForm__input" type="password" v-model="passwordAgain" placeholder="new password again">
        <input class="updateUserForm__input" type="file">
        <input type="file">
        <button @click="updateUser()">update je zelf</button>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            username: null,
            password: null,
            passwordAgain: null,
            checkbox: false,
        }
    },
    methods: {
        updateUser(){

        }
    }
}
</script>