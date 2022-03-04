<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Group;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupPermissionController extends Controller
{
    protected $group, $permission;
    
    public function __construct(Group $group, Permission $permission)
    {
        $this->group = $group;
        $this->permission = $permission;

        $this->middleware(['can:groups']);
    }

    /**
     * Groups x Permission
     */
    public function groups ($idPermission) 
    {
        $permission = $this->verifyPermission($idPermission);

        $groups = $permission->groups()->paginate();

        return view('admin.pages.permissions.groups.index', compact('groups', 'permission'));
    }
    
    public function groupsAvailable(Request $request, $idPermission)
    {
        $permission = $this->verifyPermission($idPermission);
        
        $filters = $request->except('_token');

        $groups = $permission->groupsAvailable($request->filter);

        return view('admin.pages.permissions.groups.available', compact('groups', 'permission', 'filters'));
    }

    public function groupPermissionsAttach(Request $request, $idGroup)
    {
        $group = $this->verifyGroup($idGroup);

        $permissions = $request->permissions;

        if(!$permissions || count($permissions) == 0){
            return redirect()->back()->with('info', __('messages.choose_one_option'));
        }

        $group->permissions()->attach($permissions);

        return redirect()->route('groups.permissions', $group->id)->with('message', __('messages.record_linked'));
    }

    public function groupPermissionsDetach ($idGroup, $idPermission) 
    {
        $group = $this->verifyGroup($idGroup);
        
        $permission = $this->verifyPermission($idPermission);

        $group->permissions()->detach($permission);

        return redirect()->route('groups.permissions', $group->id)->with('message', __('messages.record_unlinked'));
    }

    /**
     * Permission x groups
     */

    public function permissions($idGroup)
    {
        $group = $this->verifyGroup($idGroup);

        $permissions = $group->permissions()->paginate();

        return view('admin.pages.groups.permissions.index', compact('group', 'permissions'));
    }

    public function permissionsAvailable(Request $request, $idGroup)
    {
        $group = $this->verifyGroup($idGroup);
        
        $filters = $request->except('_token');

        $permissions = $group->permissionsAvailable($request->filter)->paginate();

        return view('admin.pages.groups.permissions.available', compact('group', 'permissions', 'filters'));
    }

    public function permissionsGroupAttach(Request $request, $idPermission)
    {
        $permission = $this->verifyPermission($idPermission);

        $groups = $request->groups;

        if (!$groups || count($groups) == 0) {
            return redirect()->back()->with('info', __('messages.choose_one_option'));
        }

        $permission->groups()->attach($groups);

        return redirect()->route('permissions.groups', $permission->id)->with('message', __('messages.record_linked'));;
    }

    public function permissionGroupsDetach ($idGroup, $idPermission) 
    {
        $permission = $this->verifyPermission($idPermission);

        $group = $this->verifyGroup($idGroup);

        $permission->groups()->detach($group);

        return redirect()->route('groups.permissions', $permission->id)->with('message', __('messages.record_unlinked'));
    }

    public function verifyGroup($idGroup) {
        if (!$group = $this->group->find($idGroup)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $group;
    }    
    
    public function verifyPermission($idPermission) {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $permission;
    }
}
