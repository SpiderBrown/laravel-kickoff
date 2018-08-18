{{--{{'mode: ' . $mode}}--}}
<div class="row">
    <div class="col-md-6">
      <!-- text input -->
      <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
         <label>Name</label>
         <input name="name" type="text" class="form-control" placeholder="Enter name" value="{{ $permission['name'] }}" maxlength="20" required>
          @if ($errors->has('name'))
              <span class="help-block">{{ $errors->first('name') }}</span>
          @endif
      </div>
      <!-- text input -->
      <div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}">
        <label>Display Name</label>
        <input name="display_name" type="text" class="form-control" placeholder="Enter Display Name" value="{{ $permission['display_name'] }}" required>
          @if ($errors->has('display_name'))
              <span class="help-block">{{ $errors->first('display_name') }}</span>
          @endif
      </div>

    </div>
    <!-- /.col -->

    <div class="col-md-6">
      <!-- text input -->
         <input name="id" type="hidden" disabled class="form-control" placeholder="-1" value="{{ $permission['id'] }}">
        <!-- /.input group -->
      <!-- textarea -->
      <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Enter description"> {{ $permission['description'] }} </textarea>
          @if ($errors->has('description'))
              <span class="help-block">{{ $errors->first('description') }}</span>
          @endif
      </div>
      <!-- /.form-group -->

    </div>
    <!-- /.col -->

</div>
<!-- /.row -->





