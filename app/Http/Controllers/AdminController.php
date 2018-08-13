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
        $user = User::where('uid',$uid)->first();
        $data['user'] = empty($uid)?$this->get_user():$user ;

        $userApps = UserApp::where("uid",$uid)->paginate();
        $data['user_apps'] = $userApps;
        $data['all_apps'] = AppInfo::all();



        return view("admin.user_apps",$data);
    }

}
