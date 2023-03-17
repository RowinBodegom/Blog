<template>
    <div class="follower__container">
        <div class="follower__container--button">
            <button class="follower__button">{{ followers }} volgers</button>
        </div>
        <div class="follower__container--button">
            <button class="follower__button">{{ followed }} volgend</button>
        </div>
        <div v-if="user.userID !== userData.id" class="follower__container--button">
            <button v-if="check === 'follow'" @click="followPerson()" class="follower__button">volg persoon</button>
            <button v-else @click="unfollowPerson()" class="follower__button">ontvolg persoon</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    // props are paramater given by the parent
    props: {
        user: {
            default: null,
            type: Object,
        },
        userData: {
            default: null,
            type: Object,
        },
    },
    // data presets
    data(){
        return {
            followers: null,
            followed: null,
            check: null,
        }
    },
    name: "followers-count",
    created(){
        axios.post("/api/getFollowers", {
            "followed_id": this.userData.id
        })
        .then((response) => {
            this.followers = response.data
        })
        axios.post("/api/getFollowed", {
            "follower_id": this.userData.id
        })
        .then((response) => {
            this.followed = response.data
        })
        axios.post("/api/checkFollow", {
            "follower_id": this.user.userID
        })
        .then((response) => {
            this.check = response.data
            console.log(this.check);
        })
    },
    methods: {
        // followPerson axios post to add a follower to a person
        followPerson(){
            const data = new FormData()
            data.append("followed_id", this.userData.id);
            data.append("follower_id", this.user.userID);

            axios.post("/api/followPerson", data)
            .then((response) => {
                location.reload();
            });
        },
        // unfollowPerson axios post to remove a follower from a person
        unfollowPerson(){
            axios.post("/api/unfollowPerson", {
            "id": this.check.id
            })
            .then((response) => {
                location.reload();
            })
        }
    }

}
</script>