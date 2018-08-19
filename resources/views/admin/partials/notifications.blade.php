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
                @foreach($uNotifications->toArray() as $notification)
                    @if($notification['type']=='App\Notifications\WelcomeMessage')
                        @foreach($notification['data'] as $key=>$data)
                            <li>
                                <a href="{{$data['url']}}">
                                    <i class="fa fa-users text-aqua"></i> {{$data['title']}}
                                    {{--{{$data['message']}}--}}
                                </a>
                            </li>
                        @endforeach
                    @endif
                @endforeach
                <li>
                    <a href="#">
                        <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                        page and may cause design problems
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                </li>
            </ul>
        </li>
        <li class="footer"><a href="#">View all</a></li>
    </ul>
</li>