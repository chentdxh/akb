<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use Auth;
use App\FileInfo;
use Qcloud\Cos\Client  as CosClient;

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




    public function upload_tcloud($fileInfo)
    {
        logger("upload to tencent cloud ".$fileInfo->fid);

//        $fileInfo = FileInfo::where("fid", $fid)->first();

        if (!empty($fileInfo)) {

            $bucket = 'akb-1255540445';

 

            $cosClient = new CosClient(array(
                'region' => env('COS_REGION'), #地域，如ap-guangzhou,ap-beijing-1
                'credentials' => array(
                    'secretId' => env("COS_SECRET_ID"),
                    'secretKey' => env("COS_SECRET_KEY"),
                ),
            ));

            ### 上传文件流
            try {
                $result = $cosClient->putObject(array(
                    'Bucket' => $bucket,
                    'Key' => $fileInfo->fid,
                    'Body' => Storage::disk("data")->get($fileInfo->url)));

                print_r($result);
            } catch (\Exception $e) {
               dd($e);
            }

        }
    }



}
