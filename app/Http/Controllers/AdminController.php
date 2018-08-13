<?php

namespace App\Http\Controllers;

use App\AppInfo;
use App\User;
use Illuminate\Http\Request;
use App\UserApp;

class AdminController extends Controller
{
    //


    public function users()
    {
        $users = User::paginate(20);
        $data['users'] = $users;

        return view("admin.users",$data);
    }


    public function user_apps(Request $request)
    {
        $uid = $request->input("uid");
        $user =  empty($uid)?$this->get_user():User::where("uid",$uid)->first() ;
        $data['user'] = $user;


        $data['user_apps'] = UserApp::where("uid",$user->uid)->get();
        $data['all_apps'] = AppInfo::get();

        return view("admin.user_apps",$data);
    }

}
