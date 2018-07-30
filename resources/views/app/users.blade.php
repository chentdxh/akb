

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>App 用户管理</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">用户列表</h3>


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
                    <th>App</th>
                    <th>用户</th>
                    <th>Token</th>
                    <th  >创建时间</th>
                </tr>
                @foreach($users as $user )
                <tr>
                    <td>{{$user->id}}.</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                       {{$user->token}}
                    </td>
                    <td>{{$user->created_at}}</td>
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

                        <input type="hidden" name="appid" value="{{$app_info->appid}}" />
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
                    <button type="button" class="btn btn-primary" v-on:click="add_user">Save</button>
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
                add_user:function()
                {
                    $.ajax({
                        url:"/serve/app/user/add",
                        type:"post",
                        data:$("#userForm").serialize(),
                        success:function (res) {
                            if (res.code ==0)
                            {
                                swal({type:"success",title:"Add User Success"})
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


