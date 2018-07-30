<template>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Test </div>

                    <div class="card-body">
                        <button v-on:click="count++">You clicked me {{ count }} times.</button>

                        <button v-on:click="testclick(1)"  >测试</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




</template>



<script>
    export default {
        mounted() {
            console.log('test Component mounted.')
        },
        // testclick:function(){
        //
        //     toastr.success("success");
        // },

        methods: {
            testclick: function (id) {
                toastr.success("success"+id);
                swal({type:"success",title:"test"})
            }
        },

        data: function () {

            return {

                count: 0
            }
        },
    }
</script>
