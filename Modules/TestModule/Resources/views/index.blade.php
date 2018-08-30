@extends('adminlte::page')

@section('title', config('testmodule.name') )

@section('content_header')
    <h1 class="hidden-sm hidden-xs">
        Module <small>{{ config('testmodule.name') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ strtolower(config('testmodule.name'))  }}">{{ config('testmodule.name') }}</a></li>
        <li class="active">Index</li>
    </ol>
@stop()

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('testmodule.name') !!}
    </p>
@stop
