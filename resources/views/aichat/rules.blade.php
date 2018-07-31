

@extends('adminlte::page')

@section('title', 'Ai Rules')

@section('content_header')
    <h1>App 管理</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">App列表</h3>

            <div class="box-tools">

                <a type="button" class="btn   btn-default btn-sm  pull-right" data-toggle="modal" data-target="#addRuleDialog">添加</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>

                <tr>
                    <th style="width: 10px">#</th>
                    <th>AppId</th>

                    <th>规则</th>

                    <th>操作</th>
                </tr>
                @foreach($rules as $rule )
                <tr>
                    <td>{{$rule->id}}.</td>
                    <td>
                        {{$rule->appid}}
                    </td>

                    <td>{{$rule->rule}}</td>

                    <td>

                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/app/edit?id={{$rule->id}}">编辑</a></li>
                                <li><a href="#" v-on:click="del_rule('{{$rule}}')">删除</a></li>
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




    <div class="modal fade" id="addRuleDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Rule </h4>
                </div>
                <div class="modal-body">
                    <form id="ruleForm">

                        <div class="form-group">
                            <label for="inputAppId">appid</label>
                            <input type="text" name="appid" class="form-control" id="inputAppId" placeholder="AppId">
                        </div>

                        <div class="form-group">
                            <label for="inputName">rule</label>
                            <input type="text" name="rule" class="form-control" id="inputName" placeholder="rule">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="add_rule">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop



@section("vuejs")
    <script >
        const app = new Vue({ el: '#app',
            methods:{

                add_rule:function(){

                    post_request("/serve/aichat/rule/add",$("#ruleForm").serialize(),function (res) {
                        show_success_dialog("Add Rule Success","reload")
                    })


                },
                del_rule:function (rule) {
                   show_delete_dialog("/serve/aichat/rule/del",{escape_str:rule,remove:true},"reload");

                },
                del_app:function (appid) {

                    show_delete_dialog("/serve/app/del",{appid:appid});

                }
            }


        });

    </script>
@stop






