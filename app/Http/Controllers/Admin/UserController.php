<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(config('PAGINATION_MAX_REC',10));

        $params = [
            'title' => 'Users Listing',
            'users' => $users,
        ];
        return view('admin.users.users_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        $user = new User;
        $params = [
            'title' => 'Create User',
            'roles' => $roles,
            'user' => $user
        ];
        return view('admin.users.users_create')->with($params);
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

        $auto_password=false;
        if($request->has('auto_password'))
            $password = $auto_password = str_random(6);
        else
            $password = $request->input('password');


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
        ]);



        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'active' => $request->input('active')?true:false,
            'password' => Hash::make($password),
        ]);

        // Update role of the user !espected though
        $roles = $user->roles;
        foreach ($roles as $key => $value) {
            $user->detachRole($value);
        }

        $role_ids = Role::find($request->input('roles_id'));
        if($role_ids) {
            foreach ($role_ids as $role_id) {
                $user->attachRole($role_id);
            }
        }


        $withPassword=($auto_password)?'with Auto Password <strong>'.$auto_password.'</strong>':'';


        return redirect()->route('users.index')
            ->with('success', "The user <strong>$user->name</strong> has successfully been created. ".$withPassword.
                "<a class='btn btn-sm btn-info' style='float:right;' href='".route('users.show',$user->id)."'>View</a>");
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
            $user = User::findOrFail($id);
            $params = [
                'title' => 'Show User',
                'user' => $user,
            ];
            return view('admin.users.users_show')->with($params);
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
            $user = User::findOrFail($id);
            //$roles = Role::all();
            $roles = Role::with('permissions')->get();
            $permissions = Permission::all();
            $params = [
                'title' => 'Edit User',
                'user' => $user,
                'user_roles' => $roles,
                'roles' => Role::all(),
                'permissions' => $permissions,
            ];
            return view('admin.users.users_edit')->with($params);
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
            $user = User::findOrFail($id);
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);
            //todo:add password b-rules
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->active =$request->input('active')?true:false;
            if(!$request->has('dontUpdatePassword'))
                $user->password = Hash::make($request->input('password'));
            $user->save();
            // Update role of the user
            $roles = $user->roles;
            foreach ($roles as $key => $value) {
                $user->detachRole($value);
            }
            $role_ids = Role::find($request->input('roles_id'));
            foreach ($role_ids as $role_id){
                $user->attachRole($role_id);
            }
            // Update permission of the user
            //$permission = Permission::find($request->input('permission_id'));
            //$user->attachPermission($permission);
            return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been updated.");
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
            $user = User::findOrFail($id);
            // Detach from Role
            $roles = $user->roles;
            foreach ($roles as $key => $value) {
                $user->detachRole($value);
            }
            $user->delete();
            return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }

    }
}
