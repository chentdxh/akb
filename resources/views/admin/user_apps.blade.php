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
        <div class="box-body text-center">

            <select multiple="multiple" id="my-select" name="my-select[]">
                <option value='elem_1'>elem 1</option>
                <option value='elem_2'>elem 2</option>
                <option value='elem_3'>elem 3</option>
                <option value='elem_4'>elem 4</option>

                <option value='elem_100'>elem 100</option>
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


        $(document).ready(function(){
            $('#my-select').multiSelect({
                selectableHeader: "<div class='custom-header'>App List</div>",
                selectionHeader: "<div class='custom-header'>User Apps</div>",

            })
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


