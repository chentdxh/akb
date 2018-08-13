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
        <div class="box-body ">

            <select multiple="multiple" id="appSelect" name="app-select[]">

                @foreach($all_apps as $appInfo )
                    <option value='{{$appInfo->appid}}'>{{$appInfo->name}}</option>
                @endforeach
                @foreach($user_apps as $appInfo)
                    <option value='{{$appInfo->appid}}' selected>{{$appInfo->name}}</option>
                @endforeach

            </select>



        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/libs/multiselect/css/multi-select.css" />
@stop

@section('js')
    <script src="/libs/multiselect/js/jquery.multi-select.js"></script>
@stop


@section("vuejs")
    <script>


        const app = new Vue({ el: '#app',
            methods:{

                add_user_app:function(appid,uid)
                {

                    post_request("/serve/user/app/add",{appid:appid,uid:uid},function (res) {

                        show_success_dialog("Add User App Success","reload")

                    })
                } ,
                del_user_app:function (appid,uid) {

                    show_delete_dialog("/serve/user/app/del",{appid:appid,uid:uid});

                }

            }


        });



        $(document).ready(function(){
            $('#appSelect').multiSelect({
                selectableHeader: "<div class='custom-header'>App List</div>",
                selectionHeader: "<div class='custom-header'>User Apps</div>",

                afterSelect: function(values){
                    console.log("Select value: "+values);
                    app.add_user_app(values[0],"{{$user->uid}}");
                },
                afterDeselect: function(values){
                    console.log("Deselect value: "+values);

                    app.del_user_app(values[0],"{{$user->uid}}");
                }

            })
        })


    </script>
@stop


