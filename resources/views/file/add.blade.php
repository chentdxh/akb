


{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', '添加文件')

@section("css")
    <link rel="stylesheet" type="text/css" href="/libs/webuploader-0.1.5/webuploader.css">

@stop


@section('content_header')
    <h1>添加文件</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title" >上传文件</h3>
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
                        <input type="text" class="form-control" id="fileName" name="fileName" placeholder="文件名称" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileSize" class="col-sm-2 control-label">文件大小</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fileSize" name="fileSize" placeholder="文件大小" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileUrl" class="col-sm-2 control-label">Url地址</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fileUrl" name="fileUrl" placeholder="Url地址" readonly>
                    </div>
                </div>
            </div>

        </form>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="#!" class=" "  id="uploadBtn" >上传</a>
                <a href="#!" type="button" class="btn btn-primary  "  id="uploadCloudBtn"   >上传腾讯云</a>
            </div>
            <!-- /.box-footer -->

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('vuejs')

    <script type="text/javascript" src="/libs/webuploader-0.1.5/webuploader.html5only.min.js"></script>



    <script>


        $(function () {




            $("#uploadBtn").click(function (event) {

                if (event) event.preventDefault();
                window.uploader = WebUploader.create({
                    auto: true,
                    // 文件接收服务端。
                    server: '/data/file/upload',

                    // 选择文件的按钮。可选。
                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                    pick: {id: "#uploadBtn", multiple: false},
                    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                    resize: false,
                    accept: {
                        title: '请选择上传文件',
                        extensions: '*',
                        mimeTypes: '*/*'
                    }
                });




                window.uploader = WebUploader.create({
                    auto: true,
                    // 文件接收服务端。
                    server: '/data/file/upload',

                    // 选择文件的按钮。可选。
                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                    pick: {id: "#uploadBtn", multiple: false},
                    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                    resize: false,
                    accept: {
                        title: '请选择上传文件',
                        extensions: '*',
                        mimeTypes: '*/*'
                    }
                });
                window.uploader.on("fileQueued", function (file) {

                })
                window.uploader.on("uploadProgress", function (file, percentage) {

                    console.log("percentage is " + percentage)
                    var value = percentage * 100;


                });

                window.uploader.on('uploadSuccess', function (file, res) {

                    if (res.code == 0) {

                        swal("上传成功!", "", "success").then((value) => {
                            //  window.location.reload();

                            $("#fileId").val(res.data.fid);
                            $("#fileName").val(res.data.name);
                            $("#fileSize").val(res.data.size);
                            $("#fileUrl").val(res.data.url);

                        });
                    }else
                    {
                        swal("上传失败!", res.msg, "error").then((value) => {

                        });
                    }

                });

                window.uploader.on( 'uploadError', function( file ) {
                    console.log(file);
                    swal("上传失败!", "", "error").then((value) => {

                    });
                });
                window.uploader.on('uploadComplete', function (file) {
                    console.log(file);

                    self.uploader.reset();

                });


            })



            $("#uploadCloudBtn").click(function (event) {

                if (event) event.preventDefault();


                window.uploader = WebUploader.create({
                    auto: true,
                    // 文件接收服务端。
                    server: '/data/file/upload?cloud=tencent',

                    // 选择文件的按钮。可选。
                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                    pick: {id: "#uploadBtn", multiple: false},
                    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                    resize: false,
                    accept: {
                        title: '请选择上传文件',
                        extensions: '*',
                        mimeTypes: '*/*'
                    }
                });





                window.uploader = WebUploader.create({
                    auto: true,
                    // 文件接收服务端。
                    server: '/data/file/upload',

                    // 选择文件的按钮。可选。
                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                    pick: {id: "#uploadBtn", multiple: false},
                    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                    resize: false,
                    accept: {
                        title: '请选择上传文件',
                        extensions: '*',
                        mimeTypes: '*/*'
                    }
                });
                window.uploader.on("fileQueued", function (file) {

                })
                window.uploader.on("uploadProgress", function (file, percentage) {

                    console.log("percentage is " + percentage)
                    var value = percentage * 100;


                });

                window.uploader.on('uploadSuccess', function (file, res) {

                    if (res.code == 0) {

                        swal("上传成功!", "", "success").then((value) => {
                            //  window.location.reload();

                            $("#fileId").val(res.data.fid);
                            $("#fileName").val(res.data.name);
                            $("#fileSize").val(res.data.size);
                            $("#fileUrl").val(res.data.url);

                        });
                    }else
                    {
                        swal("上传失败!", res.msg, "error").then((value) => {

                        });
                    }

                });

                window.uploader.on( 'uploadError', function( file ) {
                    console.log(file);
                    swal("上传失败!", "", "error").then((value) => {

                    });
                });
                window.uploader.on('uploadComplete', function (file) {
                    console.log(file);

                    self.uploader.reset();

                });


            })





        });


    </script>
@stop



