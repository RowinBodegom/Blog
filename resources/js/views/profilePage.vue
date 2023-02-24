<template>
        <img class="banner" :src="banner"/>
        <div class="profilePage">
            <div class="user">
                <img class="user--picture" :src="person"/>
                <div>
                    <h1>gvfdkljgfdbjkf</h1>
                </div>
            </div>
            <div class="blog">
                <div class="blog__createblog">
                    <img class="blog__createblog--picture" :src="logo"/>
                    <input class="blog__createblog--input" type="text">
                </div>
                <div class="blog__showblog">
                    <div v-for="n in 2" class="blog__showblog-card">
                        <img class="blog__showblog-card--picture" :src="person"/>
                        <h2>naam persoon</h2>
                        <img class="blog__showblog-card--bigpicture" :src="person"/>
                    </div>
                </div>
            </div>
        </div>
</template>

<script setup>
    import banner from "../../assets/luca-bravo-O453M2Liufs-unsplash.jpg";
    import person from "../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg";
    import logo from "../../assets/writing.png";
</script>