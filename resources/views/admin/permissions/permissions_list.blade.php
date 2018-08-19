{{! $menu="permissions" }}
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
              <a href="{{ route("$menu.create") }}" class="btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> New</a>
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

                  @foreach($permissions as $permission)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                      <strong>
                        <a class="link-unstyled"  href="{{ route("$menu.show",$permission->id) }}">
                          {{ $permission->display_name }}</a>
                      </strong>
                    </td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ str_limit($permission->description, $limit = 50, $end = '...') }}</td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="{{ route("$menu.show",$permission->id) }}">
                        <i class="fa fa-file"></i> view</a>
                      <a class="btn btn-sm btn-info" href="{{ route("$menu.edit",$permission->id) }}">
                        <i class="fa fa-edit"></i> Edit</a>
                      {{--<a class="btn btn-sm btn-danger" href="{{ route('permissions.destroy',$permission->id) }}">--}}
                        {{--<i class="fa fa-bin"></i> Delete</a></a>--}}
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

              <div>
                {{$permissions->render()}}
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