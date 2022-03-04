<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionRoleController extends Controller
{
    protected $role, $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(['can:roles']);
    }

    /**
     * Roles x Permissions
     */
    public function permissions($idRole)
    {
        if (!$role = $this->role->find($idRole)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.index', compact('role', 'permissions'));
    }

    public function permissionsAvailable(Request $request, $idRole)
    {
        $filters = $request->except('_token');

        $role = $this->verifyRole($idRole);

        $permissions = $role->permissionsAvailable($request->filter)->paginate();

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions', 'filters'));
    }

    public function attachPermissionsRole(Request $request, $idRole) 
    {
        $role = $this->verifyRole($idRole);

        $permissions = $request->permissions;

        if (!$permissions || count($permissions) == 0) {
            return redirect()->back()->with('info', __('messages.choose_one_option'));
        }

        $role->permissions()->attach($permissions);

        return redirect()->route('roles.permissions', $role->id)->with('message', __('messages.record_linked'));
    }

    public function rolePermissionDetach($idRole, $idPermission)
    {
        $role = $this->verifyRole($idRole);
        $permission = $this->verifyPermission($idPermission);

        $role->permissions()->detach($permission);

        return redirect()->route('roles.permissions', $role->id)->with('message', __('messages.record_unlinked'));
    }

    /**
     * Permissions x Roles
     */
    public function roles($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        $roles = $permission->roles()->paginate();

        return view('admin.pages.permissions.roles.index', compact('roles', 'permission'));
    }

    public function rolesAvailable(Request $request, $idPermission)
    {
        $filters = $request->except('_token');

        $permission = $this->verifyPermission($idPermission);

        $roles = $permission->rolesAvailable($request->filter)->paginate();

        return view('admin.pages.permissions.roles.available', compact('roles', 'permission', 'filters'));
    }

    public function attachRolesPermission(Request $request, $idPermission)
    {
        $permission = $this->verifyPermission($idPermission);
        $role = $request->roles;

        if (!$role || count($role) < 0) {
            return redirect()->back()->with('info', __('messages.choose_one_option'));            
        }

        $permission->roles()->attach($role);

        return redirect()->route('permissions.roles', $permission->id)->with('message', __('messages.record_linked'));
    }

    public function permissionRoleDetach($idRole, $idPermission)
    {
        $role = $this->verifyRole($idRole);
        $permission = $this->verifyPermission($idPermission);

        $permission->roles()->detach($role);

        return redirect()->route('permissions.roles', $permission->id)->with('message', __('messages.record_unlinked'));
    }

    /**
     * Helper
     */
    public function verifyRole($idRole) {
        if (!$role = $this->role->find($idRole)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $role;
    }

    public function verifyPermission($idPermission) {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $permission;
    }

}
