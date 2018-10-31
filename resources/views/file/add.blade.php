


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
            <h3 class="box-title" id="uploadBtn">上传文件</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="appForm">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">文件名称</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="App名称" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAppId" class="col-sm-2 control-label">文件大小</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAppId" name="appid" placeholder="App Id" readonly>
                    </div>
                </div>



                {{--<div class="form-group">--}}
                    {{--<div class="col-sm-offset-2 col-sm-10">--}}
                        {{--<div class="checkbox">--}}
                            {{--<label>--}}
                                {{--<input type="checkbox"> Remember me--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>

        </form>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="button" class="btn btn-default">取消</button>
                <button type="button" id="saveBtn" class="btn btn-info pull-right" v-on:click="add_post">提交</button>
            </div>
            <!-- /.box-footer -->

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('vuejs')

    <script type="text/javascript" src="/libs/webuploader-0.1.5/webuploader.html5only.min.js"></script>
    <script type="text/javascript" src="/js/uploader.js"></script>


    <script>


        $(function () {


            var uploader = create_uploader("upload");
        });
9
        var app = new Vue({
            el: '.wrapper',

            data: {

            },
            methods:{
                add_post:function () {
                    $.ajax({
                        url:"/serve/app/add",
                        type:"post",
                        data:$("#appForm").serialize(),
                        success:function (res) {
                            swal({type:"success",title:"添加成功！"});

                        },error:function (res) {

                        }
                    })

                }
            }
        })




    </script>
@stop