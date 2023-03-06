<template>
    <header class="header">
        <div class="header__logo">
            <img class="header__logo--foto" :src="logo"/>
            <p class="header__logo--text">BLOG.</p>
        </div>
        <div class="header__rightSide">
            <nav class="header__navigationbar">
                <ul class="header__menubar">
                    <li><a class="header__link" href="/home">Home</a></li>
                    <li><a class="header__link" href="">Ontdek</a></li>
                    <li><a class="header__link" href="">Volgend</a></li>
                    <li><a class="header__link" href="">Categorieën</a></li>
                    <li><a class="header__link" href="">Top posts</a></li>
                </ul>
            </nav>
           <a href="/"><img class="header__person--foto" :src="person"/></a> 
        </div>
    </header>
</template>

<script setup>
    import logo from "../../assets/writing-wit.png";
    import person from "/storage/blogImage/standard_pfp.png";
</script>