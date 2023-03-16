<template>
    <div v-for="item of data">
        <img :src="'/storage/blogImage/'+item.img" alt="">
    </div>
</template>

<script>
export default {
    name: "blogdetail/Slideshow",
    props: {
        data: Object
    }
}
</script>