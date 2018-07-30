<?php

namespace App\Http\Controllers;

use App\AppInfo;
use App\AppUser;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function profile(Request $request)
    {
        return view("profile");
    }


    public function chat_with(Request $request)
    {
        return view("chat.chat");
    }

    public function talk(Request $request)
    {
        return view("chat.talk");
    }


    public function apps(Request $request)
    {

        $user = $this->get_user();
        if ($user->role == "super")
        {
            $apps = AppInfo::orderBy("created_at","desc")->paginate(10);

        }else
        {

            $apps = AppInfo::where("uid",$user->uid)->orderBy("created_at","desc")->paginate(10);
        }

        $data['apps'] = $apps;
        return view("app.apps",$data);

    }

    public function app_users(Request $request)
    {
        $users = AppUser::paginate(20);
        $data['users'] = $users;
        return view("app.users",$data);
    }


    public function add_app(Request $request)
    {
        return view("app.add");
    }

    public function add_app_user(Request $request)
    {
        return view("app.add_user");
    }

    public function test(Request $request)
    {
        return view("test");
    }


    public function demo(Request $request)
    {
        return view("demo");
    }
}
