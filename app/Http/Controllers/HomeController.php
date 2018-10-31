<?php

namespace App\Http\Controllers;

use App\AppInfo;
use App\AppUser;
use App\UserApp;
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



    public function test(Request $request)
    {
        return view("test");
    }


    public function demo(Request $request)
    {
        return view("demo");
    }


    public function files(Request $request)
    {
        return view("file.list");
    }



}
