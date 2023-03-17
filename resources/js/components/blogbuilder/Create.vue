<template>
    <div class="blogbuilder-create">
        <div class="blogbuilder-create__button">
            <img @click="toggleCreateText()" class="blogbuilder-create__icon" src="../../../assets/write-text.png">
            <img @click="toggleCreateImg()" class="blogbuilder-create__icon" src="../../../assets/add-image.png" alt="hallo">
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
import addtext from "../blogbuilder/addtext.vue";
import addimg from "../blogbuilder/addimg.vue";

export default {
    name: "blogbuilder-create",
    components: {addtext,addimg},
    // props are paramater given by the parent
    props: {
        data: Number,
    },
    // data presets
    data() {
        return {
            showText: false,
            showImg: false,
        }
    },
    methods: {
            // toggleCreateText turns the text forms on and the image form off
            toggleCreateText(){
                if(this.showText === false){
                    this.showText = true;
                    this.showImg = false;
                } else {
                    this.showText = false;
                }
            },
            // toggleCreateText turns the image forms on and the text form off
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