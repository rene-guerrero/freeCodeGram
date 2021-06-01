<template>
    <div class="d-flex align-items-center">
        <div class="mr-2"><h3 class="m-0 pt-1">{{ this.tempLikeCount }}</h3></div>
        <a @click="likePost" style="cursor:pointer">
            <img :src="iconPath" style="height: 30px; " class="pr-2">
        </a>
    </div>
</template>

<script>
    export default {
        props: ['postId', 'like', 'likeCount'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return{
                status: this.like,
                tempLikeCount: this.likeCount
            }
        },

        methods:{
            likePost(){
                axios.post('/like/' + this.postId).then(response => {
                    this.status = !this.status;
                    this.tempLikeCount = (this.status) ?  Number(this.tempLikeCount) + 1 : this.tempLikeCount - 1;
                    console.log(response.data);
                }).catch(errors => {
                    if (errors.response.status == 401) {
                        window.location = "/login";
                    }
                }
                );
            }
        },

        computed: {
            iconPath(){
                return (this.status) ? '/svg/heart_filled.svg' : '/svg/heart.svg';
            },

        }
    }
</script>
