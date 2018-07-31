<?php
/**
 * Created by PhpStorm.
 * User: q
 * Date: 2018/7/31
 * Time: 4:55 PM
 */




/**************AICHAT*****************/
Route::get("/aichat/rules","AiChatController@rules");


Route::any("/serve/aichat/rule/add","AiChatController@add_rule");
Route::any("/serve/aichat/rule/del","AiChatController@del_rule");
Route::any("/serve/aichat/complain/review","AiChatController@review_complain");