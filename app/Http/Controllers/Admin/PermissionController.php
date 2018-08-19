<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public $rules=[
        'display_name' => 'required|max:255',
        'name' => 'required|max:255|alphadash|unique:permissions,name',
        'description' => 'sometimes|max:255'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::paginate(config('PAGINATION_MAX_REC',10));
        //dd($users);
        $params = [
            'title' => 'Permissions Listing',
            'permissions' => $permissions,
        ];
        return view('admin.permissions.permissions_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $params = [
            'title' => 'Create Permission',
            'permission' => new Permission()
        ];
        return view('admin.permissions.permissions_create')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->permission_type == 'access') {
            $this->validateWith($this->rules);

            $permission = new Permission();
            $permission->name = $request->name;
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            $permission->save();
            Session::flash('success', 'Permission has been successfully added');
            return redirect()->route('permissions.index');
        } elseif ($request->permission_type == 'crud') {
            $this->validateWith([
                'resource' => 'required|min:3|max:100|alpha'
            ]);
            $crud = explode(',', $request->crud_selected);
            if (count($crud) > 0) {
                foreach ($crud as $x) {
                    $slug = strtolower($x) . '-' . strtolower($request->resource);
                    $display_name = ucwords($x . " " . $request->resource);
                    $description = "Allows a user to " . strtoupper($x) . ' a ' . ucwords($request->resource);
                    $permission = new Permission();
                    $permission->name = $slug;
                    $permission->display_name = $display_name;
                    $permission->description = $description;
                    $this->validateCrud($permission->toArray());
                    $permission->save();
                }
                Session::flash('success', 'Permissions were all successfully added');
                return redirect()->route('permissions.index');
            }
        } else {
            return redirect()->route('permissions.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);
            $params = [
                'title' => 'Delete Permission',
                'permission' => $permission,
            ];
            return view('admin.permissions.permissions_show')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);
            $params = [
                'title' => 'Edit Permission',
                'permission' => $permission,
            ];
            //dd($role_permissions);
            return view('admin.permissions.permissions_edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);
            $this->validate($request, [
                'display_name' => 'required',
                'description' => 'required',
            ]);
            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');
            $permission->save();
            return redirect()->route('permissions.index')->with('success', "The permission <strong>$permission->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);
            DB::table("permission_role")->where('permission_id', $id)->delete();
            //OR $permission->role()->sync([]);
            $permission->delete();

            return redirect()->route('permissions.index')->with('success', "The Role <strong>$permission->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

  private function validateCrud($permission){
      \Validator::make($permission, $this->rules)->validate();
  }
}
