<?php

namespace App\Http\Controllers;

use App\AppInfo;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\JWTAuth;

use Lcobucci\JWT\Builder;


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
        $appInfo->token = $this->create_app_token($appId);
        $appInfo->uid = $user->uid;
        $appInfo->save();

        return $this->json_return(0,"success");
    }


    public function create_app_token($appId)
    {
//        $customClaims = ['appid' => '123456' ];
//
//        $payload = JWTFactory::make($customClaims);
//
//        $token = JWTAuth::encode($payload);
//
//        return $token;


        $token = (new Builder())->setIssuer('http://sdo.com') // Configures the issuer (iss claim)
        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
        ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
        ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
        ->set('appid', $appId) // Configures a new claim, called "uid"
        ->getToken(); // Retrieves the generated token

        return $token;
    }

}
