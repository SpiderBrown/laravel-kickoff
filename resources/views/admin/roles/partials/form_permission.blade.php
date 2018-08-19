
<div class="row">
    <div class="col-md-12">
        <div>{{'mode: ' . $mode}}</div>
        <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>SN</th>
                <th>Permission Name</th>
                @foreach($action_template as $action=>$isPermit)
                    <th>{{ strtoupper($action) }} </th>
                @endforeach
            </tr>
            </thead>
            <tbody>

            @foreach($nest_permissions as $module=>$actions)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $module }}</td>
                    @foreach($action_template as $action=>$isPermit)
                        <td>
                            @foreach($permissions as $permission)
                                @if(($permission['name']==$action.'-'.$module))
                                    <input class="iCheck-helper" name="permission_id[]" type="checkbox" value="{{$permission['id']}}"

                                    @if($actions[$action])
                                        {{ ' checked' }}
                                            @else
                                        {{ ' unchecked' }}
                                            @endif
                                    >
                                @endif
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            @endforeach
            {{--</form>--}}

            </tbody>
            <tfoot>
            <tr>
                <th>SN</th>
                <th>Permission Name</th>
                @foreach($action_template as $action=>$isPermit)
                    <th>{{ strtoupper($action) }} </th>
                @endforeach
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.col -->

</div>
<!-- /.row -->






