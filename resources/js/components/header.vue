<template>
    
    <header class="header">
        <div class="header__logo">
            <img class="header__logo--foto" :src="logo"/>
            <p class="header__logo--text">BLOG.</p>
        </div>
        <div class="header__rightSide">
            <nav class="header__navigationbar">
                <ul class="header__menubar">
                    <li>Home</li>
                    <li>Ontdek</li>
                    <li>Volgend</li>
                    <li>categorieën</li>
                    <li>Top posts</li>
                </ul>
            </nav>
            <img class="header__person--foto" :src="person"/>
        </div>
    </header>
</template>

<script setup>
    import logo from "../../assets/writing-wit.png";
    import person from "../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg";
</script>