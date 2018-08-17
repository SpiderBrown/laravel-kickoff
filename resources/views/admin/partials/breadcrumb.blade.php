<ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route("$menu.index")  }}">{{ ucfirst($menu) }}</a></li>
    <li class="active">{{ ucfirst($mode) }}</li>
</ol>