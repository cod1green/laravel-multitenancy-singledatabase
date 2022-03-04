<?php

namespace App\Repositories\Eloquent;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepository;

class EloquentTenantRepository extends AbstractRepository implements TenantRepository
{
    protected mixed $model = Tenant::class;

    public function getTenantByUuid(string $uuid)
    {
        // dd($this->entity->where('uuid', $uuid)->first());
        $tenant = $this->model->when(
            $uuid,
            function ($q) use ($uuid) {
                $q->where('uuid', $uuid);
            }
        )
            ->firstOrFail();

        return $tenant;
    }

    public function getTenantByFlag(string $flag)
    {
        $tenant = $this->model->when(
            $flag,
            function ($q) use ($flag) {
                $q->where('url', $flag);
            }
        )
            ->firstOrFail();

        return $tenant;
    }
}
