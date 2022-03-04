<?php
namespace App\Repositories\Eloquent;

use App\Models\Table;
use App\Repositories\Contracts\TableRepository;
use App\Tenant\Scopes\TenantScope;

class EloquentTableRepository extends AbstractRepository implements TableRepository
{
    protected mixed $model = Table::class;

    public function getTablesByTenantId(int $idTenant)
    {
        return $this->model
            ->where('tenant_id', $idTenant)
            ->withoutGlobalScope(TenantScope::class)
            ->get();
    }

    public function getTableIdentifyByTenantId(int $idTenant, string $identify)
    {
        $table = $this->model
            ->where('uuid', $identify)
            ->where('tenant_id', $idTenant)
            ->withoutGlobalScope(TenantScope::class)
            ->firstOrFail();

        return $table;
    }

    public function getTablesSearch(int $idTenant, string $filter)
    {
        return $this->model
            ->where('tenant_id', $idTenant)
            ->where('name', 'LIKE', "%{$filter}%")
            ->withoutGlobalScope(TenantScope::class)
            ->paginate(10);
    }
}
