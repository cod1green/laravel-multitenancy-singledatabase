<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = [
        'tenant_id',
        'name',
        'slug',
        'icon',
        'description'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function search($filter = null)
    {
        $categories = $this->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('categories.name', 'LIKE', "%{$filter}%");
                    $query->where('categories.description', 'LIKE', "%{$filter}%");
                    $query->orWhere('tenants.name', 'LIKE', "%{$filter}%");
                }
            })
            ->select('categories.*')
            ->latest()
            ->with('tenant');

        return $categories;
    }
}
