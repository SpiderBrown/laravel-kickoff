<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning">{{$uNotifications->groupBy('type')->count()}}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have {{$uNotifications->count()}} notifications</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                @foreach($uNotifications as $notification)
                        <li>
                            <a href="{{route('timeline.index')}}">
                                <i class="fa {{!empty($notification->data['icon'])?$notification->data['icon']:'fa fa-circle-o bg-blue'}}"></i>
                                {{ $notification->data['title']}}
                            </a>
                        </li>

                @endforeach
                <li>
                    <a href="{{route('timeline.index')}}">
                        <i class="fa fa-user text-red"></i> Your account is ready
                    </a>
                </li>
            </ul>
        </li>
        <li class="footer"><a href="{{route('timeline.index')}}">View all</a></li>
    </ul>
</li>