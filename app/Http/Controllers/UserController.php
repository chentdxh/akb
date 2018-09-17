<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function add_system_user(Request $request)
    {
        $name = $request->input("name");
        $phone = $request->input("phone");

        $email = $request->input("email");
        $password = $request->input("password");

        $user = User::where("email",$email)->first();
        if (empty($user))
        {
            $user = new User();
            $user->uid = uniqid("u");
            $user->name = $name;
            $user->email = $email;
            $user->role = $request->input("role");
            $user->password =  Hash::make($password);
            $user->save();
            return $this->json_return(0,"success");
        }

        return $this->json_return(-1,"failed");
    }


    public function del_system_user(Request $request)
    {
        $uid = $request->input("uid");
        $user = User::where("uid",$uid)->first();
        if (!empty($user))
        {
            $user->delete();
            return $this->json_return(0,"success");
        }
        return $this->json_return(-1,"user not found");
    }


    public function user_info(Request $request)
    {
        //$user = new User();
        $user = User::first();
        $user->name = "arthur";
        $user->uid = "u39sa9300dssax";

        return $user;

    }
}
