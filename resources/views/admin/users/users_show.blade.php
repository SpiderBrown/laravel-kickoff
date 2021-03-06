{{! $menu="users" }}
{{! $mode="show" }}

@extends('adminlte::page')

@include('admin.partials.header')

@section('content')

    {{--  --}}
    <!-- user -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Details</h3>

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
              <a href="{{ Route("$menu.edit",[$user['id']]) }}" class="btn btn-info pull-right">Edit</a>
        </div>
      </div>
      <!-- /.box -->

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
      .form-control{
        {{-- border:0px; --}}
      }
    </style>
@stop

@section('js')

<script> console.log('Hi!'); </script>

@stop


