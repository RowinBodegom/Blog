<template>
        <div :id="'update' + data.id" class="card__update">
            <label for="titel">titel: </label><input type="text" v-model="data.title"><br>
            <label for="text">text: </label><input type="text" v-model="data.text"><br>
            <label for="img">foto: </label><input type="file" ref="files" name="img" v-on:change="getFiles()"><br>
            <button @click="editBlog(data.id)">update</button>
        </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "blog-update",
        props: {
            data: Object
        },
        data(){
            return {
                title: null,
                text: null,
                img: null,
            }
        },
        methods: {
            getFiles(){
                this.img = this.$refs.files.files[0]
            },
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
                    this.img = null;
                    this.$parent.reloadData();
                })
                .catch((error) => {
                    console.warn(error);
                })
            }
        }
    }
</script>
