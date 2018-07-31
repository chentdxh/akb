<?php

namespace App\Http\Controllers;

use App\AppInfo;
use App\AppUser;
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

    public function add_app_user(Request $request)
    {
        $appId = $request->input("appid");
        $uid = $request->input("uid");
        $name = $request->input("name");
        $appUser = new AppUser();
        $appUser->appid = $appId;
        $appUser->uid = $uid;
        $appUser->token = $this->create_app_user_token($appId,$uid);
        $appUser->name = $name;
        $appUser->save();

        return $this->json_return(0,"success");
    }


    public function update_app_token(Request $request)
    {



        $appId = $request->input("appid");
        $appInfo = AppInfo::where("appid",$appId)->first();
        $token = (new Builder())->setIssuer('http://sdo.com') // Configures the issuer (iss claim)
        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
        ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
        ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
        ->set('appid', $appId) // Configures a new claim, called "uid"
        ->getToken(); // Retrieves the generated token

        if (!empty($appInfo))
        {
            $appInfo->token = $token;
            $appInfo->save();
            return $this->json_return(0,"success");
        }

        return $this->json_return(-1,"update token failed");
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

    public function create_app_user_token($appid,$uid)
    {
        $token = (new Builder())->setIssuer('http://sdo.com') // Configures the issuer (iss claim)
        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
        ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
        ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
        ->set('appid', $appid) // Configures a new claim, called "uid"
            ->set("uid",$uid)
        ->getToken(); // Retrieves the generated token

        return $token;
    }

}
