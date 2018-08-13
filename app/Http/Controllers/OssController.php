<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OSS\OssClient;
use OSS\Core\OssException; 

class OssController extends Controller
{
    //

    public function upload()
    {

        $accessKeyId = "LTAItvTh9k4gtApw";
        $accessKeySecret = "AFQBZQIdBZPuZp4Rapg8S7hOG28G4l";
        $endpoint = "oss-cn-beijing-internal.aliyuncs.com";
        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);


            $bucket= "uoozu";
            $object = "hello.txt";
            $content = "Hello, OSS!"; // Content of the uploaded file

                $rst = $ossClient->putObject($bucket, $object, $content);


                logger("result is ");
                logger(json_encode($rst));

                logger("upload success");


        } catch (OssException $e) {

            logger("upload error");
            print $e->getMessage();
        }

    }
}
