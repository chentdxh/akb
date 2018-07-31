

@extends('adminlte::page')

@section('title', 'Dashboard')

@section("css")

    <style type="text/css">
        textarea {
            resize: none;
        }
    </style>
    @stop

@section('content_header')
    <h1>App 管理</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">App列表</h3>

            <div class="box-tools">

                <a type="button" class="btn   btn-default btn-sm  pull-right" data-toggle="modal" data-target="#addAppDialog">添加</a>



            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>

                <tr>
                    <th style="width: 10px">#</th>
                    <th>名称</th>
                    <th>AppId</th>
                    <th>Token</th>
                    <th>状态</th>
                    <th  >创建时间</th>
                    <th>操作</th>
                </tr>
                @foreach($apps as $appInfo )
                <tr>
                    <td>{{$appInfo->id}}.</td>
                    <td>{{$appInfo->name}}</td>
                    <td>{{$appInfo->appid}}</td>
                    <td>
                        <a href="#" v-on:click="show_token('{{$appInfo->token}}')">{{substr($appInfo->token,0,8)}}...</a>
                    </td>

                    <td>{{$appInfo->status}}</td>
                    <td>{{$appInfo->created_at}}</td>
                    <td>

                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/app/users?appid={{$appInfo->appid}}">App Detail</a></li>

                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li><a href="#">Separated link</a></li>--}}
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{--<ul class="pagination pagination-sm no-margin pull-right">--}}
                {{--<li><a href="#">«</a></li>--}}
                {{--<li><a href="#">1</a></li>--}}
                {{--<li><a href="#">2</a></li>--}}
                {{--<li><a href="#">3</a></li>--}}
                {{--<li><a href="#">»</a></li>--}}
            {{--</ul>--}}
            {{$apps->links()}}
        </div>
    </div>



    <div class="modal fade" id="addAppDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add App </h4>
                </div>
                <div class="modal-body">
                    <form id="appForm">

                        <div class="form-group">
                            <label for="inputAppId">appid</label>
                            <input type="text" name="appid" class="form-control" id="inputAppId" placeholder="AppId">
                        </div>

                        <div class="form-group">
                            <label for="inputName">name</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="add_app">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')

@stop


@section("vuejs")
    <script >
    const app = new Vue({ el: '#app',
    methods:{
        show_token:function(token)
        {
            swal({ input: 'textarea',
                title:"token 信息",

                inputValue:token,
                inputAttributes: {
                    value: token,
                    readonly: true,
                    rows:10,
                    resize: "none"

                }  })
        },
        add_app:function(){

            $.ajax({
                url:"/serve/app/add",
                type:"post",
                data:$("#appForm").serialize(),
                success:function (res) {
                    if (res.code == 0)
                    {
                        swal({type:"success",title:"Add App Success"}).then((result)=>function () {

                            window.location.reload();
                        })
                    }
                },
                error:function (res) {
                    
                }
            })
        }
    }


    });

    </script>
@stop


