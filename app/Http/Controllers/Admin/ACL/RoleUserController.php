<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\{
    Role,
    User
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    protected $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
        
        $this->middleware(['can:users']);
    }

    /**
     * User x Role
     */
    public function roles($idUser)
    {
        $user = $this->verifyUser($idUser);

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.index', compact('user', 'roles'));
    }

    public function userRoleAvailable(Request $request, $idUser)
    {
        $filters = $request->except('_token');

        $user = $this->verifyUser($idUser);

        $roles = $user->userRoleAvailable($request->filter)->paginate();

        return view('admin.pages.users.roles.available', compact('user', 'roles', 'filters'));
    }

    public function attachUserRole(Request $request, $idUser)
    {
        $user = $this->verifyUser($idUser);

        $roles = $request->roles;

        if (!$roles || count($roles) < 0) {
            return redirect()->back()->with('info', __('messages.choose_one_option')); 
        }

        $user->roles()->attach($roles);

        return redirect()->route('users.roles', $user->id)->with('message', __('messages.record_linked'));
    }

    public function detachUserRole($idUser, $idRole)
    {
        $user = $this->verifyUser($idUser);
        $role = $this->verifyRole($idRole);

        $user->roles()->detach($role);

        return redirect()->route('users.roles', $user->id)->with('message', __('messages.record_linked'));
    }

    /**
     * Roles x users
     */
    public function users($idRoles)
    {
        $role = $this->verifyRole($idRoles);

        $users = $role->users()->where('tenant_id', auth()->user()->tenant_id)->paginate();

        return view('admin.pages.roles.users.index', compact('users', 'role'));
    }

    public function roleUserAvailable(Request $request, $idRole)
    {
        $filters = $request->except('_token');

        $role = $this->verifyRole($idRole);

        $users = $role->roleUserAvailable($request->filter)->paginate();

        return view('admin.pages.roles.users.available', compact('users', 'role', 'filters'));
    }

    public function attachRoleUser(Request $request, $idRole)
    {
        $role = $this->verifyRole($idRole);

        $users = $request->users;

        if (!$users || count($users) < 0) {
            return redirect()->back()->with('info', __('messages.choose_one_option')); 
        }

        $role->users()->attach($users);

        return redirect()->route('roles.users', $role->id)->with('message', __('messages.record_linked'));
    }

    public function detachRoleUser($idRole, $idUser)
    {
        $user = $this->verifyUser($idUser);
        $role = $this->verifyRole($idRole);

        $role->users()->detach($user);

        return redirect()->route('roles.users', $role->id)->with('message', __('messages.record_linked'));
    }

    /**
     * Helpers
     */
    public function verifyUser($idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $user;
    }    
    
    public function verifyRole($idRole)
    {
        if (!$role = $this->role->find($idRole)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $role;
    }
}
