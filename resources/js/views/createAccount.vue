<template>
    <section class="create-account">
        <h1 class="create-account__title">CREATE ACCOUNT</h1>
        <form action="" method="post">
            <div>
                <label for="username">name:</label>
                <input type="text" name="username">
            </div>
            <div>
                <label for="mail">mail:</label>
                <input type="mail" name="mail"> 
            </div>  
            <div>
                <label for="password">password:</label>       
                <input type="password" name="password">
                <br>
                <label for="repeatPassword">repeat password:</label>
                <input type="password" name="repeatPassword">
            </div>
            <br><br>
            <input type="button" value="Create Account">
        </form>
    </section>
</template>