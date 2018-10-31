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

//Route::get("/register","HomeController@register");

Route::get('/home', 'HomeController@index')->name('home');


Route::get("/dashboard","HomeController@dashboard");

Route::get("/profile","HomeController@profile");



Route::any("/test","HomeController@test");

Route::any("/demo","HomeController@demo");



Route::any("/oss/upload","OssController@upload");



Route::any("/file/help","HomeController@help");

Route::any("/file/add","HomeController@add_file");
Route::any("/file/list","HomeController@files");

Route::any("/data/file/upload","FileController@upload");

Route::any("/data/file/remove","FileController@remove");


Route::any("/data/file/download","FileController@download");