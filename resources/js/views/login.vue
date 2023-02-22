
<template>
    <section class="login">
        <h1 class="login__title">INLOGGEN</h1>
            <div class="login__input">
        <div>
                <input v-model="username" type="text" name="username" placeholder="Gebruikersnaam">
            </div>
            <div class="login__input">
                <input v-model="password" type="password" name="password" placeholder="Wachtwoord">
            </div>
            <div class="login__input">
                <input v-model="checkbox" type="checkbox" name="privacycheck"><label for="privacycheck">Ja, ik ga akkoord met de privacyverklaring</label>
            </div>
            <div class="login__inlog-button">
                <button @click="sendLoginRequest()">Login</button>
            </div>
        </div>

        <section class="login__account--buttons">
            <p><router-link to="#" class="login__account--buttons--left">Wachtwoord vergeten</router-link></p>
            <p><router-link to="/createAccount" class="login__account--buttons--right">nog geen account?</router-link></p>
        </section>
    </section>
</template>

<script>
import axios from 'axios'

export default {
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
                    'username': this.username,
                    'password': this.password,
                })
                .then((response) => {
                    console.log(response)
                })
            }
        }
    }
}
</script>