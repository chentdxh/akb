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

@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop