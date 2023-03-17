<template>
    <div v-if="modifier === 'view'" class="blogdetail__container__img" :class="this.class">
        <img class="blogdetail__display--img" v-for="item of data" :src="'/storage/blogImage/'+item.img" alt="">
    </div>
    <div v-else-if="modifier === 'edit'" class="blogdetail__container__img" :class="this.class">
        <div v-for="item of data" >
            <img class="blogdetail__display--img blogdetail__edit--img" :src="'/storage/blogImage/'+item.img" @click="toggleShowEdit('editFromImg'+item.id)">
            <div :id="'editFromImg'+item.id" class="blogdetail--hide">
                <input type="file" :ref="'editIMG'+item.id" :id="'editIMG'+item.id" name="img" v-on:change="getFiles('editIMG'+item.id)"/>
                <button @click="submit(item.id)">aanpassen</button>
                <button @click="toggleHideEdit('editFromImg'+item.id)">annuleren</button>
            </div>
        </div>
    </div>
    <div v-else-if="modifier === 'delete'" class="blogdetail__container__img" :class="this.class">
        <img class="blogdetail__display--img" v-for="item of data" :src="'/storage/blogImage/'+item.img" alt="">
        <p>hallo :D</p>
    </div>
</template>

<script>
import axios from 'axios'

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
            img: null,
            showUpdateImg: false,
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
        },
        getFiles(o){
            const element = document.getElementById(o);
            this.img = element.files[0];
        },
        toggleShowEdit(element_id){
            if(this.showUpdateImg == false){
                this.showUpdateImg = true;
                document.getElementById(element_id).classList.toggle("blogdetail--show");
            }
        },
        toggleHideEdit(element_id){
            if(this.showUpdateImg == true){
                this.showUpdateImg = false;
                document.getElementById(element_id).classList.toggle("blogdetail--show");
            }
        },
        submit($id){
            const data = new FormData()

            data.append('id', $id)
            data.append('img', this.img)
            
            axios.post("/api/blogdetail/update/img/", data)
            .then(
                 window.location.reload()
            );
        },
    }
}
</script>