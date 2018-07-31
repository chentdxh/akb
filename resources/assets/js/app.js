
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('./bootstrap');
require("jquery-slimscroll");
window.Vue = require('vue');

window.toastr = require('toastr');


window.swal = require('sweetalert2');

var Promise = require('promise-polyfill').default;


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// Vue.component('test-component', require('./components/testcomponent.vue'));


// const app = new Vue({
//     el: '#app'
// });


function show_delete_dialog(url,data) {

    swal({
        title: '确定删除？',
        text: "删除后不可恢复",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText:"取消",
        confirmButtonText: '确认'
    }).then((result) => {
        if (result.value) {

            $.ajax({
                url:url,
                data:data,
                type:"post",
                success:function (response) {

                    if (response.code == 0)
                    {
                        swal({type:"success",title:"删除成功!" }).then((result) => {

                            window.location.reload();
                        });
                    }else
                    {
                        swal({type:"error",title:"删除失败!" })
                    }
                },
                error:function (response) {

                    swal({type:"error",title:"删除失败!" })
                }
            });

        }
    })
}