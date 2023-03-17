
<template>
    <div class="updateUser">
        <section class="updateUser__form">
            <input class="updateUser__input" type="text" v-model="name" placeholder="new name">
            <input class="updateUser__input" type="text" v-model="username" placeholder="new username">
            <input class="updateUser__input" type="email" v-model="mail" placeholder="mail">
            <input class="updateUser__input" type="password" v-model="password" placeholder="new password">
            <input class="updateUser__input" type="password" v-model="passwordAgain" placeholder="new password again">
            <label for="profilePicture">profile picture: <input class="updateUser__button updateUser__button--file" type="file" ref="profilePicture" v-on:change="getFiles()"></label>
            <label for="banner">banner: <input type="file" class="updateUser__button updateUse__button--file" ref="banner" v-on:change="getFiles()"></label>
            <button class="updateUser__button" @click="updateUser()">update je zelf</button>
        </section>
    </div>
    
</template>

<script>
import axios from 'axios';

export default {
    // props are paramater given by the parent
    props: {
        user: Object,
    },
    // data presets
    data(){
        return {
            name: null,
            username: null,
            mail: null,
            password: null,
            passwordAgain: null,
            profilePicture: null,
            banner: null,
            checkbox: false,
        }
    },
    methods: {
        // getFile gets the file form a input when input changes
        getFiles(){
            this.profilePicture = this.$refs.profilePicture.files[0]
            this.banner = this.$refs.banner.files[0]
        },
        // updateUser axios post sends new data so the old user data can be rewriten with the data given
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