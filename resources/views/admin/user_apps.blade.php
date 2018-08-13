{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'User Apps')

@section('content_header')
    <h1>User Apps</h1>
@stop

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User Apps</h3>
            {{--<div class="box-tools">--}}
                {{--<a type="button" class="btn   btn-default btn-sm  pull-right" data-toggle="modal" data-target="#addUserDialog">添加</a>--}}
            {{--</div>--}}

        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <select multiple="multiple" id="my-select" name="my-select[]">
                <option value='elem_1'>elem 1</option>
                <option value='elem_2'>elem 2</option>
                <option value='elem_3'>elem 3</option>
                <option value='elem_4'>elem 4</option>
                ...
                <option value='elem_100'>elem 100</option>
            </select>


            <table class="table table-bordered">
                <tbody>

                <tr>
                    <th style="width: 10px">#</th>
                    <th>用户</th>
                    <th>角色</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                @foreach($user_apps as $userApp )
                    <tr>
                        <td>{{$userApp->id}}.</td>

                        <td>{{$userApp->name}}</td>
                        <td>
                            <a href="#"  >{{$userApp->role}}</a>
                        </td>
                        <td>{{$userApp->created_at}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">


                                    <li><a href="#">Permissions</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#" v-on:click="del_user('{{$userApp->appid}}','{{$userApp->uid}}')">Delete</a></li>

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
            {{$user_apps->links()}}
        </div>
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">

    <link rel="stylesheet" href="/libs/multiselect/css/multi-select.css">
@stop

@section('js')

    <script   src="/libs/multiselect/js/jquery.multi-select.js" />
@stop




@section("vuejs")
    <script>


        $(document).ready(function(){
            $('#my-select').multiSelect()
        })


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


