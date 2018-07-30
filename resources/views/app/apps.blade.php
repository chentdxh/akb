

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

                <a type="button" class="btn   btn-default btn-sm  pull-right" data-toggle="modal" data-target="#addAppUserDialog">添加</a>



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



    <div class="modal fade" id="addAppUserDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add App User</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="inputEmail">uid</label>
                            <input type="text" class="form-control" id="inputEmail" placeholder="Uid">
                        </div>

                        <div class="form-group">
                            <label for="inputName">name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
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
    <script> console.log('Hi!'); </script>
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
        }
    }


    });

    </script>
@stop


