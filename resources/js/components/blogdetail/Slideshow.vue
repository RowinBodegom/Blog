<template>
    <!-- <div v-for="item of data">
        <img class="blogdetail__diplay--img" :src="'/storage/blogImage/'+item.img" alt="">
    </div> -->
    <div>
        WIP
    </div>
</template>

<script>
export default {
    name: "blogdetail/Slideshow",
    // props are paramater given by the parent
    props: {
        data: Object,
        modifier: {
            type: String,
            required: false
        }
    }
}
</script>