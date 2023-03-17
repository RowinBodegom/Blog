<template>
    <div v-if="modifier === 'view'" class="blogdetail__container__img" :class="this.class">
        <img class="blogdetail__display--img" v-for="item of data" :src="'/storage/blogImage/'+item.img" alt="">
    </div>
    <div v-else-if="modifier === 'edit'" class="blogdetail__container__img" :class="this.class">
        <div v-for="item of data" >
            <img class="blogdetail__display--img blogdetail__hover--img" :src="'/storage/blogImage/'+item.img" @click="toggleShowEdit('editFromImg'+item.id)">
            <div :id="'editFromImg'+item.id" class="blogdetail--hide">
                <div class="blogdetail__input">
                    <input class="blogdetail__input__img" type="file" :ref="'editIMG'+item.id" :id="'editIMG'+item.id" name="img" v-on:change="getFiles('editIMG'+item.id)"/>
                </div>
                <div class="blogdetail__input blogdetail__input__container--button">
                    <button class="blogdetail__input__button blogdetail__input__button--submit" @click="submit(item.id)">aanpassen</button>
                    <button class="blogdetail__input__button blogdetail__input__button--cancel" @click="toggleHideEdit('editFromImg'+item.id)">annuleren</button>
                </div>
                
            </div>
        </div>
    </div>
    <div v-else-if="modifier === 'delete'" class="blogdetail__container__img" :class="this.class">
        <img class="blogdetail__display--img blogdetail__hover--img" v-for="item of data" :src="'/storage/blogImage/'+item.img" alt="" @click="deleteImg(item.id)">
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "blogdetail/Image",
    // props are paramater given by the parent
    props: {
        data: Object,
        modifier: {
            type: String,
            required: false
        }
    },
    // data presets
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
        // getFile gets the file form a input when input changes
        getFiles(o){
            const element = document.getElementById(o);
            this.img = element.files[0];
        },
        // when entering edit mode if the user clicks on the images this function will be activated to display the form for updating
        toggleShowEdit(element_id){
            if(this.showUpdateImg == false){
                this.showUpdateImg = true;
                document.getElementById(element_id).classList.toggle("blogdetail--show");
            }
        },
        // when entering edit mode if the user clicks on the images this function will be activated to hide the form for updating
        toggleHideEdit(element_id){
            if(this.showUpdateImg == true){
                this.showUpdateImg = false;
                document.getElementById(element_id).classList.toggle("blogdetail--show");
            }
        },
        // submit axios post sends data for updating the images
        submit($id){
            const data = new FormData()

            data.append('id', $id)
            data.append('img', this.img)
            
            axios.post("/api/blogdetail/update/img/", data)
            .then(
                 window.location.reload()
            );
        },
        // deleteImg axios post sends ID of the img to remove it from the database
        deleteImg($id){
            const data = new FormData()

            data.append('id', $id)
            axios.post("/api/blogdetail/delete/img/", data)
            .then(
                 window.location.reload()
            );
        }
    }
}
</script>