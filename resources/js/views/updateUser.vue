
<template>
    <section class="updateUserForm">
        <input type="text" v-model="name" placeholder="new name">
        <input type="text" v-model="username" placeholder="new username">
        <input type="email" v-model="mail" placeholder="mail">
        <input type="password" v-model="password" placeholder="new password">
        <input type="password" v-model="passwordAgain" placeholder="new password again">
        <label for="profilePicture">profile picture: <input type="file" ref="profilePicture" v-on:change="getFiles()"></label>
        <label for="banner">banner: <input type="file" ref="banner" v-on:change="getFiles()"></label>
        <button @click="updateUser()">update je zelf</button>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        user: Object,
    },
    data(){
        return {
            name: null,
            unsername: null,
            mail: null,
            password: null,
            passwordAgain: null,
            profilePicture: null,
            banner: null,
            checkbox: false,
        }
    },
    methods: {
        getFiles(){
            this.profilePicture = this.$refs.profilePicture.files[0]
            this.banner = this.$refs.banner.files[0]
        },
        updateUser(){
            if(this.password === this.passwordAgain){
                const data = new FormData()
                data.append('id', this.user.userID)
                data.append('name', this.name)
                data.append('username', this.username)
                data.append('email', this.mail)
                data.append('password', this.password)
                data.append('profilePicture', this.profilePicture)
                data.append('banner', this.banner)

                axios.post("/api/editUser", data)
                .then((response) => {
                    sessionStorage.setItem("user", JSON.stringify(response.data));
                    document.body.classList.remove("loginBody");
                    this.$router.push("/home");
                })
            }
        }
    }
}
</script>