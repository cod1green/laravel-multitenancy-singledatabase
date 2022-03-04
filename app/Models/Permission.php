<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'permission_group');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', 'LIKE', "%{$filter}%")
                ->paginate();

        return $results;
    }

    public function groupsAvailable($filter = null)
    {
        return Group::whereNotIn('id', function($query) {
            $query->select('pg.group_id');
            $query->from('permission_group AS pg');
            $query->whereRaw("pg.permission_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('groups.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();
    }

    public function rolesAvailable($filter = null)
    {
        return Role::whereNotIn('id', function($query) {
            $query->select('permission_role.role_id');
            $query->from('permission_role');
            $query->whereRaw("permission_role.permission_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('roles.name', 'LIKE', "%{$filter}%");
        });
    }
}
