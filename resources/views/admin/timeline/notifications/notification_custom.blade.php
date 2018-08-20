{{--todo:Make every detail customisable--}}
{{! $data =$notification->data}}

  <!-- timeline item -->
  <li>
    <!-- timeline icon -->
    <i class="fa {{!empty($data['icon'])?$data['icon']:'fa fa-circle-o bg-blue'}}"></i>
    <div class="timeline-item">
      <span class="time"><i class="fa fa-clock-o"></i> {{$notification->created_at->format('H:i')}}</span>

      <h3 class="timeline-header">
        <a href="{{!empty($data['title_route'])?route($data['title_route']):!empty($data['title_link'])?$data['title_link']:'#'}}">
          {{!empty($data['title'])?$data['title']:''}}</a>
          {{isset($data['title_info'])?$data['title_info']:'..'}}
      </h3>

      @if(!empty($data['content']))
      <div class="timeline-body">
        {!!$data['content']!!}
      </div>
      @endif

      @if(!empty($data['button_text']))
      <div class="timeline-footer">
        <a class={{!empty($data['button_class'])?$data['button_class']:'btn btn-primary btn-xs'}}
           href="{{!empty($data['button_route'])?route($data['button_route']):!empty($data['button_link'])?$data['button_link']:'#'}}">
          {{$data['button_text']}}
        </a>
      </div>
      @endif

    </div>
  </li>
  <!-- END timeline item -->
