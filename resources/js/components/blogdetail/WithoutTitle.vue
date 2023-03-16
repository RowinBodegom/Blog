<template>

    <!-- * this one is for displaying the data -->
    <div v-if="modifier === 'view'" class="blogdetail__container__text" v-for="item of data">
        <div class="blogdetail__text blogdetail__text--paragraf">{{ item.text }}</div>
    </div>

    <!-- ? this one is for editing the page  -->
    <div v-else-if="modifier === 'edit'" class="blogdetail__container__text blogdetail__mode__text--edit"  v-for="(item, index) in data" :id="item.id">
        <div v-if="edit.id !== item.id">
            <div :id="'text'+ item.id" class="blogdetail__text blogdetail__text--paragraf " @click="toggleForm(item.id)">{{ item.text }}</div>
        </div>
        <div v-else-if="edit.id === item.id">
            <textarea name="text" v-model="data[index].text"></textarea>
            <button @click="submit(item.id)">aanpassen</button>
            <button @click="toggleForm(null)">annuleren</button>
        </div>
    </div>

    <!-- ! this one is for deleting the element form the page -->
    <div v-else-if="modifier === 'delete'" class="blogdetail__container__text " v-for="item of data">
        <div class="blogdetail__text blogdetail__text--paragraf blogdetail__mode__text--delete">{{ item.text }}</div>
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
            console.log(this.edit);
        },
        submit($id){
            const data = new FormData()

            data.append('id', $id)
            data.append('title', null)
            data.append('text', this.data[0].text)
            
            axios.post("/api/blogdetail/update/text/", data)
            .then( this.toggleForm(null) )
        }
    }
}
</script>