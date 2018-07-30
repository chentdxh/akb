

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
                    <th>名称</th>
                    <th>AppId</th>
                    <th>Token</th>
                    <th>状态</th>
                    <th  >创建时间</th>
                </tr>
                @foreach($apps as $appInfo )
                <tr>
                    <td>{{$appInfo->id}}.</td>
                    <td>{{$appInfo->name}}</td>
                    <td>{{$appInfo->appid}}</td>
                    <td>
                        <a href="#" v-on:click="show_token('{{$appInfo->token}}')">{{substr($appInfo->token,0,8)}}...</a>
                    </td>

                    <td>{{$appInfo->status}}</td>
                    <td>{{$appInfo->created_at}}</td>
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
            {{$apps->links()}}
        </div>
    </div>
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
        show_token:function(token)
        {
            swal({ input: 'textarea', inputAttributes: {
                    value: token,
                    readonly: true,
                    resize: "none"

                }  })
        }
    }


    });

    </script>
@stop


