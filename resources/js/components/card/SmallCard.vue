<template>
    <div v-for="item in data" class="smallCard">
        <img class="smallCard__img" :src="person">
        <div class="smallCard__container">
            <div class="smallCard__username">@{{item['user_id']['name']}}</div>
            <div class="smallCard__title">{{item['title']}}</div>
            <div class="smallCard__text">{{item['text']}}</div>
        </div>
    </div>
</template>

<script setup>
    import person from "/storage/blogImage/standard_pfp.png";
</script>

<script>
export default {
    name: "smallCard",
    // props are paramater given by the parent
    props: {
        data: Object
    }
}
</script>