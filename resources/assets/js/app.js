
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


import { show_delete_dialog } from './custom.js';

console.log("show global functions");
console.log(show_delete_dialog);

window.show_delete_dialog = show_delete_dialog; 


window.show_success_dialog = function(title,callback)
{
    swal({type:"success",title:title}).then((result)=>{
        callback(result);
    })
}

window.show_error_dialog  = function(title,callback){
    swal({type:"error",title:title}).then((result)=>{
        callback(result);
    })
}

window.post_request = function (url,data,success,fail,error) {

    var errorCB = function(res){
        console.log(res)

        swal({type:"error",title:"Service Error"})
    }
    if (typeof error != "undefined")
    {
        errorCB = error;
    }

    var failCB = function(res) {
        console.log(res);
        swal({type:"error",title:res.msg})
    }

    if (typeof fail != "undefined")
    {
        failCB = fail;
    }

    var successCB = function(res){
        console.log(res)
        window.location.reload();
    }


    if (typeof success != "undefined")
    {
        successCB = success;
    }
    $.ajax({
        url:url,
        type:"post",
        data:data,
        success:function (res) {
            if (res.code ==0)
            {
                successCB(res);
            }else
            {
                failCB(res);
            }
        },
        error:errorCB
    })
}