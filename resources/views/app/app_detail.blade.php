{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>App Detail</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <i class="fa fa-text-width"></i>

            <h3 class="box-title">App Description</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <dl class="dl-horizontal">
                <dt>AppId </dt>
                <dd>{{$app_info->appid}}</dd>
                <dt>Name</dt>
                <dd>{{$app_info->name}}</dd>

                <dt>Created At</dt>
                <dd>{{$app_info->created_at}}</dd>

            </dl>
        </div>
        <!-- /.box-body -->
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/custom.css">
@stop

@section('js')

@stop