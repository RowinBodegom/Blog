<template>

    <!-- * this one is for displaying the data -->
    <div v-if="modifier === 'view'" class="blogdetail__container__text" v-for="item of data">
        <div class="blogdetail__text blogdetail__text--paragraf">{{ item.text }}</div>
    </div>

    <!-- ? this one is for editing the page  -->
    <div v-else-if="modifier === 'edit'" class="blogdetail__container__text blogdetail__hover--text"  v-for="(item, index) in data" :id="item.id">
        <div v-if="edit.id !== item.id">
            <div :id="'text'+ item.id" class="blogdetail__text blogdetail__text--paragraf " @click="toggleForm(item.id)">{{ item.text }}</div>
        </div>
        <div v-else-if="edit.id === item.id">
            <div class="blogdetail__input">
                <textarea class="blogdetail__input__text blogdetail__input__text--textarea" name="text" v-model="data[index].text"></textarea>
            </div>
            <div class="blogdetail__input">
                <button class="blogdetail__input__button blogdetail__input__button--submit" @click="submit(item.id)">aanpassen</button>
                <button class="blogdetail__input__button blogdetail__input__button--cancel" @click="toggleForm(null)">annuleren</button>
            </div>
            
        </div>
    </div>

    <!-- ! this one is for deleting the element form the page -->
    <div v-else-if="modifier === 'delete'" class="blogdetail__container__text blogdetail__hover--text" v-for="item of data">
        <div class="blogdetail__text blogdetail__text--paragraf" @click="deleteText(item.id)">{{ item.text }}</div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "blogdetail/WithTitle",
    props: {
        data: Object,
        modifier: {
            type: String,
            required: false
        }
    },
    data(){
        return{
            edit:{
                id: null,
            },
            text: null,
        }
    },
    methods: {
        toggleForm($elementID){
            this.edit.id = $elementID;
        },
        submit($id){
            const data = new FormData()

            data.append('id', $id)
            data.append('title', null)
            data.append('text', this.data[0].text)
            
            axios.post("/api/blogdetail/update/text/", data)
            .then( this.toggleForm(null) )
        },
        deleteText($id){
            const data = new FormData()

            data.append('id', $id)
            
            axios.post("/api/blogdetail/delete/text/", data)
            .then(  window.location.reload() )
        }
    }
}
</script>