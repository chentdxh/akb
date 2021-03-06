@extends('adminlte::page')

@section('title', 'App User Manager')

@section('content_header')
    <h1>App 用户管理</h1>
@stop
@section("css")

    <style type="text/css">
        textarea {
            resize: none;
        }
    </style>
@stop

@section('content')


    @if(!empty($app_info))

        <div class="box ">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>

                <h3 class="box-title">App Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>AppId </dt>
                    <dd>{{$app_info->appid}}</dd>
                    <dt>Name</dt>
                    <dd>{{$app_info->name}}</dd>

                    <dt>Owner</dt>
                    <dd>{{$app_info->uid}}</dd>

                    <dt>Created At</dt>
                    <dd>{{$app_info->created_at}}</dd>

                    <dt>Token</dt>
                    <dd style="  word-wrap: break-word;">{{$app_info->token}}</dd>

                </dl>
            </div>
            <!-- /.box-body -->
        </div>


    @endif


    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">App用户列表</h3>


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
                    <th>AppId</th>
                    <th>用户</th>
                    <th>Token</th>
                    <th  >创建时间</th>
                    <th>操作</th>
                </tr>
                @foreach($users as $user )
                <tr>
                    <td>{{$user->id}}.</td>
                    <td>{{$user->appid}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                        <a href="#" v-on:click="show_token('{{$user->token}}')">{{substr($user->token,0,8)}}...</a>
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">


                                <li role="separator" class="divider"></li>
                                <li><a href="#" v-on:click="del_user('{{$user->appid}}','{{$user->uid}}')">Delete</a></li>

                                <li><a href="#" v-on:click="update_token('{{$user->appid}}','{{$user->uid}}')">Update Token</a></li>


                            </ul>
                        </div>

                    </td>
                </tr>
                @endforeach

                </tbody></table>
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
            {{$users->links()}}
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
                    <form id="userForm">
                        @if(!empty($app_info))
                            <input type="hidden" name="appid" value="{{$app_info->appid}}" />
                        @else



                            <div class="form-group">
                                <label for="inputAppId">AppId</label>
                                <select class="form-control" id="inputAppId" name="appid">
                                    @foreach($apps as $appInfo)
                                        <option value="{{$appInfo->appid}}">{{$appInfo->appid}}</option>
                                    @endforeach

                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="inputUid">uid</label>
                            <input type="text" name="uid" class="form-control" id="inputUid" placeholder="Uid">
                        </div>


                        <div class="form-group">
                            <label for="inputName">name</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="add_user" data-dismiss="modal">Save</button>
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
                add_user:function()
                {

                    post_request("/serve/app/user/add",$("#userForm").serialize(),function (res) {

                        show_success_dialog("Add User Success","reload")
                        
                    })
                },update_token:function (appid,uid) {

                    post_request("/serve/app/user/token/update",{appid:appid,uid:uid},function (res) {

                        show_success_dialog("Update User Token Success","reload")
                    })
                },
                del_user:function (appid,uid) {

                    show_delete_dialog("/serve/app/user/del",{appid:appid,uid:uid});

                    
                }

            }


        });

    </script>
@stop


