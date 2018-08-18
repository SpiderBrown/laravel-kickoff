{{--{{'mode: ' . $mode}}--}}
<div class="row" id="app2">
    <div class="col-md-6">

        <!-- text input -->
        <input name="id" type="hidden" disabled class="form-control" placeholder="-1" value="{{ $user->id }}">

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label>
            <img src="https://www.shareicon.net/data/2016/05/26/771189_man_512x512.png" class="img-circle img-lg" alt="User Image">
            </label>
            <p>{{$user->name}}
                <span class="hep-block has-success"> <small> - Member since {{$user->created_at->toFormattedDateString()}}</small></span>
            </p>
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
            <input v-if="!dontUpdatePassword" name="password" type="password" class="form-control" placeholder="" >
            <p>
                <input name="dontUpdatePassword" v-model="dontUpdatePassword" type="checkbox" >
                <span>Dont Update Password</span>
            </p>
            @if ($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>

    </div>
    <!-- /.col -->

    <div class="col-md-6">
        @if($mode=="show")
            <!-- text input -->
            <div class="form-group">
                <label>Roles</label>
                <ul>
                    @forelse ($user->roles as $role)
                        <li>{{$role->display_name}} - ({{$role->description}})</li>
                    @empty
                        <p>This user has not been assigned any roles yet</p>
                    @endforelse
                </ul>
            </div>
        @else

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
                        </li>
                    @endforeach
                </div>
        @endif
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





