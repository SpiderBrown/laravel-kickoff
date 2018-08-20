{{! $menu="timeline" }}
{{! $mode="index" }}

@extends('adminlte::page')

@include('admin.partials.header')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <ul class="timeline">

              {{! $date_grouping='' }}
              @foreach($notifications as $notification)
                  {{--todo: if not set can cause error--}}
                  @if($date_grouping !=$notification->created_at->toFormattedDateString())
                    {{! $date_grouping = $notification->created_at->toFormattedDateString() }}

                      <!-- timeline time label -->
                    <li class="time-label">
                      <span class="bg-red">
                          {{$date_grouping}}
                      </span>
                    </li>
                    <!-- /.timeline-label -->
                  @endif

                  @include("admin.timeline.notifications.notification_".$notification->data['type'])

              @endforeach


          </ul>
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