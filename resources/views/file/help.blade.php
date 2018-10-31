{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'System Users')

@section('content_header')
    <h1>接口列表</h1>
@stop

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">接口列表</h3>
            <div class="box-tools">
                <a role="button" class="btn   btn-default btn-sm  pull-right"  href="/file/add">添加</a>
            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <table class="table table-bordered">
                <tbody>

                <tr>
                    <th style="width: 10px">#</th>
                    <th>接口</th>
                    <th>说明</th>

                </tr>

                    <tr>
                        <td>1.</td>

                        <td>/data/file/upload</td>
                        <td>
                           上传接口
                        </td>

                    </tr>

                <tr>
                    <td>2.</td>

                    <td>/data/file/download?fid=</td>
                    <td>
                        下载接口
                    </td>

                </tr>

                </tbody></table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">

        </div>
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')

@stop



