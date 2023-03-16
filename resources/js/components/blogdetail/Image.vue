<template>
    <div v-if="modifier === 'view'" class="blogdetail__container__img" :class="this.class">
        <img class="blogdetail__display--img" v-for="item of data" :src="'/storage/blogImage/'+item.img" alt="">
    </div>
    <div v-else-if="modifier === 'edit'" class="blogdetail__container__img" :class="this.class">
        <div v-for="item of data" >
            <img class="blogdetail__display--img" :src="'/storage/blogImage/'+item.img" alt="">
            <p>hallo :D</p>
        </div>
    </div>
    <div v-else-if="modifier === 'delete'" class="blogdetail__container__img" :class="this.class">
        <img class="blogdetail__display--img" v-for="item of data" :src="'/storage/blogImage/'+item.img" alt="">
        <p>hallo :D</p>
    </div>
</template>

<script>
export default {
    name: "blogdetail/Image",
    props: {
        data: Object,
        modifier: {
            type: String,
            required: false
        }
    },
    data(){
        return {
            class: null,
        }
    },
    async created(){ 
        this.give();
    },
    methods:{
        give(){
            switch(this.data.length){
                case 1: 
                    this.class = "blogdetail__container__img--single";
                    break;
                case 2:
                    this.class = "blogdetail__container__img--duo";
                    break;
                case 3:
                    this.class = "blogdetail__container__img--triple";
                    break;
            }
        }
    }
}
</script>