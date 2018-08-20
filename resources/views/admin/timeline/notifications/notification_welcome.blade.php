
{{--@foreach($notification as $noti)--}}
  {{! $data =$notification->data}}
  <!-- timeline item -->
  <li>
    <!-- timeline icon -->
    <i class="fa fa-comment bg-green"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{$notification->created_at->format('H:i')}}</span>

      <h3 class="timeline-header"><a href="#">{{$data['title']}}</a> {{$data['title_info']}} </h3>

      <div class="timeline-body">
        {!!$data['message']!!}
      </div>

      <div class="timeline-footer">
        <a class="btn btn-success btn-xs" href="#">Goto</a>
      </div>

    </div>
  </li>
  <!-- END timeline item -->
{{--@endforeach--}}