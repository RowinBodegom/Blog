<template>
        <div class="card__update__container">
            <div class="card__update__container--title">
                <label class="card__update__label--title" for="titel">titel: </label>
                <input class="card__update__input--title" type="text" v-model="data.title">
            </div>
            <div class="card__update__container--text">
                <label class="card__update__label--text" for="text">text: </label>
                <textarea class="card__update__input--text" type="text" v-model="data.text"></textarea>
            </div>
            <div class="card__update__container--img">
                <label class="card__update__label--img" for="img">foto: </label>
                <input class="card__update__input--img" type="file" ref="files" name="img" v-on:change="getFiles()"> 
            </div>
        </div>
        <button class="card__update__button"  @click="editBlog(data.id)">Aanpassen</button>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "blog-update",
        // props are paramater given by the parent
        props: {
            data: Object,
        },
        // data presets
        data(){
            return {
                title: null,
                text: null,
                img: null,
            }
        },
        methods: {
            // getFile gets the file form a input when input changes
            getFiles(){
                this.img = this.$refs.files.files[0]
            },
            // editBlog axios post updates the old data from a blogpost
            editBlog(id){
                const data = new FormData()
                data.append('title', this.data.title)
                data.append('text', this.data.text)
                data.append('img', this.img)
                data.append('id', id)

                axios.post("/api/editBlog", data)
                .then((response) => {
                    this.title = null;
                    this.text = null;
                    this.title = null;
                    this.$parent.reloadData();
                })
                .catch((error) => {
                    console.warn(error);
                })
            }
        }
    }
</script>
