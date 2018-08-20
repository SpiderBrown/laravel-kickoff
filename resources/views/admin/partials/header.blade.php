@section('title', ucfirst($menu) )

@section('content_header')
    <h1 class="hidden-sm hidden-xs">
        {{ ucfirst($menu) }} <small>{{ ucfirst($mode) }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ (route("$menu.index"))?:'#'  }}">{{ ucfirst($menu) }}</a></li>
        <li class="active">{{ ucfirst($mode) }}</li>
    </ol>
@stop