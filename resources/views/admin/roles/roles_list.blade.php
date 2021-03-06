{{! $menu="roles" }}
{{! $mode="list" }}

@extends('adminlte::page')

@include('admin.partials.header')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              {{--<h3 class="box-title">Hover Data Table</h3>--}}
              <a href="{{ route('roles.create') }}" class="btn-sm btn-primary pull-right">New</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($roles as $role)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                      <strong>
                        <a class="link-unstyled"  href="{{ route("$menu.show",$role->id) }}">
                          {{ $role->display_name }}</a>
                      </strong>
                    </td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ str_limit($role->description, $limit = 50, $end = '...') }}</td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="{{ route("$menu.show",$role->id) }}">
                        <i class="fa fa-file"></i> view</a>
                      <a class="btn btn-sm btn-info" href="{{ route("$menu.edit",$role->id) }}">
                        <i class="fa fa-edit"></i> Edit</a>
                        {{--<a class="btn-danger" href="{{ route('roles.destroy',$role['id']) }}">[x]</a> &nbsp--}}
                    </td>
                  </tr>  
                  @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>SN</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
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