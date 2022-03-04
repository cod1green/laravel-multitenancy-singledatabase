<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = ['name', 'description', 'uuid', 'tenant_id'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function search($filter = null)
    {
        $tables = $this->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%");

        return $tables;
    }
}
