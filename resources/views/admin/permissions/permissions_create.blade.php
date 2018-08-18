{{! $menu="permissions" }}
{{! $mode="create" }}

@include('admin.partials.header')

@section('content')

    <!-- Role -->
    <form action="{{ Route("$menu.store") }}" method="POST">
        {{ csrf_field() }}
        <div class="box box-default" id="permission">
            <div class="box-header with-border">
                <h3 class="box-title">Details</h3>
                {{--<div class="box-tools pull-right">--}}
                {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>--}}
                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>--}}
                {{--</div>--}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input name="permission_type" type="radio" v-model="permissionType" value="access">
                                            Access Permission
                                        </label>
                                    </div>
                                </div>
                                <!-- text input -->
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input name="permission_type" type="radio" v-model="permissionType" value="crud">
                                            CRUD Permissions
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12" v-if="permissionType == 'access'">
                                <!-- text input -->
                                <h1 v-text="permissionType"></h1>

                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}" >
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" v-model="accessInput">
                                    <div v-if="accessInput.length >= 3">
                                        <strong><p v-text="accessName('access')"></p></strong>
                                    </div>
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


                            <div class="col-md-6" v-if="permissionType == 'crud'">
                                <!-- /.input group -->
                                <div class="form-group {{ $errors->has('resource') ? ' has-error' : '' }}">
                                    <label>Resource</label>
                                    <input id="resource" v-model="resource" name="resource" type="text" class="form-control" placeholder="Enter Resource Name" >
                                    @if ($errors->has('resource'))
                                        <span class="help-block">{{ $errors->first('resource') }}</span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                                <div class="columns" v-if="permissionType == 'crud'">
                                    <div class="column is-one-quarter">
                                        <div class="field">
                                            <input type="checkbox" v-model="crudSelected" value="create">Create</input>
                                        </div>
                                        <div class="field">
                                            <input type="checkbox" v-model="crudSelected" v-model="crudSelected" value="read">Read</input>
                                        </div>
                                        <div class="field">
                                            <input type="checkbox" v-model="crudSelected" value="update">Update</input>
                                        </div>
                                        <div class="field">
                                            <input type="checkbox" v-model="crudSelected" value="delete">Delete</input>
                                        </div>
                                    </div> <!-- end of .column -->
                                    <input type="hidden" name="crud_selected" :value="crudSelected">
                                </div>
                            </div>


                            <div class="col-md-6" v-if="permissionType == 'crud' && resource.length >= 3 && crudSelected.length > 0">
                                <h4>Results</h4>
                                <p>The following Permissions would be created after saving</p>
                                <table class="table" >
                                    <thead>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in crudSelected">
                                        <td v-text="crudName(item)"></td>
                                        <td v-text="crudSlug(item)"></td>
                                        <td v-text="crudDescription(item)"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>

            </div>

            <div class="box-footer">
                <a href="{{route("$menu.index")}}" class="btn btn-default">Cancel</a>
                <input type="submit" value="Save" class="btn btn-primary pull-right">
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
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
        el: '#permission',
        data: {
            permissionType: 'access',
            resource: '',
            accessInput: '',
            crudSelected: ['create', 'read', 'update', 'delete']
        },
        methods: {
            crudName: function(item) {
                return item.substr(0,1).toUpperCase() + item.substr(1) + " " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
            },
            crudSlug: function(item) {
                return item.toLowerCase() + "-" + app.resource.toLowerCase();
            },
            crudDescription: function(item) {
                return "Allow a User to " + item.toUpperCase() + " a " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
            },
            accessName: function(item) {
                return item.toLowerCase() + "-" + app.accessInput.toLowerCase();
            }
        }
    });
</script>
@stop
