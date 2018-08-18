@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper" id="app">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                            </a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    @else
                        <!-- Logo -->
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                                <!-- mini logo for sidebar mini 50x50 pixels -->
                                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                                <!-- logo for regular state and mobile devices -->
                                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
                            </a>

                            <!-- Header Navbar -->
                            <nav class="navbar navbar-static-top" role="navigation">
                                <!-- Sidebar toggle button-->
                                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                                </a>
                            @endif
                            <!-- Navbar Right Menu -->
                                <div class="navbar-custom-menu">

                                    <ul class="nav navbar-nav">
                                        <!-- Notifications: style can be found in dropdown.less -->
                                        <li class="dropdown notifications-menu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-bell-o"></i>
                                                <span class="label label-warning">10</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="header">You have 10 notifications</li>
                                                <li>
                                                    <!-- inner menu: contains the actual data -->
                                                    <ul class="menu">
                                                        <li>
                                                            <a href="#">
                                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                            </a>
                                                        </li>
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


                                        <!-- User Account: style can be found in dropdown.less -->
                                        <li class="dropdown user user-menu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <img src="{{{ isset(Laratrust::user()->avatar) ? Laratrust::user()->avatar : 'https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png' }}}" class="user-image" alt="avater">
                                                <span class="hidden-xs">{{{ isset(Laratrust::user()->name) ? Laratrust::user()->name : 'guest' }}}</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- User image -->
                                                <li class="user-header">
                                                    <img src="{{{ isset(Laratrust::user()->avatar) ? Laratrust::user()->avatar : 'https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png' }}}" class="img-circle" alt="avater">

                                                    <p>
                                                        {{{ isset(Laratrust::user()->name) ? Laratrust::user()->name : 'guest' }}}
                                                        <small>Member since Nov. 2012</small>
                                                    </p>
                                                </li>
                                                <!-- Menu Body -->
                                                <li class="user-body">
                                                    <div class="row">
                                                        <div class="col-xs-4 text-center">
                                                            <a href="#">Followers</a>
                                                        </div>
                                                        <div class="col-xs-4 text-center">
                                                            <a href="#">Sales</a>
                                                        </div>
                                                        <div class="col-xs-4 text-center">
                                                            <a href="#">Friends</a>
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                </li>
                                                <!-- Menu Footer-->
                                                <li class="user-footer">
                                                    <div class="pull-left">
                                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                                    </div>
                                                    <div class="pull-right">
                                                        @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                                            <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                            </a>
                                                        @else
                                                            <a href="#"
                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                            >
                                                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                            </a>
                                                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                                                @if(config('adminlte.logout_method'))
                                                                    {{ method_field(config('adminlte.logout_method')) }}
                                                                @endif
                                                                {{ csrf_field() }}
                                                            </form>
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-fw fa-gear"></i>
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                            @if(config('adminlte.layout') == 'top-nav')
                    </div>
                    @endif
                </nav>
        </header>

    @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{{ isset(Laratrust::user()->name) ? Laratrust::user()->name : 'guest' }}}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>
    @endif

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
                <div class="container">
                @endif

                <!-- Content Header (Page header) -->
                    <section class="content-header">
                        @yield('content_header')
                    </section>

                    <!-- Main content -->
                    <section class="content">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible show">
                                {!!  session('success') !!}
                            </div>
                        @endif
                        @if(session('info'))
                            <div class="alert alert-info alert-dismissible">
                                {!! session('info') !!}
                            </div>
                        @endif
                        @if(session('warning'))
                            <div class="alert alert-warning alert-dismissible ">
                                {!! session('warning') !!}
                            </div>
                        @endif

                        @if(session('danger'))
                            <div class="alert alert-danger alert-dismissible show">
                                {!! session('danger') !!}
                            </div>
                        @endif

                        @yield('content')

                    </section>
                    <!-- /.content -->
                    @if(config('adminlte.layout') == 'top-nav')
                </div>
                <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
