<template>
    <div class="blogbuilder--addimg">
        <div>
            <select class="blogbuilder--addimg__select" id="select" @change="changeImgType()">
                <option class="blogbuilder--addimg__option" value="" hidden>kies een format</option>
                <template v-for="item of formatArray">
                    <option class="blogbuilder--addimg__option">{{ item }}</option>
                </template>
            </select>
        </div>
        <div>
            <template v-if="display_type === 'normal'">
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
            <template v-if="display_type === 'slideshow'">
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
            <button @click="submit()">aanmaken</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "blogbuilder-addimg",
    props: {
        data: Number,
    },
    data(){
        return {
            blog_ID: this.data,
            formatArray: [
                'normal',
                'slideshow'
            ],
            type: "img",
            position: null,
            display_type: null,
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
        getFiles($ref, $number){
            this.img[$number] = $ref.files[0];
        },
        changeImgType(){
            this.display_type = document.getElementById("select").value;
            this.img = [];
        },
        submit(){
            console.log('submiting');
            const data = new FormData()

            data.append('blogpost_id', this.blog_ID)
            data.append('type', this.type)
            data.append('position', this.position)
            data.append('display_type', this.display_type)
            data.append('img', this.img)
            
            axios.post("/api/blogbuilder/addImg", data)
        },
    }
}
</script>