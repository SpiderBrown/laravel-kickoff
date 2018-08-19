{{! $menu="users" }}
{{! $mode="create" }}

@extends('adminlte::page')

@include('admin.partials.header')

@section('content')

    <form action="{{ Route("$menu.store") }}" method="POST">
    {{ csrf_field() }}
    <!-- module -->
        <div class="box box-default" id="app2">
            <div class="box-header with-border">
                <h3 class="box-title">{{ ucfirst($menu) }}</h3>
                {{--<div class="box-tools pull-right">--}}
                {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>--}}
                {{--</div>--}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{--{{'mode: ' . $mode}}--}}
                <div class="row">
                    <div class="col-md-6">

                        <!-- text input -->
                        <input name="id" type="hidden" disabled class="form-control" placeholder="-1" value="{{ $user->id }}">

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>
                                <img src="https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png" class="img-circle img-lg" alt="User Image">
                            </label>
                            {{--<input name="avater" class="form-control" type="file">--}}
                        </div>


                        <!-- text input -->
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter name" value="{{ $user->name }}" maxlength="20" required>
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <!-- text input -->
                        <div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" placeholder="Enter email" value="{{ $user->email }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <!-- text input -->
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Password</label>
                            <input v-if="!auto_password" name="password" type="password" class="form-control" placeholder="">
                            <p>
                                <input name="auto_password" v-model="auto_password" type="checkbox" >
                                <span>Auto Generate Password</span>
                            </p>
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                    </div>
                    <!-- /.col -->

                    <div class="col-md-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Roles</label>
                            @foreach($roles as $role)
                                <li>
                                    <label for="roles_id">
                                        <input type="checkbox" name="roles_id[]" value="{{$role->id}}"
                                        @foreach($user->roles as $u_roles)
                                            @if($role->id==$u_roles->id)
                                                {{' checked'}}
                                                    @endif
                                                @endforeach
                                        />
                                        {{$role->display_name}}
                                    </label>
                                    <span> - ({{$role->description}})</span>
                                </li>
                            @endforeach
                        </div>
                        <!-- checkbox input -->
                        <div class="form-group checkbox {{ $errors->has('active') ? ' has-error' : '' }}">
                            <div class="checkbox">
                                <label>
                                    <input name="active" type="checkbox" {{($user->active)?' checked':''}}>
                                    Active
                                </label>
                                @if ($errors->has('active'))
                                    <span class="help-block">{{ $errors->first('active') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ Route("$menu.index") }}" class="btn btn-default">Cancel</a>
                {{--<a class="btn btn-danger" href="{{ Route("$menu.destroy",$user->id) }}">Delete</a>--}}
                <input type="submit" value="Save" class="btn btn-primary pull-right">
            </div>
        </div>
        <!-- /.box -->

    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script> console.log('Hi!'); </script>
    <script>
        var app = new Vue({
            el: '#app2',
            data: {
                auto_password: true
            }
        });
    </script>

@stop