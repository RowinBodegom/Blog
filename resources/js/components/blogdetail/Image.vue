<template>
    <div class="blogdetail__container__img" :class="this.class">
        <img v-for="item of data" :src="'/storage/blogImage/'+item.img" alt="">
    </div>
</template>

<script>
export default {
    name: "blogdetail/Image",
    props: {
        data: Object
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