<template>
    <div class="blogdetail__container__text" v-for="item of data">
        <div class="blogdetail__text blogdetail__text--paragraf">{{ item.text }}</div>
    </div>
</template>

<script>
export default {
    name: "blogdetail/WithoutTitle",
    props: {
        data: Object
    }
}
</script>