

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>App 管理</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">App列表</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>

                <tr>
                    <th style="width: 10px">#</th>
                    <th>AppId</th>
                    <th>ServerId</th>

                    <th>内容</th>
                    <th>时间</th>
                    <th>操作</th>
                </tr>
                @foreach($complains as $complain )
                <tr>
                    <td>{{$complain->id}}.</td>
                    <td>
                        {{$complain->app_id}}
                    </td>
                    <td>{{$complain->server_id}}</td>

                    <td>{{$complain->text}}</td>
                    <td>{{date("Y-m-d H:m:s",$complain->time/1000)}}</td>
                    <td>

                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/app/review?id={{$complain->id}}">编辑</a></li>

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

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop





