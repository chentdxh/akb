<template>






</template>



<script>

    var  kMsgList = [];

    app.prototype.messages = kMsgList;



    export default {
        mounted() {
            console.log('test Component mounted.')
        },


        methods: {

        },

        data:    {
         messages:kMsgList,

        }
    }
</script>
