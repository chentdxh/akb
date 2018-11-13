<?php

namespace App\Http\Controllers;

use App\FileInfo;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    use FileTrait;


    public function upload(Request $request)
    {

        $disk = "data";

        $file = $request->file('file');

        $fileHash = hash_file('md5', $file->path());

        $rst = $this->save_to_disk($disk);


        $idtype = $request->input("idtype");


        if (!empty($rst)) {

            if (!empty($idtype))
            {

                logger("file name is ".$file->getClientOriginalName());
                $fileInfo = FileInfo::where("fid",$file->getClientOriginalName())->first();
                if (empty($fileInfo))
                {
                    $fileInfo = new FileInfo();

                }

                $fileInfo->fid = $file->getClientOriginalName();


            }else {

                $fileInfo = new FileInfo();
                $fileInfo->fid = uniqid("f");
            }





            $fileInfo->mime_type = $rst['mime_type'];

            $fileInfo->size = $rst['file_size'];
            $fileInfo->path = $rst['path'];

            $fileInfo->name = $rst['name'];
            $fileInfo->file = $rst['file'];
            $fileInfo->url  = $rst['url'];

            $fileInfo->hash = $fileHash;

            $fileInfo->save();

            $cloud = $request->input("cloud");
            if ($cloud == "tencent")
            {
                $rst = $this->upload_tencent_cloud($fileInfo);


                if (!empty($rst))
                {
                   $fileInfo->cloud_url = $rst['ObjectURL'];
                }
            }else if ($cloud == "aliyun")
            {
                $rst = $this->upload_aliyun_cloud($fileInfo);
                if (!empty($rst))
                {
                    $fileInfo->cloud_url = $rst['oss-request-url'];
                }
            }

            return $this->json_return(0, "success", $fileInfo);

        } else {
            return $this->json_return(-1, "upload file failed");
        }
    }

    public function remove(Request $request)
    {
        $fid = $request->input("fid");

        $fileInfo = FileInfo::where("fid",$fid)->first();


        if (!empty($fileInfo))
        {
            $fileInfo->delete();
            return $this->json_return(0,"success");
        }

        return $this->json_return(-1,"file not found");
    }

    public function download(Request $request)
    {
        $fid = $request->input("fid");
        $fileInfo = FileInfo::where("fid",$fid)->first();
        if (!empty($fileInfo)){

            $fileInfo->increment("visits");

            return response()->download($fileInfo->url);
        }

        return abort(404);

    }
}
