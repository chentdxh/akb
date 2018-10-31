{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'System Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">文件列表</h3>
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
                    <th>文件名</th>
                    <th>大小</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                @foreach($files as $file )
                    <tr>
                        <td>{{$file->id}}.</td>

                        <td>{{$file->name}}</td>
                        <td>
                            {{$file->size}}
                        </td>
                        <td>{{$file->created_at}}</td>
                        <td>
                             <a href="{{$file->url}}">下载</a>

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


