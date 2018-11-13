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


        <div id="fine-uploader">
        </div>




        <!-- /.box-body -->
        <div class="box-footer text-center">
            <a href="#!" class=" " id="uploadFileBtn">上传</a>

            <a href="#!" class=" " id="uploadBtn">上传Id</a>
            <a href="#!" id="uploadTencentBtn">上传腾讯云</a>
            <a href="#!" id="uploadAliyunBtn">上传阿里云</a>
        </div>
        <!-- /.box-footer -->

    </div>


    <script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Upload a file</div>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>


    
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

                debug: true,
                element: document.getElementById(btnId),
                request: {
                    endpoint: url
                }
            })
        };



        $(function () {

            create_uploader("fine-uploader");

            // create_uploader("uploadFileBtn", "/data/file/upload");
            //
            // create_uploader("uploadBtn", "/data/file/upload?idtype=file");
            //
            // create_uploader("uploadTencentBtn", "/data/file/upload?cloud=tencent");
            //
            // create_uploader("uploadAliyunBtn", "/data/file/upload?cloud=aliyun");

        });


    </script>
@stop



