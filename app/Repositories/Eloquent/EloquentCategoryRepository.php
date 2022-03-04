<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepository;
use App\Tenant\Scopes\TenantScope;

class EloquentCategoryRepository extends AbstractRepository implements CategoryRepository
{
    protected mixed $model = Category::class;

    public function getCategoriesByTenantUuid(string $uuid)
    {
        return $this->model
            ->withoutGlobalScope(TenantScope::class)
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('categories.*')
            ->get();
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        return $this->model
            ->where('tenant_id', $idTenant)
            ->with('tenant')
            ->withoutGlobalScope(TenantScope::class)
            ->get();
    }


    public function getCategoryFlagByTenantId(int $idTenant, string $flag)
    {
        $category = $this->model
            ->where('url', $flag)
            ->where('tenant_id', $idTenant)
            ->withoutGlobalScope(TenantScope::class)
            ->first();

        return $category;
    }
}
