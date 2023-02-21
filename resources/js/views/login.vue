
<template>
    <section class="login">
        <h1 class="login__title">INLOGGEN</h1>
        <form action="" method="post">
            <div class="login__input">
                <input type="text" name="username" placeholder="Gebruikersnaam">
            </div>
            <div class="login__input">
                <input type="password" name="password" placeholder="Wachtwoord">
            </div>
            <div class="login__input">
                <input type="checkbox" name="privacycheck"><label for="privacycheck">Ja, ik ga akkoord met de privacyverklaring</label>
            </div>
            <div class="login__inlog-button">
                <input type="button" value="Inloggen">
            </div>
        </form>

        <section class="login__account-buttons">
            <p><router-link to="#">Wachtwoord vergeten</router-link></p>
            <p><router-link to="/createAccount">nog geen account?</router-link></p>
        </section>
    </section>
</template>