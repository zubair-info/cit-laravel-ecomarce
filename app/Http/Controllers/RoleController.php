<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    //

    public function role_manager()
    {
        $roles = Role::all();
        $permission = Permission::all();
        $users = User::all();
        return view('admin.role.index', [
            'permission' => $permission,
            'roles' => $roles,
            'users' => $users,
        ]);
    }

    // add permission
    public function add_permission(Request $request)
    {
        $permission = Permission::create(['name' => $request->permission_name]);
        return back();
    }

    // add role
    public function add_role(Request $request)
    {
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission);
        return back();
    }

    // assign role
    public function assign_role(Request $request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        return back();
    }

    // edit permisssion
    public function edit_permissions($user_id)
    {
        $permissions = Permission::all();
        $user_info = User::find($user_id);
        return view('admin.role.edit', [
            'permissions' => $permissions,
            'user_info' => $user_info,
        ]);
    }

    // add o=permission
    public function update_permission(Request $request)
    {

        $user = User::find($request->user_id);
        $user->syncPermissions($request->permission);
        return redirect()->route('role.manager');
    }
}
