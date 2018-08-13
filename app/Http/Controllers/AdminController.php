<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //


    public function users()
    {
        $users = User::paginate(20);
        $data['users'] = $users;

        return view("admin.users",$data);
    }
}
