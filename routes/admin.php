<?php
/**
 * Created by PhpStorm.
 * User: q
 * Date: 2018/7/31
 * Time: 3:53 PM
 */



Route::get("/system/users","AdminController@users");

Route::get("/system/user/apps","AdminController@user_apps");

Route::any("/serve/system/user/add","UserController@add_system_user");

Route::any("/serve/system/user/del","UserController@del_system_user");