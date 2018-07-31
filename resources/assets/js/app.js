
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