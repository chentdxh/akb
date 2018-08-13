<?php

namespace App\Http\Controllers;

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
        $userApps = UserApp::where("uid",$uid)->get();
        $data['user_apps'] = $userApps;
        return view("admin.user_apps",$data);
    }

}
