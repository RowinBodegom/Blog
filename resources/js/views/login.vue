
<template>
        <section class="backgroundPicture"></section>
        <section class="login">
            <h1 class="login__title">INLOGGEN</h1>
            <div>
                <div class="login__box--input">
                    <input v-model="username" class="login__input" type="text" name="username" placeholder="Gebruikersnaam">
                </div>
                <div class="login__box--input">
                    <input v-model="password" class="login__input" type="password" name="password" placeholder="Wachtwoord">
                </div>
                <div class="login__box--input">
                    <input v-model="checkbox" type="checkbox" name="privacycheck"><label for="privacycheck"> Ja, ik ga akkoord met de privacyverklaring</label>
                </div>
                <div class="login__box--input">
                    <button @click="sendLoginRequest()" class="login__inlogbutton">Login</button>
                </div>
            </div>

            <section class="login__account--buttons">
                <p><router-link to="#" class="login__account--buttons--left">Wachtwoord vergeten</router-link></p>
                <p><router-link to="/register" class="login__account--buttons--right">nog geen account?</router-link></p>
            </section>
        </section>
</template>

<script>
document.body.classList.add("loginBody");

import axios from 'axios';

export default {
    // data presets
    data(){
        return {
            username: null,
            password: null,
            checkbox: false,
        }
    },
    methods: {
        sendLoginRequest(){
            if(this.checkbox){
                axios.post("/api/login", {
                    'name': this.username,
                    'password': this.password,
                })
                .then((response) => {
                    document.body.classList.remove("loginBody");
                    sessionStorage.setItem("user", JSON.stringify(response.data));
                    document.body.classList.remove("loginBody");
                    this.$router.push("/home");
                })
                .catch((error) => {
                    console.warn(error);
                })
            }
        }
    }
}
</script>