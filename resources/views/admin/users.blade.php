{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">用户列表</h3>


            <div class="box-tools">

                <a type="button" class="btn   btn-default btn-sm  pull-right" data-toggle="modal" data-target="#addUserDialog">添加</a>

            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <table class="table table-bordered">
                <tbody>

                <tr>
                    <th style="width: 10px">#</th>

                    <th>用户</th>
                    <th>角色</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                @foreach($users as $user )
                    <tr>
                        <td>{{$user->id}}.</td>

                        <td>{{$user->name}}</td>
                        <td>
                            <a href="#"  >{{$user->role}}</a>
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


    <div class="modal fade" id="addUserDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add System User</h4>
                </div>
                <div class="modal-body">
                    <form id="userForm">





                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
                        </div>


                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="inputPassword">pasword</label>
                            <input type="text" name="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="inputAppId">Role</label>
                            <select class="form-control" id="inputRole" name="role">

                                <option value="normal">Normal</option>

                                <option value="admin">Admin</option>

                                <option value="super">Super</option>


                            </select>
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

                add_user:function()
                {

                    post_request("/serve/system/user/add",$("#userForm").serialize(),function (res) {

                        show_success_dialog("Add System User Success","reload")

                    })
                } ,
                del_user:function (appid,uid) {

                    show_delete_dialog("/serve/system/user/del",{uid:uid});


                }

            }


        });

    </script>
@stop


