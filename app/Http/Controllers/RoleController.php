<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role  $role)
    {
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role  $role)
    {
        $role->delete();
        return redirect()->route('role.index');
    }

    /**
     * Display the permissions of the an especific role
     */
    public function permissions(Role $role)
    {
       $permissions  = Permission::all();

       foreach($permissions as $permission) {
           if ($role->hasPermissionTo($permission->id)) {
               $permission->can = true;
           } else {
               $permission->can = false;
           }
       }

       return view('roles.permissions', compact('role', 'permissions'));
    }

    /**
     *
     */
    public function permissionsSync(Request $request, Role $role)
    {
        $permissionsRequest = $request->except(['_token', '_method']);

        foreach($permissionsRequest as $key => $value) {
            $permissions[] = Permission::findById($key);
        }

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions(null);
        }

        return redirect()->route('role.permissions', compact('role'));
    }
}
