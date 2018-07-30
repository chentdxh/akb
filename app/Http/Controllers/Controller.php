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

}
