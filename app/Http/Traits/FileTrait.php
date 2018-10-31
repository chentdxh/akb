<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/2/22
 * Time: 下午2:03
 */

namespace App\Http\Traits;


use Log;
use Storage;
use Request;
use App\Http\Controllers\Controller;


trait FileTrait
{



    private $forbidden_files = array("php","js","sh","py","rb","exe");



    public function create_disk_link($diskName)
    {
        $diskPath = Controller::join_path(storage_path($diskName));

        $ret = file_exists($diskPath);
        if (!$ret) {
            logger("make disk root" . $diskPath);
            mkdir($diskPath);
        }

        $disk = Storage::disk($diskName);


        if (empty($disk))
        {
            Log::error("disk ".$diskName." is not existed, set it in config");
            return false;
        }

        $resDir = config("app.res_path","res");
        if (empty($resDir))
        {
            $resDir = "res";
        }


        $resRoot = public_path($resDir);

        $ret = file_exists($resRoot);
        if (!$ret) {

            logger("make res root path" . $resRoot);
            mkdir($resRoot);
        }

        $linkPath = public_path(Controller::join_path($resDir,$diskName));

        $ret = file_exists($linkPath);

        if ($ret) {
            return true;
        }

        $diskRoot = $disk->getDriver()->getAdapter()->getPathPrefix();

        $this->create_symbol($diskRoot,$linkPath);

        return true;
    }



    //create symbol link for resource in public folder
    public function create_res_link($disk, $resDir)
    {

        $resRoot = public_path(config("app.res_path"));
        $ret = file_exists($resRoot);

        if (!$ret) {

            logger("make res root" . $resRoot);
            mkdir($resRoot);
        }

        $linkPath = public_path(config("app.res_path") . DIRECTORY_SEPARATOR . $resDir);

        $ret = file_exists($linkPath);

        if ($ret) {
            return true;
        }

        $diskRoot = $disk->getDriver()->getAdapter()->getPathPrefix();

        $this->create_symbol($diskRoot,$linkPath);
//
//        $linkCmd = "ln -s  '" . $diskRoot . "'    '" . $linkPath . "'";
//        logger("create resource symbol link ");
//        $ret = system($linkCmd);
        return true;
    }

