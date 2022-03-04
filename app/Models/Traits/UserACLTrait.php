<?php

namespace App\Models\Traits;

use App\Models\Role;
use App\Models\Tenant;

trait UserACLTrait
{
    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions(), true);
    }

    public function permissions(): array
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        return array_intersect($permissionsRole, $permissionsPlan);
    }

    public function permissionsPlan(): array
    {
        $tenant = Tenant::with('plan.groups.permissions')->where('id', $this->tenant_id)->first();

        $plan = $tenant->plan ?? null;

        $permissions = [];

        if ($plan) {
            foreach ($plan->groups as $group) {
                foreach ($group->permissions as $permission) {
                    $permissions[] = $permission->name;
                }
            }
        }

        return $permissions;
    }

    public function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();

        $permissions = [];
        foreach($roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissions[] = $permission->name;
            }
        }

        return $permissions;
    }

    public function isNotAdmin(): bool
    {
        return !$this->isAdmin();
    }

    public function isAdmin(): bool
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->id === Role::SASS) {
                return true;
            }
        }

        return false;
    }
}
