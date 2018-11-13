{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', '批量添加文件')

@section("css")
    <link rel="stylesheet" type="text/css" href="/libs/fine-uploader/fine-uploader.min.css">

@stop


@section('content_header')
    <h1>添加文件</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">上传文件</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="appForm">
            <div class="box-body">

                <div class="form-group">
                    <label for="fileId" class="col-sm-2 control-label">文件id</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fileId" name="fileId" placeholder="文件id" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileName" class="col-sm-2 control-label">文件名称</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fileName" name="fileName" placeholder="文件名称"
                               readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileSize" class="col-sm-2 control-label">文件大小</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fileSize" name="fileSize" placeholder="文件大小"
                               readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileUrl" class="col-sm-2 control-label">Url地址</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fileUrl" name="fileUrl" placeholder="Url地址"
                               readonly>
                    </div>
                </div>


                <div class="form-group">
                    <label for="fileUrl" class="col-sm-2 control-label">云地址</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fileCloudUrl" name="fileCloudUrl"
                               placeholder="云服务Url"
                               readonly>
                    </div>
                </div>
            </div>

        </form>
        <!-- /.box-body -->
        <div class="box-footer text-center">
            <a href="#!" class=" " id="uploadFileBtn">上传</a>

            <a href="#!" class=" " id="uploadBtn">上传Id</a>
            <a href="#!" id="uploadTencentBtn">上传腾讯云</a>
            <a href="#!" id="uploadAliyunBtn">上传阿里云</a>
        </div>
        <!-- /.box-footer -->

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('vuejs')



    <script type="text/javascript" src="/libs/fine-uploader/fine-uploader.min.js"></script>
    <script>
        window.create_uploader = function (btnId, url) {
            var self = this;

            this.uploader =   new qq.FineUploaderBasic({

                element: document.getElementById(btnId)
            })
        };



        $(function () {

            create_uploader("#uploadFileBtn", "/data/file/upload");

            create_uploader("#uploadBtn", "/data/file/upload?idtype=file");

            create_uploader("#uploadTencentBtn", "/data/file/upload?cloud=tencent");

            create_uploader("#uploadAliyunBtn", "/data/file/upload?cloud=aliyun");

        });


    </script>
@stop



