<?php

namespace App\Http\Controllers;

use App\AppInfo;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\JWTAuth;


class AppController extends Controller
{
    //


    public function add_app(Request $request)
    {
        $user = $this->get_user();

        $appId = $request->input("appid");
        $name =  $request->input("name");


        $existApp = AppInfo::where("appid",$appId)->first();
        if (!empty($existApp))
        {
            return $this->json_return(-1,"appid existed");
        }

        $appInfo = new AppInfo();
        $appInfo->appid = $appId;
        $appInfo->name = $name;
        $appInfo->token = $this->create_app_token();
        $appInfo->uid = $user->uid;
        $appInfo->save();

        return $this->json_return(0,"success");
    }


    public function create_app_token()
    {
        $customClaims = ['appid' => '123456' ];

        $payload = JWTFactory::make($customClaims);

        $token = JWTAuth::encode($payload);

        return $token;
    }

}
