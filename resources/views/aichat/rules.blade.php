

@extends('adminlte::page')

@section('title', 'Ai Rules')

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
                    <th>名称</th>
                    <th>AppId</th>
                    <th>状态</th>
                    <th  >创建时间</th>
                    <th>操作</th>
                </tr>
                @foreach($rules as $rule )
                <tr>
                    <td>{{$rule->id}}.</td>
                    <td>{{$rule->name}}</td>
                    <td>
                       {{$rule->appid}}
                    </td>
                    <td>{{$rule->status}}</td>
                    <td>{{$rule->created_at}}</td>
                    <td>

                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ... <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/app/edit?id={{$rule->id}}">编辑</a></li>

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





