<template>
    <div class="blogbuilder--addimg">
        <div>
            <select class="blogbuilder__select" id="select" @change="changeImgType()">
                <option class="blogbuilder__option" value="" hidden>kies een format</option>
                <template v-for="item of formatArray">
                    <option class="blogbuilder__option">{{ item }}</option>
                </template>
            </select>
        </div>
        <div>
            <template v-if="type === formatArray[0]">
                <ul>
                    <li>
                        <input type="file" ref="file" v-on:change="getFiles(this.$refs.file, 0)"/>
                    </li>
                    <li v-if="img.length >= 1" >
                        <input type="file" ref="file1" v-on:change="getFiles(this.$refs.file1, 1)"/>
                    </li>
                    <li v-if="img.length >= 2" >
                        <input type="file" ref="file2" v-on:change="getFiles(this.$refs.file2, 2)"/>
                    </li>
                </ul>  
            </template>
            <template v-if="type === formatArray[1]">
                <ul>
                    <li>
                        <input type="file" ref="file" v-on:change="getFiles(this.$refs.file, 0)"/>
                    </li>
                    <li v-if="img.length >= 1" >
                        <input type="file" ref="file1" v-on:change="getFiles(this.$refs.file1, 1)"/>
                    </li>
                    <li v-if="img.length >= 2" >
                        <input type="file" ref="file2" v-on:change="getFiles(this.$refs.file2, 2)"/>
                    </li>
                    <li v-if="img.length >= 3" >
                        <input type="file" ref="file3" v-on:change="getFiles(this.$refs.file3, 3)"/>
                    </li>
                    <li v-if="img.length >= 4" >
                        <input type="file" ref="file4" v-on:change="getFiles(this.$refs.file4, 4)"/>
                    </li>
                </ul>  
            </template>
            <template  v-if="type">
                <button @click="submit()">aanmaken</button>
            </template>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "blogbuilder-addimg",
    // props are paramater given by the parent
    props: {
        data: Number,
    },
    // data presets
    data(){
        return {
            blog_ID: this.data,
            formatArray: [
                'afbeelding',
                'diavoorstelling'
            ],
            type: null,
            position: null,
            img: [],
        }
    },
    created(){
        axios.get("/api/getLengthBlogpostDetails/" + this.blog_ID)
        .then((response) => {
            this.position = response.data;
            console.log(this.position);
        })
        .catch((error) => {
            console.warn(error);
        })
    },
    methods: {
        // getFile gets the file form a input when input changes
        getFiles($ref, $number){
            this.img[$number] = $ref.files[0];
        },
        // changeImgType changes the type of the img before selecting the images
        changeImgType(){
            this.type = document.getElementById("select").value;
            this.img = [];
        },
        // submit axios post creating a new row with images
        submit(){
            const data = new FormData()

            data.append('blogpost_id', this.blog_ID)
            data.append('type', this.type)
            data.append('position', this.position)
            data.append('img', this.img)
            
            axios.post("/api/blogbuilder/createElement", data)
            .then((response) => {
                const img = this.img;
                img.forEach(element => {
                    const img = new FormData();

                    img.append('blogdetail_id', response.data);
                    img.append('img', element);
                    
                    axios.post("/api/blogbuilder/createElement/img", img)
                }); 
                window.location.reload();
            })
        },
    }
}
</script>