{{! $menu="users" }}
{{! $mode="list" }}

@extends('adminlte::page')

@section('title', ucfirst($menu) )

@section('content_header')
  <h1>
    {{ ucfirst($menu) }} <small>{{ ucfirst($mode) }}</small>
  </h1>
  @include('admin.partials.breadcrumb',["mode"=>$mode,"menu"=>$menu])
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              {{--<h3 class="box-title">Hover Data Table</h3>--}}
              <a href="{{ route("$menu.create") }}" class="btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> New</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Active</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($users as $user)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                      <strong>
                        <a class="link-unstyled"  href="{{ route("$menu.show",$user->id) }}">
                          {{ $user->name }}</a>
                      </strong>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                      @foreach($user->roles as $role)
                        <a href="{{route('roles.show',$role->id)}}">
                          <span class="badge">{{$role->display_name}}</span><br>
                        </a>
                      @endforeach
                    </td>
                    <td style="text-align: center;">
                      @if($user->active)
                        <i class="fa fa-check text-green"></i>
                      @else
                        <i class="fa fa-close text-red"></i>
                      @endif

                    </td>
                    <td>{{ $user->created_at->toFormattedDateString() }}</td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="{{ route("$menu.show",$user->id) }}">
                        <i class="fa fa-file"></i> view</a>
                      <a class="btn btn-sm btn-info" href="{{ route("$menu.edit",$user->id) }}">
                        <i class="fa fa-edit"></i> Edit</a>
                      {{--<a class="btn btn-sm btn-danger" href="{{ route('users.destroy',$user->id) }}">--}}
                        {{--<i class="fa fa-bin"></i> Delete</a></a>--}}
                    </td>
                  </tr>  
                  @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>SN</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Active</th>
                  <th>Created Date</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>

              <div>
                {{$users->render()}}
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.box -->
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

  <!-- page script -->
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'responsive': true
      })
    })
  </script>

@stop