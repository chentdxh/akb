

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>App 用户管理</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">用户列表</h3>
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop





