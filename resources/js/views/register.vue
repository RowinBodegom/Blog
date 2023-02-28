
<template>
        <section class="backgroundPicture"></section>
        <section class="login">
            <h1 class="login__title">REGISTER</h1>
            <div>
                <div class="login__box--input">
                    <input v-model="username" class="login__input" type="text" name="username" placeholder="Gebruikersnaam">
                </div>
                <div class="login__box--input">
                    <input v-model="mail" class="login__input" type="email" name="Mail" placeholder="e-mail">
                </div>
                <div class="login__box--input">
                    <input v-model="password" class="login__input" type="password" name="password" placeholder="Wachtwoord">
                </div>
                <div class="login__box--input">
                    <input v-model="repeat_password" class="login__input" type="password" name="repeat_password" placeholder="Herhaal Wachtwoord">
                </div>
                <div class="login__box--input">
                    <input v-model="checkbox" type="checkbox" name="privacycheck"><label for="privacycheck"> Ja, ik ga akkoord met de privacyverklaring</label>
                </div>
                <div class="login__box--input">
                    <button @click="sendRegisterRequest()" class="login__inlogbutton">REGISTER</button>
                </div>
            </div>
        </section>
</template>

<script>
    document.body.classList.add("loginBody");

    import axios from 'axios'

export default {
    data(){
        return {
            username: null,
            mail: null,
            password: null,
            repeat_password: null,
            checkbox: false,
        }
    },
    methods: {
        sendRegisterRequest(){
            if(this.checkbox && this.password === this.repeat_password){
                axios.post("/api/register", {
                    'name': this.username,
                    'email': this.mail,
                    'password': this.password,
                })
                .then((response) => {
                    this.$router.push("/");
                })
                .catch((error) => {
                    console.warn(error);
                })
            }
        }
    }
}
</script>