    public function create_symbol($path,$linkPath)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {

            $linkCmd = 'mklink /J  "' . $linkPath . '"    "' . $path . '"';

            logger("create resource symbol link  from ".$path."  to ".$linkPath);
            $ret = system($linkCmd);
            return $ret;

        } else {


            $linkCmd = "ln -s  '" . $path . "'    '" . $linkPath . "'";
            logger("create resource symbol link  from ".$path."  to ".$linkPath);
            $ret = system($linkCmd);
            return $ret;
        }
    }

    //get the file's dir ,day is different
    public function get_disk_path($disk)
    {
        $diskDir = date("Y") . "/" . date("m") . "/" . date("d") . "/";


        if ($disk->exists($diskDir)) {
            logger("exist disk dir " . $diskDir);
            return $diskDir;
        } else {

            logger("not exist disk dir " . $diskDir);
            $ret = $disk->makeDirectory($diskDir);
            if ($ret) {


                logger("make dir success " . $diskDir);
            } else {
                logger("make dir failed " . $diskDir);
            }
        }

        return $diskDir;
    }

    public function get_user_path($uid)
    {

    }

    //get the resource's url in public folder
    public function get_disk_url($filePath, $diskLabel)
    {

        return "/" . Controller::join_path(config("app.res_path") , $diskLabel, $filePath);
        // return "/" . config("app.res_path") . "/" . $diskLabel . "/" . $filePath;
    }

    public function delete_disk_file($diskLabel,$file)
    {
        $disk = Storage::disk($diskLabel);
        $disk->delete($file);
    }


    public function save_to_disk($diskLabel,$diskPath=null,$prefix="f",$fileTag = "file")
    {
        $file = Request::file($fileTag);
        if (empty($file)) {
            logger("no upload file");
            return null;
        }

        if (!empty($file) && $file->isValid()) {

            $disk = Storage::disk($diskLabel);

            if (empty($disk))
            {
                Log::error("disk ".$diskLabel." is not existed, get the default disk");

                $disk = Storage::disk("data");
            }

            $diskRoot = $disk->getDriver()->getAdapter()->getPathPrefix();
            //$diskPrefix = substr($diskRoot, strlen(public_path()));
            logger("disk root is " . $diskRoot);

            $this->create_res_link($disk,$diskLabel);


            if ($diskPath == null)
            {
                $fileDir = $this->get_disk_path($disk);
            }else
            {

                $fileDir = $diskPath;

                if (!$disk->exists($fileDir)) {

                    logger("not exist disk dir " . $fileDir);
                    $ret = $disk->makeDirectory($fileDir);
                    if ($ret) {
                        logger("make dir success " . $fileDir);
                    } else {
                        logger("make dir failed " . $fileDir);
                    }
                }

            }

            //$newFileName = uniqid($prefix) . $file->getClientOriginalName();
            $fileExt = $file->getClientOriginalExtension();
            if (in_array($fileExt,$this->forbidden_files))
            {
                return null;
            }

            $newFileName = uniqid($prefix) . time().(empty($fileExt)?"":".".strtolower($fileExt));


            $destPath = Controller::join_path($diskRoot,$fileDir);
            logger("move to dest path :".$destPath);

            $result['mime_type'] = $file->getMimeType();

            $result['file_size'] = $file->getClientSize();

            //$file->move($diskRoot . $diskPath, $newFileName);
            $file->move($destPath, $newFileName);
            $fullPath =Controller::join_path($destPath, $newFileName);
            logger("full  path is  :".$fullPath);
            //$url = url($diskPrefix.$fileDir . $newFileName);
            //$url = $disk->url($fileDir . $newFileName);
            $url = $this->get_disk_url(Controller::join_path($fileDir , $newFileName), $diskLabel);


            $fileUrl= "/";

            logger(" disk url is ".$url);

            $url = Controller::join_path($fileUrl,$url);
            logger("file url is " . $url);

            $result['title'] = Request::input('file_title');
            $result['desc'] = Request::input('file_desc');
            $result['file'] = $newFileName;
            $result['localurl']  = $url;
            $result['url']  = $url;
            $result['type'] = $file->getClientOriginalExtension();
            //  $result['full_path'] = $fullPath;
            $result['path'] = $fileDir;
            $result['name'] = $file->getClientOriginalName();
            $result['size'] = $file->getClientSize();

            //   $result['disk_root'] = $diskRoot;
            logger("upload file",$result);

            return $result;
        }

        return null;
    }


    //upload file to one disk
    public function upload_to_disk($fileTag = "file", $prefix = "f", $diskLabel = "res")
    {

        $file = Request::file($fileTag);
        if (empty($file)) {
            logger("no upload file");
            return null;
        }


        if (!empty($file) && $file->isValid()) {

            $disk = Storage::disk($diskLabel);

            if (empty($disk))
            {

                Log::error("disk ".$diskLabel." is not existed, get the default disk");

                $disk = Storage::disk("data");
            }

            $diskRoot = $disk->getDriver()->getAdapter()->getPathPrefix();
            //$diskPrefix = substr($diskRoot, strlen(public_path()));

            $this->create_res_link($disk,$diskLabel);

            logger("disk root is " . $diskRoot);

            $fileDir = $this->get_disk_path($disk);

            $newFileName = uniqid($prefix) . $file->getClientOriginalName();

            $destPath = Controller::join_path($diskRoot,$fileDir);
            $file->move($destPath, $newFileName);
            $fullPath =Controller::join_path($destPath, $newFileName);
            logger("full  path is  :".$fullPath);


            //$url = url($diskPrefix.$fileDir . $newFileName);
            //$url = $disk->url($fileDir . $newFileName);
            $url = $this->get_disk_url(Controller::join_path($fileDir , $newFileName), $diskLabel);

            logger("url is ".$url);

            $fileUrl = env("FILE_URL",config("app.app_url"));
            if (empty($fileUrl))
            {
                $fileUrl = url();
            }
            $url = Controller::join_path($fileUrl,$url);
            logger("file url is " . $url);


            $result['title'] = Request::input('file_title');
            $result['desc'] = Request::input('file_desc');
            $result['file'] = $newFileName;
            $result['url']  = $url;
            $result['type'] = $file->getClientOriginalExtension();
            $result['path'] = $fileDir;
            $result['name'] = $file->getClientOriginalName();
            $result['size'] = $file->getClientSize();

            logger("upload file",$result);
            return $result;
        }

        return null;

    }



    protected function _get_file_path()
    {

        $yearDir = 'uploads/' . date("Y");
        $monthDir = $yearDir . "/" . date("m");
        $dayDir = $monthDir . "/" . date("d") . "/";

        if (Storage::exists($dayDir)) {

            logger("exist dir " . $dayDir);
            return $dayDir;
        }
        /*
                if (!Storage::exists($yearDir)) {
                    logger("not exist dir ".$yearDir);
                    Storage::makeDirectory($yearDir);
                }

                if (!Storage::exists($monthDir)) {

                    logger("not exist dir ".$monthDir);
                    Storage::makeDirectory($monthDir);
                }
        */
        if (!Storage::exists($dayDir)) {

            logger("not exist dir " . $dayDir);
            $ret = Storage::makeDirectory($dayDir);
            if ($ret) {
                logger("make dir success " . $dayDir);
            } else {
                logger("make dir failed " . $dayDir);
            }
        }

        return $dayDir;
    }

    protected function _upload_one_file($fileTag = "file", $prefix = "art", $disk = "res")
    {

        $file = Request::file($fileTag);
        if (empty($file)) {
            return false;
        }

        $result["files"] = $file;
        //$result["files"] = $_FILES;

        if (!empty($file) && $file->isValid()) {
            $fileDir = $this->_get_file_path();

            // $extName = $file->getClientOriginalExtension();
            // $newFileName = md5(date('ymdhis'))."_".$file->getClientOriginalName();
            $newFileName = uniqid($prefix) . $file->getClientOriginalName();

            $url = url($fileDir . $newFileName);
            $file->move(public_path() . DIRECTORY_SEPARATOR . $fileDir, $newFileName);
            $result['title'] = Request::input('file_title');
            $result['desc'] = Request::input('file_desc');
            $result['file'] = $newFileName;
            $result['url'] = $url;
            $result['type'] = $file->getClientOriginalExtension();
            $result['path'] = $fileDir;
            $result['name'] = $file->getClientOriginalName();
            $result['size'] = $file->getClientSize();
            return $result;
        }

        return null;

    }



    public function load_file($url)
    {
        $ch = curl_init();
        $timeout = 0;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);

        $fileType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

        curl_close($ch);

        return array("content" => $file_contents, "type" => $fileType);
        //return $file_contents;
    }


    public function save_image($imageUrl)
    {
        Log::info('Downloading image file ' . $imageUrl);
        $fileData = $this->load_file($imageUrl);
        $file = $fileData['content'];
        $fileType = $fileData['type'];

        //$finfo = finfo_open(FILEINFO_MIME, $imageUrl);

        //$file = file_get_contents($imageUrl);

        $fileName = basename($imageUrl);

        //echo $fileName."<br>";
        $fileInfo = pathinfo(basename($fileName));

        //  var_dump($fileInfo);

        $fileDir = $this->_get_file_path();
        if ($fileType == "image/jpeg") {
            $fileInfo['extension'] = "jpg";
        } else if ($fileType == "image/gif") {
            $fileInfo['extension'] = "gif";
        } else if ($fileType == "application/octet-stream" || $fileType == "image/png") {
            $fileInfo['extension'] = "png";
        } else if ($fileType == "image/webp") {
            $fileInfo['extension'] = "webp";
        } else {
            $fileInfo['extension'] = "jpg";
        }

        //    echo ("load file type ".$fileInfo['extension']);
        Log::info("load file type " . $fileInfo['extension']);

        $newFileName = uniqid(date('YmdHis') . rand(1000, 100000)) . '.' . $fileInfo['extension'];

        $newFile = $fileDir . $newFileName;


        //  echo $newFile."<br>";
        $fd = @fopen($newFile, 'wb');
        if ($fd) {

            @fwrite($fd, $file);
            fclose($fd);

            clearstatcache();

            // Set correct file permissions
            $stat = @ stat(dirname($newFile));
            $perms = $stat['mode'] & 0007777;
            $perms = $perms & 0000666;
            @ chmod($newFile, $perms);
            clearstatcache();


            $url = Config::get('app.url') . $fileDir . $newFileName;


            //$url = Config::get('app.url') . $fileDir . $newFileName;


            //      echo $url . "<br>";
            //    echo "<img src='".$url."' >";

            return $url;
            //return array('file' => $newFile, 'url' => $url, 'error' => false);
        } else {

            echo "write image file failed<br>";
        }

        return "";
        //return array('file' => "", 'url' => "", 'error' => true);

    }


    function upload_file($fileInfo, $uploadPath = 'uploads', $flag = true, $allowExt = array('jpeg', 'jpg', 'gif', 'png'), $maxSize = 2097152)
    {
        // 判断错误号
        if ($fileInfo ['error'] > 0) {
            switch ($fileInfo ['error']) {
                case 1 :
                    $mes = '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
                    break;
                case 2 :
                    $mes = '超过了表单MAX_FILE_SIZE限制的大小';
                    break;
                case 3 :
                    $mes = '文件部分被上传';
                    break;
                case 4 :
                    $mes = '没有选择上传文件';
                    break;
                case 6 :
                    $mes = '没有找到临时目录';
                    break;
                case 7 :
                case 8 :
                    $mes = '系统错误';
                    break;
            }
            echo($mes);
            return false;
        }
        $ext = pathinfo($fileInfo ['name'], PATHINFO_EXTENSION);

        if (!is_array($allowExt)) {
            exit('系统错误');
        }
        // 检测上传文件的类型
        if (!in_array($ext, $allowExt)) {
            exit ('非法文件类型');
        }
        //$maxSize = 2097152; // 2M
        // 检测上传文件大小是否符合规范
        if ($fileInfo ['size'] > $maxSize) {
            exit ('上传文件过大');
        }
        //检测图片是否为真实的图片类型
        //$flag=true;
        if ($flag) {
            if (!getimagesize($fileInfo['tmp_name'])) {
                exit('不是真实图片类型');
            }
        }
        // 检测文件是否是通过HTTP POST方式上传上来
        if (!is_uploaded_file($fileInfo ['tmp_name'])) {
            exit ('文件不是通过HTTP POST方式上传上来的');
        }
        //$uploadPath = 'uploads';
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
            chmod($uploadPath, 0777);
        }
        $uniName = md5(uniqid(microtime(true), true)) . '.' . $ext;
        $destination = $this->_get_file_path();
        if (!@move_uploaded_file($fileInfo ['tmp_name'], $destination)) {
            exit ('文件移动失败');
        }

        return $destination;
    }


}
