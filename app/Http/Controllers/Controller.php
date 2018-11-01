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
use Storage;
use OSS\OssClient;


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

    public function upload_aliyun_cloud($fileInfo)
    {

        $accessKeyId = "LTAItvTh9k4gtApw";
        $accessKeySecret = "AFQBZQIdBZPuZp4Rapg8S7hOG28G4l";
        $endpoint = "oss-cn-beijing-internal.aliyuncs.com";
        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

            $bucket= "uoozu";
            $object = $fileInfo->fid;
            $fileExt = pathinfo($fileInfo->name, PATHINFO_EXTENSION);
            $fullPath  = storage_path($fileInfo->url);

            $diskPath = $fileInfo->path.$fileInfo->file;

            logger("full path is :".$fullPath);
            //$content = fopen($fullPath,'rb'); // Content of the uploaded file

            $content = Storage::dist("data")->get($diskPath);

            $rst = $ossClient->putObject($bucket, $object, $content);


            logger("result is ");
            logger(json_encode($rst));

            logger("upload success");

            return $rst;


        } catch (OssException $e) {

            logger("upload error");
            print $e->getMessage();
        }

        return null;
    }


    public function upload_tencent_cloud($fileInfo)
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

            $fileExt = pathinfo($fileInfo->name, PATHINFO_EXTENSION);
            $fullPath  = storage_path($fileInfo->url);

            $fileKey = $fileInfo->fid;
            if (!empty($fileExt))
            {
            //    $fileKey = $fileInfo->fid.".".$fileExt;
            }

            ### 上传文件流
            try {
                logger("start upload to tencent cloud ".$fileInfo->url);
                $result = $cosClient->putObject(array(
                    'Bucket' => $bucket,
                    'Key' => $fileKey,
                    'Body' =>fopen($fullPath,'rb')));

              logger( print_r($result,true));


                logger("upload result success");
                return $result;

            } catch (\Exception $e) {
                    logger($e->getMessage());
            }

        }else{

            logger("file not found");
        }

        return null;
    }



}
