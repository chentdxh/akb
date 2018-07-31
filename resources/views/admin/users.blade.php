{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
    <div class="box ">
        <div class="box-header with-border">
            <i class="fa fa-info"></i>

            <h3 class="box-title">App Description</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>AppId </dt>
                <dd>{{$app_info->appid}}</dd>
                <dt>Name</dt>
                <dd>{{$app_info->name}}</dd>

                <dt>Owner</dt>
                <dd>{{$app_info->uid}}</dd>

                <dt>Created At</dt>
                <dd>{{$app_info->created_at}}</dd>

                <dt>Token</dt>
                <dd>{{$app_info->token}}</dd>

            </dl>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop