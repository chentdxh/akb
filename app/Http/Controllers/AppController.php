<?php

namespace App\Http\Controllers;

use App\AppInfo;
use App\AppUser;
use App\User;
use App\UserApp;
use Illuminate\Http\Request;
use Lcobucci\JWT\Signer\Hmac\Sha256;

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

    public function del_app(Request $request)
    {
        $appId = $request->input('appid');
        $appInfo = AppInfo::where('appid',$appId)->first();
        if (!empty($appInfo))
        {
            $appInfo->delete();
        }
        return $this->json_return(0,"success");

    }
    public function add_app_user(Request $request)
    {

        $appId = $request->input("appid");
        $uid = $request->input("uid");
        $name = $request->input("name");

        $token = $request->input("token", $this->create_app_user_token($appId,$uid));
        $appUser = new AppUser();
        $appUser->appid = $appId;
        $appUser->uid = $uid;
        $appUser->token = $token;
        $appUser->name = $name;
        $appUser->save();

        return $this->json_return(0,"success");
    }

    public function del_app_user(Request $request)
    {
        $appid = $request->input("appid");
        $uid = $request->input("uid");
        $appUser = AppUser::where("appid",$appid)->where("uid",$uid)->first();
        if (!empty($appUser))
        {
            $appUser->delete();
            return $this->json_return(0,"success");
        }
        return $this->json_return(-1,"user not found");

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


    public function update_app_user_token(Request $request)
    {
        $appid = $request->input("appid");
        $uid = $request->input("uid");

        $appUser = AppUser::where("appid",$appid)->where("uid",$uid)->first();

        if (!empty($appUser))
        {
            $token = (new Builder())->setIssuer('http://sdo.com') // Configures the issuer (iss claim)
            ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
            ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
            ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
            ->set('appid', $appid) // Configures a new claim, called "uid"
            ->set("uid",$uid)
                ->getToken(); // Retrieves the generated token


            $appUser->token = $token;
            $appUser->save();
            return $this->json_return(0,"success");

        }

        return $this->json_return(-1,"user not found");
    }

    public function create_app_token($appId)
    {
//        $customClaims = ['appid' => $appId ];
//
//        $payload = JWTFactory::make($customClaims);
//
//        $token = JWTAuth::encode($payload);
//
//        return $token;



        $signer = new Sha256();

        $token = (new Builder())
//            ->setIssuer('http://sdo.com') // Configures the issuer (iss claim)
//        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
//        ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
//        ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
        ->set('appid', $appId) // Configures a new claim, called "uid"
                ->sign($signer,"&^!s0,1k3ted!^&!")
        ->getToken(); // Retrieves the generated token

        return $token;
    }

    public function create_app_user_token($appid,$uid)
    {
        $signer = new Sha256();

        $token = (new Builder())
//            ->setIssuer('http://sdo.com') // Configures the issuer (iss claim)
//        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
//        ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
//        ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
        ->set('appid', $appid) // Configures a new claim, called "uid"
            ->set("uid",$uid)
            ->sign($signer,"&^!s0,1k3ted!^&!")
        ->getToken(); // Retrieves the generated token

        return $token;
    }


    public function add_user_app(Request $request)
    {
        $uid = $request->input("uid");
        $appId = $request->input("appid");

        $userApp = UserApp::where("uid",$uid)->where("appid",$appId)->first();
        if (empty($userApp))
        {
            $userApp = new UserApp();
            $userApp->uid   = $uid;
            $userApp->appid = $appId;
            $userApp->save();
        }
        return $this->json_return(0,"success");
    }


    public function del_user_app(Request $request)
    {
        $uid = $request->input("uid");
        $appId = $request->input("appid");
        $userApp = UserApp::where("uid",$uid)->where('appid',$appId)->first();
        if (!empty($userApp))
        {
            $userApp->delete();
            return $this->json_return(0,"success");
        }

        return $this->json_return(-1,"not found");
    }

}
