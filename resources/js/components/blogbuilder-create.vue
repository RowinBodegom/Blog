<template>
    <div class="blogbuilder-create">
        <div class="blogbuilder-create__button">
            <img @click="toggleCreateText()" class="blogbuilder-create__icon" src="../../assets/write-text.png">
            <img @click="toggleCreateImg()" class="blogbuilder-create__icon" src="../../assets/add-image.png" alt="hallo">
        </div>
        <div v-if="this.showText == true && this.showImg == false">
            <addtext :data="this.data"/>
        </div>
        <div v-if="this.showImg == true && this.showText == false">
            <addimg :data="this.data"/>
        </div>
    </div>
</template>

<script>
import addtext from "../components/blogbuilder-addtext.vue";
import addimg from "../components/blogbuilder-addimg.vue";

export default {
    name: "blogbuilder-create",
    components: {addtext,addimg},
    props: {
        data: Number,
    },
    data() {
        return {
            showText: false,
            showImg: false,
        }
    },
    methods: {
            toggleCreateText(){
                if(this.showText === false){
                    this.showText = true;
                    this.showImg = false;
                } else {
                    this.showText = false;
                }
            },
            toggleCreateImg(){
                if(this.showImg === false){
                    this.showImg = true;
                    this.showText = false;
                } else {
                    this.showImg = false;
                }
            },
        }
}
</script>