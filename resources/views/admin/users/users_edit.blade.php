{{! $menu="users" }}
{{! $mode="edit" }}

@extends('adminlte::page')

@section('title', ucfirst($menu) )

@section('content_header')
    <h1>
        {{ ucfirst($menu) }} <small>{{ ucfirst($mode) }}</small>
    </h1>
    @include('admin.partials.breadcrumb',["mode"=>$mode,"menu"=>$menu])
@stop

@section('content')

  <form action="{{ Route("$menu.update",$user->id) }}" method="POST">
      {{ csrf_field() }}
  <!-- module -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">{{ ucfirst($menu) }}</h3>
        {{--<div class="box-tools pull-right">--}}
          {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
          {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>--}}
        {{--</div>--}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      {{--<div class="row">--}}
        @include("admin.$menu.partials.form",['mode'=>$mode] )
    <!-- /.row -->
    </div>
      <!-- /.box-body -->
    <div class="box-footer">
        <a href="{{ Route("$menu.index") }}" class="btn btn-default">Cancel</a>
        <a class="btn btn-danger" href="{{ Route("$menu.destroy",$user->id) }}">Delete</a>
        <input type="submit" value="Save" class="btn btn-primary pull-right">
    </div>
  </div>
  <!-- /.box -->

  </form>

@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

  <script> console.log('Hi!'); </script>
  <script>
      var app = new Vue({
          el: '#app2',
          data: {
              dontUpdatePassword: true
          }
      });
  </script>
@stop