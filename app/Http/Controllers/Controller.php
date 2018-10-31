<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function json_return($code, $msg = "ok", $data = null, $toUrl = null)
    {
        $result = array("code" => $code, "msg" => $msg);

        if (!empty($data)) {
            $result['data'] = $data;
        }

        if (\Request::ajax()) {
            return response()->json($result);
        } else {
            $toUrl = empty($toUrl) ? \Request::input('to') : $toUrl;
            if (empty($toUrl)) {
                return response()->json($result);
            }
            return \Redirect::to($toUrl);
        }

    }



    public function get_user()
    {
        return Auth::user();
    }



    public function join_path()
    {
        $args = func_get_args();
        $paths = array();
        $i = 0;
        foreach ($args as $arg) {


            if ($i > 0 )
            {
                $arg = trim($arg,"/");
            }

            if (!empty($arg))
            {
                $paths = array_merge($paths, (array)$arg);
            }

            $i ++;
        }
        $paths = array_map(function($p){
            return rtrim($p, "/");
        },$paths);

        // $paths = array_map(create_function('$p', 'return rtrim($p, "/");'), $paths);
        $paths = array_filter($paths);
        return join('/', $paths);
    }

}
