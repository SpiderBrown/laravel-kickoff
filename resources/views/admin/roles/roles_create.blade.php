{{! $menu="roles" }}
{{! $mode="create" }}

@extends('adminlte::page')

@include('admin.partials.header')

@section('content')

  <!-- Role -->
  <form action="{{ Route('roles.store') }}" method="POST">
    {{ csrf_field() }}
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

        {{--form--}}
        @include('admin.roles.partials.form',['mode'=>'add'])

      </div>
      <!-- /.box-body -->

    </div>
    <!-- /.box -->

    {{-- permissions --}}

    {{-- Permission --}}
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Assign Permission</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      {{--<div class="row">--}}
      @include('admin.roles.partials.form_permission',['mode'=>$mode] )
      <!-- /.row -->
      </div>
      <!-- /.box-body -->

    </div>
    <!-- /.box -->

    <div class="box-footer">
      <a href="#" class="btn btn-default">Cancel</a>
      <input type="submit" value="Save" class="btn btn-primary pull-right">
    </div>
  </form>
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

  <script> console.log('Hi!'); </script>

@stop
