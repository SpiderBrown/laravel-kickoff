<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public $action_template=array("access"=>false,"create"=>false,"read"=>false,"update"=>false,"delete"=>false);

    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        $roles = Role::all();
        $params = [
            'title' => 'Roles Listing',
            'roles' => $roles,
        ];
        return view('admin.roles.roles_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        $role=new Role;
        $params = [
            'title' => 'Create Roles',
            'permissions' => $permissions,
            'role' => $role,
            'action_template' => $this->action_template,
            'nest_permissions' =>$this->getCustomNestedPermission()
        ];
        \Debugbar::info($params);
        return view('admin.roles.roles_create')->with($params);
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
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'display_name' => 'required',
            'description' => 'required',
        ]);
        $role = Role::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ]);

        $permission_ids = $request->input('permission_id');
//        dump($role->id."new roleid");
//
//        dump($permission_ids);
//        die;
        $this->storePermissions($permission_ids,$role->id);

        $request->session()->flash('success', "$role->name Role created Successfully!");

        return redirect()->route('roles.index')->with('success', "The role <strong>$role->name</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        //
        try {
            $role = Role::findOrFail($id);
            $result=array();
            $action_template=array("access"=>0,"create"=>0,"read"=>0,"update"=>0,"delete"=>0);

            $nest_permissions=$this->getCustomNestedPermission($id);

            $params = [
                'title' => 'Show Role',
                'role' => $role,
                'action_template'=>$action_template,
                'permissions' => Permission::all()->toArray(),
                'nest_permissions'=>$nest_permissions,
                'role_permissions' => $role_permissions = $role->permissions()->get()->pluck('id')->toArray()
            ];

            \Debugbar::info($params);
            return view('admin.roles.roles_show')->with($params);
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
            $role = Role::findOrFail($id);
            $permissions = Permission::all();
            $role_permissions = $role->permissions()->get();

            $nest_permissions=$this->getCustomNestedPermission($id);

            $params = [
                'title' => 'Edit Role',
                'role' => $role,
                'permissions' => $permissions,
                'role_permissions' => $role_permissions,
                'action_template'=>$this->action_template,
                'nest_permissions'=>$nest_permissions
            ];
            \Debugbar::info($params);
            return view('admin.roles.roles_edit')->with($params);
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
            $role = Role::findOrFail($id);
            $this->validate($request, [
                'display_name' => 'required',
                'description' => 'required',
            ]);
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            $role->save();

            $permission_ids=$request->input('permission_id');

            $this->storePermissions($permission_ids,$role->id);

            $request->session()->flash('success', 'Role Updated Successfully!');
            return redirect()->route('roles.index')->with('success', "The role <strong>$role->name</strong> has successfully been updated.");
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
    public function destroy($id, Request $request)
    {
        //
        try {
            $role = Role::findOrFail($id);
            //$role->delete();
            // Force Delete
            $role->users()->sync([]); // Delete relationship data
            $role->permissions()->sync([]); // Delete relationship data
            $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
            $request->session()->flash('success', 'Role Updated Successfully!');
            return redirect()->route('roles.index')->with('success', "The Role <strong>$role->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    private function getCustomNestedPermission($id=null){
        //todo: move to a services, and optimize

        $permissions = Permission::all();
        if($id==null) {//for new empty user
            $role = new \stdClass();
            $role_permissions=array(new \stdClass());
        }else {
            $role = Role::findOrFail($id);
            $role_permissions = $role->permissions()->get();
            if(!$role_permissions->count())  //in case role already created without any permision
                $role_permissions=array(new \stdClass());
        }


        \Debugbar::info($role_permissions);
        $nest_permissions=array();
        $action_template=$this->action_template;
        foreach ($permissions as $permission){
            list ($action,$module) = explode('-',$permission->name);
            foreach ($role_permissions as $r_permission){
                if(!isset($nest_permissions[$module])) //if no module index yet, add template
                    $nest_permissions[$module]=$action_template;

                if(isset($r_permission->name) AND isset($permission->name) AND $permission->name===$r_permission->name) //role has permission
                    $nest_permissions[$module][$action] = true;

            }

        }

        //remove non db existing permissions: opt
        foreach ($nest_permissions as $module=>$actions) {
            foreach ($actions as $action => $isP) {
                if (!array_key_exists("$action-$module", $permissions->groupBy('name')->toArray()))
                    unset($nest_permissions[$module][$action]);
            }

        }

        return $nest_permissions;
    }

    private function storePermissions(array $permission_ids,$role_id){
        //todo: Add permission here
        try {
            $role = Role::findOrFail($role_id);
            DB::table("permission_role")->where("permission_role.role_id", $role_id)->delete();
            // Attach permission to role
            foreach ($permission_ids as $key => $value) {
                $role->attachPermission($value);
            }

        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                //$request->session()->flash('error','No valid Role found to Add permissions!');
                return response()->view('errors.' . '404');
            }
        }
    }
}
