<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get("/dashboard","HomeController@dashboard");

Route::get("/profile","HomeController@profile");



Route::get("/talk","HomeController@talk");


Route::get("/chat/with","HomeController@chat_with");

Route::get("/app/list","HomeController@apps");


Route::get("/app/users","HomeController@app_users");


Route::get("/app/add","HomeController@add_app");

Route::get("/app/detail","HomeController@app_detail");

Route::get("/app/user/add","HomeController@add_app_user");



Route::any("/serve/app/add","AppController@add_app");

Route::any("/serve/app/user/add","AppController@add_app_user");


Route::any("/test","HomeController@test");


Route::any("/demo","HomeController@demo");