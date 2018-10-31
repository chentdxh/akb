{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'System Users')

@section('content_header')
    <h1>文件列表</h1>
@stop

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">文件列表</h3>
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
                    <th>文件Id</th>
                    <th>文件名</th>
                    <th>大小</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                @foreach($files as $file )
                    <tr>
                        <td>{{$file->id}}.</td>
                        <td><a href="/data/file/download?fid={{$file->fid}}">{{$file->fid}}</a></td>

                        <td>{{$file->name}}</td>
                        <td>
                            {{$file->size}}
                        </td>
                        <td>{{$file->created_at}}</td>
                        <td>
                             {{--<a href="{{"/".$file->url}}" download>下载</a>--}}
                            <a href="/data/file/download?fid={{$file->fid}}">下载</a>

                            <a href="#!" v-on:click="del_file('{{$file->fid}}',$event)">删除</a>
                        </td>
                    </tr>
                @endforeach

                </tbody></table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">

            {{$files->links()}}
        </div>
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

                del_file:function(fid,event)
                {

                    show_delete_dialog("/data/file/remove",{fid:fid},function(res){

                        swal("删除成功");

                    })
                }


            }


        });

    </script>
@stop


