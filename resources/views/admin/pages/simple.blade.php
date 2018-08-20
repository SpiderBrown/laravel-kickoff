{{! $menu="pages" }}
{{! $mode="simple" }}

@extends('adminlte::page')

@section('title', ucfirst($menu) )

@section('content_header')
<h1 class="hidden-sm hidden-xs">
    {{ ucfirst($menu) }} <small>{{ ucfirst($mode) }}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route("$menu",$mode)  }}">{{ ucfirst($menu) }}</a></li>
    <li class="active">{{ ucfirst($mode) }}</li>
</ol>
@stop()

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <h1>I am a simple Page</h1>
            <p>you can make me a crud in future. </p>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    {{--  --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script> console.log('Hi!'); </script>
@stop